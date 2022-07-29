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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct()
    {
        $this->middleware('Admin');
    }
    public function index()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $data['main'] = 'Products';
        $data['active'] = 'All Products';
        $data['title'] = '  ';
        $products = DB::table('product')->orderBy('product_id', 'desc')->paginate(10);
        return view('admin.product.index', compact('products'), $data);
    }

public  function  unpublishedProduct(){




    $data['main'] = 'Products';
    $data['active'] = 'All Products';
    $data['title'] = '  ';
    $products = DB::table('product')->where('vendor_id',0)->where('status',0)->orderBy('product_id', 'desc')->paginate(50);

    return view('admin.product.index', compact('products'), $data);
}
    
    public function TopDealProducts(){

        $data['main'] = 'Top Deal Products';
        $data['active'] = 'Top Deal Products';
        $data['title'] = '  ';
        $products = DB::table('product')->where('top_deal' ,'>',0)
            ->orderBy('top_deal', 'desc')->get();
        return view('admin.product.TopDealProducts', compact('products'), $data);
    }

    public function staffProduct()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }


        $data['main'] = 'Products';
        $data['active'] = 'All Products';
        $data['title'] = '  ';
        $products = DB::table('product')->where('vendor_id',0)->where('purchase_price','')->where('status',0)->orderBy('product_id', 'desc')->paginate(10);

        return view('admin.product.staffProduct', compact('products'), $data);
    }

    public function pagination(Request $request)
    {

            $query = $request->get('query');
            $search_query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->where(function ($query_row) use ($search_query) {
                    return $query_row->where('sku','LIKE','%'.$search_query.'%')
                        ->orWhere('product_title','LIKE','%'.$search_query.'%');
                })
                ->orderBy('product_id', 'desc')->paginate(10);
            return view('admin.product.pagination', compact('products'));

    }


    public function create()
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();
        }
        $sku= DB::table('product')->select('product_id')->orderBy('product_id','desc')->value('product_id');

        if($sku < 10){
            $value=$sku+1;
            $data['sku']  ='0000'.$value;
           
        } else if( $sku > 10 and $sku < 100){
               $value=$sku+1;
            $data['sku']  ='00'.$value;
            
        } else {
                $value=$sku+1;
            $data['sku']  ='00'.$value;
            
        }
        
        $data['main'] = 'Products';
        $data['active'] = 'Add New Product';
        $data['title'] = '  ';
        $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
        return view('admin.product.create', $data);
    }

    public function store(Request $request)
    {

        date_default_timezone_set('Asia/Dhaka');
        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';
        File::makeDirectory($small, $mode = 0777, true, true);
        File::makeDirectory($thumb, $mode = 0777, true, true);
        $data['product_title'] = $request->product_title;
        $sell_price=0;
        $pont_price=0;
        $product_profite=0;
        if($request->discount_price){
            $sell_price=$request->discount_price;
            $pont_price=round(($sell_price*10)/100);
        } else {
            $sell_price=$request->product_price;
            $pont_price=round(($sell_price*10)/100);
        }

        $statistics=DB::table('statistics')->first();
        DB::table('statistics')->where('id','=',1)->update(['total_products'=>$statistics->total_products+1]);

        $data['product_point'] = $pont_price;

        $data['product_profite'] =  $request->product_profite;
        $data['product_subtitle'] =  $request->product_subtitle;
        $data['top_deal'] =  $request->top_deal;
        $data['commision_percent'] =  $request->commision_percent;
        $data['collection_product_from_user'] = $request->collection_product_from_user;
        $data['folder'] = $request->folder;

        $productName=DB::table('product')->where('product_name','=',$request->product_name)->value('product_name');
        if($productName){
            $data['product_name'] = $request->product_name.'1';

        }else{
            $data['product_name'] = $request->product_name;
        }

       

        $data['hot_product'] = $request->hot_product;
        $data['product_price'] = $request->product_price;
        $data['hot_deal_product'] = $request->hot_deal_product;
        $status= Session::get('status');
        if ($status != 'editor') {
        $data['purchase_price'] = $request->purchase_price;
        $data['status'] = $request->status;
        }else{
            $data['status'] = 0;
        }
        $data['discount_price'] = $request->discount_price;
        $data['product_specification'] = $request->product_specification;
        $data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
        $data['vendor_id'] = 0;
        
        $data['stock_alert'] = $request->stock_alert;
        $data['product_video'] = $request->product_video;
        $data['product_type'] = $request->product_type;
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
        $product_image1 = $request->file('product_image1');
        $product_image2 = $request->file('product_image2');
        $product_image3 = $request->file('product_image3');
        $product_image4 = $request->file('product_image4');
        $product_image5 = $request->file('product_image5');
        $product_image6 = $request->file('product_image6');

   $featured_image_orgianal = $request->file('featured_image');
        if ($featured_image_orgianal) {
            // $image_name = time().'.'.$featured_image->getClientOriginalExtension();
            $featured_image = $product_id . '.' . $featured_image_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($featured_image_orgianal->getRealPath());
            $resize_image->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image1->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image2->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image3->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image4->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image5->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image6->resize(1000, 1000, function ($constraint) {

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




    public function show($id)
    {

    }


    public function edit($id)
    {

        $data['product'] = DB::table('product')->where('product_id', $id)->first();
        if( $data['product'] ){
            $data['main'] = 'Products';
            $data['active'] = 'Update Products';
            $data['title'] = 'Update User Registration Form';
            $data['categories'] = DB::table('category')->where('parent_id', 0)->orderBy('category_id', 'ASC')->get();
            $data['vendors'] = DB::table('vendor')->select('vendor_id','vendor_f_name','vendor_shop')->get();
            $data['product_categories'] = DB::table('product_category_relation')->where('product_id', $id)->orderBy('product_id', 'ASC')->get();
            return view('admin.product.edit', $data);
        } else {
            return redirect('admin/products');
        }

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
        $discount_price_row=DB::table('product')->select('discount_price')->where('product_id',$product_id)->first();
        if($discount_price_row){
            $previous_price=$discount_price_row->discount_price;
            if($previous_price==$request->discount_price){

            } else {
                $product_notification=array();
                $product_notification['product_id']=$product_id;
                $product_notification['previous_price']=$previous_price;
                $product_notification['present_price']=$request->discount_price;
                $product_notification['created_at']=date('Y-m-d H:i:s');
               $existing_product_check= DB::table('product_update_notification')->where('product_id',$product_id)->first();
                if($existing_product_check){

                    DB::table('product_update_notification')->where('product_id',$product_id)->update($product_notification);
                    $afflites=DB::table('users_public')->select('id')->get();
                    $product_update_affiliate_notification['created_at']=date('Y-m-d H:i:s');
                    $product_update_affiliate_notification['status']=0;
                        $existing_product_check= DB::table('product_update_affiliate_notification')
                            ->where('product_id',$product_id)
                            ->update($product_update_affiliate_notification);
                } else {
                    $existing_product_check= DB::table('product_update_notification')->insert($product_notification);
                    $afflites=DB::table('users_public')->select('id')->get();
                    $product_update_affiliate_notification['product_id']=$product_id;
                    $product_update_affiliate_notification['created_at']=date('Y-m-d H:i:s');
                    foreach ($afflites as $afflite){
                        $product_update_affiliate_notification['affiliate_id']=$afflite->id;
                        DB::table('product_update_affiliate_notification')->insert($product_update_affiliate_notification);
                    }
                }
            }
        }

        $media_path = 'uploads/' . $request->folder;
        $orginalpath = public_path() . '/uploads/' . $request->folder;
        $small = $orginalpath . '/' . 'small';
        $thumb = $orginalpath . '/' . 'thumb';
        $sell_price=0;
        $pont_price=0;
        $product_profite=0;
        if($request->discount_price){
            $sell_price=$request->discount_price;
            $pont_price=round(($sell_price*10)/100);
         } else {
            $sell_price=$request->product_price;
            $pont_price=round(($sell_price*10)/100);
        }
        $data['product_subtitle'] =  $request->product_subtitle;
        $data['hot_deal_product'] = $request->hot_deal_product;
        $data['product_point'] = $pont_price;
        $data['product_profite'] =  $request->product_profite;
        $data['top_deal'] =  $request->top_deal;
        $data['commision_percent'] =  $request->commision_percent;
        $data['product_title'] = $request->product_title;
        $data['collection_product_from_user'] = $request->collection_product_from_user;
        $data['folder'] = $request->folder;
       // $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $status= Session::get('status');

        
        if ($status != 'editor') {
            $data['purchase_price'] = $request->purchase_price;
            $data['status'] = $request->status;
            $data['vendor_id'] = $request->vendor_id;
        }else{
            $data['status'] = 0;
        }
        $data['discount_price'] = $request->discount_price;
        $data['product_specification'] = $request->product_specification;
        $data['delivery_in_dhaka'] = $request->delivery_in_dhaka;
        $data['delivery_out_dhaka'] = $request->delivery_out_dhaka;
        $data['product_description'] = $request->product_description;
        $data['product_terms'] = $request->product_terms;
        $data['sku'] = $request->sku;
        
        $data['product_type'] = $request->product_type;
        $data['product_video'] = $request->product_video;
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
            $resize_image->resize(1000, 1000, function ($constraint) {
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
            $resize_galary_image1->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image2->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image3->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image4->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image5->resize(1000, 1000, function ($constraint) {

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
            $resize_galary_image6->resize(1000, 1000, function ($constraint) {

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
                ->with('success', 'Update successfully.');
        } else {
            return redirect('admin/product/create')
                ->with('error', 'No successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = DB::table('product')->where('product_id', $id)->delete();
        if ($result) {
            return redirect('admin/products')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/products')
                ->with('error', 'No successfully.');
        }

    }

    public function urlCheck(Request $request)
    {
        $product_name = $request->get('url');
        $result = DB::table('product')->where('product_name', $product_name)->first();
        if ($result) {
            echo 'This product exit';
        } else {
            echo '';
        }
    }

    
    public function StockUpdate($id)
    {
        
        $data['product']= DB::table('product')->where('product_id',$id)->first();
        return view('admin.product.product_stock_entry', $data);
    }
    public function productStockUpdate(Request $request)
    {
       $product_id= $request->product_id;
       $stock= $request->stock;
       $zone_id= Session::get('zone_id');
       $shop_id= Session::get('shop_id');
       $admin_id= Session::get('id');
      $checkProductStock= DB::table('product_stocks')->where('shop_id',$shop_id)->where('product_id',$product_id)->first();
      if($checkProductStock){
        // update
        $data_stock['stock']=$checkProductStock->stock+$stock;
        $data_stock['updated_at']=date("Y-m-d H:i:s");
         DB::table('product_stocks')->where('shop_id',$shop_id)->where('product_id',$product_id)->update($data_stock);

         $data_stock_details['zone_id']=$zone_id;
         $data_stock_details['shop_id']=$shop_id;
         $data_stock_details['product_id']=$product_id;
         $data_stock_details['stock']=$stock;
         $data_stock_details['product_stock_id']=$checkProductStock->id;
         $data_stock_details['price']=single_product_information($product_id)->purchase_price;
         $data_stock_details['user_id']=$admin_id;
         $data_stock_details['created_at']=date("Y-m-d H:i:s");
         $data_stock_details['updated_at']=date("Y-m-d H:i:s");
         DB::table('product_stock_details')->insert($data_stock_details);


      }else{
        $data_stock['zone_id']=$zone_id;
        $data_stock['shop_id']=$shop_id;
        $data_stock['product_id']=$product_id;
        $data_stock['stock']=$stock;
        $data_stock['created_at']=date("Y-m-d H:i:s");
        $data_stock['updated_at']=date("Y-m-d H:i:s");
       $product_stock_id= DB::table('product_stocks')->insertGetId($data_stock);

        $data_stock_details['zone_id']=$zone_id;
        $data_stock_details['shop_id']=$shop_id;
        $data_stock_details['product_id']=$product_id;
        $data_stock_details['stock']=$stock;
        $data_stock_details['product_stock_id']=$product_stock_id;
        $data_stock_details['user_id']=$admin_id;
        $data_stock_details['price']=single_product_information($product_id)->purchase_price;
        $data_stock_details['created_at']=date("Y-m-d H:i:s");
        $data_stock_details['updated_at']=date("Y-m-d H:i:s");
        DB::table('product_stock_details')->insert($data_stock_details);


      }
      echo 'success';
        
    }
    

    public function foldercheck(Request $request)
    {
        //  $product_name = $request->get('url');
        $result = DB::table('product')->orderby('product_id', 'desc')->first();
        if ($result) {
            $product_id = $result->product_id;
            $product_id = $product_id + 1;
            echo $product_id;
        } else {
            echo '1';
        }
    }
}
