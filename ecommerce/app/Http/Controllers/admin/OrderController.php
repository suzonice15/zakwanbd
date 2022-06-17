<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use AdminHelper;
use URL;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set('Asia/Dhaka');

    }

    public function index()
    {
        
        
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $data['main'] = 'Orders';
        $data['active'] = 'All Orders';
        $data['title'] = '  ';
        $data['order_status'] = 'new';
        $admin_user_status=Session::get('status');
        $staff_id=Session::get('id');
        if($admin_user_status=='office-staff' || $admin_user_status=='editor') {
            $orders = DB::table('order_data')->where('staff_id', $staff_id)->where('order_status', 'new')->orderBy('order_id', 'desc')->paginate(10);
        }else{
            $orders = DB::table('order_data')->where('order_status', 'new')->orderBy('order_id', 'desc')->paginate(10);
        }
       $data['stuffInfo'] =DB::table('admin')->where('status','office-staff')
            ->where('active_status', 1)->get();
        return view('admin.order.index', compact('orders'), $data);
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $admin_user_status=Session::get('status');
            $staff_id=Session::get('id');
            if($admin_user_status=='office-staff' || $admin_user_status=='editor') {
                if($status==1){
                    $orders = DB::table('order_data')->orderBy('order_id', 'desc')
                        ->paginate(10);
                }else{
                    $orders = DB::table('order_data')->where('staff_id',$staff_id)->where('order_status', $status)->orderBy('order_id', 'desc')
                        ->paginate(10);
                }


            } else{
                if($status==1){
                    $orders = DB::table('order_data')->orderBy('order_id', 'desc')
                        ->paginate(10);
                }else {
                    $orders = DB::table('order_data')->where('order_status', $status)->orderBy('order_id', 'desc')
                        ->paginate(10);
                }
            }
            return view('admin.order.pagination', compact('orders'));
        }
    }

    public function pagination_by_search(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $orders = DB::table('order_data')->orWhere('order_id', 'LIKE', '%' . $query . '%')
                ->orderBy('order_id', 'desc')
                ->paginate(10);
            return view('admin.order.pagination', compact('orders'));
        }

    }


    public function orderConvertToProductCode()
    {


        $orders = DB::table('users')->select('id','bonus_blance')->get();
        foreach ($orders as $key => $order) {
                        $data['bonus_blance']=$order->bonus_blance*100;
                        DB::table('users')->where('id',$order->id)->update($data);
                    }
        echo 'done';
    }

    public function pagination_search_by_phone(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $orders = DB::table('order_data')
                ->where('customer_phone', 'LIKE', '%' . $query . '%')
                ->orderBy('order_id', 'desc')
                ->paginate(500);
            return view('admin.order.pagination', compact('orders'));
        }

    }

    public function pagination_search_by_product_code(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $orders = DB::table('order_data')
                ->join('product_of_order_data', 'product_of_order_data.order_id', '=', 'order_data.order_id')
                ->where('product_code', $query)
                ->orderBy('order_data.order_id', 'desc')
                ->paginate(100);
            return view('admin.order.pagination', compact('orders'));
        }

    }


    public function pagination_search_by_affiliate_id(Request $request)
    {

        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $orders = DB::table('order_data')
                ->where('user_id', '=', $query)
                ->orderBy('order_id', 'desc')
                ->paginate(500);
            return view('admin.order.pagination', compact('orders'));
        }

    }


    public function pagination_by_status(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $admin_user_status=Session::get('status');
            $staff_id=Session::get('id');
            if($admin_user_status=='office-staff' || $admin_user_status=='editor') {


                $orders = DB::table('order_data')->where('staff_id', $staff_id)->where('order_status', $status)->orderBy('order_id', 'desc')
                    ->paginate(10);
            }else{
                $orders = DB::table('order_data')->where('order_status', $status)->orderBy('order_id', 'desc')
                    ->paginate(10);
            }
            return view('admin.order.pagination', compact('orders'));
        }

    }


    public function create()
    {

        $status = Session::get('status');
        if ($status == 'super-admin' || $status == 'office-staff' || $status == 'editor') {

            $user_id = AdminHelper::Admin_user_autherntication();
            $url = URL::current();

            if ($user_id < 1) {
                //  return redirect('admin');
                Redirect::to('admin')->with('redirect', $url)->send();

            }

            $data['main'] = 'Orders';
            $data['active'] = 'All orders';
            $data['title'] = '  ';
            $data['order'] = DB::table('order_data')->where('order_id', 268)->first();


            $data['couriers'] = DB::table('courier')->get();
            $data['products'] = DB::table('product')->select('product_id', 'product_title', 'sku')->orderby('product_id', 'desc')->get();


            return view('admin.order.create', $data);
        } else {
            return redirect()->back();
        }


    }

    public function store(Request $request)
    {
        $data['order_status'] = $request->order_status;
        $order_status = $request->order_status;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['user_id'] = $request->user_id;
        $data['created_time'] = date("Y-m-d H:i:s");
        $data['created_by'] = Session::get('name');
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data['order_date'] = date("Y-m-d");
        $data['order_total'] = $request->order_total;
        $data['products'] = serialize($request->products);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['courier_service'] = $request->courier_service;
        $data['order_from'] = "sohojbuy.com";
        $data['staff_id'] = Session::get('id');
        //$data['delevery_address'] = $request->delevery;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['discount_price'] = $request->discount_price;
        $data['advabced_price'] = $request->advabced_price;
        $data['order_note'] = $request->order_note;
        //   $data['payment_type'] = $request->payment_type;
        // $data['city'] = $request->city');
        //$row_data['order_remark'] = $request->order_remark');


        if ($order_status == 'delivered') {

        }


        // $customer_name = $data['customer_name'];
        // $customer_email = $data['customer_email'];
        // $site_title = get_option('site_title');
        // $site_email = get_option('email');


        if ($request->shipment_time) {

            $data['shipment_time'] = date('Y-m-d H:i:s', strtotime($request->shipment_time));
        }


        $order_data = DB::table('order_data')->insertGetId($data);
        /// order edit track
        $order_track['status'] = "order From " . Session::get('name') . $order_status;
        $order_track['user_id'] = Session::get('id');
        $order_track['order_id'] = $order_data;
        $order_track['updated_date'] = date('Y-m-d H:i:s');
        $order_track['user_name'] = Session::get('name');
        $order_track['order_note'] = $request->order_note;
        DB::table('order_edit_track')->insert($order_track);


        if ($order_data) {


            return redirect('admin/orders')->with('success', 'Created successfully.');
        } else {

            return redirect('admin/orders/')->with('error', 'Error to Create this order');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }


        $data['main'] = 'Orders';
        $data['active'] = 'Update Orders';
        $data['title'] = 'Update Orders Data';
        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();


        $data['couriers'] = DB::table('courier')->where('active', '=', 1)->get();
        $data['products'] = DB::table('product')->select('product_id', 'product_title', 'sku')->orderby('product_id', 'desc')->get();


        return view('admin.order.edit', $data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        /* product stock variation */
        $order_details = DB::table('order_data')->select('products', 'order_date')->where('order_id', $id)->first();
        $order_items = unserialize($order_details->products);
        $stock_check_product = serialize($request->products);
        if (is_array($order_items['items'])) {
            foreach ($order_items['items'] as $product_id => $item) {
                $form_products = unserialize($stock_check_product);
                foreach ($form_products['items'] as $product_id_form => $item_from) {

                    if ($product_id_form == $product_id) {

                        if ($item_from['qty'] >= $item['qty']) {
                            $product_stock = DB::table('product')->select('product_stock')
                                ->where('product_id', $product_id)->first();
                            if ($product_stock) {
                                $stock['product_stock'] = $product_stock->product_stock - ($item_from['qty'] - $item['qty']);
                                $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);
                            }
                        } else {
                            $product_stock = DB::table('product')->select('product_stock')
                                ->where('product_id', $product_id)->first();
                            if ($product_stock) {
                                $stock['product_stock'] = $product_stock->product_stock + ($item['qty'] - $item_from['qty']);
                                $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);
                            }

                        }


                    }

                }

            }
        }


        $order_number = $id;
        $statusInfoCheck = $request->order_status;
        //vendor amount add..
        if ($statusInfoCheck == 'delivered') {

            $product_of_order_data ['order_id'] = $id;
            $product_of_order_data ['date'] = $order_details->order_date;
            $order_items = unserialize($order_details->products);
            if (is_array($order_items['items'])) {
                foreach ($order_items['items'] as $product_id => $item) {
                    $products_sku = DB::table('product')->select('sku')->where('product_id', '=', $product_id)->first();
                    if ($products_sku) {
                        $product_of_order_data ['product_code'] = $products_sku->sku;
                        DB::table('product_of_order_data')->insert($product_of_order_data);
                    }
                }
            }

        }

        if ($statusInfoCheck == 'completed') {
            $cashBackInfo = DB::table('order_data')
                ->where('order_id', $order_number)
                ->first();
            $info = DB::table('users_public')
                ->where('id', $cashBackInfo->order_from_affilite_id)
                ->first();
            if ($info) {
                $preCash = $info->cash_back;
                $presentCash = ($preCash + $cashBackInfo->cash_back);
                $data_customer['cash_back'] = $presentCash;
                $updateInfo = DB::table('users_public')
                    ->where('id', $cashBackInfo->order_from_affilite_id)
                    ->update($data_customer);
            }

        }
        $data['order_status'] = $request->order_status;
        $order_status = $request->order_status;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['discount_price'] = $request->discount_price;
        $data['advabced_price'] = $request->advabced_price;
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data['order_total'] = $request->order_total;
        $data['products'] = serialize($request->products);
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['courier_service'] = $request->courier_service;
        $data['changed_affilite_commision'] = $request->totalCommision;
        $data['order_note'] = $request->order_note;


        /// order edit track
        $order_track['status'] = $order_status;
        $order_track['user_id'] = Session::get('id');
        $order_track['order_id'] = $order_number;
        $order_track['updated_date'] = date('Y-m-d H:i:s');
        $order_track['user_name'] = Session::get('name');
        $order_track['order_note'] = $request->order_note;
        DB::table('order_edit_track')->insert($order_track);
        if ($request->shipment_time) {
            $data['shipment_time'] = date('Y-m-d H:i:s', strtotime($request->shipment_time));
        }
        $order_data = DB::table('order_data')->where('order_id', $order_number)->update($data);
        /// Commision calcution
        if ($order_status == 'completed') {
            // top product sell
            $BackBonasInfo = DB::table('order_data')
                ->where('order_id', $order_number)
                ->first();
            /* statistics data */
            $statistics = DB::table('statistics')->first();
            $statistics_data['total_sell_amounts'] = $statistics->total_sell_amounts + $BackBonasInfo->order_total;
            $statistics_data['total_sell_count'] = $statistics->total_sell_count + 1;
            DB::table('statistics')->where('id', '=', 1)->update($statistics_data);
            // contest commision fund
            if ($BackBonasInfo->user_id > 0) {
                $today_date = date("Y-m-d");
                $contest_first_date = get_option_of_affilite('contest_first_date');
                $contest_last_date = get_option_of_affilite('contest_last_date');
                if ($BackBonasInfo->order_date >= $contest_first_date && $BackBonasInfo->order_date <= $contest_last_date) {
                    $contest_fund = DB::table('contest_fund')->first();
                    $contest_fund_data['amount'] = $contest_fund->amount + 20;
                    DB::table('contest_fund')->update($contest_fund_data);
                    $contest_fund_history['user_id'] = $BackBonasInfo->user_id;
                    $contest_fund_history['amount'] = 20;
                    $contest_fund_history['order_id'] = $order_number;
                    $contest_fund_history['created_at'] = date("Y-m-d");
                    DB::table('contest_fund_history')->insert($contest_fund_history);
                }
            }
            $info = DB::table('users_public')
                ->where('id', $BackBonasInfo->user_id)
                ->first();
            if ($info) {
                $mainWithdrawh = $info->withdraw_balance;
                $finalWithdraw = ($mainWithdrawh + $BackBonasInfo->bonus_balance);
                $bonashdata_customer['withdraw_balance'] = $finalWithdraw;
                $bonashdata_customer['status'] = 1;
                $updateInfo = DB::table('users_public')
                    ->where('id', $BackBonasInfo->user_id)
                    ->update($bonashdata_customer);
                UpdateStatisticCommisionData($BackBonasInfo->bonus_balance);
            }
            $order_details = DB::table('order_data')->select('products')->where('order_id', $order_number)->first();
            $order_items = unserialize($order_details->products);
            if (is_array($order_items['items'])) {
                foreach ($order_items['items'] as $product_id => $item) {
                    $top_product_sell['quantity'] = $item['qty'];
                    $top_product_sell['product_id'] = $product_id;
                    $top_product_sell['order_id'] = $order_number;
                    $top_product_sell['order_id'] = $order_number;
                    $top_product_sell['sell_price'] = $item['price'];
                    DB::table('top_product_sell')->insert($top_product_sell);
                }
            }

            $this->commisionDistribution($order_number, $request->totalCommision);
            $this->pointDistribution($order_number);

            $affiliate_id = DB::table('order_data')
                ->select('user_id', 'order_from_affilite_id')
                ->where('order_id', $order_number)->first();
            if ($affiliate_id->user_id > 0) {
                $loopCount = count($request->commion_product_id);
                for ($i = 0; $i < $loopCount; $i++) {
                    $commision_data['order_id'] = $order_number;
                    $commision_data['product_id'] = $request->commion_product_id[$i];
                    $commision_data['comission'] = $request->commision[$i];
                    $commision_data['affilate_id'] = $affiliate_id->user_id;
                    $commision_data['date'] = date('Y-m-d');
                    DB::table('product_permission_report')->insert($commision_data);
                }
            }
        }

        if ($order_status == 'cancled') {
            $BackBonasInfo = DB::table('order_data')
                ->where('order_id', $order_number)
                ->first();
            $info = DB::table('users_public')
                ->where('id', $BackBonasInfo->user_id)
                ->first();
            if ($info) {
                DB::table('withdraw_history')
                    ->where('order_id', $order_number)
                    ->delete();
                $preCash = $info->bonus_balance;
                $presentCash = ($preCash + $BackBonasInfo->bonus_balance);
                $bonashdata_customer['bonus_balance'] = $presentCash;
                $updateInfo = DB::table('users_public')
                    ->where('id', $BackBonasInfo->user_id)
                    ->update($bonashdata_customer);
                $data_orderback_bonas['bonus_balance'] = 0;
                $BackBonasInfo = DB::table('order_data')
                    ->where('order_id', $order_number)
                    ->update($data_orderback_bonas);
            }
        }


        if ($order_data) {
/// stock add
            if ($order_status == 'cancled') {
                $order_details = DB::table('order_data')->where('order_id', $order_number)->first();
                $order_items = unserialize($order_details->products);
                if (is_array($order_items['items'])) {
                    foreach ($order_items['items'] as $product_id => $item) {
                        $product_stock = DB::table('product')->select('product_stock')->where('product_id', $product_id)->first();
                        if ($product_stock) {
                            $stock['product_stock'] = $product_stock->product_stock + $item['qty'];
                            $product_stock = DB::table('product')->where('product_id', $product_id)->update($stock);
                        }
                    }
                }
            }
            return redirect('admin/orders')
                ->with('success', 'Updated successfully.');
        } else {

            return redirect('admin/order/' . $order_number)
                ->with('success', 'Error to update this order');
        }


    }

    // point distribution to normal user

    function pointDistribution($order_id)
    {

        $order_details = DB::table('order_data')->where('order_id', $order_id)->first();
        if ($order_details->customer_id > 0) {


            if (!empty($order_details)) {

                $order_id = $order_details->order_id;
                $baseID = $order_details->customer_id; // order korse je tar userid
                $order_items = unserialize($order_details->products);
                if (is_array($order_items['items'])) {
                    $single_product_point = 0;
                    foreach ($order_items['items'] as $product_id => $item) {
                        $single_product = DB::table('product')->select('product_point')
                            ->where('product_id', $product_id)->first();


                        $single_product_point += $single_product->product_point * $item['qty'];
                    }

                    $user = DB::table('users')->where('id', $baseID)->first();
                    if ($user) {
                        $points = $user->points;
                        $data['points'] = $single_product_point + $points;
                    }
                    if (!empty($baseID)) {
                        DB::table('users')->where('id', $baseID)->update($data);
                    }

                    //all insert query start from here.
                    if (!empty($baseID)) {
                        $row_data['order_id'] = $order_id;
                        $row_data['user_id'] = $baseID;
                        $row_data['point'] = $data['points'];
                        DB::table('user_point_history')->insert($row_data);

                    }


                }


            }


        }
    }

    function orderHistoryGenerate()
    {
        $order_details = DB::table('order_data')->where('order_status', '=', 'completed')->get();

        foreach ($order_details as $order) {


            $order_id = $order->order_id;
            $order_items = unserialize($order->products);
            if (is_array($order_items['items'])) {

                foreach ($order_items['items'] as $product_id => $item) {

                    $single_product = DB::table('product')
                        ->select('product_order_count')
                        ->where('product_id', $product_id)->first();
                    if ($single_product) {
                        $priviousOrderCount['product_order_count'] = $single_product->product_order_count + $item['qty'];
                        DB::table('product')->where('product_id', $product_id)->update($priviousOrderCount);
                        $order_history_count['product_id'] = $product_id;
                        $order_history_count['order_count'] = $item['qty'];
                        $order_history_count['order_id'] = $order_id;
                        $order_history_count['created_at'] = date("Y-m-d");
                        DB::table('product_order_history')->insert($order_history_count);
                    }

                }
            }
        }

    }

    function commisionDistribution($order_id, $commision_price)
    {

        $order_details = DB::table('order_data')->where('order_id', $order_id)->first();

        if (!empty($order_details)) {
            $single_product_point = 0;
            $order_id = $order_details->order_id;
            $order_items = unserialize($order_details->products);

            /* vendor commistion */
            if (is_array($order_items['items'])) {
                foreach ($order_items['items'] as $product_id => $item) {
                    $single_product = DB::table('product')
                        ->select('product_profite', 'product_order_count', 'product_point', 'vendor_id', 'vendor_price', 'discount_price')
                        ->where('product_id', $product_id)->first();
                    if ($single_product) {
                        $priviousOrderCount['product_order_count'] = $single_product->product_order_count + $item['qty'];
                        DB::table('product')->where('product_id', $product_id)->update($priviousOrderCount);
                        $order_history_count['product_id'] = $product_id;
                        $order_history_count['order_count'] = $item['qty'];
                        $order_history_count['order_id'] = $order_id;
                        $order_history_count['created_at'] = date("Y-m-d");
                        DB::table('product_order_history')->insert($order_history_count);
                        $single_product_point += $single_product->product_point * $item['qty'];
                        if ($single_product->vendor_id != 0) {
                            $vendorInfo = DB::table('vendor')
                                ->where('vendor.vendor_id', $single_product->vendor_id)
                                ->select('vendor.life_time_earning', 'vendor.amount')
                                ->first();
                            $vendor_life_amount = $vendorInfo->life_time_earning + $single_product->vendor_price * $item['qty'];
                            $adminPrice = ($single_product->discount_price - $single_product->vendor_price);
                            $adminPriceData = array();
                            $adminPriceData['vendor_id'] = $single_product->vendor_id;
                            $adminPriceData['amount'] = $adminPrice * $item['qty'];
                            $adminPriceData['date'] = date("Y-m-d");;
                            $adminPriceData['product_id'] = $product_id;
                            $adminPriceData['order_id'] = $order_id;
                            $adminPriceData['vendor_amount'] = $single_product->vendor_price * $item['qty'];
                            DB::table('vendor_price_commution')
                                ->insert($adminPriceData);
                            $vendor_amount = $vendorInfo->amount + $single_product->vendor_price * $item['qty'];
                            $dataUpdateVendor = array();
                            $dataUpdateVendor['life_time_earning'] = $vendor_life_amount;
                            $dataUpdateVendor['amount'] = $vendor_amount;
                            DB::table('vendor')
                                ->where('vendor.vendor_id', $single_product->vendor_id)
                                ->update($dataUpdateVendor);
                        }
                    }
                }
            }
        }

        /// affiliate order from  website
        if ($order_details->user_id > 0) {
            /// affiliate order from  website
            $father_id_1 = null;
            $father_id_2 = null;
            $father_id_3 = null;
            $user_id = $order_details->user_id;
            $order_id = $order_details->order_id;
            $order_items = unserialize($order_details->products);
            $son_data = DB::table('users_public')->where('id', $user_id)->first();
            /// son income
            if ($son_data) {
                $base_name = $son_data->name;
                $father_id_1 = $son_data->parent_id; // got parent id of son
                $son_commistion = $commision_price;
                $son_array['earning_balance'] = $son_data->earning_balance + $son_commistion;
                $son_array['life_time_earning'] = $son_data->life_time_earning + $son_commistion;
                //     update of affiliate Income
                $this->updateCommisionDataForAffiliate($user_id, $son_array);
                //     income history generate  of direact affiliate
                $this->earningHistoryGenerate($order_id, $base_name, $user_id, $son_commistion, $user_id, 1);
                /* Royalty fund */
                $this->generateRoyaltyHistory($user_id, $son_commistion, $order_id);
                /* affiliate customer active and  total income amount update */

                if ($order_details->customer_id > 0) {   //check customer exist

                    $user = DB::table('users')->select('affiliate_commision_from_customer')->where('id', $order_details->customer_id)->first();
                    $customer_update_data['affiliate_commision_from_customer'] = $user->affiliate_commision_from_customer + $son_commistion;
                    $customer_update_data['status'] = 1;
                    DB::table('users')->where('id', $order_details->customer_id)->update($customer_update_data);
                }


            }

            if ($father_id_1) {
                $father_commition_1 = ($son_commistion * 5) / 100;
                $fatherData_1 = DB::table('users_public')->where('id', $father_id_1)->first();
                $father_id_2 = $fatherData_1->parent_id;
                $fatherData_1_count = DB::table('users_public')->where('parent_id', $father_id_1)->where('status', 1)->count();
                if ($fatherData_1_count >= 1) {
                    // for active affiliate
                    if ($fatherData_1->status == 1) {
                        $father_array_1['earning_balance'] = $fatherData_1->earning_balance + $father_commition_1;
                        $father_array_1['life_time_earning'] = $fatherData_1->life_time_earning + $father_commition_1;
                        $this->updateCommisionDataForAffiliate($father_id_1, $father_array_1);
                        $this->earningHistoryGenerate($order_id, $fatherData_1->name, $father_id_1, $father_commition_1, $user_id, 2);
                    }
                }
            }

            if ($father_id_2) {

                $fatherData_2 = DB::table('users_public')->where('id', $father_id_2)->first();
                $father_id_3 = $fatherData_2->parent_id;
                $fatherData_2_count = DB::table('users_public')->where('parent_id', $father_id_2)->where('status', 1)->count();
                if ($fatherData_2_count >= 5) {  // for active affiliate
                    $father_commition_2 = ($son_commistion * 3) / 100;
                    if ($fatherData_2->status == 1) {
                        $father_array_1['earning_balance'] = $fatherData_2->earning_balance + $father_commition_2;
                        $father_array_1['life_time_earning'] = $fatherData_2->life_time_earning + $father_commition_2;
                        $this->updateCommisionDataForAffiliate($father_id_2, $father_array_1);
                        $this->earningHistoryGenerate($order_id, $fatherData_2->name, $father_id_2, $father_commition_2, $user_id, 3);

                    }
                }
            }

            if ($father_id_3) {
                $fatherData_3 = DB::table('users_public')->where('id', $father_id_3)->first();
                $fatherData_3_count = DB::table('users_public')->where('parent_id', $father_id_3)->where('status', 1)->count();
                if ($fatherData_3_count >= 10) {  // for active affiliate
                    $father_commition_3 = ($son_commistion * 2) / 100;
                    if ($fatherData_3->status == 1) {
                        $father_array_1['earning_balance'] = $fatherData_3->earning_balance + $father_commition_3;
                        $father_array_1['life_time_earning'] = $fatherData_3->life_time_earning + $father_commition_3;
                        $this->updateCommisionDataForAffiliate($father_id_3, $father_array_1);
                        $this->earningHistoryGenerate($order_id, $fatherData_3->name, $father_id_3, $father_commition_3, $user_id, 4);

                    }

                }

            }

        }

    }

    public function updateCommisionDataForAffiliate($user_id, $data_array)
    {
        DB::table('users_public')->where('id', $user_id)->update($data_array);
    }

    public function generateRoyaltyHistory($user_id, $commision, $order_id)
    {

        $fund = DB::table('royalty_fund')->where('royalty_fund_id', '=', 1)->first();
        $fund_commision = ($commision * 1) / 100;
        $previous_fund = $fund->amount;
        $after_fund['amount'] = $previous_fund + $fund_commision;
        $fund_result = DB::table('royalty_fund')->where('royalty_fund_id', '=', 1)->update($after_fund);
        $fund_history['user_id'] = $user_id;
        $fund_history['amount'] = $fund_commision;
        $fund_history['order_id'] = $order_id;
        $fund_history['created_at'] = date("Y-m-d");
        DB::table('royalty_fund_history')->insert($fund_history);
    }

    public function lebelIncomeUpdate($earning_from_id, $permission, $commision)
    {
        $user = DB::table('users_public')->select('income_of_lebel_1', 'income_of_lebel_2', 'income_of_lebel_3', 'income_of_lebel_4')->where('id', $earning_from_id)->first();
       if($user){
           if ($permission == 1) {
               $data['income_of_lebel_1'] = $user->income_of_lebel_1 + $commision;
           } else if ($permission == 2) {
               $data['income_of_lebel_2'] = $user->income_of_lebel_2 + $commision;
           } else if ($permission == 3) {
               $data['income_of_lebel_3'] = $user->income_of_lebel_3 + $commision;
           } else if ($permission == 4) {
               $data['income_of_lebel_4'] = $user->income_of_lebel_4 + $commision;
           }


           DB::table('users_public')->where('id', $earning_from_id)->update($data);
       }
    }

    public function earningHistoryGenerate($order_id, $base_name, $earner_id, $commision, $earning_from_id, $permission)
    {

        $data['order_id'] = $order_id;
        $data['earner_name'] = $base_name;
        $data['earner_id'] = $earning_from_id;
        $data['commision'] = $commision;
        $data['earning_for_id'] = $earner_id;  // earning id for affiliate
        $data['permission'] = $permission;
        DB::table('earning_history')->insert($data);
        UpdateStatisticCommisionData($commision);
        $this->lebelIncomeUpdate($earner_id,$permission,$commision);
    }

    public function courierViewReport()
    {
        $data['main'] = ' Courier';
        $data['active'] = 'All Courier';
        $data['title'] = '  ';
        $data['order_status'] = 'new';
        $data['couriers'] = DB::table('courier')->get();
        $data['orders_total'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->count();
        $data['orders_total_refund'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'refund')
            ->count();
        $data['orders_total_oncurrier'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'on_courier')
            ->count();
        $data['orders_total_completed'] = DB::table('order_data')->select('courier_service')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'completed')
            ->count();
        $data['orders_total_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->sum('order_total');
        $data['orders_total_refund_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'refund')
            ->sum('order_total');
        $data['orders_total_on_courier_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'on_courier')
            ->sum('order_total');
        $data['orders_total_completed_sum'] = DB::table('order_data')->select('order_total')
            ->where('courier_service', '>', 0)
            ->where('order_status', '=', 'completed')
            ->sum('order_total');

        return view('admin.order.courierViewReport', $data);
    }

    public function courierViewReportPagination(Request $request)
    {
        if ($request->ajax()) {


            $courier_id = $request->get('courier_id');
            $data['orders_total'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->count();
            $data['orders_total_refund'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'refund')
                ->count();
            $data['orders_total_oncurrier'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'on_courier')
                ->count();
            $data['orders_total_completed'] = DB::table('order_data')->select('courier_service')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'completed')
                ->count();
            $data['orders_total_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->sum('order_total');
            $data['orders_total_refund_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'refund')
                ->sum('order_total');
            $data['orders_total_on_courier_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'on_courier')
                ->sum('order_total');
            $data['orders_total_completed_sum'] = DB::table('order_data')->select('order_total')
                ->where('courier_service', '=', $courier_id)
                ->where('order_status', '=', 'completed')
                ->sum('order_total');
            $orders = DB::table('order_data')
                ->where('courier_service', $courier_id)
                ->orderBy('order_id', 'desc')
                ->paginate(10);
            return view('admin.order.courierViewReportPagination', compact('orders'), $data);
        }
    }

    public function invoicePrint($id)
    {

        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $data['orderData'] = DB::table('order_data as od')
            ->join('courier as c', 'c.courier_id', '=', 'od.courier_service')
            ->where('order_id', $id)
            ->select('c.*')
            ->first();

        return view('admin.order.invoice_view', $data);
    }

    public function orderModalPrint($id)
    {

        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $data['orderData'] = DB::table('order_data as od')
            ->join('courier as c', 'c.courier_id', '=', 'od.courier_service')
            ->where('order_id', $id)
            ->select('c.*')
            ->first();

        return view('admin.order.modal_invoice', $data);
    }

    public function orderEditHistory($id)
    {

        $data['orders'] = DB::table('order_edit_track')
            ->where('order_id', $id)
            ->orderBy('order_edit_track_id', 'desc')
            ->get();

        $data['order'] = DB::table('order_data')
            ->select('customer_order_note', 'affiliate_order_note')
            ->where('order_id', $id)
            ->first();
        return view('admin.order.orderEditHistory', $data);

    }

    public function orderReport()
    {
        $data['years'] = date('Y');
        $data['month'] = date('m');
        $today = date("Y-m-d");
        $data['new_count'] = $this->orderCount('new', $today);
        $data['phone_pending_count'] = $this->orderCount('phone_pending', $today);
        $data['pending_payment_count'] = $this->orderCount('pending_payment', $today);
        $data['processing_count'] = $this->orderCount('processing', $today);
        $data['on_courier_count'] = $this->orderCount('on_courier', $today);
        $data['delivered_count'] = $this->orderCount('delivered', $today);
        $data['refund_count'] = $this->orderCount('refund', $today);
        $data['completed_count'] = $this->orderCount('completed', $today);
        $data['cancled_count'] = $this->orderCount('cancled', $today);
        $data['new_sum'] = $this->orderSum('new', $today);
        $data['phone_pending_sum'] = $this->orderSum('phone_pending', $today);
        $data['pending_payment_sum'] = $this->orderSum('pending_payment', $today);
        $data['processing_sum'] = $this->orderSum('processing', $today);
        $data['on_courier_sum'] = $this->orderSum('on_courier', $today);
        $data['delivered_sum'] = $this->orderSum('delivered', $today);
        $data['refund_sum'] = $this->orderSum('refund', $today);
        $data['completed_sum'] = $this->orderSum('completed', $today);
        $data['cancled_sum'] = $this->orderSum('cancled', $today);

        return view('admin.order.orderReport', $data);

    }

    public function orderReportGeneration(Request $request)
    {


        if ($request->day && $request->month) {

            $data['years'] = date("Y", strtotime($request->month));
            $data['month'] = date("m", strtotime($request->month));
            $today = date("Y-m-d", strtotime($request->day));
            $data['new_count'] = $this->orderCount('new', $today);
            $data['phone_pending_count'] = $this->orderCount('phone_pending', $today);
            $data['pending_payment_count'] = $this->orderCount('pending_payment', $today);
            $data['processing_count'] = $this->orderCount('processing', $today);
            $data['on_courier_count'] = $this->orderCount('on_courier', $today);
            $data['delivered_count'] = $this->orderCount('delivered', $today);
            $data['refund_count'] = $this->orderCount('refund', $today);
            $data['completed_count'] = $this->orderCount('completed', $today);
            $data['cancled_count'] = $this->orderCount('cancled', $today);

            $data['new_sum'] = $this->orderSum('new', $today);
            $data['phone_pending_sum'] = $this->orderSum('phone_pending', $today);
            $data['pending_payment_sum'] = $this->orderSum('pending_payment', $today);
            $data['processing_sum'] = $this->orderSum('processing', $today);
            $data['on_courier_sum'] = $this->orderSum('on_courier', $today);
            $data['delivered_sum'] = $this->orderSum('delivered', $today);
            $data['refund_sum'] = $this->orderSum('refund', $today);
            $data['completed_sum'] = $this->orderSum('completed', $today);
            $data['cancled_sum'] = $this->orderSum('cancled', $today);
            return view('admin.order.orderReportView', $data);
        }
        if ($request->month) {
            $data['years'] = date("Y", strtotime($request->month));
            $data['month'] = date("m", strtotime($request->month));
            return view('admin.order.orderReportView', $data);
        }
        if ($request->day) {
            $today = date("Y-m-d", strtotime($request->day));
            $data['new_count'] = $this->orderCount('new', $today);
            $data['phone_pending_count'] = $this->orderCount('phone_pending', $today);
            $data['pending_payment_count'] = $this->orderCount('pending_payment', $today);
            $data['processing_count'] = $this->orderCount('processing', $today);
            $data['on_courier_count'] = $this->orderCount('on_courier', $today);
            $data['delivered_count'] = $this->orderCount('delivered', $today);
            $data['refund_count'] = $this->orderCount('refund', $today);
            $data['completed_count'] = $this->orderCount('completed', $today);
            $data['cancled_count'] = $this->orderCount('cancled', $today);

            $data['new_sum'] = $this->orderSum('new', $today);
            $data['phone_pending_sum'] = $this->orderSum('phone_pending', $today);
            $data['pending_payment_sum'] = $this->orderSum('pending_payment', $today);
            $data['processing_sum'] = $this->orderSum('processing', $today);
            $data['on_courier_sum'] = $this->orderSum('on_courier', $today);
            $data['delivered_sum'] = $this->orderSum('delivered', $today);
            $data['refund_sum'] = $this->orderSum('refund', $today);
            $data['completed_sum'] = $this->orderSum('completed', $today);
            $data['cancled_sum'] = $this->orderSum('cancled', $today);
            return view('admin.order.orderReportView', $data);


        }
    }

    public function orderCount($staus, $today)
    {
        $count = DB::table('order_data')->where('order_status', '=', $staus)->where('order_date', '=', $today)->count();
        return $count;
    }

    public function orderSum($staus, $today)
    {


        $sum = DB::table('order_data')->where('order_status', '=', $staus)->where('order_date', '=', $today)->sum("order_data.order_total");
        return $sum;
    }

    public function statusChanged($staus, $order_id)
    {
        $order_track['status'] = $staus;
        $order_track['user_id'] = Session::get('id');
        $order_track['order_id'] = $order_id;
        $order_track['updated_date'] = date('Y-m-d H:i:s');
        $order_track['user_name'] = Session::get('name');
        $order_track['order_note'] = '';
        DB::table('order_edit_track')->insert($order_track);


        $data['order_status'] = $staus;
        $result = DB::table('order_data')
            ->where('order_id', '=', $order_id)
            ->update($data);
        if ($result) {
            return redirect('admin/orders')
                ->with('success', 'Updated successfully.');
        }
    }

    public function promotionOrders()
    {

        $data['main'] = 'Promotion Orders';
        $data['active'] = 'Promotion Orders';
        $data['title'] = ' ';
        $data['order_status'] = 'new';
        $orders = DB::table('promotion_offers')->orderBy('id', 'desc')->paginate(10);
        return view('admin.order.promotionOrders', compact('orders'), $data);
    }

    public function lotary()
    {
        $data['main'] = 'Promotion Orders Lotary';
        $data['active'] = 'Promotion Orders Lotary';
        $data['title'] = ' ';
        $data['order_status'] = 'new';
        $data['users'] = DB::table('promotion_offers')->get();

        return view('admin.order.lotary', $data);
    }

    public function lotarySuccess(Request $request)
    {
        $request->promosion_offer_published;
        if ($request->promosion_offer_published == 1) {
            $winnerUser = DB::table('promotion_offers')->where('winnerStatus', '=', 1)->first();
            if ($winnerUser) {

                $winnerUserList = DB::table('promotion_offers')->where('winnerStatus', '=', 1)->get();
                foreach ($winnerUserList as $winnerUser) {

                    $order_data['order_from'] = 'sohojbuy.com';
                    $order_data['customer_id'] = $winnerUser->customer_id;
                    $order_data['user_id'] = $winnerUser->affiliate_id;
                    $order_data['order_total'] = $winnerUser->order_total;
                    $order_data['products'] = $winnerUser->products;
                    $order_data['created_time'] = date("Y-m-d H:i:s");
                    $order_data['order_date'] = date("Y-m-d");
                    $order_data['customer_name'] = $winnerUser->customer_name;
                    $order_data['customer_phone'] = $winnerUser->customer_phone;
                    $order_data['customer_address'] = $winnerUser->customer_address;
                    $order_data['order_note'] = "Promotion offer winer";
                    $order_data['order_status'] = "new";
                    DB::table('order_data')->insert($order_data);
                }


                $failedUsers = DB::table('promotion_offers')->where('winnerStatus', '=', 0)->get();
                foreach ($failedUsers as $user) {
                    $customrData = DB::table('users')->select('bonus_blance')->where('id', '=', $user->customer_id)->first();
                    $returnBack['bonus_blance'] = $customrData->bonus_blance + $order_data['order_total'];
                    DB::table('users')->where('id', '=', $user->customer_id)->update($returnBack);
                }
                DB::table('promotion_offers')->truncate();
                return redirect('admin/promotion/orders')
                    ->with('success', 'Winer are   selected Successfully');
            } else {
                return redirect('admin/promotion/orders/lotary')
                    ->with('success', 'Winer are not selected');
            }
        } else {
            return redirect('admin/promotion/orders/lotary')
                ->with('success', 'Please Select Published from select menu');
        }
    }


    public function customerActiveCommisionCheck()
    {
        $orders = DB::table('order_data')->select('user_id', 'order_id', 'customer_id')->where('order_status', 'completed')->where('customer_id', '>', 0)->get();
        foreach ($orders as $order) {
            $commision = DB::table('earning_history')->where('earning_for_id', $order->user_id)->where('order_id', $order->order_id)->value('commision');
            if ($commision > 0) {
                $user = DB::table('users')->select('affiliate_commision_from_customer')->where('id', $order->customer_id)->first();
                $row_data['affiliate_commision_from_customer'] = $user->affiliate_commision_from_customer + $commision;
                $row_data['status'] = 1;
                DB::table('users')->where('id', $order->customer_id)->update($row_data);
            }

        }

    }


    public function EearningHistoryToLevelTransfer()
    {

        $users = DB::table('earning_history')->select('earning_for_id','permission','commision')->groupBy('earning_for_id')->get();

        foreach ($users as $order) {

            $commision_1= DB::table('earning_history')->where('earning_for_id', $order->earning_for_id)->whereIn('permission', [0,1])->sum('commision');
            if($commision_1 > 0){
                $this->lebelIncomeUpdate($order->earning_for_id,1,$commision_1);
            }
            $commision_2= DB::table('earning_history')->where('earning_for_id', $order->earning_for_id)->where('permission',2)->sum('commision');
            if($commision_2 > 0){
                $this->lebelIncomeUpdate($order->earning_for_id,2,$commision_2);
            }
            $commision_3= DB::table('earning_history')->where('earning_for_id', $order->earning_for_id)->where('permission',3)->sum('commision');
            if($commision_3 > 0){
                $this->lebelIncomeUpdate($order->earning_for_id,3,$commision_3);
            }
            $commision_4= DB::table('earning_history')->where('earning_for_id', $order->earning_for_id)->where('permission',4)->sum('commision');
            if($commision_4 > 0){
                $this->lebelIncomeUpdate($order->earning_for_id,4,$commision_4);
            }


        }
        echo "successfully doone";

    }

    public function orderExchange(Request $request)
    {

        $orders=$request->order_id;
        foreach ($orders as $key=>$order_id){ 
            $data['staff_id']=$request->staff_id;
            DB::table('order_data')->where('order_id', $order_id)->update($data);
        }

    }

    public function customerPromosionOrder()
    {
        $promotions = DB::table('promotion_offers')->pluck('customer_name');
        $ami = array();
        if (isset($promotions)) {
            foreach ($promotions as $key => $promotion) {
                $ami[] = $promotion;
            }
            $data['promosioins'] = $ami;
        }
        return response()->json($data['promosioins']);
    }
}
