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
        foreach ($items as $row) {
            $product_id = $row->id;
            $row->quantity;
            $product_stock = DB::table('product')->select('product_stock')->where('product_id', $product_id)->first();
            if ($product_stock) {
                $stock['product_stock'] = $product_stock->product_stock - $row->quantity;
                $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);
            }
        }
        $data['order_status'] = 'new';
        $data['shipping_charge'] = $request->shipping_charge;
        if( $request->affiliate_discount >0) {
            $data['affiliate_discount'] = $request->affiliate_discount;
            $data['coupon_code'] = $request->coupon_code;
        }


        $data['created_time'] = date("Y-m-d h:i:s");
        $data['created_by'] = 'Customer';
        //$data['modified_time'] = date("Y-m-d h:i:s");
        $data['order_date'] = date("Y-m-d");
        $data['order_total'] = $request->order_total;
        $data['products'] = serialize($request->products);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['customer_order_note'] = $request->customer_order_note;
        $data['staff_id'] =  selectRandomStuff();
        $data['payment_type'] = $request->payment_type;
        $data['order_area'] = $request->order_area;
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
            $account_suspend_id = DB::table('account_suspend')->where('user_id', $set_user_id)
                ->orderBy('account_suspend_id', 'desc')->first();
            if ($account_suspend_id) {
                if ($account_suspend_id->status == 0) {
                    $set_user_id = $set_user_id;
                } else {
                    $set_user_id = 0;
                }
            } else {
            }
        } else {
            $set_user_id = 0;
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
                $userCheck= DB::table('users')->select('affiliate_id')
                    ->where('phone',$request->customer_phone)->first();
                if($userCheck){
                    if($userCheck->affiliate_id > 0){
                        $set_user_id=$userCheck->affiliate_id;
                    }
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
            } else {

                $data['customer_id'] = 0;
            }

        }




        //$set_user_id   is the affilite Id

        if ($get_cookies) {
            $data['user_id'] = $set_user_id;
        } else {
            $data['user_id'] = $set_user_id2;
        }

        $data['order_from'] = 'sohojbuy.com';

        $order_id = DB::table('order_data')->insertGetId($data);
        $row_data['order_id'] = $order_id;
        if ($order_id) {
            $product_ids = $request->product_id;

            if ($set_user_id > 0) {
                $account_suspend_id = DB::table('account_suspend')
                    ->where('user_id', $set_user_id)
                    ->orderBy('account_suspend_id', 'desc')
                    ->first();

                if ($account_suspend_id) {
                    if ($account_suspend_id->status == 0) {
                        foreach ($product_ids as $key => $prod) {
                            $data_product['order_id'] = $order_id;
                            $data_product['product_id'] = $prod;
                            $data_product['user_id'] = $set_user_id;
                            $data_product['link_id'] = $get_link_id;
                            $data_product['order_date'] = date('Y-m-d');                            //  $this->MainModel->insertData('user_order_count', $dataa);
                            DB::table('user_order_count')->insertGetId($data_product);
                        }
                    }

                } else {

                    foreach ($product_ids as $key => $prod) {
                        $data_product['order_id'] = $order_id;
                        $data_product['product_id'] = $prod;
                        $data_product['user_id'] = $set_user_id;
                        $data_product['link_id'] = $get_link_id;
                        $data_product['order_date'] = date('Y-m-d');
                        DB::table('user_order_count')->insertGetId($data_product);
                    }
                }


                if ($account_suspend_id) {
                    if ($account_suspend_id->status == 0) {
                        if ($set_user_id > 0) {

                            foreach ($product_ids as $key => $prod) {

                                $product_point = DB::table('product')
                                    ->select('discount_price','product_point','product_price','top_deal')
                                    ->where('product_id', $prod)->first();
                                if ($product_point->discount_price) {
                                    $sell_price = $product_point->discount_price;
                                } else {
                                    $sell_price = $product_point->product_price;
                                }
                               
                                    $user_commission['commission'] = $product_point->top_deal;
                                    $user_commission['order_id'] = $order_id;
                                    $user_commission['product_id'] = $prod;
                                    $user_commission['user_id'] = $set_user_id;
                                    $user_commission['link_id'] = $get_link_id;
                                    $user_commission['sell_price'] = $sell_price;
                                    // $user_commission['commission'] = $product_point->product_profite;
                                    DB::table('user_commission')->insert($user_commission);

                               

//                                } else {
//                                    $user_commission['commission'] = $product_point->product_profite;
//                                }
                              
                                if ($product_point->product_point > 0) {
                                    $point_product['order_id'] = $order_id;
                                    $point_product['product_id'] = $prod;
                                    $point_product['affilate_id'] = $set_user_id;
                                    $point_product['point'] = $product_point->product_point;
                                    DB::table('points')->insert($point_product);
                                }


                            }

                        }

                    }

                } else {

                    foreach ($product_ids as $key => $prod) {
                        if ($set_user_id > 0) {

                            $product_point = DB::table('product')
                                ->select('discount_price','product_point','product_price','top_deal')
                                ->where('product_id', $prod)->first();
                            if ($product_point->discount_price) {
                                $sell_price = $product_point->discount_price;
                            } else {
                                $sell_price = $product_point->product_price;
                            }


                           
                                $user_commission['commission'] = $product_point->top_deal;
                                $user_commission['order_id'] = $order_id;
                                $user_commission['product_id'] = $prod;
                                $user_commission['user_id'] = $set_user_id;
                                $user_commission['link_id'] = $get_link_id;
                                $user_commission['sell_price'] = $sell_price;
                                DB::table('user_commission')->insert($user_commission);
                         

//                            else {
//                                $user_commission['commission'] = $product_point->product_profite;
//                            }


                            if ($product_point->product_point > 0) {
                                $point_product['order_id'] = $order_id;
                                $point_product['product_id'] = $prod;
                                $point_product['affilate_id'] = $set_user_id;
                                $point_product['point'] = $product_point->product_point;
                                DB::table('points')->insert($point_product);
                            }


                        }



                    }


                }


            }

            $customer_id = Session::get('customer_id');
            if ($customer_id > 0) {
                foreach ($product_ids as $key => $prod) {

                    $product_point = DB::table('product')->select('product_point')->where('product_id', $prod)->first();
                    if ($product_point->product_point > 0) {
                        $point_product_customer['order_id'] = $order_id;
                        $point_product_customer['product_id'] = $prod;
                        $point_product_customer['user_id'] = $customer_id;
                        $point_product_customer['point'] = $product_point->product_point;
                        DB::table('points')->insert($point_product_customer);
                    }

                }
            }


            foreach ($product_ids as $product_id) {
                $product_row = single_product_information($product_id);
                if ($product_row->vendor_id > 0) {
                    $row_data['vendor_id'] = $product_row->vendor_id;
                    $row_data['product_id'] = $product_id;
                    $row_data['order_date'] = $data['order_date'];
                    DB::table('vendor_orders')->insertGetId($row_data);
                }
            }


            return redirect('thank-you?order_id=' . $order_id);
        } else {

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
        $order_items = unserialize($data['order']->products);
        if (is_array($order_items['items'])) {
            foreach ($order_items['items'] as $product_id => $item) {
                $products_sku = DB::table('product')->select('sku')->where('product_id', '=', $product_id)->first();
                if($products_sku){
                    $track_data ['product_code'] = $products_sku->sku;
                    DB::table('product_of_order_data')->insert($track_data);
                }
            }
        }
        $data['categories'] = DB::table('category')->select('category_id', 'category_title', 'category_name')->where('parent_id', 0)->get();
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


}
