<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class ZoneStockController extends Controller
{

    public function index()
    {
        
        $data['main'] = 'Zone Stock';
        $data['active'] = 'All Zone Stock';
        $data['title'] = '  ';
        $products = DB::table('product')->orderBy('product_id', 'desc')->paginate(10);
        return view('admin.zone.zone_stock_management', compact('products'), $data);
    }
 

    public function zoneProducts(Request $request)
    {
            $query = $request->get('query');
            $search_query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->where(function ($query_row) use ($search_query) {
                    return $query_row->where('sku','LIKE','%'.$search_query.'%')
                        ->orWhere('product_title','LIKE','%'.$search_query.'%');
                })
                ->orderBy('product_id', 'desc')->paginate(10);
            return view('admin.zone.zone_stock_management_pagination', compact('products'));
    }

 
    public function zoneProductOfStock($id)
    {        
        $data['product']= DB::table('product')->where('product_id',$id)->first();
        $data['suppliers']= DB::table('suppliers')->get();
        return view('admin.zone.product_stock_entry', $data);
    }
    public function zoneStockUpdate(Request $request)
    {
        $zone_id= Session::get('zone_id');       
        $product_id= $request->product_id;       
        $stock= $request->stock;       
        $supply_id= $request->supply_id;       
        $productCheck= DB::table('zone_stocks')
                    ->where('zone_id',$zone_id)
                    ->where('product_id',$product_id)
                    ->first();
        if($productCheck){
             
            $data['stock']=$productCheck->stock+$stock;
                  DB::table('zone_stocks')
                   ->where('zone_id',$zone_id)
                   ->where('product_id',$product_id)->update($data);
          
          $stock_details['zone_id']=$zone_id;
          $stock_details['supply_id']=$supply_id;
          $stock_details['product_id']=$product_id;
          $stock_details['stock']=$stock;
          $stock_details['date']=date('Y-m-d');
          DB::table('zone_stock_details')->insert($stock_details);
            
        }else{

            $data['zone_id']=$zone_id;
            $data['product_id']= $product_id;
            $data['stock']=$stock;
          $insert_id=  DB::table('zone_stocks')->insertGetId($data);
          
          $stock_details['zone_id']=$zone_id;
          $stock_details['supply_id']=$supply_id;
          $stock_details['product_id']=$product_id;
          $stock_details['stock']=$stock;
          $stock_details['date']=date('Y-m-d');
          DB::table('zone_stock_details')->insert($stock_details);


        }
        return 'success';  
         
    }

    
}
