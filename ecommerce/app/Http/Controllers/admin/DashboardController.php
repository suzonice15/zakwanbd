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
   
            // $data['orders']= DB::table('order_data')->select('advabced_price','order_status')->get();
            $today = date('Y-m-d');
            $data['new'] = DB::table('order_data')->where('order_status', 'new')->count();
           
            
            $data['processing'] = DB::table('order_data')->where('order_status', 'processing')->count();
             $data['on_courier'] = DB::table('order_data')->where('order_status', 'on_courier')->count();
             $data['delivered'] = DB::table('order_data')->where('order_status', 'delivered')->count();
             $data['refund'] = DB::table('order_data')->where('order_status', 'refund')->count();
             $data['cancled'] = DB::table('order_data')->where('order_status', 'cancled')->count();
             $data['completed'] = DB::table('order_data')->where('order_status', 'completed')->count();
             $data['today_order'] = DB::table('order_data')->where('order_date', $today)->count();
             $data['products'] = DB::table('product')->count(); 
            $data['unpublishedProduct'] = DB::table('product')->select('prouct_id')->where('vendor_id',0)->where('status',0)->orderBy('product_id', 'desc')->count();
  
            $data['vendor_profit'] = DB::table('vendor_product_price_history')->sum('amount');
            $data['vendor_pending_product'] = DB::table('product')->where('vendor_id','!=',0)->where('status','=',0)->count();
           
            $data['affiliateVisitor'] = DB::table('affiliate_hitcounter')->where('date',$today)->count();

            $data['admin'] = DB::table('admin')->where('admin_id',session::get('id'))->first();
            $data['sohojbuyVisitor'] = DB::table('visitors')
             ->whereDate('created_at', $today) 
            ->select(DB::raw('count(DISTINCT ip) as distinct_ip_count')) 
            ->groupBy('ip')
            ->get()->count(); 
             
            return view('layouts.dashboard', $data);
        
    }
    public function shop_visitor_count(){
        date_default_timezone_set("Asia/Dhaka");
        $today = date('Y-m-d');
       return DB::table('visitors')
            ->whereDate('created_at', $today) 
            ->select(DB::raw('count(DISTINCT ip) as distinct_ip_count')) 
            ->groupBy('ip')
            ->get()->count(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shopVisitorList(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        $data['main'] = 'Visitor';
        $data['active'] = 'All Visitor';
        $data['title'] = '  ';
        $start_date = date('Y-m-d');
        $end_date = $start_date;
        if($request->all()){
            $start_date=$request->start_date;
            $end_date=$request->end_date; 
        } 

        $data['visitors']=DB::table('visitors')
            ->whereDate('created_at', '>=',$start_date)  
            ->whereDate('created_at', '<=',$end_date)  
             ->groupBy('ip')
             ->orderBy('id','desc')
             ->get(); 
        return view('admin.visitor.index',compact('start_date','end_date') ,$data);
    }
    public function visitorDetail($ip,$date)
    {
        $data['main'] = 'Visitor';
        $data['active'] = 'Visitor Details';
        $data['title'] = '  ';
     
        $data['visitors']=DB::table('visitors')
           ->whereDate('created_at', $date)  
           ->where('ip', $ip)  
          ->get(); 
        return view('admin.visitor.visitorDetail', $data);
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
