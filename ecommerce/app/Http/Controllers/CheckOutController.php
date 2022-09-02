<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use  Cart;
use Session;
use Illuminate\Support\Facades\Cookie;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        date_default_timezone_set("Asia/Dhaka");     //Country which we are selecting.
    }

    public function checkout()
    {
        $items = \Cart::getContent();
        $data['share_picture'] = get_option('home_share_image');

        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');


        $data['categories'] = DB::table('category')->select('category_id', 'category_title', 'category_name')->where('parent_id', 0)->get();

        return view('website.checkout', $data);
    }

    public function sendMessage(Request $request)
    {

        $data = array();
        $data['message'] = $request->message;
        $data['phone'] = $request->mobile_number;
        $word = "fox";
        $wordFound=0;
$mystring = $request->message;

$wrongSentance=get_option('bad_word');
$databaseString= explode(" ", $wrongSentance);
foreach ($databaseString as $key => $word) {
   if(strpos($mystring, $word) !== false){
    
     $wordFound +=1;
} else{
    
     $wordFound +=0;
}

}
 
 


if($wordFound >0){
    return 0;

} else {
 $insert = DB::table('message')
            ->insert($data);
            return 1;

}
       
        
    }

    public function checkoutStore(Request $request)
    {

        $set_user_id2=0;
        $items = \Cart::getContent();        
        $data['order_status'] = '';
        $data['shipping_charge'] = $request->shipping_charge;
        if( $request->affiliate_discount >0) {
            $data['affiliate_discount'] = $request->affiliate_discount;
            $data['coupon_code'] = $request->coupon_code;
        }

        $data['created_time'] = date("Y-m-d h:i:s");
        $data['created_by'] = 'Customer';
        $data['modified_time'] = date("Y-m-d h:i:s");
        $data['order_date'] = date("Y-m-d");
        $data['order_total'] = 0 ;   
        $data['advabced_price'] = $request->order_total;   
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
         $data['staff_id'] =  selectRandomStuff();
        $data['payment_type'] = $request->payment_type;
        $data['order_area'] = $request->order_area;
        $data['payment_method'] = $request->payment_method;
        if($request->payment_method=='Bank'){
            $data['transaction_id'] = $request->transaction_id;
            $data['account_number'] = $request->account_number; 
        }else{
            $data['transaction_id'] = $request->transaction_id_mobile;
            $data['account_number'] = $request->account_number_mobile; 
        } 

        $get_cookies = Cookie::get('unique_code');
        $get_link_id = Cookie::get('link_id');
        if($get_link_id){
            $get_link_id=$get_link_id;
        } else {
            $get_link_id=0;
        }

        if ($get_cookies) {
            $result = DB::table('product_hit_count')->select('user_id')
                ->where('unique_number', $get_cookies)->first();    
            $set_user_id = $result->user_id;           
        } else {
            $set_user_id = 2;
        }

        $customer_id = Session::get('customer_id');
        if ($customer_id) {
            $data['customer_id'] = $customer_id;
            if($request->customer_phone){
                $userCheck= DB::table('users')->select('affiliate_id')
                    ->where('id',$customer_id)->first();
                if($userCheck){
                        $set_user_id=$userCheck->affiliate_id;
                }
            }

        } else {
            if($request->customer_phone){
                $userCheck= DB::table('users')->where('phone',$request->customer_phone)->first();
                if($userCheck){
                    
                } else {
                        $set_user_id2=2;
                        $insert_affiliate['affiliate_id']=$set_user_id2;
                        $insert_affiliate['bonus_blance']=200;
                        $insert_affiliate['phone']=$request->customer_phone;
                        $insert_affiliate['name']= $request->customer_name;
                        $insert_affiliate['email']= $request->customer_email;
                        $insert_affiliate['created_date']= date('Y-m-d');
                        $insert_affiliate['address']= $request->customer_address;
                        $customerId= DB::table('users')->insertGetId($insert_affiliate);
                        $data['customer_id'] = $customerId;
                }
            } 

        } 

        //$set_user_id   is the affilite Id

        if ($get_cookies) {
            $data['user_id'] = $set_user_id;
        } else {
            $data['user_id'] = $set_user_id2;
        }

        $data['order_from'] = 'zakwanbd.com';

        $order_id = DB::table('order_data')->insertGetId($data);
        $row_data['order_id'] = $order_id;
        if ($order_id) {

            foreach($request->products as $product_id=>$quantity){
                $order_details['order_id']=$order_id;
                $order_details['zone_id'] = '';
                $order_details['shop_id'] =  '';
                $order_details['product_id']=$product_id;
                $order_details['qnt']=$quantity;
                $order_details['price']=$request->price[$product_id];
                $order_details['sub_total']=$request->price[$product_id]*$quantity;
                $order_details['commision']=single_product_information($product_id)->top_deal * $quantity;
                $order_details['order_date']=date("Y-m-d");
                DB::table('order_details')->insert($order_details);               

            }     
            $product_ids = $request->product_id;

            if ($set_user_id > 0) { 
                    foreach ($product_ids as $key => $prod) {
                        $data_product['order_id'] = $order_id;
                        $data_product['product_id'] = $prod;
                        $data_product['user_id'] = $set_user_id;
                        $data_product['link_id'] = $get_link_id;
                        $data_product['order_date'] = date('Y-m-d');
                        DB::table('user_order_count')->insertGetId($data_product);
                    }
                } 
                return redirect('thank-you?order_id=' . $order_id);
            }  else {
            return redirect('/chechout')->with('error', 'Error to Create this order');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thankYou(Request $request)
    {
        $items = \Cart::clear();
        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');
        $id = $request->order_id;
        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $track_data ['order_id'] = $data['order']->order_id;
        $track_data ['date'] = $data['order']->order_date;
        $data['order_items'] = DB::table('order_details')->where('order_id',$id)->get();     
        $data['share_picture'] = get_option('home_share_image');
        return view('website.thank_you', $data);
    }

    public function cart()
    {
        $data['share_picture'] = get_option('home_share_image');
        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');
        /////     $data['order']=DB::table('order_data')->where('order_id',$id)->first();
        //    $data['categories']=DB::table('category')->select('category_id','category_title','category_name')->where('parent_id',0)->get();
        return view('website.cart', $data);
    }

    public function plus_cart_item(Request $request)
    {
        if ($request->ajax()) {
            $product_id = $request->get('product_id');
            Cart::update($product_id, array(
                'quantity' => 1, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
            ));
            //  return view('website.category_ajax', compact('products'));
            $view = view('website.cart_ajax')->render();
            $items = \Cart::getContent();
            //Cart::clear();
            $total = 0;
            $quantity = 0;
            foreach ($items as $row) {
                $total = \Cart::getTotal();
                $quantity += $row->quantity;
            }
            $quantity = Cart::getContent()->count();
//        $data['total']=$total;
//        $data['count']=$quantity;
            $data1 = [
                'total' => $total,
                'count' => $quantity,
            ];

            // return response()->json(['result'=>$data1]);

            return response()->json(['html' => $view, 'result' => $data1]);
        }

    }

    public function minus_cart_item(Request $request)
    {
        if ($request->ajax()) {

            $product_id = $request->get('product_id');
            Cart::update($product_id, array(
                'quantity' => -1, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
            ));

            //  return view('website.category_ajax', compact('products'));
            $view = view('website.cart_ajax')->render();

            $items = \Cart::getContent();
            //Cart::clear();
            $total = 0;
            $quantity = 0;
            foreach ($items as $row) {

                $total = \Cart::getTotal();
                $quantity += $row->quantity;

            }
            $quantity = Cart::getContent()->count();
//        $data['total']=$total;
//        $data['count']=$quantity;
            $data1 = [
                'total' => $total,
                'count' => $quantity,
            ];

            // return response()->json(['result'=>$data1]);

            return response()->json(['html' => $view, 'result' => $data1]);
        }

    }

    public function remove_cart_item(Request $request)
    {
        if ($request->ajax()) {

            $product_id = $request->get('product_id');
            Cart::remove($product_id);
            //  return view('website.category_ajax', compact('products'));
            $view = view('website.cart_ajax')->render();

            $items = \Cart::getContent();
            //Cart::clear();
            $total = 0;
            $quantity = 0;
            foreach ($items as $row) {

                $total = \Cart::getTotal();
                $quantity += $row->quantity;

            }
            $quantity = Cart::getContent()->count();
//        $data['total']=$total;
//        $data['count']=$quantity;
            $data1 = [
                'total' => $total,
                'count' => $quantity,
            ];

            // return response()->json(['result'=>$data1]);

            return response()->json(['html' => $view, 'result' => $data1]);
        }

    }

    public function add_to_wishlist(Request $request)
    {
        // $request->session()->put('my_name','Virat Gandhi');
        $wishlist = array();
        $product_id = $request->product_id;
        if ($request->session()->has('wishlist')) {
            // $wishlist = $this->session->userdata('wishlist');
            $wishlist = $request->session()->get('wishlist');

        }
        array_push($wishlist, $product_id);
        $wishlist = array_unique($wishlist);
        $request->session()->put('wishlist', $wishlist);
        Session::put("total_wishlist_count",count($wishlist));
      
    }

    public function wishlist(Request $request)
    {

        $wishlist = $request->session()->get('wishlist');

        if ($request->session()->has('wishlist')) {
            $wishlist = $request->session()->get('wishlist');
            $data['products'] = DB::table('product')->whereIn('product_id', $wishlist)->get();

        } else {
            $data['products'] = '';

        }

        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');
        $data['share_picture'] = get_option('home_share_image');
        return view('website.wishlist', $data);


    }

    public function remove_wish_list(Request $request)
    {
        $wishlist = array();

        $product_id = $request->product_id;
        if ($request->session()->has('wishlist')) {
            // $wishlist = $this->session->userdata('wishlist');
            $wishlist = $request->session()->get('wishlist');
        }

        $key = array_search($product_id, $wishlist);
        unset($wishlist[$key]);
        $wishlist = array_values($wishlist);
        ///  $this->session->set_userdata('wishlist', $wishlist);
        $request->session()->put('wishlist', $wishlist);
        $products = DB::table('product')->whereIn('product_id', $wishlist)->get();

        $view = view('website.wishlist_ajax', compact('products'))->render();

        return response()->json(['html' => $view]);
    }

    public function checkoutMethod(Request $request){

       $payment=$request->method;
       $system=$request->system;
       if($system=='mobile'){
        if($payment=='Bkash'){
           $data['number']= get_option('bkash');
           return response()->json($data);
        }else{
            $data['number']=  get_option('nagod');
            return response()->json($data);
        }

       }else{
        $data['bank_name']=  get_option('bank_name');
        $data['bank_account_number']=  get_option('bank_account_number');
        return response()->json($data);
       }
        
    }


}
