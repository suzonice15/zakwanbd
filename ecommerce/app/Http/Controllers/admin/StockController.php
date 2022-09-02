<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use Illuminate\Support\Facades\Redirect;
use AdminHelper;
use URL;
use App\Models\Admin;
use App\Models\Shop;
use App\Models\Zone;
use Mail;

class StockController extends Controller
{
    

    public  function __construct()
    {
         date_default_timezone_set("Asia/Dhaka");     //Country which we are selecting.
    }
 
 
      
    public function productStockCheck(Request $request)
    {
        $data['zones']= Zone::latest()->get(); 
        $data['main'] = 'Stock Upgrade Check';
        $data['active'] = 'Stock Upgrade Check';
        $data['title'] = 'Stock Upgrade Check'; 
        $data['zone_id'] = ''; 
        $data['date'] = ''; 
        $data['shop_id'] = ''; 
        $data['products']=array();
        if($request->submit=='submit'){
            $zone_id=$request->zone_id;
            $shop_id=$request->shop_id;
            $date=date("Y-m-d",strtotime($request->date));
            
           $data['products']=  DB::table('product_stock_details')
            ->whereDate('created_at',$date)->where(function ($query) use ($shop_id,$zone_id) {
                return $query->where('shop_id', '=', $shop_id)
                 ->where('zone_id','=',$zone_id);
            })->select(['product_id',DB::raw("SUM(stock) as total")])
            ->groupBy('product_id')
            ->get();
            $data['zone_id'] = $zone_id; 
            $data['shop_id'] = $shop_id;
            $data['date'] = $date;
           
        }
        return view('admin.stock.productStockCheck', $data);
    }
    public function ProductSellReport(Request $request)
    {
        $data['zones']= Zone::latest()->get(); 
        $data['main'] = 'Product Sell Report';
        $data['active'] = 'Product Sell Report';
        $data['title'] = 'Product Sell Report'; 
        $data['zone_id'] = ''; 
        $data['date'] = ''; 
        $data['shop_id'] = ''; 
        $data['products']=array();
        if($request->submit=='submit'){
            $zone_id=$request->zone_id;
            $shop_id=$request->shop_id;
            $date=date("Y-m-d",strtotime($request->date));
            
           $data['products']=  DB::table('order_details')
            ->whereDate('order_date',$date)->where(function ($query) use ($shop_id,$zone_id) {
                return $query->where('shop_id', '=', $shop_id)
                 ->where('zone_id','=',$zone_id);
            })->select(['product_id',DB::raw("SUM(qnt) as total_quanitty"),DB::raw("SUM(sub_total) as sub_total")])
            ->groupBy('product_id')
            ->get();
            $data['zone_id'] = $zone_id; 
            $data['shop_id'] = $shop_id;
            $data['date'] = $date;
           
        }
        return view('admin.stock.ProductSellReport', $data);
    }
 
    
}
