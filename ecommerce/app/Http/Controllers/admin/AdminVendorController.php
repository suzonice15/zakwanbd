<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use Image;

use  Session;
use Webp;
use AdminHelper;
use URL;
use Illuminate\Support\Facades\Redirect;

class AdminVendorController extends Controller
{
    public  function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set("Asia/Dhaka");
    }

public  function vendor_edit($id){

    $data['main'] = 'Vendors';
    $data['active'] = 'All vendors ';
    $data['title'] = '';
    $vendor = DB::table('vendor')->where('vendor_id',$id )->first();

    return view('admin.vendor.vendor_user_edit', compact('vendor'), $data);
}
    public  function vendor_edit_update(Request $request,$id){
        $data['vendor_percent'] = $request->vendor_percent;
        $data['first_verify'] = $request->first_verify;
        $data['second_verify'] = $request->second_verify;
        DB::table('vendor')->where('vendor_id',$id)->update($data);
        return redirect('/admin/vendors');
    }


    public function withdrowMoney()
    {
        $data['main'] = 'Vendors Money';
        $data['active'] = 'Vendors Money ';
        $data['title'] = '';
        $vendors = DB::table('vendor')
            ->where('amount','>',0)->orderBy('amount', 'desc')->paginate(10);

        return view('admin.vendor.withdrowMoney', compact('vendors'), $data);
    }

    public function paginationWithdrowMoney(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $vendors = DB::table('vendor')->orWhere('vendor_f_name', 'LIKE', '%' . $query . '%')
                ->orWhere('vendor_phone', 'LIKE', '%' . $query . '%')
                ->orWhere('request_shop_name', 'LIKE', '%' . $query . '%')
                ->orWhere('vendor_email', 'LIKE', '%' . $query . '%')
                ->orWhere('request_shop_name', 'LIKE', '%' . $query . '%')
                ->orderBy('amount', 'desc')->paginate(10);
            return view('admin.vendor.paginationWithdrowMoney', compact('vendors'));
        }

    }

    public function moneyPay($id)
    {



        $data['main'] = 'Vendors Money';
        $data['active'] = 'Vendors Money ';
        $data['title'] = '';
        $vendor = DB::table('vendor')->where('vendor_id',$id)->first();
        return view('admin.vendor.moneyPay', compact('vendor'), $data);
    }




    public function insertWithdrowAmount(Request $request,$vendor_id){

        $id=$vendor_id;
        $amountInfo=DB::table('vendor')
            ->where('vendor_id',$id)
            ->first();
        $currentAmount=$amountInfo->amount;
        $requestAmount=$request->withdrawAmount;
        if ($currentAmount<$requestAmount) {
            return redirect('admin/vendor/money/pay/'.$id)->with('errorr','Insufficent Blance');
        }else{
            $finalAmount=($currentAmount-$requestAmount);
            $dataUpdate['amount']=$finalAmount;
            DB::table('vendor')->where('vendor_id',$id)->update($dataUpdate);
            $data['vendorId']=$id;
            $data['withdrawAmount']=$requestAmount;
            $data['date']=date("Y/m/d");
            $data['accountStatus']=$request->accountStatus;
            $data['status']=1;
            DB::table('vendor_withdraw_amount')->insert($data);
            return redirect('admin/vendor/money/withdrow')->with('success','Your request send successfully done.');
        }

    }

    public function index()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }


        $data['main'] = 'Vendors';
        $data['active'] = 'All vendors ';
        $data['title'] = '';
        $vendors = DB::table('vendor')->orderBy('vendor_id', 'desc')->get();
        return view('admin.vendor.vendor_users', compact('vendors'), $data);
    }

    public function pagination(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')->where('sku', 'LIKE', '%' . $query . '%')
                ->orWhere('product_title', 'LIKE', '%' . $query . '%')
                ->orderBy('product_id', 'desc')->paginate(10);
            return view('admin.product.pagination', compact('products'));
        }

    }

    public function pending()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {          
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $data['main'] = 'Vendors';
        $data['active'] = 'All vendors ';
        $data['title'] = '';
        $products = DB::table('product')
            ->where('status','=',0)
            ->where('vendor_id', '>',0)
            ->orderBy('product_id', 'desc')
            ->paginate(10);

        return view('admin.vendor.vendor_pending_products', compact('products'), $data);
    }


    public function pending_pagination(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')->where('status','=',0)->where('vendor_id', '>',0)->where('sku', 'LIKE', '%' . $query . '%')
                ->orderBy('product_id', 'desc')->paginate(10);
            return view('admin.vendor.pending_pagination', compact('products'));
        }

    }

    public function published_product()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }


        $data['main'] = 'Vendors';
        $data['active'] = 'All vendors ';
        $data['title'] = '';
        $products = DB::table('product')->where('status','=',1)->where('vendor_id', '>',0)->orderBy('product_id', 'desc')->paginate(10);

        return view('admin.vendor.vendor_published_products', compact('products'), $data);
    }

    public function vandorWithdrawStatus(){

        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }

        $withdrowInfo=DB::table('vendor_withdraw_amount as vwa')
                            ->join('vendor as ven','ven.vendor_id','=','vwa.vendorId')
                            ->select('ven.vendor_f_name','ven.vendor_l_name','ven.vendor_shop','ven.vendor_email','ven.vendor_phone','vwa.*')
                            ->get();
        // echo "<pre/>";
        // print_r($withdrowInfo);
        // exit();
        return view('admin.vendor.vendor_withdraw_amount', compact('withdrowInfo'));                   
    }

    public function shopNameStatus(){

        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }

        $requestInfo=DB::table('vendor')
                        ->where('request_status','=','1')
                        ->get();
        // echo "<pre/>";
        // print_r($withdrowInfo);
        // exit();
        return view('admin.vendor.vendor_shop_status', compact('requestInfo'));                   
    }

    public function shopNameStatusChange(Request $request){
        $vendorId=$request->vendorId;
        $prevendor=DB::table('vendor')
                        ->where('vendor_id',$vendorId)
                        ->first();
        $status=$request->status;
        if ($status==2) {
           
           $data=array();
           $data['request_shop_name']=$prevendor->vendor_shop;
           $data['request_shop_link']=$prevendor->vendor_link;
           $data['request_status']='2';

        }else{

            $data=array();
            $data['request_status']='3';
        }
        $statusChangest=DB::table('vendor')
                                ->where('vendor_id',$vendorId)
                                ->update($data);
        return redirect('admin/vendor/published/shop-name')->with('success', 'Status Change Successfully.');
    }

    public function vandorAmountHistory(){

        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }

        $historyInfo=DB::table('vendor_price_commution as vp')
                            ->join('vendor as ven','ven.vendor_id','=','vp.vendor_id')
                            ->join('product as p','p.product_id','=','vp.product_id')
                            ->select('ven.vendor_f_name','ven.vendor_shop','vp.*','p.product_title')
                            ->get();
        return view('admin.vendor.vandorAmountHistory',compact('historyInfo'));
    }

    public function WithdrowStatusChange(Request $request){
        $status=$request->status;
        $id=$request->id;
        $withdrawAmount=$request->withdrawAmount;
        $vendorId=$request->vendorId;
        if ($status=='3') {
           $vendorInfo=DB::table('vendor')
                            ->where('vendor_id',$vendorId)
                            ->first();
            $preAmount=$vendorInfo->amount;
            $finalAmount=($preAmount+$withdrawAmount);
            $data['amount']=$finalAmount;
            $statusChange=DB::table('vendor')
                                ->where('vendor_id',$vendorId)
                                ->update($data);
            $datast['status']=$status;
            $statusChangest=DB::table('vendor_withdraw_amount')
                                ->where('id',$id)
                                ->update($datast);
            return redirect('admin/vendor/published/Withdrow')
                ->with('success', 'Refund successfully.');

        }else{
            $data['status']=$status;
            $statusChange=DB::table('vendor_withdraw_amount')
                                ->where('id',$id)
                                ->update($data);
            return redirect('admin/vendor/published/Withdrow')
                ->with('success', 'Status update successfully.');
        }
    }

    public function published_pagination(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')->where('status','=',1)->where('vendor_id', '>',0)->where('sku', 'LIKE', '%' . $query . '%')
                ->orderBy('product_id', 'desc')->paginate(10);
            return view('admin.vendor.published_pagination', compact('products'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }
        $sku_row= DB::table('product')->select('product_id')->orderBy('product_id','desc')->first();
        $sku=$sku_row->product_id;
        if($sku < 10){
            $data['sku']  ='000'.$sku;
        } else if( $sku > 10 and $sku < 100){
            $data['sku']  ='00'.$sku;
        } else {
            $data['sku']  =$sku;
        }




        $data['main'] = 'Products';
        $data['active'] = 'Add New Product';
        $data['title'] = '  ';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        return view('admin.product.create', $data);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';


        File::makeDirectory($small, $mode = 0777, true, true);
        File::makeDirectory($thumb, $mode = 0777, true, true);

        $sell_price=0;
        $pont_price=0;
        if($request->discount_price){
            $sell_price=$request->discount_price;
            $pont_price=round(($sell_price*10)/100);
        } else {
            $sell_price=$request->product_price;
            $pont_price=round(($sell_price*10)/100);


        }

        $data['product_point'] = $pont_price;

        $data['product_title'] = $request->product_title;
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['purchase_price'] = $request->purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_summary'] = $request->product_summary;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
        $data['product_stock'] = $request->product_stock;
        $data['stock_alert'] = $request->stock_alert;
        $data['product_video'] = $request->product_video;
        $data['status'] = $request->status;
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
            return redirect('admin/products')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/product/create')
                ->with('error', 'No successfully.');
        }

    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function published($id)
    {
        $data['status']=1;
        $result= DB::table('product')->where('product_id', $id)->update($data);


        if ($result) {
            return redirect('admin/vendor/pending/products')
                ->with('success', 'updated successfully.');
        } else {
            return redirect('admin/vendor/pending/products')
                ->with('error', 'No successfully.');
        }
    }
    public function unpublished($id)
    {
        $data['status']=0;
        $result= DB::table('product')->where('product_id', $id)->update($data);


        if ($result) {
            return redirect('admin/vendor/pending/products')
                ->with('success', 'updated successfully.');
        } else {
            return redirect('admin/vendor/pending/products')
                ->with('error', 'No successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */



    public function vendor_order_show($id)
    {

        $data['commisions'] = DB::table('vendor_price_commution')
            ->orderBy('id','desc')
            ->where('vendor_id', $id)->paginate(10);
//        dd($data);
        $data['main'] = 'Vendor Orders';
        $data['active'] = 'Update Vendor Orders';
        $data['title'] = 'Update User Registration Form';         
        return view('admin.vendor.vendor_order_show', $data);
    }

    public function productPricePay($id)
    {
        $data['status']=1;

        $data['commisions']=DB::table('vendor_price_commution')
            ->where('id', $id)->update($data);
        return redirect()->back();

    }
    public function productPriceunPay($id)
    {
        $data['status']=0;

        $data['commisions']=DB::table('vendor_price_commution')
            ->where('id', $id)->update($data);
        return redirect()->back();

    }


    public function edit($id)
    {

        $data['product'] = DB::table('product')->where('product_id', $id)->first();
        $data['main'] = 'Products';
        $data['active'] = 'Update Products';
        $data['title'] = 'Update User Registration Form';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        $data['product_categories'] = DB::table('product_category_relation')->where('product_id', $id)->orderBy('product_id', 'ASC')->get();


        return view('admin.product.edit', $data);
    }

    public function vendor_product_edit($id){

        $data['product'] = DB::table('product')->where('product_id', $id)->first();
        $data['main'] = 'Vendor Products';
        $data['active'] = 'Update Vendor Products';
        $data['title'] = 'Update User Registration Form';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        $data['product_categories'] = DB::table('product_category_relation')->where('product_id', $id)->orderBy('product_id', 'ASC')->get();


        return view('admin.vendor.vendor_pending_product_edit', $data);

    }


    public function vendor_product_edit_update(Request $request, $product_id)
    {

        date_default_timezone_set('Asia/Dhaka');

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';
//        $sell_price=0;
//        $pont_price=0;
//        if($request->discount_price){
//            $sell_price=$request->discount_price;
//            $pont_price=round(($sell_price*10)/100);
//        } else {
//            $sell_price=$request->product_price;
//            $pont_price=round(($sell_price*10)/100);
////
//
//        }
//
//        $data['product_point'] = $pont_price;

        $data['product_title'] = $request->product_title;
        $data['commision_percent'] = $request->commision_percent;
        $data['top_deal'] = $request->top_deal;
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
       // $data['purchase_price'] = $request->purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['vendor_price'] = $request->vendor_price;
        $data['product_specification'] = $request->product_specification;
        $data['product_summary'] = $request->product_summary;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
      //  $data['vendor_percent'] = $request->vendor_percent;

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
        if($category_id) {
            foreach ($category_id as $key => $cat) {
                $category_data['product_id'] = $product_id;
                $category_data['category_id'] = $cat;
                DB::table('product_category_relation')->updateOrInsert($category_data);

            }
        }


        if ($product_id) {
            return redirect('admin/vendor/pending/products')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/vendor/pending/products')
                ->with('error', 'No successfully.');
        }

    }

    public function show($id)
    {

        $data['user'] = DB::table('vendor')->where('vendor_id', $id)->first();
        $data['main'] = 'Vendors';
        $data['active'] = 'vendor profile view ';
        $data['title'] = 'Update User Registration Form';


        return view('admin.vendor.vendor_users_view', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {

        date_default_timezone_set('Asia/Dhaka');

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';
        $sell_price=0;
        $pont_price=0;
        if($request->discount_price){
            $sell_price=$request->discount_price;
            $pont_price=round(($sell_price*10)/100);
        } else {
            $sell_price=$request->product_price;
            $pont_price=round(($sell_price*10)/100);


        }

        $data['product_point'] = $pont_price;


        $data['product_title'] = $request->product_title;
        $data['folder'] = $request->folder;
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['purchase_price'] = $request->purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_summary'] = $request->product_summary;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
        $data['product_stock'] = $request->product_stock;
//        $data['stock_alert']=$request->stock_alert;
        $data['product_video'] = $request->product_video;
        $data['status'] = $request->status;
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
            return redirect('admin/products')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/product/create')
                ->with('error', 'No successfully.');
        }

    }

    public function active($id){
        $data['status']=1;
       $result= DB::table('vendor')->where('vendor_id', $id)->update($data);
        if ($result) {

            return redirect('admin/vendors')
                ->with('success', 'updated successfully.');
        } else {
            return redirect('admin/vendors')
                ->with('error', 'No successfully.');
        }
    }
    public function inactive($id){
        $data['status']=0;
        $result= DB::table('vendor')->where('vendor_id', $id)->update($data);


        if ($result) {
            $stock['product_stock']=0;
            DB::table('product')->where('vendor_id', $id)->update($stock);
            return redirect('admin/vendors')
                ->with('success', 'updated successfully.');
        } else {
            return redirect('admin/vendors')
                ->with('error', 'No successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $result = DB::table('vendor')->where('vendor_id', $id)->delete();
        if ($result) {
            return redirect('admin/vendors')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/vendors')
                ->with('error', 'No successfully.');
        }

    }

    public  function orderCheck($id){

        $data['main'] = 'Single Vendors Orders';
        $data['active'] = 'Single Vendors Orders';
        $data['title'] = '';
        $vendors = DB::table('vendor_orders')
            ->select('*')
            ->join('order_data','order_data.order_id','=','vendor_orders.order_id')
            ->where('vendor_orders.vendor_id',$id )
            ->orderBy('vendor_order_id','desc')
            ->get();
       

        return view('admin.vendor.vendor_orderCheck', compact('vendors'), $data);

    }





}
