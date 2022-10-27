<?php

namespace App\Services\OpenWeatherAPI;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Log;
use Exception;

class FetchWeatherForecastData
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
     * @var array|string[]
     */
    protected array  $selectedTimeSlots;

    /**
     * FetchWeatherForecastData constructor.
     */
    public function __construct()
    {
        $this->appID = Config::get('services.openWeatherApi.key');
        $this->serviceURL = Config::get('services.openWeatherApi.url');
        $this->selectedTimeSlots = ['00:00:00', '06:00:00', '12:00:00', '18:00:00'];
    }

    /**
     * Fetch data from openweather API
     *
     * @param string $latitude
     * @param string $longitude
     *
     * @return array|null
     */
    public function fetch(string $latitude, string $longitude)
    {
        $forecastData = array();
        try {
            Log::info('Trying to fetch current weather forecast details from openweather API...');
            $response = Http::get($this->serviceURL . 'data/2.5/forecast?lat=' . $latitude .
                '&lon=' . $longitude . '&units=metric&appid=' . $this->appID);

            if ($response->status() == 200) {
                foreach ($response->json('list') as $value) {
                    if (in_array(explode(' ', $value['dt_txt'])[1], $this->selectedTimeSlots)) {
                        $forecastData[gmdate("Y-m-d", $value['dt'])][] = $value;
                    }
                }
                return $forecastData;
            }else {
                throw new Exception('API error status code: ' . $response->status());
            }

        } catch (Exception $ex) {
            Log::alert('An error occurred while fetching weather info: ' . $ex->getMessage());
            return null;
        }
    }
}
