<?php

namespace App\Http\Resources;

use App\DTOs\ForecastApiData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForecastApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var ForecastApiData $this */
        return $this->toArray();
    }
}
