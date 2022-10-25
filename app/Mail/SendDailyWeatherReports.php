<?php

namespace App\Mail;

use App\Services\OpenWeatherAPI\FetchCurrentWeatherData;
use App\Services\OpenWeatherAPI\FetchWeatherForecastData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class SendDailyWeatherReports extends Mailable
{
    use Queueable, SerializesModels;

    protected string $latitude;
    protected string $longitude;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->latitude = $data->latitude;
        $this->longitude = $data->longitude;
    }


    public function build(FetchCurrentWeatherData $currentDatafetcher, FetchWeatherForecastData $forecastDataFetcher)
    {
        $currentWeatherData = $currentDatafetcher->fetch($this->latitude, $this->longitude);
        $forecastedWeatherData = $forecastDataFetcher->fetch($this->latitude, $this->longitude);
        return $this->from('example@pk.com', 'Daily Weather Report')
            ->view('mails.report')->with([
                'currentWeather'=>$currentWeatherData,
                'futureWeather'=>$forecastedWeatherData
            ]);
    }
}
