<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Session;
use Illuminate\Support\Facades\Redirect;


use DB;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {



    }

    public function index()
    {

    $user_id=1;


        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->send();

        }
       $status= Session::get('status');
        if($status=='super-admin'){
            // $data['orders']= DB::table('order_data')->select('order_total','order_status')->get();
            $today = date('Y-m-d');
            $data['affilites'] = DB::table('users_public')->count();
            $data['new_sum'] = DB::table('order_data')->where('order_status', '=', 'new')->sum('order_total');
            $data['pending_payment'] = DB::table('order_data')->where('order_status', 'pending_payment')->count();
            $data['pending_sum'] = DB::table('order_data')->where('order_status', 'pending_payment')->sum('order_total');
            $data['processing'] = DB::table('order_data')->where('order_status', 'processing')->count();
            $data['processing_sum'] = DB::table('order_data')->where('order_status', 'processing')->sum('order_total');
            $data['on_courier'] = DB::table('order_data')->where('order_status', 'on_courier')->count();
            $data['on_courier_sum'] = DB::table('order_data')->where('order_status', 'on_courier')->sum('order_total');
            $data['delivered'] = DB::table('order_data')->where('order_status', 'delivered')->count();
            $data['delivered_sum'] = DB::table('order_data')->where('order_status', 'delivered')->sum('order_total');
            $data['refund'] = DB::table('order_data')->where('order_status', 'refund')->count();
            $data['refund_sum'] = DB::table('order_data')->where('order_status', 'refund')->sum('order_total');
            $data['cancled'] = DB::table('order_data')->where('order_status', 'cancled')->count();
            $data['cancled_sum'] = DB::table('order_data')->where('order_status', 'cancled')->sum('order_total');
            $data['completed'] = DB::table('order_data')->where('order_status', 'completed')->count();
            $data['completed_sum'] = DB::table('order_data')->where('order_status', 'completed')->sum('order_total');
            $data['today_order'] = DB::table('order_data')->where('order_date', $today)->count();
            $data['today_order_sum'] = DB::table('order_data')->where('order_date', $today)->sum('order_total');
            $data['products'] = DB::table('product')->where('vendor_id',Session::get('id'))->count();
            $data['category'] = DB::table('category')->count();

            return view('layouts.dashboard', $data);

        } else 
        {

          


            // $data['orders']= DB::table('order_data')->select('order_total','order_status')->get();
            $today = date('Y-m-d');
            $data['new'] = DB::table('order_data')->where('order_status', 'new')->count();
            $data['new_sum'] = DB::table('order_data')->where('order_status', '=', 'new')->sum('order_total');
            $data['pending_payment'] = DB::table('order_data')->where('order_status', 'pending_payment')->count();
            $data['pending_sum'] = DB::table('order_data')->where('order_status', 'pending_payment')->sum('order_total');
            $data['processing'] = DB::table('order_data')->where('order_status', 'processing')->count();
            $data['processing_sum'] = DB::table('order_data')->where('order_status', 'processing')->sum('order_total');
            $data['on_courier'] = DB::table('order_data')->where('order_status', 'on_courier')->count();
            $data['on_courier_sum'] = DB::table('order_data')->where('order_status', 'on_courier')->sum('order_total');
            $data['delivered'] = DB::table('order_data')->where('order_status', 'delivered')->count();
            $data['delivered_sum'] = DB::table('order_data')->where('order_status', 'delivered')->sum('order_total');
            $data['refund'] = DB::table('order_data')->where('order_status', 'refund')->count();
            $data['refund_sum'] = DB::table('order_data')->where('order_status', 'refund')->sum('order_total');
            $data['cancled'] = DB::table('order_data')->where('order_status', 'cancled')->count();
            $data['cancled_sum'] = DB::table('order_data')->where('order_status', 'cancled')->sum('order_total');
            $data['completed'] = DB::table('order_data')->where('order_status', 'completed')->count();
            $data['completed_sum'] = DB::table('order_data')->where('order_status', 'completed')->sum('order_total');
            $data['today_order'] = DB::table('order_data')->where('order_date', $today)->count();
            $data['today_order_sum'] = DB::table('order_data')->where('order_date', $today)->sum('order_total');
            $data['products'] = DB::table('product')->count();
            $data['category'] = DB::table('category')->count();

            return view('layouts.affilate_dashboard', $data);
        }
    }

    
    
}
