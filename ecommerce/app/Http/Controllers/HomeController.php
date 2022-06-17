<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use  Cart;
use Jenssegers\Agent\Agent;
use Session;

use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
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

    public function index()
    {

        $data['share_picture'] = get_option('home_share_image');
        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_description'] = get_option('home_seo_content');
        $data['sliders'] = DB::table('homeslider')
            ->select('homeslider_title','slider_color', 'target_url', 'homeslider_picture', 'homeslider_text')
            ->where('status', 1)->get();
        $data['hotDealproducts'] = DB::table('product')
            ->select('hot_deal_product','product_title', 'product_name', 'discount_price', 'product_price', 'folder', 'feasured_image')
            ->whereIn('hot_deal_product',[1,2])
//            ->where('status', '=', 1)
//            ->where('product_stock', '>', 0)
            ->orderBy('product.modified_time', 'DESC')
            ->get();       
        return view('website.home', $data);
    }

    public function product_click(Request $request)
    {


        $agent = new Agent();

        $device = $agent->isDesktop();
        if ($agent->isDesktop() == 1) {
            $data['device'] = "desktop";
        } elseif ($agent->isTablet() == 1) {
            $data['device'] = "tablet";
        } else {
            $data['device'] = "mobile";
        }
        $data['ip'] = $request->ip();
        $ip = $request->ip();
        $data['view_from'] = $_SERVER['HTTP_REFERER'];
        $data['click_date'] = date("Y-m-d");
        $data['click_date_time'] = date("Y-m-d H:i:s");
        $data['product_id'] = $request->product_id;
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

        DB::table('product_click')->insert($data);
    }

    public function visitor(Request $request)
    {

        $data['client_ip'] = $request->ip();
        $data['date'] = date("Y-m-d");
        $agent = new Agent();
        $device = $agent->isDesktop();
        if ($agent->isDesktop() == 1) {
            $data['agent'] = "desktop";
        } elseif ($agent->isTablet() == 1) {
            $data['agent'] = "tablet";
        } else {
            $data['agent'] = "mobile";
        }
        $visited = DB::table('hitcounter')->where('client_ip', '=', $request->ip())->where('date', '=', date("Y-m-d"))->first();
        if ($visited) {

        } else {
            DB::table('hitcounter')->insert($data);
        }

    }


    public function ip()
    {
        $ip = '103.120.39.9';
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        echo '<pre>';
        print_r($details);
        echo $details->city;

    }


    public function category(Request $request,$category_name)
    {

        $coin = $request->coin;
        $data['products'] = DB::table('product')
            ->select('product.product_id', 'discount_price', 'product_price', 'product_name', 'folder', 'feasured_image', 'product_title','product_subtitle')
            ->join('product_category_relation', 'product_category_relation.product_id', '=', 'product.product_id')
            ->join('category', 'category.category_id', '=', 'product_category_relation.category_id')
            ->where('product.status', '=', 1)
            ->where('category_name', $category_name)
            ->orderBy('modified_time', 'DESC')
            ->simplePaginate(30);
        $category_row = DB::table('category')
            ->select('share_image', 'parent_id', 'category_name', 'category_title', 'seo_title', 'seo_keywords', 'seo_content')
            ->where('category_name', $category_name)
            ->first();
        if ($category_row) {
            $category_id = $category_row->parent_id;
            $category_row_second = DB::table('category')
                ->select('category.parent_id', 'category_title', 'category_name')
                ->where('category_id', $category_id)->first();
            if ($category_row_second) {
                $category_id = $category_row_second->parent_id;
                $data['category_name_middle'] = $category_row_second->category_name;
                $data['category_title_middle'] = $category_row_second->category_title;
                $category_row_first = DB::table('category')
                    ->select('category.parent_id', 'category_title', 'category_name')
                    ->where('category_id', $category_id)
                    ->first();
                if ($category_row_first) {
                    $data['category_name_first'] = $category_row_first->category_name;
                    $data['category_title_first'] = $category_row_first->category_title;
                }
            }
        $data['category_name_last'] = $category_row->category_name;
        $data['category_name'] = $category_name;
        $data['category_title_last'] = $category_row->category_title;
        $data['share_picture'] = url('/') . '/' . $category_row->share_image;
        $data['seo_title'] = $category_row->seo_title;
        $data['seo_keywords'] = $category_row->seo_keywords;
        $data['seo_description'] = $category_row->seo_content;
        $data['coin'] = $coin;

        return view('website.category', $data);
        } else{
            return redirect('/');
        }
    }


    public function allProducts()
    {


        $data['products'] = DB::table('product')
            ->select('product.product_id', 'discount_price', 'product_price', 'product_name', 'folder', 'feasured_image', 'product_title','product_subtitle')
            ->where('product.status', '=', 1)
            ->orderBy('modified_time', 'desc')
            ->simplePaginate(36);
        return view('website.all_products', $data);
    }

    public function ajaxAllProducts(Request $request)
    {

        if ($request->ajax()) {
            $order_by = $request->get('order_by');
            $query = DB::table('product')
                ->select('product.product_id', 'discount_price', 'product_price', 'product_name', 'folder', 'feasured_image', 'product_title')
                ->where('product.status', '=', 1);

            if($order_by=="name_asc"){
                $query->orderBy('product_title', 'ASC');
            }else if($order_by=="name_desc"){
                $query->orderBy('product_title', 'DESC');
            }else if($order_by=="price_asc"){
                $query->orderBy('product_price', 'ASC');
            }else if($order_by=="price_desc"){
                $query->orderBy('product_price', 'DESC');
            } else{
                $query->orderBy('modified_time', 'DESC');
            }
            $products= $query->simplePaginate(30);
        
            
            $view = view('website.all_product_by_ajax', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
    }

    public function ajax_category(Request $request)
    {
        if ($request->ajax()) {
            $category_name = $request->get('category_name');
            $order_by = $request->get('order_by');
            // $query = str_replace(" ", "%", $query);
            $query = DB::table('product')
                ->select('product.product_id', 'discount_price', 'product_price', 'product_name', 'folder', 'feasured_image', 'product_title','product_subtitle')
                ->join('product_category_relation', 'product_category_relation.product_id', '=', 'product.product_id')
                ->join('category', 'category.category_id', '=', 'product_category_relation.category_id')
                ->where('product.status', '=', 1)
                ->where('category_name', $category_name);
            if($order_by=="name_asc"){
                $query->orderBy('product_title', 'ASC');
            }else if($order_by=="name_desc"){
                $query->orderBy('product_title', 'DESC');
            }else if($order_by=="price_asc"){
                $query->orderBy('product_price', 'ASC');
            }else if($order_by=="price_desc"){
                $query->orderBy('product_price', 'DESC');
            } else{
                $query->orderBy('modified_time', 'DESC');
            }
            $products= $query->simplePaginate(30);
            $view = view('website.category_ajax', compact('products'))->render();
            return response()->json(['html' => $view]);
        }

    }

    public function hot_home_product()
    {
        $data['products'] = DB::table('product')->where('status', '=', 1)->orderBy('modified_time', 'desc')->get();
        $view = view('website.hot_home_ajax_product', $data)->render();
        return response()->json(['html' => $view]);
    }

    public function home_page_category_ajax()
    {
        // $data['products']=DB::table('product')->get();
        $view = view('website.home_page_ajax_category')->render();
        return response()->json(['html' => $view]);
    }

    public function product(Request $request,$product_name)
    {
        $coin = $request->coin;
        $data['product'] = DB::table('product')->select('*')
            ->where('product_name', $product_name)
            ->where('status', '=', 1)
            ->first();

        if ($data['product']) {
            $data['category_name_last'] = '';
            $data['category_title_last'] = '';
            $category_row = DB::table('product')->select('category.parent_id', 'category_title', 'category_name')
                ->join('product_category_relation', 'product_category_relation.product_id', '=', 'product.product_id')
                ->join('category', 'category.category_id', '=', 'product_category_relation.category_id')
                ->where('product_name', $product_name)->orderBy('category.category_id', 'DESC')->first();
            $data['page_title'] = $data['product']->product_title;
            $data['seo_title'] = $data['product']->seo_title;
            $data['seo_keywords'] = $data['product']->seo_keywords;
            $data['seo_description'] = $data['product']->seo_content;
            $data['share_picture'] = url('/public/uploads/') . '/' . $data['product']->folder . '/' . $data['product']->feasured_image;
            if($category_row) {
                $category_id = $category_row->parent_id;
                $category_row_second = DB::table('category')->select('category.parent_id', 'category_title', 'category_name')
                    ->where('category_id', $category_id)->first();
                if ($category_row_second) {
                    $category_id = $category_row_second->parent_id;
                    $data['category_name_middle'] = $category_row_second->category_name;
                    $data['category_title_middle'] = $category_row_second->category_title;
                    $category_row_first = DB::table('category')->select('category.parent_id', 'category_title', 'category_name')->where('category_id', $category_id)->first();
                    if ($category_row_first) {
                        $data['category_name_first'] = $category_row_first->category_name;
                        $data['category_title_first'] = $category_row_first->category_title;
                    }
                }
                $data['category_name_last'] = $category_row->category_name;
                $data['category_title_last'] = $category_row->category_title;
            }


            $data['coin'] = $coin;
            return view('website.product.product', $data);
        } else {
            $data['seo_title'] = get_option('home_seo_title');
            $data['seo_keywords'] = get_option('home_seo_keywords');
            $data['seo_description'] = get_option('home_seo_content');
            $data['share_picture'] = get_option('home_share_image');
            $data['page'] = DB::table('page')->select('*')->where('page_link', $product_name)->first();
            if ($data['page']) {
                return view('website.page', $data);
            } else {
                // affiliate test section
                $link_row = DB::table('users_public')->where('id', $product_name)->first();
                if ($link_row) {
                    Cookie::forget('unique_code');
                    Cookie::forget('link_id');
                    $unique_number = (mt_rand(10000, 999999));
                    $unique_number = $unique_number . $link_row->id;
                    Cookie::queue('unique_code', $unique_number, 10);
                    Cookie::queue('link_id', $link_row->id, 10);
                    $data = array(
                        'user_id' => $product_name,
                        'product_id' => 0,
                        'unique_number' => $unique_number,
                        'hit_date' => date('Y-m-d')
                    );
                    DB::table('product_hit_count')->insert($data);
                    return redirect('/');
                } else {
                    return redirect('/');
                }
            }

        }
    }

    public function search_engine(Request $request)
    {
        $search_query = $request->search_query;
        $search_query = str_replace(" ", "%", $search_query);
        $data['products'] = DB::table('product')
            ->select('product_title', 'folder', 'feasured_image', 'product_price', 'sku', 'discount_price', 'product_name')
            ->where('status', '=', 1)
            ->where(function ($query) use ($search_query) {
                return $query->where('sku', 'LIKE', '%' . $search_query . '%')
                    ->orWhere('product_title', 'LIKE', '%' . $search_query . '%');
            })->orderBy('modified_time', 'desc')->simplePaginate(10);
        $data['search_query'] = $search_query;
        $view = view('website.search_engine', $data)->render();
        return response()->json(['html' => $view]);
    }

    public function search(Request $request)
    {

        $coin = 0;
        $search_query = $request->search;
        $array = explode('?', $request->search);

        /* start check for coin data */
        if(isset($array[0])){
            $search_query=$array[0];
        }
        if(isset($array[1])){
            $coin=$array[1];
            $array = explode('=', $coin);
            $coin=$array[1];
        }
        /* end check for coin data */


        $data['share_picture'] = get_option('home_share_image');
        $search_query = str_replace(" ", "%", $search_query);
        $products = DB::table('product')
            ->select('product_id', 'product_title', 'folder', 'feasured_image', 'product_price', 'sku', 'discount_price', 'product_name','product_subtitle')
            ->where('product.status', '!=', 0)
            ->where('sku', 'LIKE', '%' . $search_query . '%')
            ->orWhere('product_title', 'LIKE', '%' . $search_query . '%')->orderBy('modified_time', 'desc')->get();
        return view('website.search', compact('products', 'search_query','coin'));

    }


    public function hotDealProduct( )
    {
        $data['products'] = DB::table('product')->whereIn('hot_deal_product',[1,2])->get();
        return view('website.hotDealProduct',$data);

    }
    public function coin( )
    {
        $data['coins'] = DB::table('coin_list')->get();
        $customer = Session::get('customer_id');
        $data['user_id'] = $customer;
        if ($customer){
            $data['bonus_blance'] = DB::table('users')->where('id', $customer)->value('bonus_blance');
    }
        return view('website.coin',$data);

    }
    public function getCoinDataByAjax()
    {
        $data['coins']=DB::table('coin_list')->get();
        $customer=Session::get('customer_id');
        $data['user_id']=$customer;
        $data['bonus_blance'] = DB::table('users')->where('id', $customer)->value('bonus_blance');
        $view = view('website.coin_ajax',$data)->render();
        return response()->json(['html' => $view]);


    }

    public function getCoinBonusById($id)
    {
        $coin=DB::table('coin_history')->where('id',$id)->first();
        if($coin){
            if($coin->status==0){
                DB::table('coin_history')->where('id',$id)->update(['status'=>1]);
                $bonus= DB::table('users')->where('id',$coin->user_id)->first();
                $data['bonus_blance']=$bonus->bonus_blance+100;
                DB::table('users')->where('id',$coin->user_id)->update($data);


              $parent_affiliate=  DB::table('users')->where('affiliate_user_id',$bonus->affiliate_id)->first();
                if($parent_affiliate){
                   $affiliate_income['bonus_blance']= $parent_affiliate->bonus_blance+5;
                    DB::table('users')->where('id',$parent_affiliate->id)->update($affiliate_income);
                }

                echo "done";
            }else{
                echo "already";
            }

        }else{
            echo "failed";
        }



    }

    public function getCoinData(Request $request)

    {
        
        $id=$request->url;
        $customer=Session::get('customer_id');  
        if($customer) {
            $coin = DB::table('coin_history')->where('link', '=', $id)->where('user_id', $customer)->where('created_at', date('Y-m-d'))->count();
            if ($coin == 0) {
                $data['status'] = 0;
                $data['link'] = $id;
                $data['user_id'] = $customer;
                $data['amount'] = 100;
                $data['created_at'] = date("Y-m-d");
                DB::table('coin_history')->insert($data);
                echo "done";

            } else {
                echo "already";
            }

        }else{
            echo 'no';
        }
    }




    public function search_ajax(Request $request)
    {
        $search_query = $request->search;
        $data['share_picture'] = get_option('home_share_image');
        $search_query = str_replace(" ", "%", $search_query);
        $products = DB::table('product')
            ->select('product_id', 'product_title', 'folder', 'feasured_image', 'product_price', 'sku', 'discount_price', 'product_name','product_subtitle')
            ->where('product.status', '!=', 0)
            ->where('sku', 'LIKE', '%' . $search_query . '%')
            ->orWhere('product_title', 'LIKE', '%' . $search_query . '%')->orderBy('modified_time', 'desc')->limit(42)->get();

        return view('website.search_ajax', compact('products', 'search_query'));

    }

    public function allShop()
    {

        $data['shops'] = DB::table('vendor')
            ->select('vendor_shop', 'vendor_shop_image', 'vendor_link', 'vendor_image', 'product.vendor_id')
            ->join('product', 'product.vendor_id', '=', 'vendor.vendor_id')
            ->where('vendor.status', '=', 1)
            ->groupBy('vendor.vendor_id')
            ->get();

        return view('website.allShop', $data);
    }

    public function track_order(Request $request)
    {
        if ($request->mobile) {
            $data['mobile'] = $request->mobile;
            $data['order'] = DB::table('order_data')->where('customer_phone', $request->mobile)->orderBy('order_id', 'desc')->first();
            $data['mobile'] = $request->mobile;
            return view('website.track_order_page', $data);
        } else {
            return view('website.track_order_page');
        }
    }

    public function affiliate_check_controller($product_key = null, $user_id = null)
    {

        $link = url('/') . '/' . $product_key . "/" . $user_id;
        $link_row = DB::table('product_link_info')->where('product_link', $link)->first();
        if ($link_row) {
            Cookie::forget('unique_code');
            Cookie::forget('link_id');
            $unique_number = (mt_rand(10000, 999999));
            $unique_number = $unique_number . $link_row->id;
            Cookie::queue('unique_code', $unique_number, 10);
            Cookie::queue('link_id', $link_row->id, 10);
            $product_row = DB::table('product')->select('product_id')->where('product_name', $product_key)->first();
            $data = array(
                'user_id' => $user_id,
                'product_id' => $product_row->product_id,
                'unique_number' => $unique_number,
                'hit_date' => date('Y-m-d')
            );

            DB::table('product_hit_count')->insert($data);
            $get_link = url('/') . "/product/" . $product_key;
            return redirect($get_link);
        } else {
            return redirect('/');
        }
    }

    public function affilates_products()
    {
        return view('website.affilates_products');
    }

    public function askQuestionsFromWebsite(Request $request)
    {
        $data['comment_from_customer'] = $request->question;
        $data['question_email'] = $request->question_email;
        $data['product_id'] = $request->product_id;
        $vendor = DB::table('product')->select('vendor_id')->where('product_id', $request->product_id)->first();
        if ($vendor) {
            $data['vendor_id'] = $vendor->vendor_id;
        }
        $data['staus'] = 1;
        $resutl = DB::table('product_comment')->insert($data);
        if ($resutl) {
            return response()->json(['result' => 'done']);
        } else {
            return response()->json(['result' => 'failed']);
        }
    }

    public function allQuestions($product_id)
    {
        $data['comments'] = DB::table('product_comment')
            ->where('product_id', $product_id)
            ->orderBy('comment_id', 'desc')
            ->get();
        return view('website.single_product_comment', $data);

    }

    public function checkCouponCode($coupon_code)
    {
        $coupon = DB::table('affiliate_coupon_code')
            ->where('coupon_code', $coupon_code)
            ->first();

        $productReduce = false;

        if ($coupon) {
            if ($coupon->expire_date > date("Y-m-d")) {
                $items = \Cart::getContent();
                //Cart::clear();
                foreach ($items as $row) {
                    $product_id = $row->id;
                    if ($product_id == $coupon->product_id) {
                        $productReduce = true;
                    }
                }
                if ($productReduce) {
                    $data['dicount'] = $coupon->discount;
                    $data['message_success'] = "Coupon  discount " . $coupon->discount . " Tk  ";
                } else {
                    $data['message'] = "This Coupon Code is not valid for this product";
                }

            } else {
                $data['message'] = "This Coupon Code is Expired";
            }
        } else {
            $data['message'] = "Invalid Coupon  Code ";
        }
        return response()->json($data);
    }


}
