<?php

namespace App\Services;

use App\DTOs\ForecastApiData;
use App\DTOs\ForecastItemData;
use App\Exceptions\WeatherApiException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected string $appId;
    protected string $apiUrl;
    protected int $cachePeriod = 180; // 3 hours

    public function __construct()
    {
        $this->appId = config('services.weather.app_id');
        $this->apiUrl = config('services.weather.api_url');
        $this->cachePeriod = config('services.weather.cache_period');
    }

    /**
     * @throws ConnectionException
     * @throws WeatherApiException
     */
    public function getForecastByCity(string $city): ForecastApiData
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get(
            $this->apiUrl,
            [
                'units' => 'metric',
                'appid' => $this->appId,
                'q' => $city
            ]
        );

        $forecastData = $response->json();

        if (!$response->successful()) {
            throw new WeatherApiException($forecastData['message']);
        }

        $firstDateTime = null;
        $lastDateTime = null;
        $forecasts = [];
        $forecastsList = $forecastData['list'] ?: [];

        if (empty($forecastsList)) {
            throw new WeatherApiException('The forecasts list is empty.');
        }

        $periodStart = $forecastsList[0]['dt_txt'];
        $periodEnd = $forecastsList[count($forecastsList) - 1]['dt_txt'];

        foreach ($forecastsList as $forecastItemData) {
            $forecasts[] = new ForecastItemData(
                timestamp_dt: $forecastItemData['dt'],
                text_dt: $forecastItemData['dt_txt'],
                min_temp: $forecastItemData['main']['temp_min'],
                max_temp: $forecastItemData['main']['temp_max'],
                wind_speed: $forecastItemData['wind']['speed']
            );
        }

        return new ForecastApiData($city, $periodStart, $periodEnd, $forecasts);
    }

    public function getCachedForecastByCity(string $city)
    {
        return Cache::remember(
            strtolower($city),
            $this->cachePeriod,
            fn() => $this->getForecastByCity($city)
        );
    }
}
