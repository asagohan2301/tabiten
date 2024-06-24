<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use App\Services\Geocoding;
use Exception;

class UpdateCoordinates extends Command
{
    protected $signature = 'update:coordinates';
    protected $description = 'Geocodingサービスを呼び出してcitiesの緯度経度を更新する';

    private $geocoding;

    public function __construct(Geocoding $geocoding)
    {
        parent::__construct();
        $this->geocoding = $geocoding;
    }

    public function handle()
    {
        $cities = City::all();

        foreach($cities as $city) {
            $city_name = $city->city_name;
            $country_name = $city->country->country_name;

            try {
                $data = $this->geocoding->fetchCoordinates($city_name, $country_name);
                $formatted_address = $data['formatted_address'];
                $latitude = $data['latitude'];
                $longitude = $data['longitude'];

                // 国名と都市名が formatted_address に含まれていれば、正しいデータとみなして db に保存
                if ($this->validCity($formatted_address, $country_name, $city_name)) {
                    $city->update([
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ]);
                    $this->info("緯度と経度のアップデートに成功しました: {$country_name} {$city_name}");
                } else {
                    throw new Exception("取得したデータが一致しません: req: {$country_name} {$city_name} res: {$formatted_address} lat {$latitude} lng {$longitude}");
                }
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }

    private function validCity($formatted_address, $country_name, $city_name)
    {
        if ($country_name === '中国') {
            return strpos($formatted_address, '中華人民共和国') !== false && strpos($formatted_address, $city_name) !== false;
        } elseif ($country_name === '韓国') {
            return strpos($formatted_address, '大韓民国') !== false && strpos($formatted_address, $city_name) !== false;
        } else {
            return strpos($formatted_address, $country_name) !== false && strpos($formatted_address, $city_name) !== false;
        }
    }
}
