<?php

namespace App\Http\Resources;

use App\DTOs\ForecastItemData;
use App\Models\Forecast;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            min_temp: $this->min_tmp,
            max_temp: $this->max_tmp,
            wind_speed: $this->wind_spd
        ))->toArray() + [
            'updated_at' => $this->updated_at,
            'city_name' => $this->city_name,
            ];
    }
}
