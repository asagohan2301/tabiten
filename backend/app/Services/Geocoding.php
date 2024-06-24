<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class Geocoding
{
    private $api_key;

    public function __construct()
    {
        $this->api_key = config('services.google_maps.api_key');
    }

    public function fetchCoordinates($city_name, $country_name)
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
          'address' => "{$country_name} {$city_name}",
          'key' => $this->api_key,
          'language' => 'ja',
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (!empty($data['results'])) {
                $formatted_address = $data['results'][0]['formatted_address'];
                $latitude = $data['results'][0]['geometry']['location']['lat'];
                $longitude = $data['results'][0]['geometry']['location']['lng'];

                return ['formatted_address' => $formatted_address, 'latitude' => $latitude, 'longitude' => $longitude];
            } else {
                throw new Exception("レスポンスに results が存在しません: {$country_name} {$city_name}");
            }
        } else {
            throw new Exception("データの取得に失敗しました: {$country_name} {$city_name}");
        }
    }
}
