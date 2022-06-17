<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use URL;
use Mail;
use Illuminate\Support\Facades\Cookie;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function __construct()
    {
        date_default_timezone_set("Asia/Dhaka");     //Country which we are selecting.
    }

    public function checkout()
    {

        $customer_id=Session::get('id');
        $items = \Cart::getContent();
        $data['share_picture'] = get_option('home_share_image');

        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');
        $data['bonus_info']=DB::table('bonus_offer')
            ->where('id',1)
            ->where('status',1)
            ->first();
        $data['cashback_info']=DB::table('cashback_offer')
            ->where('id',1)
            ->where('status',1)
            ->first();
        $data['bonus_amount_info']=DB::table('users_public')
            ->where('id',$customer_id)
            ->select('bonus_balance')
            ->first();
        $data['cashback_amount_info']=DB::table('users_public')
            ->where('id',$customer_id)
            ->select('cash_back')
            ->first();
        return view('admin.affilate.checkout', $data);
    }

    public  function orderForCustomerCheckout(){
        $data['main'] = 'Order For Customer';
        $data['active'] = 'Order For Customer';
        $customer_id=Session::get('id');
        $items = \Cart::getContent();

        $wallet=DB::table('users_public')->where('id',$customer_id)->sum('ewallet_balance');
        $data['wallet_blance']=$wallet;

        return view('admin.affilate.orderForCustomerCheckout', $data);

    }
    public  function userAffiliteCheck($phone){

        if($phone){
            $userCheck= DB::table('users')->select('affiliate_id')
                ->where('phone',$phone)
                ->first();
            if($userCheck){
                if($userCheck->affiliate_id > 0){
                    return response()->json(['result'=>false]);
                } else{
                    return response()->json(['result'=>true]);       }

            } else {
                return response()->json(['result'=>true]);
            }
        }
    }



    public function orderForCustomerCheckoutStore(Request $request)
    {
        //sotck reduce from product
        $items = \Cart::getContent();
        //Cart::clear();
        foreach ($items as $row) {
            $product_id = $row->id;
            $row->quantity;
            $product_stock = DB::table('product')->select('product_stock')->where('product_id', $product_id)->first();
            if ($product_stock) {
                $stock['product_stock'] = $product_stock->product_stock - $row->quantity;
                $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);
            }
        }

        $customer_id = Session::get('id');
        $suspend_user = DB::table('account_suspend')->where('user_id', $customer_id)->first();
        if ($suspend_user) {
            if($suspend_user->status==0){
                $data['order_status'] = 'new';
                $data['shipping_charge'] = $request->shipping_charge;
                $data['advabced_price'] = $request->advabced_price;
                $data['affiliate_discount'] = $request->affiliate_discount;
                $data['created_time'] = date("Y-m-d h:i:s");
                $data['created_by'] = 'Customer';
                //$data['modified_time'] = date("Y-m-d h:i:s");
                $data['order_date'] = date("Y-m-d");
                $data['order_total'] = $request->order_total;
                // $data['user_id'] = 0;
                $data['products'] = serialize($request->products);
                $mailOrderProduct = serialize($request->products);
                $data['customer_name'] = $request->customer_name;
                $data['customer_phone'] = $request->customer_phone;
                $data['customer_email'] = $request->customer_email;
                if($request->order_area=='virtual'){
                    $data['customer_address'] = '';
                } else {
                    $data['customer_address'] = $request->customer_address;
                }
                $data['staff_id'] =  selectRandomStuff();
                $data['payment_type'] = $request->payment_type;
                $data['order_area'] = $request->order_area;
                $data['user_id'] = $customer_id;

                ///affilite id 
                $data['customer_id'] = 0;
                $order_id = DB::table('order_data')->insertGetId($data);
                $row_data['order_id'] = $order_id;
//send email for order information end here
                if ($order_id) {
                    $product_ids = $request->product_id;
                    foreach ($product_ids as $product_id) {
                        $product_row = single_product_information($product_id);
                        $product_point = DB::table('product')->where('product_id', $product_id)->first();
                        if ($product_point->discount_price) {
                            $sell_price = $product_point->discount_price;
                        } else {
                            $sell_price = $product_point->product_price;
                        }
                        if ($product_point->top_deal > 0) {
                            $user_commission['commission'] = $product_point->top_deal;
                            $user_commission['order_id'] = $order_id;
                            $user_commission['product_id'] = $product_id;
                            $user_commission['user_id'] = $customer_id;
                            $user_commission['link_id'] = 0;
                            $user_commission['sell_price'] = $sell_price;
                            // $user_commission['commission'] = $product_point->product_profite;
                            DB::table('user_commission')->insert($user_commission);
                        }
                        $product_row = single_product_information($product_id);
                        if ($product_row->vendor_id > 0) {
                            $row_data['vendor_id'] = $product_row->vendor_id;
                            $row_data['product_id'] = $product_id;
                            $row_data['order_date'] = $data['order_date'];
                            DB::table('vendor_orders')->insertGetId($row_data);
                        }
                    }
                    $emailInfo = DB::table('smtp')
                        ->where('id', 1)
                        ->first();
                    $senderEmail = $emailInfo->username;
                    $customerEmail = $request->customer_email;
                    if($request->customer_phone){
                        $userCheck= DB::table('users')->select('affiliate_id')->where('phone',$request->customer_phone)->first();
                        if($userCheck){
                            if($userCheck->affiliate_id > 0){
                            } else{
                                $user_affiliate['affiliate_id']=$customer_id;
                                $userCheck= DB::table('users')->where('phone',$request->customer_phone)->update($user_affiliate);                            }

                        } else {
                            $insert_affiliate['affiliate_id']=$customer_id;
                            $insert_affiliate['phone']=$request->customer_phone;
                            $insert_affiliate['name']= $request->customer_name;
                            $insert_affiliate['email']= $request->customer_email;
                            $insert_affiliate['address']= $request->customer_address;
                            $insert_affiliate['created_date']= date('Y-m-d');
                            $insert_affiliate['bonus_blance']=1000;
                            $userCheck= DB::table('users')->insert($insert_affiliate);

                        }
                    }
                    if($customerEmail) {
                        $messageBody = '<html><body>';
                        $messageBody .= "<h1>Hi,Successfully Order for sohojaffiliates.com </h1>";
                        $messageBody .= "<br>";
                        $messageBody .= '<h3>Your Order Details</h3>';
                        $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $request->customer_name . "</td></tr>";
                        $mailOrderProductInfo = unserialize($mailOrderProduct);
                        $count = 1;
                        $total = 0;
                        foreach ($mailOrderProductInfo['items'] as $product_id => $item) {
                            $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                            $total += $totall;
                            $messageBody .= "<tr style='background: #eee;'><td><strong>Product Name:</strong> </td><td>" . $item['name'] . "</td></tr>";
                            $messageBody .= "<tr style='background: #eee;'><td><strong>Price Quantity:</strong> </td><td>" . $item['price'] . "✖" . $item['qty'] . "</td></tr>";
                            $count++;
                        }
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Delivery Cost:</strong> </td><td>" . $request->shipping_charge . "</td></tr>";
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Order Total:</strong> </td><td>" . $request->order_total . "</td></tr>";
                        $messageBody .= "</table>";
                        $messageBody .= "</body></html>";
                        Mail::send([], [], function ($message) use ($customerEmail, $messageBody, $senderEmail) {
                            $message->from($senderEmail, 'Sohoj Affilate');
                            $message->subject("Order Details");
                            $message->setBody($messageBody);
                            $message->setBody($messageBody, 'text/html');
                            $message->to($customerEmail);
                        });
                    }

                    /*  vendor email */
                    $messageBody = '<html><body>';
                    $messageBody .= "<h1>Hi,Successfully Order for sohojaffiliates.com </h1>";
                    $messageBody .= "<br>";
                    $messageBody .= '<h3>Your Order Details</h3>';
                    $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $request->customer_name . "</td></tr>";

                    $mailOrderProductInfo = unserialize($mailOrderProduct);
                    $count = 1;
                    $total = 0;
                    foreach ($mailOrderProductInfo['items'] as $product_id => $item) {

                        $vendor=DB::table('product')->select('vendor_id')->where('product_id',$product_id)->first();
                        if($vendor->vendor_id >0){
                            $vendor=DB::table('vendor')->select('vendor_email')->where('vendor_id',$vendor->vendor_id)->first();

                            $vendorEmail=$vendor->vendor_email;
                            $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                            $total += $totall;
                            $messageBody .= "<tr style='background: #eee;'><td><strong>Product Name:</strong> </td><td>" . $item['name'] . "</td></tr>";
                            $messageBody .= "<tr style='background: #eee;'><td><strong>Price Quantity:</strong> </td><td>" . $item['price'] . "✖" . $item['qty'] . "</td></tr>";
                            $count++;
                            $messageBody .= "<tr style='background: #eee;'><td><strong>Delivery Cost:</strong> </td><td>" . $request->shipping_charge . "</td></tr>";
                            $messageBody .= "<tr style='background: #eee;'><td><strong>Order Total:</strong> </td><td>" . $request->order_total . "</td></tr>";
                            $messageBody .= "</table>";
                            $messageBody .= "</body></html>";
                            Mail::send([], [], function ($message) use ($vendorEmail, $messageBody, $senderEmail) {

                                $message->from($senderEmail, 'Sohoj Affilate');

                                $message->subject("Order Details");
                                $message->setBody($messageBody);
                                $message->setBody($messageBody, 'text/html');
                                $message->to($vendorEmail);
                            });
                        }


                    }
                    return redirect('thank-you?order_id=' . $order_id);
                } else {

                    return redirect('/chechout')->with('error', 'Error to Create this order');
                }
            } else {
                return redirect('/dashboard')->with('error', 'Your Account Suspended Contact With Admin');

            }

        } else {
            $data['order_status'] = 'new';
            $data['advabced_price'] = $request->advabced_price;
            $data['shipping_charge'] = $request->shipping_charge;
            $data['affiliate_discount'] = $request->affiliate_discount;
            $data['created_time'] = date("Y-m-d H:i:s");
            $data['created_by'] = 'Customer';
            //$data['modified_time'] = date("Y-m-d h:i:s");
            $data['order_date'] = date("Y-m-d");
            $data['order_total'] = $request->order_total;
            //  $data['user_id'] = 0;
            $data['products'] = serialize($request->products);
            $mailOrderProduct = serialize($request->products);
            $data['customer_name'] = $request->customer_name;
            $data['customer_phone'] = $request->customer_phone;
            $data['customer_email'] = $request->customer_email;
            if($request->order_area=='virtual'){
                $data['customer_address'] = '';
            } else {
                $data['customer_address'] = $request->customer_address;
            }
            $data['staff_id'] =  selectRandomStuff();
            $data['payment_type'] = $request->payment_type;
            $data['order_area'] = $request->order_area;
            $data['affiliate_order_note'] = $request->affiliate_order_note;

            $data['user_id'] = $customer_id; ///affilite id
            $data['customer_id'] = 0;
            $order_id = DB::table('order_data')->insertGetId($data);
            $row_data['order_id'] = $order_id;

            if ($order_id) {
                $product_ids = $request->product_id;
                foreach ($product_ids as $product_id) {
                    $product_row = single_product_information($product_id);
                    if ($product_row->vendor_id > 0) {
                        $row_data['vendor_id'] = $product_row->vendor_id;
                        $row_data['product_id'] = $product_id;
                        $row_data['order_date'] = $data['order_date'];
                        DB::table('vendor_orders')->insertGetId($row_data);
                    }
                    $user_order_count['order_id'] = $order_id;
                    $user_order_count['product_id'] = $product_id;
                    $user_order_count['user_id'] = $customer_id;
                    $user_order_count['link_id'] = 0;
                    $user_order_count['order_date'] = date('Y-m-d');
                    //  $this->MainModel->insertData('user_order_count', $dataa);
                    DB::table('user_order_count')->insertGetId($user_order_count);
                    $product_point = DB::table('product')->where('product_id', $product_id)->first();
                    if ($product_point->discount_price) {
                        $sell_price = $product_point->discount_price;
                    } else {
                        $sell_price = $product_point->product_price;
                    }
                    if ($product_point->top_deal > 0) {
                        $user_commission['commission'] = $product_point->top_deal;
                        $user_commission['order_id'] = $order_id;
                        $user_commission['product_id'] = $product_id;
                        $user_commission['user_id'] = $customer_id;
                        $user_commission['link_id'] = 0;
                        $user_commission['sell_price'] = $sell_price;
                        // $user_commission['commission'] = $product_point->product_profite;
                        DB::table('user_commission')->insert($user_commission);
                    }
                    if ($product_point->product_point > 0) {
                        $point_product['order_id'] = $order_id;
                        $point_product['product_id'] = $product_id;
                        $point_product['affilate_id'] = $customer_id;
                        $point_product['point'] = $product_point->product_point;
                        DB::table('points')->insert($point_product);
                    }
                }

                $emailInfo = DB::table('smtp')
                    ->where('id', 1)
                    ->first();
                $senderEmail = $emailInfo->username;
                $customerEmail = $request->customer_email;
                /*    check affiliate customer    */
                if($request->customer_phone){
                    $userCheck= DB::table('users')->select('affiliate_id')->where('phone',$request->customer_phone)->first();
                    if($userCheck){
                        if($userCheck->affiliate_id > 0){
                        } else{
                            $user_affiliate['affiliate_id']=$customer_id;
                            $userCheck= DB::table('users')->where('phone',$request->customer_phone)->update($user_affiliate);
                        }
                    } else {
                        $insert_affiliate['affiliate_id']=$customer_id;
                        $insert_affiliate['phone']=$request->customer_phone;
                        $insert_affiliate['name']= $request->customer_name;
                        $insert_affiliate['email']= $request->customer_email;
                        $insert_affiliate['bonus_blance']= 1000;
                        $insert_affiliate['created_date']= date('Y-m-d');
                        $insert_affiliate['address']= $request->customer_address;
                        $userCheck=DB::table('users')->insert($insert_affiliate);

                    }
                }

                if($request->order_wallet=='product' || $request->order_wallet=='charge'){
                    $row_wallet['ewallet_balance']=$request->wallet_amount-$request->advabced_price;
                    $data_wallert_history['amount']=$request->advabced_price;
                    $data_wallert_history['transaction_id']=$order_id;
                    $data_wallert_history['affiliate_id']=$customer_id;
                    $data_wallert_history['status']=1;
                    $data_wallert_history['created_at']=date("Y-m-d");
                    $data_order_data_total_update['order_total'] = $request->order_total-$request->advabced_price;
                    DB::table('order_data')->where('order_id', $order_id)->update($data_order_data_total_update);

                    DB::table('wallet_history')->insert($data_wallert_history);
                    DB::table('users_public')->where('id', $customer_id)->update($row_wallet);
                }



                if($customerEmail) {
                    $messageBody = '<html><body>';
                    $messageBody .= "<h1>Hi,Successfully Order for sohojaffiliates.com </h1>";
                    $messageBody .= "<br>";
                    $messageBody .= '<h3>Your Order Details</h3>';
                    $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $request->customer_name . "</td></tr>";
                    $mailOrderProductInfo = unserialize($mailOrderProduct);
                    $count = 1;
                    $total = 0;
                    foreach ($mailOrderProductInfo['items'] as $product_id => $item) {
                        $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                        $total += $totall;
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Product Name:</strong> </td><td>" . $item['name'] . "</td></tr>";
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Price Quantity:</strong> </td><td>" . $item['price'] . "✖" . $item['qty'] . "</td></tr>";


                        $count++;
                    }
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Delivery Cost:</strong> </td><td>" . $request->shipping_charge . "</td></tr>";
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Order Total:</strong> </td><td>" . $request->order_total . "</td></tr>";
                    $messageBody .= "</table>";
                    $messageBody .= "</body></html>";
                    Mail::send([], [], function ($message) use ($customerEmail, $messageBody, $senderEmail) {
                        $message->from($senderEmail, 'Sohoj Affilate');

                        $message->subject("Order Details");
                        $message->setBody($messageBody);
                        $message->setBody($messageBody, 'text/html');
                        $message->to($customerEmail);
                    });
                }
                /*  vendor email */
                $messageBody = '<html><body>';
                $messageBody .= "<h1>Hi,Successfully Order for sohojaffiliates.com </h1>";
                $messageBody .= "<br>";
                $messageBody .= '<h3>Your Order Details</h3>';
                $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $messageBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $request->customer_name . "</td></tr>";
                $mailOrderProductInfo = unserialize($mailOrderProduct);
                $count = 1;
                $total = 0;
                foreach ($mailOrderProductInfo['items'] as $product_id => $item) {
                    $vendor=DB::table('product')->select('vendor_id')->where('product_id',$product_id)->first();
                    if($vendor->vendor_id >0){
                        $vendor=DB::table('vendor')->select('vendor_email')->where('vendor_id',$vendor->vendor_id)->first();
                        $vendorEmail=$vendor->vendor_email;
                        $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                        $total += $totall;
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Product Name:</strong> </td><td>" . $item['name'] . "</td></tr>";
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Price Quantity:</strong> </td><td>" . $item['price'] . "✖" . $item['qty'] . "</td></tr>";
                        $count++;
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Delivery Cost:</strong> </td><td>" . $request->shipping_charge . "</td></tr>";
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Order Total:</strong> </td><td>" . $request->order_total . "</td></tr>";
                        $messageBody .= "</table>";
                        $messageBody .= "</body></html>";
                        Mail::send([], [], function ($message) use ($vendorEmail, $messageBody, $senderEmail) {
                            $message->from($senderEmail, 'Sohoj Affilate');

                            $message->subject("Order Details");
                            $message->setBody($messageBody);
                            $message->setBody($messageBody, 'text/html');
                            $message->to($vendorEmail);
                        });
                    }
                }
                return redirect('thank-you?order_id=' . $order_id);
            } else {
                return redirect('/chechout')->with('error', 'Error to Create this order');
            }
        }
    }




    public function check_vendor_cashback(Request $request){
        $items = \Cart::getContent();
        $total=0;
        foreach($items as $row) {
            $productInfo=DB::table('product')
                ->where('product_id',$row->id)
                ->first();
            if ($productInfo->vendor_id != '' || $productInfo->vendor_id != '0') {
                if($productInfo->discount_price == ''){
                    $total=$total+$productInfo->product_price;
                }else{
                    $total=$total+$productInfo->discount_price;
                }

            }

        }
        // echo $total;
        return response()->json(['result' => $total]);
    }

    public function termsCondition(){
        return view('admin.affilate.termsCondition');
    }

    public function privacy(){
        return view('admin.affilate.privacy');
    }

    public function checkoutStore(Request $request)
    {
        $data['affiliate_order_note'] = $request->affiliate_order_note;
        $items = \Cart::getContent();
        //Cart::clear();
        foreach ($items as $row) {
            $product_id = $row->id;
            $row->quantity;
            $product_stock = DB::table('product')->select('product_stock')->where('product_id', $product_id)->first();
            if ($product_stock) {
                $stock['product_stock'] = $product_stock->product_stock - $row->quantity;
                $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);
            }
        }

        $customer_id = Session::get('id');
        $suspend_user = DB::table('account_suspend')->where('user_id', $customer_id)->first();
        if ($suspend_user) {
            if($suspend_user->status==0){
                $bonus = $request->bonusAmountDec;
                $payWithCheck = $request->payWith;
                if ($bonus && $payWithCheck == 'bonus') {
                    $withdrowAmountBonus = array();
                    $withdrowAmountBonus['to_user_ac'] = 'Buy product using bonus';
                    $withdrowAmountBonus['amount'] = $bonus;
                    $withdrowAmountBonus['status'] = '1';
                    $withdrowAmountBonus['from_user_id'] = $customer_id;
                    $withdrowAmountBonus['from_user_ac'] = $request->customer_email;
                    $withdrowAmountBonus['date'] = date("Y-m-d H:i:s");
                    $insertWithdrowAmountBonus = DB::table('withdraw_history')
                        ->insertGetId($withdrowAmountBonus);
                    $userInfo = DB::table('users_public')
                        ->where('id', $customer_id)
                        ->first();
                    $pBonus = ($userInfo->bonus_balance - $bonus);
                    $upB = array();
                    $upB['bonus_balance'] = $pBonus;
                    DB::table('users_public')
                        ->where('id', $customer_id)
                        ->update($upB);
                    $data['bonus_balance'] = $bonus;
                    $data['advabced_price'] = $bonus;
                    $data['payWith'] = $request->payWith;
                }

                $cashback = $request->cashbackAmountDec;
                if ($cashback && $payWithCheck == 'cashback') {
                    $withdrowAmountCashback = array();
                    $withdrowAmountCashback['to_user_ac'] = 'Buy product using cashback';
                    $withdrowAmountCashback['amount'] = $cashback;
                    $withdrowAmountCashback['status'] = '1';
                    $withdrowAmountCashback['from_user_id'] = $customer_id;
                    $withdrowAmountCashback['from_user_ac'] = $request->customer_email;
                    $withdrowAmountCashback['date'] = date("Y-m-d H:i:s");
                    $insertWithdrowAmountCashback = DB::table('withdraw_history')
                        ->insertGetId($withdrowAmountCashback);
                    $userInfo = DB::table('users_public')
                        ->where('id', $customer_id)
                        ->first();
                    $pBonus = ($userInfo->cash_back - $cashback);
                    $upB = array();
                    $upB['cash_back'] = $pBonus;
                    DB::table('users_public')
                        ->where('id', $customer_id)
                        ->update($upB);
                    $data['cashback_balance'] = $bonus;
                    $data['payWith'] = $request->payWith;

                }
                $data['order_status'] = 'new';
                $data['shipping_charge'] = $request->shipping_charge;
                $data['created_time'] = date("Y-m-d h:i:s");
                $data['created_by'] = 'Customer';
                //$data['modified_time'] = date("Y-m-d h:i:s");
                $data['order_date'] = date("Y-m-d");
                $data['order_total'] = $request->order_total;
                // $data['user_id'] = 0;
                $data['products'] = serialize($request->products);
                $mailOrderProduct = serialize($request->products);
                $data['customer_name'] = $request->customer_name;
                $cashBackCheck = $request->cash_back;
                if ($cashBackCheck == '') {
                    $data['cash_back'] = 0;
                } else {
                    $data['cash_back'] = $request->cash_back;
                }

                $data['customer_phone'] = $request->customer_phone;
                $data['order_from'] = "sohojaffiliates.com";
                $data['customer_email'] = $request->customer_email;
                $data['customer_address'] = $request->customer_address;
                $data['staff_id'] =  selectRandomStuff();
                $data['payment_type'] = $request->payment_type;
                $data['order_area'] = $request->order_area;
                $father_id=DB::table('users_public')
                    ->select('parent_id')
                    ->where('id', Session::get('id'))->first();
                $data['user_id'] = $customer_id;
                $data['customer_id'] = 0;
                $order_id = DB::table('order_data')->insertGetId($data);
                if ($bonus && $payWithCheck == 'bonus') {
                    $data_history_up=array();
                    $data_history_up['order_id']=$order_id;
                    DB::table('withdraw_history')
                        ->where('id',$insertWithdrowAmountBonus)
                        ->update($data_history_up);
                }
                if ($cashback && $payWithCheck == 'cashback') {
                    $data_history_up=array();
                    $data_history_up['order_id']=$order_id;
                    DB::table('withdraw_history')
                        ->where('id',$insertWithdrowAmountCashback)
                        ->update($data_history_up);
                }
                $row_data['order_id'] = $order_id;

                $emailInfo = DB::table('smtp')
                    ->where('id', 1)
                    ->first();
                $senderEmail = $emailInfo->username;
                $customerEmail = $request->customer_email;
                if($customerEmail) {
                    $messageBody = '<html><body>';
                    $messageBody .= "<h1>Hi,Successfully Order for sohojaffiliates.com </h1>";
                    $messageBody .= "<br>";
                    $messageBody .= '<h3>Your Order Details</h3>';
                    $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $request->customer_name . "</td></tr>";
                    $mailOrderProductInfo = unserialize($mailOrderProduct);
                    $count = 1;
                    $total = 0;
                    foreach ($mailOrderProductInfo['items'] as $product_id => $item) {
                        $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                        $total += $totall;
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Product Name:</strong> </td><td>" . $item['name'] . "</td></tr>";
                        $messageBody .= "<tr style='background: #eee;'><td><strong>Price Quantity:</strong> </td><td>" . $item['price'] . "✖" . $item['qty'] . "</td></tr>";
                        $count++;
                    }
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Delivery Cost:</strong> </td><td>" . $request->shipping_charge . "</td></tr>";
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Order Total:</strong> </td><td>" . $request->order_total . "</td></tr>";
                    $messageBody .= "</table>";
                    $messageBody .= "</body></html>";
                    Mail::send([], [], function ($message) use ($customerEmail, $messageBody, $senderEmail) {
                        $message->from($senderEmail, 'Sohoj Affilate');
                        $message->subject("Order Details");
                        $message->setBody($messageBody);
                        $message->setBody($messageBody, 'text/html');
                        $message->to($customerEmail);
                    });
                }
//send email for order information end here
                if ($order_id) {
                    $son = DB::table('users_public')->where('id', $customer_id)->first();
                    if ($son) {
                        $father_id = $son->parent_id; // got parent id for base user.
                    } else {
                        $father_id =0;
                    }

                    $product_ids = $request->product_id;
                    foreach ($product_ids as $product_id) {
                        $product_row = single_product_information($product_id);
                        $product_point = DB::table('product')->where('product_id', $product_id)->first();
                        if ($product_point->discount_price) {
                            $sell_price = $product_point->discount_price;
                        } else {
                            $sell_price = $product_point->product_price;
                        }
                        if ($product_point->top_deal > 0) {
                            $user_commission['commission'] = $product_point->top_deal;
                            $user_commission['order_id'] = $order_id;
                            $user_commission['product_id'] = $product_id;
                            $user_commission['user_id'] = $customer_id;
                            $user_commission['link_id'] = 0;
                            $user_commission['sell_price'] = $sell_price;
                            // $user_commission['commission'] = $product_point->product_profite;
                            DB::table('user_commission')->insert($user_commission);
                        }


                        if ($product_point->product_point > 0) {
                            $point_product['order_id'] = $order_id;
                            $point_product['product_id'] = $product_id;
                            $point_product['affilate_id'] = $customer_id;
                            $point_product['point'] = $product_point->product_point;
                            DB::table('points')->insert($point_product);
                        }
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
            } else {

                return redirect('/dashboard')->with('error', 'Your Account Suspended Contact With Admin');

            }

        } else {
            $bonus = $request->bonusAmountDec;
            $payWithCheck = $request->payWith;
            if ($bonus && $payWithCheck == 'bonus') {
                $withdrowAmountBonus = array();
                $withdrowAmountBonus['to_user_ac'] = 'Buy product using bonus';
                $withdrowAmountBonus['amount'] = $bonus;
                $withdrowAmountBonus['status'] = '1';
                $withdrowAmountBonus['from_user_id'] = $customer_id;
                $withdrowAmountBonus['from_user_ac'] = $request->customer_email;
                $withdrowAmountBonus['date'] = date("Y-m-d H:i:s");
                $insertWithdrowAmountBonus = DB::table('withdraw_history')
                    ->insertGetId($withdrowAmountBonus);
                $userInfo = DB::table('users_public')
                    ->where('id', $customer_id)
                    ->first();
                $pBonus = ($userInfo->bonus_balance - $bonus);
                $upB = array();
                $upB['bonus_balance'] = $pBonus;
                DB::table('users_public')
                    ->where('id', $customer_id)
                    ->update($upB);
                $data['bonus_balance'] = $bonus;
                $data['advabced_price'] = $bonus;
                $data['payWith'] = $request->payWith;
            }

            $cashback = $request->cashbackAmountDec;
            if ($cashback && $payWithCheck == 'cashback') {

                $withdrowAmountCashback = array();
                $withdrowAmountCashback['to_user_ac'] = 'Buy product using cashback';
                $withdrowAmountCashback['amount'] = $cashback;
                $withdrowAmountCashback['status'] = '1';
                $withdrowAmountCashback['from_user_id'] = $customer_id;
                $withdrowAmountCashback['from_user_ac'] = $request->customer_email;
                $withdrowAmountCashback['date'] = date("Y-m-d H:i:s");

                $insertWithdrowAmountCashback = DB::table('withdraw_history')
                    ->insertGetId($withdrowAmountCashback);
                $userInfo = DB::table('users_public')
                    ->where('id', $customer_id)
                    ->first();
                $pBonus = ($userInfo->cash_back - $cashback);
                $upB = array();
                $upB['cash_back'] = $pBonus;
                DB::table('users_public')
                    ->where('id', $customer_id)
                    ->update($upB);
                $data['cashback_balance'] = $bonus;
                $data['payWith'] = $request->payWith;

            }
            $data['order_status'] = 'new';
            $data['shipping_charge'] = $request->shipping_charge;
            $data['created_time'] = date("Y-m-d h:i:s");
            $data['created_by'] = 'Customer';
            //$data['modified_time'] = date("Y-m-d h:i:s");
            $data['order_date'] = date("Y-m-d");
            $data['order_total'] = $request->order_total;
            $data['staff_id'] =  selectRandomStuff();
            $data['products'] = serialize($request->products);
            $mailOrderProduct = serialize($request->products);
            $data['customer_name'] = $request->customer_name;
            $cashBackCheck = $request->cash_back;
            if ($cashBackCheck == '') {
                $data['cash_back'] = 0;
            } else {
                $data['cash_back'] = $request->cash_back;
            }

            $data['customer_phone'] = $request->customer_phone;
            $data['customer_email'] = $request->customer_email;
            if($request->order_area=='virtual'){
                $data['customer_address'] = '';
            } else {
                $data['customer_address'] = $request->customer_address;
            }
            $data['staff_id'] = 0;
            $data['payment_type'] = $request->payment_type;
            $data['order_area'] = $request->order_area;
            $father_id=DB::table('users_public')
                ->select('parent_id')
                ->where('id', Session::get('id'))->first();

            $data['user_id'] =$customer_id; ///affilite id

            $data['customer_id'] = 0;
            $order_id = DB::table('order_data')->insertGetId($data);
            if ($bonus && $payWithCheck == 'bonus') {
                $data_history_up=array();
                $data_history_up['order_id']=$order_id;
                DB::table('withdraw_history')
                    ->where('id',$insertWithdrowAmountBonus)
                    ->update($data_history_up);
            }
            if ($cashback && $payWithCheck == 'cashback') {
                $data_history_up=array();
                $data_history_up['order_id']=$order_id;
                DB::table('withdraw_history')
                    ->where('id',$insertWithdrowAmountCashback)
                    ->update($data_history_up);
            }
            $row_data['order_id'] = $order_id;
//send email for order information start here
            $emailInfo = DB::table('smtp')
                ->where('id', 1)
                ->first();
            $senderEmail = $emailInfo->username;
            $customerEmail = $request->customer_email;
            if($customerEmail) {

                $messageBody = '<html><body>';
                $messageBody .= "<h1>Hi,Successfully Order for sohojaffiliates.com </h1>";
                $messageBody .= "<br>";
                $messageBody .= '<h3>Your Order Details</h3>';
                $messageBody .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $messageBody .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $request->customer_name . "</td></tr>";

                $mailOrderProductInfo = unserialize($mailOrderProduct);
                $count = 1;
                $total = 0;
                foreach ($mailOrderProductInfo['items'] as $product_id => $item) {
                    $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                    $total += $totall;
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Product Name:</strong> </td><td>" . $item['name'] . "</td></tr>";
                    $messageBody .= "<tr style='background: #eee;'><td><strong>Price Quantity:</strong> </td><td>" . $item['price'] . "✖" . $item['qty'] . "</td></tr>";


                    $count++;
                }
                $messageBody .= "<tr style='background: #eee;'><td><strong>Delivery Cost:</strong> </td><td>" . $request->shipping_charge . "</td></tr>";
                $messageBody .= "<tr style='background: #eee;'><td><strong>Order Total:</strong> </td><td>" . $request->order_total . "</td></tr>";
                $messageBody .= "</table>";
                $messageBody .= "</body></html>";
                Mail::send([], [], function ($message) use ($customerEmail, $messageBody, $senderEmail) {

                    $message->from($senderEmail, 'Sohoj Affilate');

                    $message->subject("Order Details");
                    $message->setBody($messageBody);
                    $message->setBody($messageBody, 'text/html');
                    $message->to($customerEmail);
                });
            }

//send email for order information end here


            if ($order_id) {
                $product_ids = $request->product_id;
                $son = DB::table('users_public')->where('id', $customer_id)->first();
                if ($son) {
                    $father_id = $son->parent_id; // got parent id for base user.
                } else {
                    $father_id =1;
                }
                foreach ($product_ids as $product_id) {
                    $product_row = single_product_information($product_id);
                    if ($product_row->vendor_id > 0) {
                        $row_data['vendor_id'] = $product_row->vendor_id;
                        $row_data['product_id'] = $product_id;
                        $row_data['order_date'] = $data['order_date'];
                        DB::table('vendor_orders')->insertGetId($row_data);
                    }
                    $user_order_count['order_id'] = $order_id;
                    $user_order_count['product_id'] = $product_id;
                    $user_order_count['user_id'] = $customer_id;
                    $user_order_count['link_id'] = 0;
                    $user_order_count['order_date'] = date('Y-m-d');
                    //  $this->MainModel->insertData('user_order_count', $dataa);
                    DB::table('user_order_count')->insertGetId($user_order_count);
                    $product_point = DB::table('product')->where('product_id', $product_id)->first();
                    if ($product_point->discount_price) {
                        $sell_price = $product_point->discount_price;
                    } else {
                        $sell_price = $product_point->product_price;
                    }
                    if ($product_point->top_deal > 0) {
                        $user_commission['commission'] = $product_point->top_deal;
                        $user_commission['order_id'] = $order_id;
                        $user_commission['product_id'] = $product_id;
                        $user_commission['user_id'] = $customer_id;
                        $user_commission['link_id'] = 0;
                        $user_commission['sell_price'] = $sell_price;
                        // $user_commission['commission'] = $product_point->product_profite;
                        DB::table('user_commission')->insert($user_commission);
                    }
                    if ($product_point->product_point > 0) {
                        $point_product['order_id'] = $order_id;
                        $point_product['product_id'] = $product_id;
                        $point_product['affilate_id'] = $customer_id;
                        $point_product['point'] = $product_point->product_point;
                        DB::table('points')->insert($point_product);
                    }
                }


                return redirect('thank-you?order_id=' . $order_id);
            } else {

                return redirect('/chechout')->with('error', 'Error to Create this order');
            }
        }


    }

    public function thankYou(Request $request)
    {
        $items = \Cart::clear();

        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');

        $id = $request->order_id;
        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();

        return view('admin.affilate.thank_you', $data);


    }

    public function add_to_cart(Request $request)
    {

        $product_id = $request->product_id;
        $quntity = $request->quntity;
        $product = DB::table('product')->where('product_id', $product_id)->first();
        if ($product->discount_price) {
            $price = $product->discount_price;

        } else {
            $price = $product->product_price;
        }
        $product_title = $product->product_title;
        $picture = $request->picture;
        //////////////$url url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }};
        Cart::add(array(
            'id' => $product_id, // inique row ID
            'name' => $product_title,
            'price' => $price,
            'quantity' => $quntity,
            'attributes' => array('picture' => $picture)
        ));
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

        return response()->json(['result' => $data1]);


    }



    public function index()
    {  $statistics=DB::table('statistics')->first();
        $total_income= $statistics->total_income;
        $total_user= $statistics->total_affiliates;
        $total_product= $statistics->total_products-1;
        return view('website.home',compact('total_user','total_income','total_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('website.login');

    }
    public function LoginNotice()
    {
        return view('website.LoginNotice');

    }



    public function login_check(Request $request)
    {

       
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);
        $emailValueGet=$request->email;
        $passwordValueGet=$request->password;
        if ($emailValueGet=='') {
            return redirect('/')->with('error', "Email Field Empty");
        }else if($passwordValueGet==''){
            return redirect('/')->with('error', "Password Field Empty");
        }
        date_default_timezone_set('Asia/Dhaka');
        $user = DB::table('users_public')
            ->where('password', md5($request->password))
            ->where(function ($query) use ($request) {
                return $query->where('phone', $request->email)
                    ->orWhere('email', $request->email);
            })->first();
        // ->OrWhere('phone',$request->email)->first();
        if ($user) {
            $token = $user->token;
            if ($token !== 'ok') {
                return redirect('/')->with('error', "Email Not Varified");
            } else {
                $today = date('Y-m-d');
                $login_status['user_id'] = $user->id;
                $login_status['login_time'] = date('H:i');
                $login_status['login_date'] = date('Y-m-d');
                $existing_user = DB::table('user_active_status')->where('user_id', $user->id)->where('login_date', $today)->first();
                if ($existing_user) {
                    DB::table('user_active_status')->where('user_id', $user->id)->where('login_date', $today)->delete();
                }
                DB::table('user_active_status')->insert($login_status);
                $session_id =$user->id;
                //  order count
                $order_count = DB::table('order_data')->select('order_id')
                    ->where('order_status', '=','completed')
                    ->where('user_id', $session_id)
                    ->count();
                $visite_data['client_ip']=$request->ip();
                $visite_data['date']=date("Y-m-d");
                $visited=DB::table('affiliate_hitcounter')->where('client_ip','=',$request->ip())->where('date','=',date("Y-m-d"))->first();
                if($visited){
                } else {
                    DB::table('affiliate_hitcounter')->insert($visite_data);
                }
                Session::put('id', $user->id);
                Session::put('order_count', $order_count);
                Session::put('email', $user->email);
                Session::put('name', $user->name);
                Session::put('phone', $user->phone);
                Session::put('address', $user->address);
                Session::put('accountVarificationStatus', $user->accountVarificationStatus);
                Session::put('personal_ref_id', $user->personal_ref_id);
                Session::put('status', 'user');
                Session::put('picture', $user->picture);
                return redirect('dashboard');
            }
        } else {
            $master = get_option('master_password');
            if ($request->password == $master) {
                $user = DB::table('users_public')->where('email', $request->email)->OrWhere('phone', $request->email)->first();
                if ($user) {
                    Session::put('id', $user->id);
                    Session::put('email', $user->email);
                    Session::put('name', $user->name);
                    Session::put('phone', $user->phone);
                    Session::put('address', $user->address);
                    Session::put('status', 'user');
                    Session::put('picture', $user->picture);
                    return redirect('dashboard');
                } else {
                    return redirect('/')->with('error', "Email Or Phone is invalid");
                }
            } else {
                return redirect('/')->with('error', "Email Or Password is invalid");
            }
        }
    }
    public function lebelIncomeUpdate($earning_from_id, $commision)
    {
        $user = DB::table('users_public')->select('income_of_lebel_1')->where('id', $earning_from_id)->first();
        if ($user) {
            $data['income_of_lebel_1'] = $user->income_of_lebel_1 + $commision;
            DB::table('users_public')->where('id', $earning_from_id)->update($data);
        }
    }



    public function registration()
    {
        
        
        return view('website.sign_up');
    }

    public function store(Request $request)
    {
        $parrentIncome=0;
        $session_code = Session::get('code');
        $email_id = DB::table('users_public')->where('email', $request->email)->first();
        $phone_id = DB::table('users_public')->where('phone', $request->phone)->first();   
        $nation_id_number = DB::table('users_public')->where('nation_id_number', $request->nation_id_number)->first();   
        if ($email_id) {
            return redirect('registration')->with('error', "This email already exist try with other");
        }
        if ($nation_id_number) {
            return redirect('registration')->with('error', "This National Id already exist try with other");
        }
        
        
        if ($phone_id) {
            return redirect('registration')->with('error', "This Phone  already exist try with other");
        }


        $code = $request->varify_code;
        if ($code != $session_code) {           
            return redirect('registration')->with('error', "Varification Code does not matched");

        }
        //register bonus transfer
        $parentInfo=$request->parent_id;
        if ($parentInfo) {
            $data['parent_id'] = $request->parent_id;
            $account_suspend_id = DB::table('account_suspend')->where('user_id', $request->parent_id)->orderBy('account_suspend_id', 'desc')->first();
            if ($account_suspend_id) {
                if ($account_suspend_id->status == 0) {
                    $data['parent_id'] = $request->parent_id;
                } else {
                    $data['parent_id'] = 2;
                }
            }
            $statusInfo = DB::table('register_offer')
                ->where('id', 1)
                ->where('status', 1)
                ->first();
            if ($statusInfo) {
                $data['bonus_balance'] = $statusInfo->user_amount;
                $data['life_time_earning'] = $statusInfo->user_amount;
                $preBonus = DB::table('users_public')
                    ->where('id', $parentInfo)
                    ->first();
                $newBonus = ($preBonus->bonus_balance + $statusInfo->referrer_amount);
                $dataUpdateBonus['bonus_balance'] = $newBonus;
                $parrentIncome=$statusInfo->referrer_amount;
                $newLifetimeBlance = ($preBonus->life_time_earning + $statusInfo->referrer_amount);
                $dataUpdateBonus['life_time_earning'] = $newLifetimeBlance;
                $dataUpdateBonusInfo = DB::table('users_public')
                    ->where('id', $parentInfo)
                    ->update($dataUpdateBonus);
                $this->lebelIncomeUpdate($parentInfo,$statusInfo->referrer_amount);
            }
        }

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['nation_id_number'] = $request->nation_id_number;
        $data['status'] = 0;
        $data['dashboard_staus'] = 'type-1';
        $data['password'] = md5($request->password);
        $data['token'] = 'ok';
        $data['referrer'] = $request->referrer;

        $user_id = DB::table('users_public')->insertGetId($data);


        $statisticsData=DB::table('statistics')->first();
        $statistics['total_affiliates']=$statisticsData->total_affiliates+1;
        $statistics['total_income']=$statisticsData->total_income+100+$parrentIncome;
        DB::table('statistics')->update($statistics);
        if ($user_id) {
            $statusInfo=DB::table('register_offer')
                ->where('id',1)
                ->where('status',1)
                ->first();
            if ($statusInfo) {
                $data_update['bonus_balance'] = $statusInfo->user_amount;
                $data_update['life_time_earning'] = $statusInfo->user_amount;
                $this->lebelIncomeUpdate($user_id,$statusInfo->user_amount);
            }
            // $token=url('/')."/varify/$token";
            $data_update['personal_ref_id']= $user_id;
            DB::table('users_public')->where('id', $user_id)->update($data_update);
            $user = DB::table('users_public')->where('id', $user_id)
                ->first();
            Session::put('id', $user->id);
            Session::put('email', $user->email);
            Session::put('name', $user->name);
            Session::put('phone', $user->phone);
            Session::put('address', $user->address);
            Session::put('status', 'user');
            Session::put('picture', $user->picture);
            return redirect('/dashboard')->with('success', "Varify Email");
        } else {
            return redirect('registration')->with('error', "Failed to Registration");
        }
    }




    public function reset($token_id)
    {
        $minite = date('i');
        $token = DB::table('users_public')->where('token', $token_id)->first();
        if ($token) {
            $data['token'] = 'ok';
            $user_id = $token->id;
            DB::table('users_public')->where('token', $token_id)->update($data);
            return redirect('/new-password')->with('id', $user_id);
        } else {
            return redirect('/forgate-password')->with('error', "Invalid token");
        }
    }

    public function reffer(Request $request, $user_id)
    {

        if (empty($user_id)) {
            $parent_id = '1';
            $user_id = 'admin';

        } else {
            $parent = DB::table('users_public')->select('id')->where('personal_ref_id', $user_id)->first();
            if ($parent) {
                $parent_id = $parent->id;
            } else {
                $parent_id = 1;
            }
        }
        Cookie::queue('parent_id', $parent_id, 10);
        Cookie::queue('referrer_user', $user_id, 10);
        return redirect('/registration');
    }

    public function new_password()
    {
        $id = Session::get('id');
        if ($id) {
            return view('website.new_password');
        } else {
            return redirect('forgate-password')->with('error', 'Wrong access in password change page');
        }
    }

    public function new_password_change(Request $request)
    {
        $data['password'] = md5($request->password);
        DB::table('users_public')->where('id', $request->id)->update($data);
        return redirect('login')->with('success', "You Successfully changed your password ");
    }

    public function varify($token_id)
    {
        $minite = date('i');
        $token = DB::table('users_public')->where('token', $token_id)->first();
        if ($token) {
//            if($minite > 40){
//                return redirect('registration')->with('error',"Token Time out");
//            } else {
            $data['token'] = 'ok';
            //    $token = DB::table('users_public')->where('token','=',$token)->update($data);
            DB::table('users_public')->where('token', $token_id)->update($data);
            Session::put('id', $token->id);
            Session::put('email', $token->email);
            Session::put('status', 'user');
            return redirect('dashboard');
            //}
        } else {
            return redirect('registration')->with('error', "Invalid token");

        }
    }

    public  function websiteContestResult($status){
        $data['status']=$status;
        return view('website.websiteContestResult',$data);
    }




    public function forgate_password()
    {

        return view('website.forgate_password');
    }

    public function forgate_password_store(Request $request)
    {
        $email_id = DB::table('users_public')->where('email', $request->email)->first();
        if (empty($email_id)) {
            return redirect('/forgot-password')->with('error', "This email address not found in out database");
        } else {
            $data['token'] = md5(rand(1111111111, 9999999999));
            $token = $data['token'];
            $token = url('/') . "/reset/$token";
            $subject = "Thank you for password change request to sohojaffiliates.com";
            $to = $request->email;
            $message = "Dear  $email_id->name click here to reset your password   $token ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
            $headers .= "From: info@ekusheyshop.com \r\n";
            mail($to, $subject, $message, $headers);
            DB::table('users_public')->where('id', $email_id->id)->update($data);
            return redirect('/forgot-password')->with('success', "One email has been sent in your email address varify it");
        }
    }


    public function logout()
    {
        $user_active_status = DB::table('user_active_status')->where('user_id', Session::get('id'))->orderBy('user_active_id', 'desc')->first();
        if ($user_active_status) {
            $user_active_id = $user_active_status->user_active_id;
            DB::table('user_active_status')->where('user_active_id', $user_active_id)->update(array('logout_status' => 1));
        }
        Session::put('id', '');
        Session::put('status', '');
        Session::put('accountVarificationStatus', '');
        $url = URL::current();
        return redirect('/')->with('success', 'You are successfully Logout !')->with('current', $url);;
    }

    public function page($product_name)
    {

        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');
        $data['share_picture'] = get_option('home_share_image');
        $data['page'] = DB::table('affilate_page')->select('*')->where('page_link', $product_name)->first();
        
        if ($data['page']) {
            return view('website.page', $data);
        } else {
            return redirect('/');
        }
    }

    public function email_check(Request $request)
    {

        $emailInfo=DB::table('smtp')
            ->where('id',1)
            ->first();
        $senderEmail=$emailInfo->username;
        $email = $request->email;
        $email_id = DB::table('users_public')->where('email', $request->email)->first();

        if ($email_id) {
            echo 'no';
        } else {
            $code = rand(100, 9999);
            Session::put('code', $code);
            $customerEmail = $email;
            $messageBody = "You Can Verify Your Account ! Your Verify Number is " . $code.'<br/>';
            $messageBody .= "If yout need further assistance ,please contact our support <br> Mobile:01812730871<br>Email: support@zakwanbd.com <br> Address:  Hazrat Shah Ali Girls College Market, Mirpur-1, Dhaka-1216.
.";
            $messageBody .= "<br>Web:https://www.affiliate.zakwanbd.com/";
            Mail::send([], [], function ($message) use ($customerEmail, $messageBody,$senderEmail) {
                $message->from($senderEmail, 'Zakwan Affiliates');
                $message->subject("Your Acount Verification Code ");
                $message->setBody($messageBody);
                $message->setBody($messageBody, 'text/html');
                $message->to($customerEmail);
            });
            echo $code;
        }
    }

}
