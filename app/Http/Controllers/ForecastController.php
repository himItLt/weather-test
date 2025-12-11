<?php

namespace App\Http\Controllers;

use App\Exceptions\WeatherApiException;
use App\Http\Requests\ForecastSearchApiRequest;
use App\Http\Requests\ForecastSearchDbRequest;
use App\Http\Requests\ForecastStoreRequest;
use App\Http\Resources\ForecastApiResource;
use App\Http\Resources\ForecastDbResource;
use App\Models\Forecast;
use App\Services\WeatherService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;

class ForecastController extends BaseController
{
    public function getFromApi(ForecastSearchApiRequest $request, WeatherService $weather): JsonResponse
    {
        $validated = $request->validated();

        try {
            $forecastData = $weather->getForecastByCity($validated['city_name']);

            return $this->sendSuccess(
                (new ForecastApiResource($forecastData))->toArray($request),
                'Forecast data retrieved successfully.'
            );
        } catch (WeatherApiException|ConnectionException $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    public function getFromDb(ForecastSearchDbRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $forecast = Forecast::where('city_name', $validated['city_name'])->first();

        return $this->sendSuccess(
            (new ForecastDbResource($forecast))->toArray($request),
            'Forecast retrieved successfully.'
        );
    }

    public function store(ForecastStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $forecast = Forecast::updateOrCreate([
            'city_name' => $validated['city_name']
        ], $validated);

        return $this->sendSuccess(
            (new ForecastDbResource($forecast))->toArray($request),
            'Forecast stored successfully.'
        );
    }
}
