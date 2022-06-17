<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use  Session;
use Illuminate\Support\Facades\Redirect;

use AdminHelper;
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
        date_default_timezone_set("Asia/Dhaka");


        $user_id=AdminHelper::Admin_user_autherntication();


        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->send();

        }
       $status= Session::get('status');
        if($status=='vendor'){
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
            $data['vendorTotalOrder'] = DB::table('vendor_orders')
                ->join('order_data','order_data.order_id','=','vendor_orders.order_id')
                ->where('vendor_orders.vendor_id',Session::get('id'))
                ->groupBy('order_data.order_id')
                ->orderBy('vendor_orders.order_id', 'desc')
                ->count();
            $data['completed_sum'] = DB::table('order_data')->where('order_status', 'completed')->sum('order_total');
            $data['today_order'] = DB::table('order_data')->where('order_date', $today)->count();
            $data['today_order_sum'] = DB::table('order_data')->where('order_date', $today)->sum('order_total');
            $data['products'] = DB::table('product')->where('vendor_id',Session::get('id'))->count();
            $data['category'] = DB::table('category')->count();
            $data['myBalance']=DB::table('vendor')->where('vendor_id',Session::get('id'))->first();
            $data['verify']=DB::table('vendor')->where('vendor_id',Session::get('id'))->first();
            $data['totalWithdrawAmount'] = DB::table('vendor_withdraw_amount')->where('vendorId',Session::get('id'))->where('status','1')->sum('withdrawAmount');
            $data['total_pending_order'] = DB::table('product')->where('status','=',0)->where('vendor_id',Session::get('id'))->count();
            $data['total_approved_order'] = DB::table('product')->where('status','=',1)
                ->where('vendor_id',Session::get('id'))->count();
            $data['total_cancel_order'] = DB::table('vendor_orders')->join('order_data','order_data.order_id','=','vendor_orders.order_id')->where('vendor_orders.vendor_id',Session::get('id'))->where('order_data.order_status','cancled')->orderBy('vendor_orders.order_id', 'desc') ->groupBy('vendor_orders.order_id')->count();
            $data['total_refund_order'] = DB::table('vendor_orders')->join('order_data','order_data.order_id','=','vendor_orders.order_id')->where('vendor_orders.vendor_id',Session::get('id'))->where('order_data.order_status','refund')->orderBy('vendor_orders.order_id', 'desc') ->groupBy('vendor_orders.order_id')->count();


            $total_order = DB::table('vendor_orders')
                ->select('order_status')
                ->join('order_data','order_data.order_id','=','vendor_orders.order_id')
                ->where('vendor_orders.vendor_id',Session::get('id'))
                ->orderBy('vendor_orders.order_id', 'desc')
                ->get();

            $data['total_new']=0;
            $data['total_orders']=0;
            $data['total_cancled']=0;
            $data['total_refund']=0;
            $data['total_completed']=0;
            $data['total_on_courier']=0;
            $data['total_pending_payment']=0;
            $data['total_phone_pending']=0;

            foreach($total_order as $order){
                $data['total_orders'] +=1;
                if($order->order_status=='new'){
                    $data['total_new'] +=1;
                }
                if($order->order_status=='cancled' ){
                    $data['total_cancled'] +=1;
                }
                if( $order->order_status=='refund' ){
                    $data['total_refund'] +=1;
                }

               

                if( $order->order_status=='completed' ){
                    $data['total_completed'] +=1;
                }
                if( $order->order_status=='on_courier' ){
                    $data['total_on_courier'] +=1;
                }

                if( $order->order_status=='pending_payment' ){
                    $data['total_pending_payment'] +=1;
                }
                 if( $order->order_status=='phone_pending
' ){
                     $data['total_phone_pending'] +=1;
                 }
                


            }
            

            return view('layouts.vendor_dashboard', $data);

        } else  {
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
            $data['unpublishedProduct'] = DB::table('product')->select('prouct_id')->where('vendor_id',0)->where('status',0)->orderBy('product_id', 'desc')->count();

            $data['limited_products']= DB::table('product')->where('product_stock','=',0)->count();
            $data['vendor_profit'] = DB::table('vendor_product_price_history')->sum('amount');
            $data['vendor_pending_product'] = DB::table('product')->where('vendor_id','!=',0)->where('status','=',0)->count();
            $data['sohojbuyVisitor'] = DB::table('hitcounter')->where('date',$today)->count();
            $data['affiliateVisitor'] = DB::table('affiliate_hitcounter')->where('date',$today)->count();

            return view('layouts.dashboard', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
