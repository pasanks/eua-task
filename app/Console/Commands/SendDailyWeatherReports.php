<?php

namespace App\Console\Commands;

use App\Models\Favourite;
use App\Mail\SendDailyWeatherReports as DailyWeatherReportEmail;
use Illuminate\Console\Command;
use Mail;
use Log;
use Exception;

class SendDailyWeatherReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will email a weather report to subscribed users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mailList = Favourite::where('send_notification', 1)->get();
        try
        {
            foreach ($mailList as $mail) {
                Mail::to($mail->user->email)->send(new DailyWeatherReportEmail($mail));
            }
            Log::alert('Mail successfully sent!');
        }
        catch(Exception $ex)
        {
            Log::alert('Mail sent error: ' . $ex->getMessage());
        }
        return Command::SUCCESS;
    }
}
