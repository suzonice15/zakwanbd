<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class InactiveAffiliate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactiveAffiliate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info("Cron is working fine!");
        $month=date("m");
        $previous_month=date("m")-1;
        $previous_year=date("Y");
        $day=date("d");

        $today=date("Y").'-'.$month.'-'.$day;
        if($previous_month==0){
            $previous_month=12;
            $previous_year=date("Y")-1;
        }
        $previous_day=$previous_year.'-'.$previous_month.'-'.$day;


        \Log::info("Cron is working fine!".$today);

       $users= DB::table('users_public')->select('id')->select('id')->get();
        foreach ($users as $user){
            

           $orderCount= DB::table('order_data')
               ->where('order_status','=','completed')
               ->whereBetween('order_date', [$previous_day, $today])
               ->where('user_id','=',$user->id)->count();
             if($orderCount==0){
                 DB::table('users_public')->where('id','=',$user->id)->update(['status'=>0]);
             } else {
                 DB::table('users_public')->where('id','=',$user->id)->update(['status'=>1]);

             }
        }

        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */

        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
