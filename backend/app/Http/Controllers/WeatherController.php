<?php

namespace App\Http\Controllers;

class WeatherController extends Controller
{
    public function getWeather()
    {
        return response()->json(['message' => 'test']);
    }
}
