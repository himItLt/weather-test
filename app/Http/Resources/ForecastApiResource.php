<?php

namespace App\Http\Resources;

use App\DTOs\ForecastApiData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForecastApiResource extends JsonResource
{
    public $resource;

    public function __construct(ForecastApiData $resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource->toArray();
    }
}
