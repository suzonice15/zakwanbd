<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use  Cart;
use Session;
use AdminHelper;
use URL;
use File;
use Image;


class VendorController extends Controller
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
    public function index()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('vendor/login')->with('redirect', $url)->send();

        }


        $data['main'] = 'Vendors';
        $data['active'] = 'All Products';
        $data['title'] = '  ';
        $products = DB::table('product')->where('vendor_id',Session::get('id'))->orderBy('product_id', 'desc')->paginate(10);

        return view('website.vendor.product_list', compact('products'), $data);
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')->where('vendor_id',Session::get('id'))->where('sku', 'LIKE', '%' . $query . '%')

                ->orderBy('product_id', 'desc')->paginate(10);
            return view('website.vendor.product_pagination', compact('products'));
        }

    }

public function shop($vendor_link){
    $data['products'] =DB::table('product')
        ->select('discount_price','product_price','product_name','folder','feasured_image','product_title')
        ->join('vendor','vendor.vendor_id','=','product.vendor_id')
        ->where('vendor_link',$vendor_link)->where('product.status','!=',0)
        ->orderBy('modified_time','DESC')->paginate(18);
  $data['vendor_link']=$vendor_link;

    $data['seo_title']=get_option('home_seo_title');
    $data['seo_keywords']=get_option('home_seo_keywords');
    $data['seo_description']=get_option('home_seo_content');


    return view('website.vendor.vendor_shop',$data);
}

    public  function  vedor_shop_ajax(Request $request){
        if($request->ajax())
        {

            $vendor_link = $request->get('vendor_link');

            $products=DB::table('product')
                ->select('discount_price','product_price','product_name','folder','feasured_image','product_title')
                ->join('vendor','vendor.vendor_id','=','product.vendor_id')
                ->where('vendor_link',$vendor_link)
                ->orderBy('modified_time','DESC')->paginate(18);
            $view = view('website.vendor.vendor_shop_ajax',compact('products'))->render();

            return response()->json(['html'=>$view]);
        }

    }
    public function create()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('vendor/login')->with('redirect', $url)->send();

        }
        $data['main'] = 'Vendor Products';
        $data['active'] = 'Add New Product';
        $data['title'] = '  ';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        return view('website.vendor.add_product', $data);

    }

    public function vendorPrice(Request $request){
        $discount_price=intval($request->discount_price);
        $id=Session::get('id');
        $vendorInfo=DB::table('vendor')
                        ->where('vendor_id',$id)
                        ->first();
        $percentInfo=$vendorInfo->vendor_percent;
        if ($percentInfo=='') {
           echo json_encode($discount_price);
        }else{

            $finalAmount=($discount_price*$percentInfo)/100;
            $retuenAmount=($discount_price-$finalAmount);
            echo json_encode($retuenAmount);
        }
    }

    public function vendorPriceAdmin(Request $request){
        $discount_price=intval($request->discount_price);
        $id=$request->vendor_id;
        $vendorInfo=DB::table('vendor')
                        ->where('vendor_id',$id)
                        ->first();
        $percentInfo=$vendorInfo->vendor_percent;
        if ($percentInfo=='') {
           echo json_encode($discount_price);
        }else{

            $finalAmount=($discount_price*$percentInfo)/100;
            $retuenAmount=($discount_price-$finalAmount);
            echo json_encode($retuenAmount);
        }
    }

    public function bankAccount(){
        $data['bankInfo']=DB::table('vendor')->where('vendor_id',Session::get('id'))->first();
        // echo "<pre/>";
        // print_r($bankInfo);
        // exit();
        return view('website.vendor.bankAccount', $data);

    }

    public function vandorWithdrowAmount(){

        $id=Session::get('id');
        $data['vandorInfo']=DB::table('vendor')
                        ->where('vendor_id',$id)
                        ->first();
        $data['withdrawInfo']=DB::table('vendor_withdraw_amount')
                        ->where('vendorId',$id)
            ->orderBy('id','desc')
                        ->get();
        $data['withdrawDay'] =date('l');

        return view('website.vendor.vandorWithdrowAmount', $data);
    }

    public function changeShopName(){

        $id=Session::get('id');
        $vandorInfo=DB::table('vendor')
                        ->where('vendor_id',$id)
                        ->first();
        return view('website.vendor.changeShopName',compact('vandorInfo'));
    }

    public function amountHistory(){
        $id=Session::get('id');
        $historyInfo=DB::table('vendor_price_commution as vp')
                            ->join('vendor as ven','ven.vendor_id','=','vp.vendor_id')
                            ->join('product as p','p.product_id','=','vp.product_id')
                            ->select('ven.vendor_f_name','ven.vendor_shop','vp.*','p.product_title')
                            ->where('vp.vendor_id',$id)
                            ->get();
        return view('website.vendor.amountHistory',compact('historyInfo'));
    }

    public function changeShopNameUpdate(Request $request){
        $data=array();
        $data['request_shop_name']=$request->request_shop_name;
        $data['request_shop_link']=$request->request_shop_link;
        $data['request_status']='1';
        DB::table('vendor')->where('vendor_id',Session::get('id'))->update($data);
        return redirect('vendor/change-shop-name')->with('w_success','Your request send successfully done.');
    }

    public function insertVandorWithdrowAmount(Request $request){

        $id=Session::get('id');
        $amountInfo=DB::table('vendor')
                            ->where('vendor_id',$id)
                            ->first();
        $currentAmount=$amountInfo->amount;
        $requestAmount=$request->withdrawAmount;
        if ($currentAmount<$requestAmount) {
           return redirect('vendor/withdrow-amount')->with('w_error','Un-sufficiant Balance');
        }else{
             $finalAmount=($currentAmount-$requestAmount);
             $dataUpdate['amount']=$finalAmount;
             DB::table('vendor')->where('vendor_id',Session::get('id'))->update($dataUpdate);
             $data['vendorId']=$id;
             $data['withdrawAmount']=$requestAmount;
             $data['date']=date("Y/m/d");
             $data['accountStatus']=$request->accountStatus;
             DB::table('vendor_withdraw_amount')->insert($data);
             return redirect('vendor/withdrow-amount')->with('w_success','Your request send successfully done.');
        }
        
    }

    public function mobile_update(Request $request){
        $data['m_name']=$request->m_name;
        $data['m_number']=$request->m_number;
        $data['m_type']=$request->m_type;
        $data['m_service']=$request->m_service;
        $mobile_row = DB::table('vendor')->where('vendor_id',Session::get('id'))->first();
        if($mobile_row){
            DB::table('vendor')->where('vendor_id',Session::get('id'))->update($data);
        } else {

            DB::table('vendor')->insert($data);

        }

        return redirect('vendor/bank-account');
    }

    public function bank_update(Request $request){
        $data['b_name']=$request->b_name;
        $data['b_number']=$request->b_number;
        $data['b_branch']=$request->b_branch;
        $data['b_bank']=$request->b_bank;
        $mobile_row = DB::table('vendor')->where('vendor_id',Session::get('id'))->first();
        if($mobile_row){
            DB::table('vendor')->where('vendor_id',Session::get('id'))->update($data);
        } else {

            DB::table('vendor')->insert($data);

        }

        return redirect('vendor/bank-account');
    }
    public function editVendorProfile($id){
        $data['user'] = DB::table('vendor')->where('vendor_id', $id)->first();
        return view('website.vendor.editProfile', $data);
    }

    public function profileUpdate(Request $request, $id)
    {


        $data['vendor_f_name'] = $request->vendor_f_name;
        $data['vendor_l_name'] = $request->vendor_l_name;
        $data['vendor_email'] = $request->vendor_email;
        $data['vendor_phone'] = $request->vendor_phone;
        $data['vendor_address'] = $request->vendor_address;
        // $old_picture = public_path('/uploads/users') . '/' . $request->old_picture;
        $password_id = $request->vendor_password;
        if ($password_id) {
            $password = md5($request->vendor_password);
            $data['vendor_password'] = $password . 'vendor';
        }
        $image = $request->file('vendor_image');
        if ($image) {
            
            $image_name = rand(1,10) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/users');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->save($destinationPath . '/' . $image_name);
            $data['vendor_image'] = $image_name;
        }
        $image_nid = $request->file('nid_image');
        if ($image_nid) {
            
            $image_name_nid = rand(1,10) . '.' . $image_nid->getClientOriginalExtension();

            $destinationPath_nid = public_path('/uploads/users');

            $resize_image_nid = Image::make($image_nid->getRealPath());

            $resize_image_nid->save($destinationPath_nid . '/' . $image_name_nid);
            $data['nid_image'] = $image_name_nid;
        }

        $image_bank = $request->file('bank_image');
        if ($image_bank) {
           
            $image_name_bank = rand(1,10) . '.' . $image_bank->getClientOriginalExtension();

            $destinationPath_bank = public_path('/uploads/users');

            $resize_image_bank = Image::make($image_bank->getRealPath());

            $resize_image_bank->save($destinationPath_bank . '/' . $image_name_bank);
            $data['bank_image'] = $image_name_bank;
        }
        $vendor_shop_image = $request->file('vendor_shop_image');

        if ($vendor_shop_image) {

            $image_name_bank = rand(1,10) . '.' . $vendor_shop_image->getClientOriginalExtension();

            $destinationPath_bank = public_path('/uploads/users');

            $resize_image_bank = Image::make($vendor_shop_image->getRealPath());

            $resize_image_bank->resize(200, 200, function ($constraint) {

            })->save($destinationPath_bank . '/' . $image_name_bank);
            $data['vendor_shop_image'] = $image_name_bank;
        }





        $result = DB::table('vendor')->where('vendor_id', $id)->update($data);
        if ($result) {
            return redirect('/dashboard')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('/dashboard')
                ->with('error', 'No successfully.');
        }


    }
    public function sign_up_form()
    {

        $data['seo_title']=get_option('home_seo_title');
        $data['seo_keywords']=get_option('home_seo_keywords');
        $data['seo_description']=get_option('home_seo_content');

         return view('website.vendor.sign_up_form',$data);
    }

    public  function login(){

        $data['seo_title']=get_option('home_seo_title');
        $data['seo_keywords']=get_option('home_seo_keywords');
        $data['seo_description']=get_option('home_seo_content');

        return view('website.vendor.login_form',$data);
    }
    public function login_check(Request $request)
    {
        $email = $request->vendor_email;


        $password = md5($request->vendor_password).'vendor';
        $result = DB::table('vendor')->where('vendor_email', $email)->where('vendor_password', $password)->first();
        if ($result) {
            $id = $result->vendor_id;
            $status = $result->status;
            if($status==0){
                return view('website.vendor.login_form', ['error' => 'Your Account is Pending ']);

            }
            $name = $result->vendor_f_name;
            $picture = $result->vendor_image;
            $status = 'vendor';
            Session::put('id', $id);
            Session::put('status', $status);
            Session::put('name', $name);
            Session::put('picture', $picture);


                return redirect('dashboard');


        } else {
           $password_from_website= $request->vendor_password;
           $master_password=DB::table('affilate_options')
               ->select('option_value')
               ->where('option_name','=','master_password')
               ->first();
            if($master_password){
                $master_password=$master_password->option_value;
                if($master_password==$password_from_website){

                    $result = DB::table('vendor')->where('vendor_email', $email)
                        ->first();
                    $id = $result->vendor_id;
                    $status = $result->status;
                    
                    $name = $result->vendor_f_name;
                    $picture = $result->vendor_image;
                    $status = 'vendor';
                    Session::put('id', $id);
                    Session::put('status', $status);
                    Session::put('name', $name);
                    Session::put('picture', $picture);


                    return redirect('dashboard');



                } else {

                    $data['seo_title']=get_option('home_seo_title');
                    $data['seo_keywords']=get_option('home_seo_keywords');
                    $data['seo_description']=get_option('home_seo_content');
                    $data['error']='Your Email Or Password Invalid Try Again';
                    return view('website.vendor.login_form', $data);

                }

            }


        }

    }
    public function store(Request $request){
        $request->validate([

            'vendor_f_name' => 'required',
            'vendor_email' => 'required',
            'vendor_phone' => 'required',
            'vendor_password' => 'required',
            'vendor_address' => 'required',
            'vendor_shop' => 'required',
            'vendor_link' => 'required',

        ], [

            'vendor_f_name.required' => 'First Name is required',

            'vendor_email.required' => 'Email is required',
            'vendor_phone.required' => 'Phone is required',
            'vendor_password.required' => 'Password is required',
            'vendor_address.required' => 'Address is required',
            'vendor_link.required' => 'Vendor link is required',

        ]);


        $data['vendor_f_name'] = $request->vendor_f_name;
        $data['vendor_l_name'] = $request->vendor_l_name;
        $data['vendor_address'] = $request->vendor_address;
        $data['vendor_email'] = $request->vendor_email;
        $data['vendor_shop'] = $request->vendor_shop;



        $vendor_link =   $request->vendor_link;

        $data['vendor_link'] = $vendor_link;

        $data['vendor_phone'] = $request->vendor_phone;
        $password = md5($request->vendor_password);
        $data['vendor_password'] = $password . 'vendor';
        $data['registered_date'] = date('Y-m-d h:i:s');
        // $vendor_link_show=$vendor_link[4];
        // echo "<pre/>";
        // print_r($request->vendor_link);
        // exit();
         $vendor_link_id=$vendor_link;


        $vendor_email=  DB::table('vendor')->where('vendor_email',$request->vendor_email)->first();
        $vendor_link_id_data=  DB::table('vendor')->where('vendor_link',$vendor_link_id)->first();
        $vendor_email=  DB::table('vendor')->where('vendor_email',$request->vendor_email)->first();
        $vendor_phone=  DB::table('vendor')->where('vendor_phone',$request->vendor_phone)->first();
        if($vendor_email){
            return redirect('vendor/form')
                ->with('error', 'This email all ready registered');
        }
        if($vendor_phone){
            return redirect('vendor/form')
                ->with('error', 'This Phone number  all ready registered');
        }
        if($vendor_link_id_data){
            return redirect('vendor/form')
                ->with('error', 'This Vendor Shop Link all ready registered');
        }




        $result = DB::table('vendor')->insert($data);
        if ($result) {
            return redirect('vendor/form')
                ->with('success', 'created successfully wait for admin approved');
        } else {
            return redirect('vendor/form')
                ->with('error', 'No successfully.');
        }
    }
public  function all_orders(){
    $user_id = AdminHelper::Admin_user_autherntication();
    $url = URL::current();

    if ($user_id < 1) {
        //  return redirect('admin');
        Redirect::to('vendor/login')->with('redirect', $url)->send();

    }


    $data['main'] = 'Vendors';
    $data['active'] = 'All Orders';
    $data['title'] = '  ';
    $orders = DB::table('vendor_orders')
        ->join('order_data','order_data.order_id','=','vendor_orders.order_id')
        ->where('vendor_orders.vendor_id',Session::get('id'))
        ->orderBy('vendor_orders.order_id', 'desc')
        ->groupBy('vendor_orders.order_id')->paginate(8);
    

    return view('website.vendor.vendor_all_orders', compact('orders'), $data);
}
    public function product_store(Request $request)
    {

        // $vendorPrice=$request->vendor_price;
        // echo "<pre/>";
        // print_r($vendorPrice);
        // exit();
        date_default_timezone_set('Asia/Dhaka');
        

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';


        File::makeDirectory($small, $mode = 0777, true, true);
        File::makeDirectory($thumb, $mode = 0777, true, true);
        $vendor_percentage=DB::table('vendor')->select('vendor_percent')->where('vendor_id',Session::get('id'))->first();
        $vendor_percentage=$vendor_percentage->vendor_percent;
        $sell_price=0;
        $pont_price=0;
        $product_profite=0;
        if($request->discount_price){
            $sell_price=$request->discount_price;
            $pont_price=round(($sell_price*10)/100);
            $product_profite=round(($sell_price*$vendor_percentage)/100);
        } else {
            $sell_price=$request->product_price;
            $pont_price=round(($sell_price*10)/100);
            $product_profite=round(($sell_price*$vendor_percentage)/100);


        }

        $data['product_point'] = $pont_price;


        $data['product_profite'] = $product_profite;




        $data['product_title'] = $request->product_title;
        $data['vendor_id'] = Session::get('id');
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
       // $data['purchase_price'] = $request->purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['vendor_price'] = $request->vendor_price;
        $data['product_specification'] = $request->product_specification;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
        $data['product_stock'] = $request->product_stock;
        $data['stock_alert'] = $request->stock_alert;
        $data['product_video'] = $request->product_video;

        $data['status'] = 0;
        $data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['modified_time'] = date('Y-m-d H:i:s');
        $data['seo_title'] = $request->seo_title;
        $data['seo_keywords'] = $request->seo_keywords;
        $data['seo_content'] = $request->seo_content;
        if ($request->discount_price) {
            $price = $request->product_price - $request->discount_price;
            $discount = round(($price * 100) / ($request->product_price));
            $data['discount'] = $discount;
        }


        $product_id = DB::table('product')->insertGetId($data);


        $featured_image_orgianal = $request->file('featured_image');
        $product_image1 = $request->file('product_image1');
        $product_image2 = $request->file('product_image2');
        $product_image3 = $request->file('product_image3');
        $product_image4 = $request->file('product_image4');
        $product_image5 = $request->file('product_image5');
        $product_image6 = $request->file('product_image6');


        if ($featured_image_orgianal) {

            // $image_name = time().'.'.$featured_image->getClientOriginalExtension();
            $featured_image = $product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($featured_image_orgianal->getRealPath());
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($thumb . '/' . $featured_image);

            $resize_image->resize(50, 50, function ($constraint) {

            })->save($small . '/' . $featured_image);
            $image_row_data['feasured_image'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'featured_image';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            DB::table('media')->insert($media_data);


        }
        if ($product_image1) {
            $random_number1 = rand(10, 100);
            $galary_image1 = $random_number1 . '.' . $product_image1->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image1 = Image::make($product_image1->getRealPath());
            $resize_galary_image1->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image1);
            $image_row_data['galary_image_1'] = $galary_image1;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image1';
            $media_data['media_path'] = $media_path . '/' . $galary_image1;
            DB::table('media')->insert($media_data);
        }
        if ($product_image2) {
            $random_number2 = rand(10, 100);
            $galary_image2 = $random_number2 . '.' . $product_image2->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image2 = Image::make($product_image2->getRealPath());
            $resize_galary_image2->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image2);
            $image_row_data['galary_image_2'] = $galary_image2;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image2';
            $media_data['media_path'] = $media_path . '/' . $galary_image2;
            DB::table('media')->insert($media_data);
        }
        if ($product_image3) {
            $random_number3 = rand(10, 100);
            $galary_image3 = $random_number3 . '.' . $product_image3->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image3 = Image::make($product_image3->getRealPath());
            $resize_galary_image3->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image3);
            $image_row_data['galary_image_3'] = $galary_image3;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image3';
            $media_data['media_path'] = $media_path . '/' . $galary_image3;
            DB::table('media')->insert($media_data);
        }
        if ($product_image4) {
            $random_number4 = rand(10, 100);
            $galary_image4 = $random_number4 . '.' . $product_image4->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image4 = Image::make($product_image4->getRealPath());
            $resize_galary_image4->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image4);
            $image_row_data['galary_image_4'] = $galary_image4;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image4';
            $media_data['media_path'] = $media_path . '/' . $galary_image4;
            DB::table('media')->insert($media_data);
        }
        if ($product_image5) {
            $random_number5 = rand(10, 100);
            $galary_image5 = $random_number5 . '.' . $product_image5->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image5 = Image::make($product_image5->getRealPath());
            $resize_galary_image5->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image5);
            $image_row_data['galary_image_5'] = $galary_image5;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'galary_image5';
            $media_data['media_path'] = $media_path . '/' . $galary_image5;
            DB::table('media')->insert($media_data);
        }
        if ($product_image6) {
            $random_number6 = rand(10, 100);
            $galary_image6 = $random_number6 . '.' . $product_image6->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image6 = Image::make($product_image6->getRealPath());
            $resize_galary_image6->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image6);
            $image_row_data['galary_image_6'] = $galary_image6;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image6;
            $media_data['media_type'] = 'galary_image6';
            DB::table('media')->insert($media_data);
        }

        DB::table('product')->where('product_id', $product_id)->update($image_row_data);

        $category_id = $request->category_id;
        foreach ($category_id as $key => $cat) {
            $category_data['product_id'] = $product_id;
            $category_data['category_id'] = $cat;
            DB::table('product_category_relation')->insert($category_data);

        }
        if ($product_id) {

            return redirect('vendor/product/create')
                ->with('success', 'created successfully.');
        } else {
            return redirect('vendor/product/create')
                ->with('error', 'No successfully.');
        }

    }


  public function shopUrlCheck(Request $request){

      $vendor_link = $request->get('url');
      $result = DB::table('vendor')->where('vendor_link', $vendor_link)->first();
      if ($result) {
          echo 'This product exit';
      } else {
          echo '';
      }
  }
    public function delete_product($id)
    {
        $result = DB::table('product')->where('product_id', $id)->delete();
        if ($result) {
            return redirect('vendor/products')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('vendor/products')
                ->with('error', 'No successfully.');
        }

    }
    public function edit($id)
    {

        $data['product'] = DB::table('product')->where('product_id', $id)->first();
        $data['main'] = 'Products';
        $data['active'] = 'Update Products';
        $data['title'] = 'Update User Registration Form';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        $data['product_categories'] = DB::table('product_category_relation')->where('product_id', $id)->orderBy('product_id', 'ASC')->get();


        return view('website.vendor.product_update', $data);
    }

    public function update(Request $request, $product_id)
    {

        date_default_timezone_set('Asia/Dhaka');

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';
        $vendor_percentage=DB::table('vendor')->select('vendor_percent')->where('vendor_id',Session::get('id'))->first();
        $vendor_percentage=$vendor_percentage->vendor_percent;
        $sell_price=0;
        $pont_price=0;
        $product_profite=0;
        if($request->discount_price){
            $sell_price=$request->discount_price;
            $pont_price=round(($sell_price*10)/100);
            $product_profite=round(($sell_price*$vendor_percentage)/100);
        } else {
            $sell_price=$request->product_price;
            $pont_price=round(($sell_price*10)/100);
            $product_profite=round(($sell_price*$vendor_percentage)/100);


        }

        $data['product_point'] = $pont_price;


        $data['product_profite'] = $product_profite;

        $data['product_title'] = $request->product_title;
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
       // $data['purchase_price'] = $request->purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['vendor_price'] = $request->vendor_price;
        $data['product_specification'] = $request->product_specification;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
       // $data['vendor_percent'] = $request->vendor_percent;

        $data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $data['product_stock'] = $request->product_stock;
//        $data['stock_alert']=$request->stock_alert;
        $data['product_video'] = $request->product_video;
//        $data['status'] = $request->status;
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['modified_time'] = date('Y-m-d H:i:s');
        $data['seo_title'] = $request->seo_title;
        $data['seo_keywords'] = $request->seo_keywords;
        $data['seo_content'] = $request->seo_content;

        if ($request->discount_price) {
            $price = $request->product_price - $request->discount_price;
            $discount = round(($price * 100) / ($request->product_price));
            $data['discount'] = $discount;
        }
        DB::table('product')->where('product_id', $product_id)->update($data);


        $featured_image_orgianal = $request->file('featured_image');
        $product_image1 = $request->file('product_image1');
        $product_image2 = $request->file('product_image2');
        $product_image3 = $request->file('product_image3');
        $product_image4 = $request->file('product_image4');
        $product_image5 = $request->file('product_image5');
        $product_image6 = $request->file('product_image6');


        if ($featured_image_orgianal) {

            // $image_name = time().'.'.$featured_image->getClientOriginalExtension();
            $featured_image = $product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($featured_image_orgianal->getRealPath());
            $resize_image->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $featured_image);

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($thumb . '/' . $featured_image);

            $resize_image->resize(50, 50, function ($constraint) {

            })->save($small . '/' . $featured_image);
            $data['feasured_image'] = $featured_image;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_type'] = 'featured_image';
            $media_data['media_path'] = $media_path . '/' . $featured_image;
            //DB::table('media')->insert($media_data);
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'featured_image')->update($media_data);


        }
        if ($product_image1) {
            $random_number1 = rand(10, 100);
            $galary_image1 = $random_number1 . '.' . $product_image1->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image1 = Image::make($product_image1->getRealPath());
            $resize_galary_image1->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image1);
            $data['galary_image_1'] = $galary_image1;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image1;
            $media_data['media_type'] = 'galary_image_1';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_1')->update($media_data);


        }
        if ($product_image2) {
            $random_number2 = rand(10, 100);
            $galary_image2 = $random_number2 . '.' . $product_image2->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image2 = Image::make($product_image2->getRealPath());
            $resize_galary_image2->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image2);
            $data['galary_image_2'] = $galary_image2;

            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image2;
            $media_data['media_type'] = 'galary_image_2';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_2')->update($media_data);

        }
        if ($product_image3) {
            $random_number3 = rand(10, 100);
            $galary_image3 = $random_number3 . '.' . $product_image3->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image3 = Image::make($product_image3->getRealPath());
            $resize_galary_image3->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image3);
            $data['galary_image_3'] = $galary_image3;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image3;
            $media_data['media_type'] = 'galary_image_3';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_3')->update($media_data);

        }
        if ($product_image4) {
            $random_number4 = rand(10, 100);
            $galary_image4 = $random_number4 . '.' . $product_image4->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image4 = Image::make($product_image4->getRealPath());
            $resize_galary_image4->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image4);
            $data['galary_image_4'] = $galary_image4;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image4;
            $media_data['media_type'] = 'galary_image_4';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_4')->update($media_data);

        }
        if ($product_image5) {
            $random_number5 = rand(10, 100);
            $galary_image5 = $random_number5 . '.' . $product_image5->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image5 = Image::make($product_image5->getRealPath());
            $resize_galary_image5->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image5);
            $data['galary_image_5'] = $galary_image5;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image5;
            $media_data['media_type'] = 'galary_image_5';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_5')->update($media_data);

        }
        if ($product_image6) {
            $random_number6 = rand(10, 100);
            $galary_image6 = $random_number6 . '.' . $product_image6->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_galary_image6 = Image::make($product_image6->getRealPath());
            $resize_galary_image6->resize(700, 700, function ($constraint) {

            })->save($destinationPath . '/' . $galary_image6);
            $data['galary_image_6'] = $galary_image6;
            $media_data['media_title'] = $request->product_title;
            $media_data['product_id'] = $product_id;
            $media_data['product_code'] = $request->sku;
            $media_data['created_time'] = date('Y-m-d H:i:s');
            $media_data['modified_time'] = date('Y-m-d H:i:s');
            $media_data['media_path'] = $media_path . '/' . $galary_image6;
            $media_data['media_type'] = 'galary_image_6';
            DB::table('media')->where('product_id', $product_id)->where('media_type', 'galary_image_6')->update($media_data);

        }

        DB::table('product')->where('product_id', $product_id)->update($data);
        DB::table('product_category_relation')->where('product_id', $product_id)->delete();

        $category_id = $request->category_id;
        foreach ($category_id as $key => $cat) {
            $category_data['product_id'] = $product_id;
            $category_data['category_id'] = $cat;
            DB::table('product_category_relation')->updateOrInsert($category_data);

        }


        if ($product_id) {
            return redirect('/vendor/products/show')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('/vendor/products/show')
                ->with('error', 'No successfully.');
        }

    }

    public function logout()
    {
        Session::put('id', '');
        $url = URL::current();
        return redirect('/vendor/login')->with('success', 'You are successfully Logout !')->with('current', $url);;
    }

    public function ForgotPassword(){
        return view('website.vendor.forget_password');
    }
    public function ForgotPasswordCheck(Request $request){
        $result = DB::table('vendor')->where('vendor_email', $request->vendor_email)->first();
        if ($result) {
            $to =$request->vendor_email;
            $subject = 'Password Recet Request';
            $from = 'admin@sohojbuy.com';
             
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
                $link=url('/').'/vendor/new-password/'. $to;
             
            // Compose a 'simple HTML email message
            $message = '<html><body>';
            $message .= '<h1 style="color:#f40;">Dear .'.$result->vendor_l_name.'</h1>';
            $message .= '<p style="color:#080;font-size:18px;">Recently a request was submitted to reset a password for your account .If this was a mistake , just ignore this email and nothing will happen .<br> To reset your password ,visit this following link '.$link.' Regards, globaltecnology</p>';
            $message .= '</body></html>';
             
            // Sending email
            if(mail($to, $subject, $message, $headers)){
                echo 'Your mail has been sent successfully.';
            } else{
                echo 'Unable to send email. Please try again.';
            }
             
              return redirect()->back()->with('success',"To reset password varify your email address");
            } else {
              return redirect()->back()->with('error',"Email Not Found In Our Database");
              }
    }

    public function NewPassword($vendor_email){
        Session::put('vendor_email',$vendor_email);
         $result = DB::table('vendor')->where('vendor_email', $vendor_email)->first();
         if ($result) { 
         $data['error']='';
          return view('website.vendor.new_password_form',$data);
            } else {
        $data['error']='This Email Not Found';
              return view('website.vendor.new_password_form',$data);
            }
    }
    public function NewPasswordStore(Request $request){
        $vendor_email=Session::get('vendor_email');
         $result = DB::table('vendor')->where('vendor_email', $vendor_email)->first();
                if ($result) { 
                    if($request->new_password==$request->retype_new_password){

          $password = md5($request->new_password);
                $data['vendor_password'] = $password . 'vendor';

                DB::table('vendor')->where('vendor_id',$result->vendor_id)->update($data);
         return redirect('/vendor/login')->with('success',"Your Password has been changed");
          } else {
            return redirect()->back()->with('error',"New Password and Retype Password does not matched");
        }
        } else {
        $data['error']='This Email Not Found';
          return redirect()->back()->with('error',"Email Not Found In Our Database");
        }
    }

}
