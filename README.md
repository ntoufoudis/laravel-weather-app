# Laravel Weather Application

A simple weather application built with Laravel 11 that utilizes the [OpenWeatherMap API](https://openweathermap.org) to provide real-time weather information.
The application uses [One Call API 3.0](https://openweathermap.org/api/one-call-3), so you need to subscribe for this service in order to get a working API Key. 

---

## Demo 

You can see the app [here](https://weather.ntoufoudis.com)

---

## Features

* **Current Weather:** Get the current weather conditions for a specific location.
* **Forecast: Retrieve** a 4-day weather forecast for a specific location.

---

## ToDo

* Add Option To Select Temperature (Celsius **°C**, Fahrenheit **°F**, Kelvin **K**)
* Add Option To Select Imperial or Metric for speed (miles/hour or meter/sec)
* Add Option To Select Language
* Add Option To Show Weather Overview for today's and tomorrow's forecast.
* Add Option To Show aggregated weather data for a particular date from 2nd January 1979 till 1,5 years ahead.
* Add Option To Show Information for any timestamp between 1st January 1979 till 4 days ahead.
* Add Option To Select Number of Days (0-7) For Forecast.
* Add Custom Error Page.
* 
---

## Installation

1. Clone repository:
```angular2html
git clone https://github.com/ntoufoudis/laravel-weather-app.git
```
2. Navigate to the project directory:
```angular2html
cd laravel-weather-app
```
3. Create .env file
```angular2html
cp .env.example .env
```
4. Add OpenWeather API Key:
```angular2html
OPENWEATHERMAP_API_KEY=Your API KEY
```
5. Install dependencies:
```angular2html
composer install
npm install
```
6. Run migrations
```angular2html
php artisan migrate
```
7. Serve application
```angular2html
npm run dev
php artisan serve
```

---

## Usage

Navigate to home page. Enter the city name in the form of "City" or "City, Country Code (e.g. London, UK)".
Click "Search to see current conditions and 4 days forecast."

---

## Contributing

Contributions are welcome. Feel free to open an issue or submit a pull request.

---

## License

The application is licensed under the [MIT License(MIT)](LICENSE)
