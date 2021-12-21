<?php

namespace App\Console;

use App\Http\Controllers\FtpController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){
            logger("Solo para " . now() . " Cada dos minutos");
       })->everyTwoMinutes();;

        // $schedule->call(function(){
        //     logger("Actualiza Última versión  con carga " . now() . " Cada 4:50 hrs");
        //     $ftpinventory = new FtpController;
        //     $ftpinventory->inventory_ftp_inventory();
        // })->dailyAt('05:00');


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
