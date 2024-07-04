<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    private function kelvinToCelsius($temperature)
    {
        return round(($temperature - 273.15));
    }

    private function getData($city = null)
    {
        $city = $city ?? 'London';

        $data = [];

        $API_KEY = config('app.openweathermap_api_key');

        $url = 'https://api.openweathermap.org/data/2.5/forecast?q=' . $city . '&appid=' . $API_KEY;

        $response = Http::get($url);

        if ($response->successful()) {
            $data['temp'] = $this->kelvinToCelsius($response['list']['0']['main']['temp']);
            $data['humidity'] = $response['list']['0']['main']['humidity'];
            $data['wind'] = $response['list']['0']['wind']['speed'];
            $data['clouds'] = $response['list']['0']['clouds']['all'];
            $data['pressure'] = $response['list']['0']['main']['pressure'];
            $data['weather'] = $response['list']['0']['weather'][0]['main'];
            $data['weatherDescription'] = $response['list'][0]['weather'][0]['description'];
            $data['country'] = $response['city']['country'];
            $data['icon'] = $response['list'][0]['weather'][0]['icon'];
            $data['iconUrl'] = 'https://openweathermap.org/img/w/' . $data['icon'] . '.png';
            $data['city'] = $city;

            $data['days'] = [6, 13, 21, 29]; // Indices for the next 4 days

            for ($i = 0; $i < 4; $i++) {
                $data['day' . $i . 'Temp'] = $this->kelvinToCelsius($response['list'][$data['days'][$i]]['main']['temp']);
                $data['icon' . $i] = $response['list'][$data['days'][$i]]['weather'][0]['icon'];
                $data['icon' . $i . 'Url'] = 'https://openweathermap.org/img/w/' . $data['icon' . $i] . '.png';
            }
        }

        return $data;
    }

    public function index()
    {
        return view('home', [
            'data' => $this->getData(),
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
