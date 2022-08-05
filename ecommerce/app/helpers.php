<?php

function get_option($key)
{
    $result = DB::table('options')->select('option_value')->where('option_name', $key)->first();
    if ($result) {
        return $result->option_value;
    }
}


function getHomeProductByCategoryId($category_id){
   return DB::table('product')->select('product.product_id','product_subtitle','product_title','product_name','discount_price','product_price','folder','feasured_image')
        ->join('product_category_relation','product.product_id','=','product_category_relation.product_id')
        ->where('product_category_relation.category_id',$category_id)
       // ->where('product_type','home')
        ->where('status','=',1)->orderBy('modified_time','desc')
        ->limit(12)->get();

}
function get_option_of_affilite($key)
{
    $result = DB::table('affilate_options')->select('option_value')->where('option_name', $key)->first();
    if ($result) {
        return $result->option_value;
    }
}

function get_category_info($category_id)
{
    $result = DB::table('category')->select('category_title', 'category_name')->where('category_id', $category_id)->first();

    if ($result) {
        return $result;

    }
}
function getAllParentCategoryForWebsite(){
  return  DB::table('category')
        ->select('category_id', 'category_title', 'category_name')
        ->where('parent_id', 0)        
        ->where('status', 1)
        ->orderBy('rank_order','asc')->limit(12)->get();
}

function getChaildCategory($category_id){
    return   DB::table('category')
        ->select('category_id', 'category_title', 'category_name')
        ->where('parent_id', $category_id)
        ->orderBy('rank_order', 'ASC')->get();
}


function single_product_data($product_id)
{
    $result = DB::table('product')->where('product_id', $product_id)->first();
    if ($result) {
        return $result;
    }
}

function getOrderDetails($order_id)
{
   $result= DB::table('order_details')->where('order_id',$order_id)->get();
    if ($result) {
        return $result;
    }
}

function getStockProductsOfShop($shop_id){
    
   return DB::table('product')->join('product_stocks','product.product_id','=','product_stocks.product_id')             
            ->select('product_stocks.product_id', 'product_title', 'sku','stock','barcode')
            ->where('stock','>',0)
            ->where('shop_id',$shop_id)
            ->orderby('stock', 'asc')->get();
}

function shopStockReduce($shop_id,$product_id,$qnt)
{
   $product= DB::table('product_stocks')->where('shop_id',$shop_id)->where('product_id',$product_id)->first();
    if ($product) {
        $data['stock']=$product->stock-$qnt;
        $data['product_sells']=$product->product_sells+$qnt;
        DB::table('product_stocks')->where('shop_id',$shop_id)->where('product_id',$product_id)->update($data);        
    }
}



function single_product_information($product_id)
{
    $result = DB::table('product')->select('sku', 'vendor_id','top_deal', 'product_name', 'product_title', 'product_stock','purchase_price','folder','feasured_image')->where('product_id', $product_id)->first();

    if ($result) {
        return $result;

    }
}


function getSingleProductStockZone($product_id)
{
    $zone_id=Session::get('zone_id');
    $result = DB::table('zone_stocks')->where('zone_id',$zone_id)->where('product_id', $product_id)->first();
    if ($result) {
        return $result;
    }
}

function stockReduceofZone($zone_id,$product_id,$stock)
{
    $zone_id=Session::get('zone_id');
    $result = DB::table('zone_stocks')->where('zone_id',$zone_id)->where('product_id', $product_id)->first();
    if ($result) {
       $data['stock'] =$result->stock-$stock;
       DB::table('zone_stocks')->where('zone_id',$zone_id)->where('product_id', $product_id)->update($data);
        
    }
}

function getSingleProductStock($product_id)
{
    $shop_id=Session::get('shop_id');
    $result = DB::table('product_stocks')->where('shop_id',$shop_id)->where('product_id', $product_id)->first();
    if ($result) {
        return $result;
    }
}

function checkCoinHistoryByUserId($user_id,$coin_id)
{
    $result = DB::table('coin_history')->where('user_id', $user_id)->where('link', $coin_id)->where('created_at',date('Y-m-d'))->first();
    if ($result) {
        return $result;
    }
}
function single_vendor_product($product_id)
{
    $result = DB::table('product')->select('*')->where('product_id', $product_id)->first();
    if ($result) {
        return $result;
    }
}

function UpdateStatisticCommisionData($amount)
{
    $statisticsData = DB::table('statistics')->first();
    $statistics['total_income'] = $statisticsData->total_income + $amount;
    DB::table('statistics')->update($statistics);
}

function totalProductRiviewCount($product_id)
{
    return DB::table('review')->select('product_id')->where('product_id', $product_id)->count();
}

function getOrderCount($order_status)
{
    $staff_id=Session::get('id');
    $status=Session::get('status');
    $shop_id=Session::get('shop_id');     
        if($order_status==1){
            return  DB::table('order_data')->where('shop_id',$shop_id)->count();
        }else{
            return  DB::table('order_data')->where('order_status',$order_status)->where('shop_id',$shop_id)->count();
        }  
}


function selectRandomStuff()
{
        $admin_id=  DB::table('admin')->where('status','office-staff')
            ->where('active_status', 1)->inRandomOrder()
            ->value('admin_id');
    if($admin_id){
        return $admin_id;
    }
    return 0;
}

?>
