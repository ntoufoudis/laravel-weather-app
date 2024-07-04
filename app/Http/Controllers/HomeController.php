<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;


class HomeController extends Controller
{
    public function getData($city)
    {
        $coordinates = $this->getCoordinates($city);
        if ($coordinates[0]['error'] == null) {
            $lat = $coordinates[0]['lat'];
            $lon = $coordinates[0]['lon'];

            $data = [];

            $url = 'https://api.openweathermap.org/data/3.0/onecall?lat=' . $lat . '&lon=' . $lon . '&appid=' . $this->apiKey();

            $response = Http::get($url);

            if ($response->successful()) {
                $data['temp'] = $this->kelvinToCelsius($response['current']['temp']);
                $data['humidity'] = $response['current']['humidity'];
                $data['wind'] = $response['current']['wind_speed'];
                $data['clouds'] = $response['current']['clouds'];
                $data['pressure'] = $response['current']['pressure'];
                $data['weather'] = $response['current']['weather'][0]['main'];
                $data['weatherDescription'] = $response['current']['weather'][0]['description'];
                $data['country'] = $coordinates[0]['country'];
                $data['icon'] = $response['current']['weather'][0]['icon'];
                $data['iconUrl'] = 'https://openweathermap.org/img/w/' . $data['icon'] . '.png';
                $data['city'] = $coordinates[0]['name'];

                $data['days'] = [1, 2, 3, 4]; // Indices for the next 4 days

                for ($i = 0; $i < 4; $i++) {
                    $data['day' . $i . 'Temp'] = $this->kelvinToCelsius($response['daily'][$data['days'][$i]]['temp']['day']);
                    $data['icon' . $i] = $response['daily'][$data['days'][$i]]['weather'][0]['icon'];
                    $data['icon' . $i . 'Url'] = 'https://openweathermap.org/img/w/' . $data['icon' . $i] . '.png';
                }
            }
            $data['error'] = '';
        }
        else {
            $data['error'] = $coordinates[0]['error'];
        }

        return $data;

    }


    private function apiKey(){
        return config('app.openweathermap_api_key');
    }

    private function kelvinToCelsius($temperature): float
    {
        return round(($temperature - 273.15));
    }

    private function getCoordinates($city = null)
    {
        $coordinates = [];

        $url = 'https://api.openweathermap.org/geo/1.0/direct?q=' . $city . '&limit=1&appid=' . $this->apiKey();

        $response = Http::get($url);
        if ($response->successful()) {
            if ($response->json() != null) {
                $coordinates = $response->json();
                $coordinates[0]['error'] = '';
            }
            else {
                $coordinates[0]['error'] = 'City not found';
            }
        }

        return $coordinates;
    }

    public function index()
    {
        $position = Location::get();
        $city = $position->cityName;

        return view('home', [
            'data' => $this->getData($city),
        ]);
    }

    public function search(Request $request)
    {
        $city = $request->input('city');

        return view('home', [
            'data' => $this->getData($city),
        ]);
    }

}
