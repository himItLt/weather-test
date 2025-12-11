<?php

namespace App\Http\Resources;

use App\DTOs\ForecastItemData;
use App\Models\Forecast;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ForecastDbResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Forecast $this */
        return (new ForecastItemData(
            timestamp_dt: $this->timestamp_dt,
            text_dt: $this->text_dt,
            min_temp: $this->min_temp,
            max_temp: $this->max_temp,
            wind_speed: $this->wind_speed
        ))->toArray() + [
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            'city_name' => $this->city_name,
            ];
    }
}
