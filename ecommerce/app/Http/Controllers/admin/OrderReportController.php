<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class OrderReportController extends Controller
{
    
    public function PersonalSellReport()
    {
        $data['main'] = 'Today Sell Report';
        $data['active'] = 'Today Sell Report';
        $data['title'] = '  ';
 
       $admin_id=Session::get('id');
       $shop_id=Session::get('shop_id');
       $zone_id=Session::get('zone_id');
       $date=date("Y-m-d");
       $status=Session::get('status');
       $data['products']=array();
       $data['discount_amount']=0;

       if($status==3){
        /// manager of sales

       $data['products']= DB::table('order_details')
                            ->where('order_date',$date)
                            ->where(function($query) use ($admin_id){
                                $query->where('staff_id',$admin_id);
                            })->select([DB::raw("SUM(qnt) as total"),DB::raw("SUM(sub_total) as sub_total_amount"),'product_id'])       
                            ->groupBy('product_id')      
                            ->orderBy('id','asc')->get();  

       $data['discount_amount']= DB::table('order_data')
                                ->where('shop_id',$shop_id)
                                ->where('is_paid',1)
                                ->where(function($query) use ($admin_id,$date){
                                    $query->where('staff_id',$admin_id)->where('order_date',$date);
                                })->sum('discount_price');  
 
             } else if ($status==4){
                 /// manager of shop incharge  
       $data['products']= DB::table('order_details')
       ->where('order_date',$date)
       ->where(function($query) use ($shop_id){
           $query->where('shop_id',$shop_id);
       })->select([DB::raw("SUM(qnt) as total"),DB::raw("SUM(sub_total) as sub_total_amount"),'product_id'])       
       ->groupBy('product_id')      
       ->orderBy('id','asc')->get();  

$data['discount_amount']= DB::table('order_data')
           ->where('shop_id',$shop_id)
           ->where('is_paid',1)
           ->where(function($query) use ($admin_id,$date){
               $query->where('order_date',$date);
           })->sum('discount_price'); 
             
        }  else if ($status==5){
            /// manager of Zone  incharge  
  $data['products']= DB::table('order_details')
  ->where('order_date',$date)
  ->where(function($query) use ($zone_id){
      $query->where('zone_id',$zone_id);
  })->select([DB::raw("SUM(qnt) as total"),DB::raw("SUM(sub_total) as sub_total_amount"),'product_id'])       
  ->groupBy('product_id')      
  ->orderBy('id','asc')->get();  

$data['discount_amount']= DB::table('order_data')
      ->where('zone_id',$zone_id)
      ->where('is_paid',1)
      ->where(function($query) use ($admin_id,$date){
          $query->where('order_date',$date);
      })->sum('discount_price'); 
        
   }
   else if ($status==1 || $status==8){
    /// manager  id and supper admin
$data['products']= DB::table('order_details')
->where('order_date',$date)
 ->select([DB::raw("SUM(qnt) as total"),DB::raw("SUM(sub_total) as sub_total_amount"),'product_id'])       
->groupBy('product_id')      
->orderBy('id','asc')->get();  

$data['discount_amount']= DB::table('order_data') 
->where('is_paid',1)
->where(function($query) use ($admin_id,$date){
  $query->where('order_date',$date);
})->sum('discount_price'); 

}



         
       return view('admin.report.PersonalSellReport',$data);
    }
    
}
