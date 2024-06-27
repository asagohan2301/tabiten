<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = [
        'city_id', 'date', 'weather_code', 'temp_max', 'temp_min', 'precipitation_probability',
    ];

    public function weatherCode()
    {
        return $this->belongsTo(WeatherCode::class, 'weather_code', 'weather_code');
    }
}
