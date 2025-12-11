<?php

namespace App\Services;

use App\DTOs\ForecastApiData;
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

        if (!$response->successful()) {
            throw new WeatherApiException('Oops... Something happened with API.');
        }

        $forecastData = $response->json();
        Log::debug('API call', $forecastData);

        return new ForecastApiData('Test', '12:00', '15:00', []);
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
