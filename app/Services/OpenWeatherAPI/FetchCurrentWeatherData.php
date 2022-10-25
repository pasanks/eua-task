<?php

namespace App\Services\OpenWeatherAPI;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Log;
use Exception;

class FetchCurrentWeatherData
{
    /**
     * @var string
     */
    protected string $appID;
    /**
     * @var string
     */
    protected string $serviceURL;

    /**
     * FetchCurrentWeatherData constructor.
     */
    public function __construct()
    {
        $this->appID = Config::get('services.openWeatherApi.key');
        $this->serviceURL = Config::get('services.openWeatherApi.url');
    }

    /**
     * Fetch data from openweather API
     *
     * @param $latitude
     * @param $longitude
     *
     * @return array|mixed|null
     */
    public function fetch($latitude, $longitude)
    {
        try {
            Log::info('Trying to fetch current weather details from openweather API...');
            $response = Http::get($this->serviceURL . 'data/2.5/weather?lat=' . $latitude .
                '&lon=' . $longitude . '&units=metric&appid=' . $this->appID);

            if ($response->status() == 200) {
                return $response->json();
            }else {
                throw new Exception('API error status code: ' . $response->status());
            }

        } catch (Exception $ex) {
            Log::alert('An error occurred while fetching weather info: ' . $ex->getMessage());
            return null;
        }
    }
}
