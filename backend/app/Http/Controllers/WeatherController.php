<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use App\Models\WeatherCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{
    public function show(int $id): JsonResponse
    {
        $city = City::find($id);
        if (!$city) {
            return response()->json(['error' => '指定の都市が見つかりませんでした'], 404);
        }

        $weathers_data_from_db = $this->getWeathersFromDB($city);

        if ($weathers_data_from_db && count($weathers_data_from_db['date']) === 7) {
            // 7日分のデータがすべて揃っている場合: DBのデータを返す
            return response()->json($weathers_data_from_db, 200);
        } elseif ($weathers_data_from_db && count($weathers_data_from_db['date']) > 0) {
            // 1日以上7日未満のデータがある場合: 足りない日にち分のデータをAPIから取得し、DBのデータとあわせて返す
            $weathers_data_from_api = $this->fetchFewDaysWeathers($city, $weathers_data_from_db);

            DB::transaction(function () use ($city, $weathers_data_from_api) {
                $this->saveWeathers($city, $weathers_data_from_api);
            });

            $combined_weathers_data = array_merge($weathers_data_from_db, $weathers_data_from_api);
            return response()->json($combined_weathers_data, 200);
        } else {
            // DBにデータがない場合: 7日分のデータをAPIから取得して返す
            $weathers_data_from_api = $this->fetchOneWeekWeathers($city);
            
            DB::transaction(function () use ($city, $weathers_data_from_api) {
                $this->saveWeathers($city, $weathers_data_from_api);
            });

            return response()->json($weathers_data_from_api, 200);
        }
    }

    private function getWeathersFromDB(City $city): ?array
    {
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(6);

        $weathers = Weather::where('city_id', $city->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->with('weatherCode')
            ->get();
    
        if ($weathers->count() > 0) {
            return $this->formatDBWeathersData($city, $weathers);
        }
        return null;
    }

    private function fetchFewDaysWeathers(City $city, array $weathers_data_from_db): array
    {
        $dates = $weathers_data_from_db['date'];
        sort($dates);
        $last_date = Carbon::parse(end($dates));
        $missing_days = 7 - count($weathers_data_from_db['date']);
        $start_date = $last_date->copy()->addDay();
        $end_date = $last_date->copy()->addDays($missing_days - 1);

        $weathers_data_from_api = $this->fetchWeathers($city->latitude, $city->longitude, $start_date, $end_date);
        if (!$weathers_data_from_api) {
            return response()->json(['error' => '天気情報の取得に失敗しました'], 500);
        }

        $formatted_weathers_data_from_api = $this->formatAPIWeathersData($city, $weathers_data_from_api['daily']);
        return $formatted_weathers_data_from_api;
    }

    private function fetchOneWeekWeathers(City $city): array
    {
        $start_date = Carbon::today();
        $end_date = Carbon::today()->addDays(7);

        $weathers_data_from_api = $this->fetchWeathers($city->latitude, $city->longitude, $start_date, $end_date);
        if (!$weathers_data_from_api) {
            return response()->json(['error' => '天気情報の取得に失敗しました'], 500);
        }

        $formatted_weathers_data_from_api = $this->formatAPIWeathersData($city, $weathers_data_from_api['daily']);
        return $formatted_weathers_data_from_api;
    }

    private function fetchWeathers(float $latitude, float $longitude, Carbon $start_date, Carbon $end_date): ?array
    {
        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'daily' => 'weather_code,temperature_2m_max,temperature_2m_min,precipitation_probability_max',
            'start_date' => $start_date,
            'end_date' => $end_date,
            'timezone' => 'Asia/Tokyo',
        ]);

        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }

    private function saveWeathers(City $city, array $weathers): void
    {
        foreach ($weathers['date'] as $index => $date) {
            $weather_code = WeatherCode::where('weather_code', $weathers['weather_code'][$index])->first();

            $exitsing_weather = Weather::where('city_id', $city->id)
                ->where('date', $date)
                ->first();

            if ($exitsing_weather) {
                // もし同じ日付のデータがあった場合は、既存のレコードを更新
                $exitsing_weather->update([
                    'weather_code' => $weather_code->weather_code,
                    'temp_max' => $weathers['temp_max'][$index],
                    'temp_min' => $weathers['temp_min'][$index],
                    'precipitation_probability' => $weathers['precipitation_probability'][$index],
                ]);
            } else {
                // 新しいレコードを挿入
                Weather::create([
                    'city_id' => $city->id,
                    'date' => $date,
                    'weather_code' => $weather_code->weather_code,
                    'temp_max' => $weathers['temp_max'][$index],
                    'temp_min' => $weathers['temp_min'][$index],
                    'precipitation_probability' => $weathers['precipitation_probability'][$index],
                ]);
            }
        }
    }

    private function formatDBWeathersData(City $city, Collection $weathers): array
    {
        $formatted_data = [
            'city_name' => $city->city_name,
            'date' => [],
            'weather_code' => [],
            'category' => [],
            'description' => [],
            'temp_max' => [],
            'temp_min' => [],
            'precipitation_probability' => [],
        ];

        foreach ($weathers as $weather) {
            $formatted_data['date'][] = $weather->date;
            $formatted_data['weather_code'][] = $weather->weather_code;
            $formatted_data['category'][] = $weather->weatherCode->category;
            $formatted_data['description'][] = $weather->weatherCode->description;
            $formatted_data['temp_max'][] = $weather->temp_max;
            $formatted_data['temp_min'][] = $weather->temp_min;
            $formatted_data['precipitation_probability'][] = $weather->precipitation_probability;
        }
        return $formatted_data;
    }

    private function formatAPIWeathersData(City $city, array $weathers): array
    {
        $weather_code_details = $this->getWeatherCodeDetails($weathers['weather_code']);

        return [
            'city_name' => $city->city_name,
            'date' => $weathers['time'],
            'weather_code' => $weathers['weather_code'],
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
