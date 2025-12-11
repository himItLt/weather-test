<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $city_name
 * @property integer $timestamp_dt
 * @property float $min_temp
 * @property float $max_temp
 * @property float $wind_speed
 * @property mixed $text_dt
 * @property mixed $created_at
 * @property mixed $updated_at
 * @mixin \Eloquent
 */
class Forecast extends Model
{
    protected $keyType = 'integer';

    protected $fillable = [
        'city_name', 'timestamp_dt', 'min_temp', 'max_temp', 'wind_speed', 'text_dt',
        'created_at', 'updated_at'
    ];
}
