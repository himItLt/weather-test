<?php

namespace App\Http\Controllers;

use App\Exceptions\WeatherApiException;
use App\Http\Requests\ForecastSearchRequest;
use App\Http\Resources\ForecastApiResource;
use App\Services\WeatherService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;

class ForecastController extends BaseController
{
    public function getFromApi(ForecastSearchRequest $request, WeatherService $weather): JsonResponse
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
}
