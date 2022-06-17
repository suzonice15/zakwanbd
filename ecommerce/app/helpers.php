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

function single_product_information($product_id)
{
    $result = DB::table('product')->select('sku', 'vendor_id', 'product_name', 'product_title', 'product_stock')->where('product_id', $product_id)->first();

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
    if($status=='office-staff' || $status=='editor'){
        if($order_status==1){
            return  DB::table('order_data')->count();
        }
      return  DB::table('order_data')->where('order_status',$order_status)->where('staff_id', $staff_id)->count();
    }else{
        if($order_status==1){
            return  DB::table('order_data')->count();
        }
        return  DB::table('order_data')->where('order_status',$order_status)->count();
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
