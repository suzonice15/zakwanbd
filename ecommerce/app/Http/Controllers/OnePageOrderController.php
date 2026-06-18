<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cookie;
use Session;

class OnePageOrderController extends Controller
{
    public function store(Request $request)
    {
        $set_user_id2 = 0;
        
        $data['order_status'] = 'new';
        $data['shipping_charge'] = $request->shipping_charge;
        
        $admin = DB::table('admin')->where('email', 'admin@zakwanbd.com')->where('status', 1)->first();
        if ($admin) {
            $data['zone_id'] = $admin->zone_id;
            $data['shop_id'] = $admin->shop_id;
        }

        $data['created_time'] = date("Y-m-d h:i:s");
        $data['created_by'] = 'Customer';
        $data['modified_time'] = date("Y-m-d h:i:s");
        $data['order_date'] = date("Y-m-d");
        // $data['order_total'] = 0;
        $data['order_status'] = 'new';
        $data['order_total'] = $request->order_total;
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_phone . '@onepage.com';
        $data['customer_address'] = $request->customer_address;
        $data['staff_id'] = selectRandomStuff();
        $data['payment_type'] = 'cash_on_delivery';
        $data['order_area'] = $request->order_area;
        $data['payment_method'] = 'Cash';
        $data['transaction_id'] = '';
        $data['account_number'] = '';

        $get_cookies = Cookie::get('unique_code');
        $get_link_id = Cookie::get('link_id');
        if ($get_link_id) {
            $get_link_id = $get_link_id;
        } else {
            $get_link_id = 0;
        }

        if ($get_cookies) {
            $result = DB::table('product_hit_count')->select('user_id')
                ->where('unique_number', $get_cookies)->first();
            if ($result) {
                $set_user_id = $result->user_id;
            } else {
                $set_user_id = 2;
            }
        } else {
            $set_user_id = 2;
        }

        $customer_id = Session::get('customer_id');
        if ($customer_id) {
            $data['customer_id'] = $customer_id;
            if ($request->customer_phone) {
                $userCheck = DB::table('users')->select('affiliate_id')
                    ->where('id', $customer_id)->first();
                if ($userCheck) {
                    $set_user_id = $userCheck->affiliate_id;
                }
            }
        } else {
            if ($request->customer_phone) {
                $userCheck = DB::table('users')->where('phone', $request->customer_phone)->first();
                if (!$userCheck) {
                    $set_user_id2 = 2;
                    $insert_affiliate['affiliate_id'] = $set_user_id2;
                    $insert_affiliate['bonus_blance'] = 200;
                    $insert_affiliate['phone'] = $request->customer_phone;
                    $insert_affiliate['name'] = $request->customer_name;
                    $insert_affiliate['email'] = $request->customer_phone . '@onepage.com';
                    $insert_affiliate['created_date'] = date('Y-m-d');
                    $insert_affiliate['address'] = $request->customer_address;
                    $customerId = DB::table('users')->insertGetId($insert_affiliate);
                    $data['customer_id'] = $customerId;
                }
            }
        }

        if ($get_cookies) {
            $data['user_id'] = $set_user_id;
        } else {
            $data['user_id'] = $set_user_id2;
        }

        $data['order_from'] = 'onepage.zakwanbd.com';

        $order_id = DB::table('order_data')->insertGetId($data);

        if ($order_id) {
            $product_id = $request->product_id;
            $price = $request->product_price;

            $order_details['order_id'] = $order_id;
            $order_details['zone_id'] = '';
            $order_details['shop_id'] = '';
            $order_details['product_id'] = $product_id;
            $order_details['qnt'] = 1;
            $order_details['price'] = $price;
            $order_details['sub_total'] = $price;
            
            $product = DB::table('product')->select('top_deal')->where('product_id', $product_id)->first();
            $order_details['commision'] = ($product ? $product->top_deal : 0);
            $order_details['order_date'] = date("Y-m-d");
            
            DB::table('order_details')->insert($order_details);

            if ($set_user_id > 0) {
                $data_product['order_id'] = $order_id;
                $data_product['product_id'] = $product_id;
                $data_product['user_id'] = $set_user_id;
                $data_product['link_id'] = $get_link_id;
                $data_product['order_date'] = date('Y-m-d');
                DB::table('user_order_count')->insertGetId($data_product);
            }

            return redirect('onepage/thank-you?order_id=' . $order_id);
        } else {
            return redirect()->back()->with('error', 'Error to Create this order');
        }
    }

    public function thankYou(Request $request)
    {
        $id = $request->order_id;
        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $data['order_items'] = DB::table('order_details')->where('order_id', $id)->get();
        return view('website.onepage_thank_you', $data);
    }
}
