<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherAPI\FetchCurrentWeatherData;
use App\Services\OpenWeatherAPI\FetchWeatherForecastData;
use Illuminate\Http\Request;
use Log;

class WeatherController extends Controller
{
    /**
     * Query weather details according to the given lat and lon
     *
     * @param Request $request
     * @param FetchCurrentWeatherData $currentDatafetcher
     * @param FetchWeatherForecastData $forecastDataFetcher
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function queryWeatherDetails(Request $request, FetchCurrentWeatherData $currentDatafetcher,
                                        FetchWeatherForecastData $forecastDataFetcher)
    {
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');

        $currentWeatherData = $currentDatafetcher->fetch($latitude, $longitude);
        $forecastedWeatherData = $forecastDataFetcher->fetch($latitude, $longitude);

        return view('dashboard')->with([
            'currentWeather' => $currentWeatherData,
            'futureWeather' => $forecastedWeatherData
        ]);
    }
}
