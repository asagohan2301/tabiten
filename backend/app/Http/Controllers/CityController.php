<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Collection;

class CityController extends Controller
{
    public function index(): JsonResponse
    {
        $areas = Area::with('countries.cities')->get();
        $areas_data = $this->formatAreasData($areas);
        return response()->json($areas_data);
    }

    private function formatAreasData(Collection $areas): array
    {
        $areas_data = [];

        foreach ($areas as $area) {
            $countries_data = $this->formatCountriesData($area->countries);
            $area_data = [
                'id' => $area->id,
                'area_name' => $area->area_name,
                'order' => $area->order,
                'countries' => $countries_data,
            ];
            $areas_data[] = $area_data;
        }

        // order カラム順に並び替える
        $areas_data = $this->sortArrayInAsc($areas_data, 'order');
        return $areas_data;
    }

    private function formatCountriesData(Collection $countries): array
    {
        $countries_data = [];

        foreach ($countries as $country) {
            $cities_data = $this->formatCitiesData($country->cities);
            $country_data = [
                'id' => $country->id,
                'country_name' => $country->country_name,
                'reading' => $country->reading,
                'cities' => $cities_data,
            ];
            $countries_data[] = $country_data;
        }

        // 五十音順に並び替える
        $countries_data = $this->sortArrayInAsc($countries_data, 'reading');
        return $countries_data;
    }

    private function formatCitiesData(Collection $cities): array
    {
        $cities_data = [];

        foreach ($cities as $city) {
            $city_data = [
                'id' => $city->id,
                'city_name' => $city->city_name,
                'reading' => $city->reading,
            ];
            $cities_data[] = $city_data;
        }

        // 五十音順に並び替える
        $cities_data = $this->sortArrayInAsc($cities_data, 'reading');
        return $cities_data;
    }

    private function sortArrayInAsc(array $array, string $key): array
    {
        usort($array, function ($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        });
        return $array;
    }
}
