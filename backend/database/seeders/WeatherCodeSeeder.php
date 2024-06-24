<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeatherCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weather_codes')->insert([
            ['weather_code' => 0, 'description' => '快晴', 'category' => '晴れ', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 1, 'description' => '晴れ', 'category' => '晴れ', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 2, 'description' => '薄曇り', 'category' => '曇り', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 3, 'description' => '曇り', 'category' => '曇り', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 45, 'description' => '霧', 'category' => '曇り', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 48, 'description' => '霧氷を伴う霧', 'category' => '曇り', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 51, 'description' => '霧雨: 弱い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 53, 'description' => '霧雨: 中程度の強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 55, 'description' => '霧雨: 強い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 56, 'description' => '凍結霧雨: 弱い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 57, 'description' => '凍結霧雨: 強い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 61, 'description' => '雨: 弱い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 63, 'description' => '雨: 中程度の強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 65, 'description' => '雨: 強い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 66, 'description' => '凍結雨: 弱い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 67, 'description' => '凍結雨: 強い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 71, 'description' => '雪: 弱い強度', 'category' => '雪', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 73, 'description' => '雪: 中程度の強度', 'category' => '雪', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 75, 'description' => '雪: 強い強度', 'category' => '雪', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 77, 'description' => '雪粒', 'category' => '雪', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 80, 'description' => 'にわか雨: 弱い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 81, 'description' => 'にわか雨: 中程度の強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 82, 'description' => 'にわか雨: 強い強度', 'category' => '雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 85, 'description' => 'にわか雪: 弱い強度', 'category' => '雪', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 86, 'description' => 'にわか雪: 強い強度', 'category' => '雪', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 95, 'description' => '雷雨: 弱いまたは中程度', 'category' => '雷雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 96, 'description' => '雷雨と小さなひょう', 'category' => '雷雨', 'created_at' => now(), 'updated_at' => now()],
            ['weather_code' => 99, 'description' => '雷雨と大きなひょう', 'category' => '雷雨', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
