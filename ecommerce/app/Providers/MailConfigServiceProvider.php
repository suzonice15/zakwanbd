<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Config;
class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $emailServices = DB::table('smtp')
                                ->where('id',1)
                                ->first();

        if ($emailServices) {
            $config = array(
                'driver'     => $emailServices->driver,
                'host'       => $emailServices->host,
                'port'       => $emailServices->port,
                'username'   => $emailServices->username,
                'password'   => $emailServices->password,
                'encryption' => $emailServices->encryption,
                
            );

            Config::set('mail', $config);
        }
    }
}
