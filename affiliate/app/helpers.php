<?php

function get_option($key)
{
    $result = DB::table('affilate_options')->select('option_value')->where('option_name', $key)->first();
    if ($result) {
        return $result->option_value;
    }
}

function sohojby_get_option($key)
{
    $result = DB::table('options')->select('option_value')->where('option_name', $key)->first();
    if ($result) {
        return $result->option_value;
    }
}

function get_category_info($category_id)
{
    $result=DB::table('category')->select('category_title','category_name')->where('category_id',$category_id)->first();

    if($result){
        return $result;

    }
}

function single_product_information($product_id)
{
    $result=DB::table('product')->select('sku','vendor_id','product_name','product_stock')->where('product_id',$product_id)->first();

    if($result){
        return $result;

    }
}

function UpdateStatisticCommisionData($amount){

    $statisticsData=DB::table('statistics')->first();
    $statistics['total_income']=$statisticsData->total_income+$amount;
    DB::table('statistics')->update($statistics);
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
