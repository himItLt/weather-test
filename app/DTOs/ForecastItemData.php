<?php

namespace App\DTOs;

class ForecastItemData extends BaseData
{
    public function __construct(
        public int $timestamp_dt,
        public string $text_dt,
        public float $min_temp,
        public float $max_temp,
        public float $wind_speed,
    )
    {
    }

    function getAttributes(): array
    {
        return ['timestamp_dt', 'text_dt', 'min_temp', 'max_temp', 'wind_speed'];
    }
}
