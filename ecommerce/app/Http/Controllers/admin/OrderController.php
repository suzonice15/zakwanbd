<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
use AdminHelper;
use URL;
use App\Models\Zone;
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
        
         
        $data['main'] = 'Orders';
        $data['active'] = 'All Orders';
        $data['title'] = '  ';
        $data['order_status'] = 'new';
        $admin_user_status=Session::get('status');
        $staff_id=Session::get('id');
        $shop_id= Session::get('shop_id');       
        $orders = DB::table('order_data')->where('zone_id', $shop_id)->where('order_status', 'new')->orderBy('order_id', 'desc')->paginate(10);               
       $data['stuffInfo'] =DB::table('admin')->where('status','office-staff')
            ->where('active_status', 1)->get();
        return view('admin.order.index', compact('orders'), $data);
    }
    public function onlineOrders()
    {       
         
        $data['main'] = 'Orders';
        $data['active'] = 'All Orders';
        $data['title'] = '  ';
        $data['order_status'] = 'new';
        $admin_user_status=Session::get('status');
        $staff_id=Session::get('id');
        $shop_id= Session::get('shop_id');       
        $orders = DB::table('order_data')->whereNull('shop_id')->where('order_status', 'new')->orderBy('order_id', 'desc')->paginate(10);               
       $data['stuffInfo'] =DB::table('admin')->where('status','office-staff')
            ->where('active_status', 1)->get();
        return view('admin.order.onlineOrders', compact('orders'), $data);
    }
    

    public function pagination(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            $admin_user_status=Session::get('status');
            $staff_id=Session::get('id');            
            $shop_id=Session::get('shop_id');            
                if($status==1){
                    $orders = DB::table('order_data')->where('shop_id',$shop_id)->orderBy('order_id', 'desc')
                        ->paginate(10);
                }else{
                    $orders = DB::table('order_data')->where('shop_id',$shop_id)->where('order_status', $status)->orderBy('order_id', 'desc')
                        ->paginate(10);
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
        $shop_id= Session::get('shop_id');       
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $orders = DB::table('order_data')
            ->where('shop_id',$shop_id)
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
            $zone_id= Session::get('zone_id');
            $shop_id= Session::get('shop_id');
            $data['products'] = getStockProductsOfShop($shop_id);
            return view('admin.order.create', $data);
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        
       $zone_id= Session::get('zone_id');
       $shop_id= Session::get('shop_id');

        $data['order_status'] = $request->order_status;
        $order_status = $request->order_status;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['user_id'] = $request->user_id;
        $data['zone_id'] = $zone_id;
        $data['shop_id'] =  $shop_id;
        $data['created_time'] = date("Y-m-d H:i:s");
        $data['created_by'] = Session::get('name');
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data['order_date'] = date("Y-m-d");
        $data['order_total'] = $request->order_total;        
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;  
        $data['staff_id'] = Session::get('id');       
        $data['shipping_charge'] = $request->shipping_charge;
        $data['discount_price'] = $request->discount_price;
        $data['advabced_price'] = $request->advabced_price;  
        if ($request->shipment_time) {
            $data['shipment_time'] = date('Y-m-d H:i:s', strtotime($request->shipment_time));
        }
        $order_id = DB::table('order_data')->insertGetId($data);   
        if ($order_id) {
            foreach($request->products as $product_id=>$quantity){
                $order_details['order_id']=$order_id;
                $order_details['zone_id'] = $zone_id;
                $order_details['shop_id'] =  $shop_id;
                $order_details['product_id']=$product_id;
                $order_details['qnt']=$quantity;
                $order_details['price']=$request->price[$product_id];
                $order_details['sub_total']=$request->price[$product_id]*$quantity;
                $order_details['commision']=single_product_information($product_id)->top_deal * $quantity;
                $order_details['order_date']=date("Y-m-d");
                DB::table('order_details')->insert($order_details);
                shopStockReduce($shop_id,$product_id,$quantity);

            }     
            $commision=DB::table('order_details')->where('order_id',$order_id)->sum('commision');   
           
            $this->commisionDistribution($order_id, $commision);               
            return redirect('admin/orders')->with('success', 'Created successfully.');
        } else {
            return redirect('admin/orders/')->with('error', 'Error to Create this order');
        }
    }     
    public function edit($id)
    {       
        $data['main'] = 'Orders';
        $data['active'] = 'Update Orders';
        $data['title'] = 'Update Orders Data';
        $data['order'] = DB::table('order_data')->where('order_id', $id)->first();
        $data['couriers'] = DB::table('courier')->where('active', '=', 1)->get();
        $data['zones']= Zone::latest()->get();         
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
        $order_number = $id;
        
        $data['order_status'] = $request->order_status;
        $order_status = $request->order_status;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['discount_price'] = $request->discount_price;
        $data['advabced_price'] = $request->advabced_price;
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data['order_total'] = $request->order_total;
       
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_address'] = $request->customer_address;
        $data['courier_service'] = $request->courier_service;
         $data['order_note'] = $request->order_note;
        $data['zone_id'] = $request->zone_id;
        $data['shop_id'] = $request->shop_id; 
        
        if ($request->shipment_time) {
            $data['shipment_time'] = date('Y-m-d H:i:s', strtotime($request->shipment_time));
        }
        if ($order_status == 'new') {

            foreach($request->products as $product_id=>$quantity){
                $order_data_details['zone_id'] = $request->zone_id;
                $order_data_details['shop_id'] = $request->shop_id;                 
                DB::table('order_details')->where('order_id',$id)->where('product_id',$product_id)->update($order_data_details);
                shopStockReduce($request->shop_id,$product_id,$quantity);
            }   

        }

        $order_data = DB::table('order_data')->where('order_id', $order_number)->update($data); 
        if ($order_status == 'completed') { 
            $info = DB::table('users_public')->where('id', $request->user_id)->first();
            if ($info) {               
                $affiliate_active['status'] = 1;
                 DB::table('users_public')->where('id', $info->id)->update($affiliate_active);
                } 
                $commision=DB::table('order_details')->where('order_id',$order_number)->sum('commision');     
            $this->commisionDistribution($order_number, $commision);  
        } 
        if ($order_data) { 
            return redirect('admin/orders')->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/order/' . $order_number)->with('success', 'Error to update this order');
        }
    }
  

    function commisionDistribution($order_id, $commision_price)
    {

        $order_details = DB::table('order_data')->where('order_id', $order_id)->first(); 
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
                if ($fatherData_2_count >= 1) {  // for active affiliate
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
                if ($fatherData_3_count >= 1) {  // for active affiliate
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

    
    public function confirmPayment($id)
    {
           $paid = DB::table('order_data')
            ->where('order_id', $id)
            ->update(['is_paid'=>1]); 
       
       if($paid){
        echo "done";
       }else{
        echo "failed";
       }

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

            if ($staus == 'completed') { 

                $result = DB::table('order_data')->where('order_id', '=', $order_id)->first();
                if($result){
                    $info = DB::table('users_public')->where('id', $result->user_id)->first();
                    if ($info) {               
                        $affiliate_active['status'] = 1;
                         DB::table('users_public')->where('id', $info->id)->update($affiliate_active);
                         $commision=DB::table('order_details')->where('order_id',$order_id)->sum('commision');     
                         $this->commisionDistribution($order_id, $commision); 
                        }                    
                }                 
            } 

            return redirect('admin/orders')
                ->with('success', 'Updated successfully.');
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

    
    public function getProductsByShopId(Request $request){
        $products= getStockProductsOfShop($request->shop_id);
            $html='<select name="product_ids" id="product_ids" class="form-control select2" ><option value="">Select Option</option>';         
            foreach($products as $product) {
            $product_title=$product->product_title;                                                    
            $html .='<option value="'.$product->product_id.'"
            >'.$product_title.' - '.$product->sku.'('.$product->stock.')</option>';
            } 
            $html .='</select>';   
            echo $html;   

    }
    public function affiliateCheckByMobile($mobile){

        $affiliate= DB::table('users_public')->where('phone',$mobile)->first();
        $data=array();
        $data['success']="no";
        if($affiliate){
         $data['name']=$affiliate->name;
         $data['phone']=$affiliate->phone;
         $data['id']=$affiliate->id;
         $data['success']="ok";
        
        }
        return $data;
 
     }
}
