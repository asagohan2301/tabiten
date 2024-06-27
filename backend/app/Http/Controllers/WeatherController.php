<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\WeatherCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    public function show(int $id): JsonResponse
    {
        $city = City::find($id);
        if (!$city) {
            return response()->json(['error' => '指定の都市が見つかりませんでした'], 404);
        }

        $weathers_data = $this->fetchWeathers($city->latitude, $city->longitude);
        if (!$weathers_data) {
            return response()->json(['error' => '天気情報の取得に失敗しました'], 500);
        }

        $formatted_weathers_data = $this->formatWeathersData($weathers_data['daily']);
        return response()->json($formatted_weathers_data, 200);
    }

    private function fetchWeathers(float $latitude, float $longitude): ?array
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'daily' => 'weather_code,temperature_2m_max,temperature_2m_min,precipitation_probability_max',
        ]);

        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }

    private function formatWeathersData(array $weathers): array
    {
        $weather_code_details = $this->getWeatherCodeDetails($weathers['weather_code']);

        return [
            'date' => $weathers['time'],
            'category' => $weather_code_details['categories'],
            'description' => $weather_code_details['descriptions'],
            'temp_max' => $weathers['temperature_2m_max'],
            'temp_min' => $weathers['temperature_2m_min'],
            'precipitation_probability' => $weathers['precipitation_probability_max'],
        ];
    }

    private function getWeatherCodeDetails(array $weather_codes): array
    {
        $categories = [];
        $descriptions = [];

        foreach ($weather_codes as $weather_code) {
            $code = WeatherCode::where('weather_code', $weather_code)->first();
            $categories[] = $code->category;
            $descriptions[] = $code->description;
        }

        return ['categories' => $categories, 'descriptions' => $descriptions];
    }
}
