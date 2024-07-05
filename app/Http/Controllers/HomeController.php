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

            $data = [];

            $url = 'https://api.openweathermap.org/data/3.0/onecall?lat=' . $coordinates[0]['lat'] . '&lon=' . $coordinates[0]['lon'] . '&appid=' . $this->apiKey();

            $response = Http::get($url);

            $data[0]['error'] = $this->checkResponseCode($response);

            if ($data[0]['error'] == null) {
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

                for ($i = 1; $i < 5; $i++) {
                    $data['day' . $i . 'Temp'] = $this->kelvinToCelsius($response['daily'][$i]['temp']['day']);
                    $data['icon' . $i] = $response['daily'][$i]['weather'][0]['icon'];
                    $data['icon' . $i . 'Url'] = 'https://openweathermap.org/img/w/' . $data['icon' . $i] . '.png';
                }
            }
            $data['error'] = '';
        } else {
            $data['error'] = $coordinates[0]['error'];
        }

        return $data;

    }

    private function apiKey()
    {
        return config('app.openweathermap_api_key');
    }

    private function getCoordinates($city = null)
    {
        $coordinates = [];

        $url = 'https://api.openweathermap.org/geo/1.0/direct?q=' . $city . '&limit=1&appid=' . $this->apiKey();

        $response = Http::get($url);

        $coordinates[0]['error'] = $this->checkResponseCode($response);

        if ($coordinates[0]['error'] == null) {
            if ($response->json() != null) {
                $coordinates[0]['name'] = $response->json()[0]['name'];
                $coordinates[0]['country'] = $response->json()[0]['country'];
                $coordinates[0]['lat'] = $response->json()[0]['lat'];
                $coordinates[0]['lon'] = $response->json()[0]['lon'];
            } else {
                $coordinates[0]['error'] = 'City not found';
            }
        }

        return $coordinates;
    }

    private function checkResponseCode($response)
    {
        $statusCode = '';

        if ($response->status() == 400) {
            $statusCode = 'Bad Request';
        } elseif ($response->status() == 401) {
            $statusCode = 'Unauthorized';
        } elseif ($response->status() == 404) {
            $statusCode = 'Not Found';
        } elseif ($response->status() == 429) {
            $statusCode = 'Too Many Requests';
        } elseif ($response->status() == 500) {
            $statusCode = 'Internal Server Error';
        }

        return $statusCode;
    }

    private function kelvinToCelsius($temperature): float
    {
        return round(($temperature - 273.15));
    }

    private function getCurrentCity()
    {
        $position = Location::get();
        return $position->cityName;
    }

    public function index()
    {
        $data = $this->getData($this->getCurrentCity());

        if ($data['error'] == null) {
            return view('home', [
                'data' => $data,
            ]);
        } else {
            return view('error', [
                'code' => $data['error'],
            ]);
        }
    }

    public function search(Request $request)
    {
        $data = $this->getData($request->input('city'));

        if ($data['error'] == null) {
            return view('home', [
                'data' => $data,
            ]);
        } else {
            return view('error', [
                'code' => $data['error'],
            ]);
        }
    }
}
