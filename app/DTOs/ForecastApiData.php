<?php

namespace App\DTOs;

class ForecastApiData extends BaseData
{
    public function __construct(
        public string $city_name,
        public string $period_start,
        public string $period_end,
        /** @property ForecastItemData[] */
        public array $forecasts = [],
    )
    {
    }

    function getAttributes(): array
    {
        return ['city_name', 'period_start', 'period_end', 'forecasts'];
    }

    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'forecasts' => array_map(fn(ForecastItemData $item) => $item->toArray(), $this->forecasts),
        ];
    }
}
