<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherCode extends Model
{
    public function weathers()
    {
        return $this->hasMany(Weather::class, 'weather_code', 'weather_code');
    }
}
