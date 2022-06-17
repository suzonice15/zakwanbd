<?php
namespace App\Http\Controllers\admin;
    use Illuminate\Http\Request;
    use DB;
    use  Session;
    use Image;
    use Illuminate\Support\Facades\Redirect;
    use URL;
    use Pusher\Pusher;
    use File;
    use Carbon\Carbon;

class AffiliteController extends Controller
{

    public  function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set("Asia/Dhaka");
    }

    public function campaing(){

        $data['main'] = 'Campaign Satatistics';
        $data['active'] = 'Campaign list';
        $data['campaings'] = DB::table('product_link_info')->where('user_id', Session::get('id'))->orderBy('id','desc')->get();
        return view('admin.affilate.campaing', $data);
    }

    public function channedPassword (Request $request){

        $data['main'] = 'Changed Password';
        $data['active'] = 'Changed Password';
        $data['success'] = '';
        $method = $request->method();
        if($method=='POST'){
            $oldpassword= md5($request->old_password);
            $user= DB::table('users_public')->where('id', Session::get('id'))->first();
            if($user->password !=$oldpassword){
                return redirect()->back()->with("error","Old Passworld does not matched");
            }
            $data_row['password']=  md5($request->new_password);
            DB::table('users_public')->where('id', Session::get('id'))->update($data_row);
            $data['success'] = 'Successfully Password Updated';
        }

        return view('admin.affilate.channedPassword', $data);
    }

    public function Profile (){

        $data['main'] = 'Profile';
        $data['active'] = 'Profile';
        $data['user'] = DB::table('users_public')->where('id', Session::get('id'))->first();
        $data['skil_point'] = DB::table('marketing_metarial')->where('affiliate_id', Session::get('id'))->sum('skill_point');
        return view('admin.affilate.profile', $data);
    }
    public function profile_store(Request $request){
        $id=  $request->id;
        $image_extension='webp';
        $user=DB::table('users_public')->select('picture','nationalIdPicture','addressVarifiedPicture','nominee_national_id')->where('id','=',$id)->first();
        $destinationPath= public_path('/uploads/');
        $data['name']=  $request->name;
        $data['phone']=  $request->phone;
        $data['address']=  $request->address;
        $data['city']=  $request->city;
        $data['post_code']=  $request->post_code;
        $data['nominee_name']=  $request->nominee_name;
        $data['nominee_phone']=  $request->nominee_phone;
        $data['nominee_relation']=  $request->nominee_relation;

        $data['address']=  $request->address;

        $data['nation_id_number']=  $request->nation_id_number;
        $image = $request->file('picture');
        if ($image) {
            if($user->picture){
                File::delete($destinationPath.$user->picture);
            }
            $image_name = $id.'_p_'.'.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(100, 100, function ($constraint) {
            })->save($destinationPath . '/' . $image_name);
            $data['picture'] = $image_name;
        }
        $image = $request->file('nominee_national_id');
        if ($image) {
            if($user->nominee_national_id){
                File::delete($destinationPath.$user->nominee_national_id);
            }
            $image_name = $id.'_nominee_p_'.'.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize(100, 100, function ($constraint) {
            })->save($destinationPath . '/' . $image_name);
            $data['nominee_national_id'] = $image_name;
        }

        $nationalIdPicture = $request->file('nationalIdPicture');
        if ($nationalIdPicture) {
            if($user->nationalIdPicture){
                File::delete($destinationPath.$user->nationalIdPicture);
            }
            $image_name = $id.'_nid_'.'.' . 'webp';
            $destinationPath = public_path('/uploads');
            $resize_image = Image::make($nationalIdPicture->getRealPath());
            $resize_image->encode($image_extension, 50)->save($destinationPath . '/' . $image_name);
            $data['nationalIdPicture'] = $image_name;
            /* submit  for varification */
            $data['accountVarificationStatus'] = 4;
        }
        $addressVarifiedPicture = $request->file('addressVarifiedPicture');
        if ($addressVarifiedPicture) {
            if($user->addressVarifiedPicture){
                File::delete($destinationPath.$user->addressVarifiedPicture);
            }
            $image_name = $id.'_a_'.'.'.'webp';
            $destinationPath = public_path('/uploads');
            $resize_image = Image::make($addressVarifiedPicture->getRealPath());
            $resize_image->encode($image_extension, 50)->save($destinationPath . '/' . $image_name);
            $data['addressVarifiedPicture'] = $image_name;
            /* submit  for varification */
            $data['accountVarificationStatus'] = 4;
        }
        DB::table('users_public')->where('id',$id)->update($data);
        return redirect('profile');
    }

    public function marketingMeterials (){
        $data['main'] = 'Marketing Meterials';
        $data['active'] = 'Marketing Meterials';
        $data['metarials'] = DB::table('marketing_metarial')
            ->where('affiliate_id', Session::get('id'))
            ->orderBy('marketing_id','desc')->get();

        $data['products'] = DB::table('product')
            ->select('product_id','sku','product_title')
            ->where('vendor_id','=',0)
            ->get();
        $data['coupons'] = DB::table('affiliate_coupon_code')->where('affiliate_id', Session::get('id'))->get();

        return view('admin.affilate.marketing_meterials', $data);
    }
    public function getCouponCodeProductPrice($product_id){

        $commision=  DB::table('product')->where('product_id','=',$product_id)->value('top_deal');
        return $commision;
    }
    public function CouponCodeCheck($couponCode){
        $existingCouponCode=  DB::table('affiliate_coupon_code')->where('coupon_code','=',$couponCode)->value('coupon_code');
        if($existingCouponCode){
            echo "1";
        } else {
            echo "0";
        }
    }
    public function couponDelete($coupon_id){
        DB::table('affiliate_coupon_code')->where('affiliate_id','=',Session::get('id'))->where('id','=',$coupon_id)->delete();
        return redirect()->back()->with("success_c","created successfully");


    }




    public function couponStore (Request $request)
    {

        $couponCount= DB::table('affiliate_coupon_code')->where('affiliate_id','=',Session::get('id'))->count();
        if($couponCount==5){
            return redirect()->back()->with("error_c","Maximum number of Coupon Code generation limit cross ");
        }
        $data['affiliate_id'] = Session::get('id');
        $data['product_id'] = $request->get('product_id');
        $data['coupon_name'] = $request->get('coupon_name');
        $data['coupon_code'] = $request->get('coupon_code');
        $data['discount'] = $request->get('discount');
        $data['created_at'] = date("Y-m-d H:i s");
        $data['expire_date'] = Carbon::now()->addDay($request->get('expire_date'));
        DB::table('affiliate_coupon_code')->insert($data);

        return redirect()->back()->with("success_c","created successfully");

    }



    public function marketingMeterialsStore (Request $request){
        $data['affiliate_id'] =Session::get('id');
        $data['metarial_value'] = $request->get('metarial_value');
        $data['metarial_name'] = $request->get('metarial_name');
        $existingMetarial=  DB::table('marketing_metarial')->where('affiliate_id',Session::get('id'))->where('metarial_name',$request->get('metarial_name'))->first();

        if($existingMetarial){
            if($existingMetarial->status==0 || $existingMetarial->status==2){
                return  redirect()->back()->with('success',"This  Metarial Already Pending");
            }
        }

        $existingMetarialValue=  DB::table('marketing_metarial')
            ->where('affiliate_id',Session::get('id'))
            ->where('metarial_value',$request->get('metarial_value'))->first();
        if($existingMetarialValue){
            return  redirect()->back()->with('success',"This  Metarial Already Existing");

        }
        $data['affiliate_id'] =Session::get('id');
        $data['created'] =date('Y-m-d');

        if(trim($request->get('metarial_name')) =='Facebook Market'){
            $marketPlaceValue= $request->get('metarial_value');
            $marketPlaceArray=explode('/',$request->get('metarial_value'));

            if($marketPlaceArray[4]=="profile"){
                /* this is market place profile*/
            } else {
                return  redirect()->back()->with('success',"This  is not MarketPlace  Link");
            }

        }
        $exitUser= DB::table('marketing_metarial')->insert($data);
        return redirect('user/my/marketing/meterials')->with('success','Your Information Inserted Successfully');
    }



    public function share_code(){
        $data['products'] = DB::table('product')
            ->where('status',1)->where('top_deal','>',0)
            ->orderBy('top_deal', 'desc')
            ->skip(0)
            ->take(6)
            ->get();
        return view('admin.affilate.share_code', $data);
    }


    public function productNotification(){


        $data['main'] = 'Notifications';
        $data['active'] = 'Notifications';
        $user_id=session::get('id');
        $data['notifications']=  DB::table('product_update_affiliate_notification')
            ->select('product_update_affiliate_notification.status','product_affiliate_notification_id','folder','feasured_image','product_title','previous_price','present_price','product_affiliate_notification_id')
            ->join('product_update_notification','product_update_notification.product_id','=','product_update_affiliate_notification.product_id')
            ->join('product','product_update_notification.product_id','=','product.product_id')
            ->where('affiliate_id',$user_id)
            ->orderBy('product_update_notification.created_at','desc')
            ->paginate(15);


        return view('admin.affilate.productNotification', $data);
    }
    public function notificationSeen($id){

        $data['status']=1;
        DB::table('product_update_affiliate_notification')->where('product_affiliate_notification_id',$id)
            ->update($data);
        $user_id=session::get('id');
        $notifications=  DB::table('product_update_affiliate_notification')
            ->select('product_update_affiliate_notification.status','product_affiliate_notification_id','folder','feasured_image','product_title','previous_price','present_price','product_affiliate_notification_id')
            ->join('product_update_notification','product_update_notification.product_id','=','product_update_affiliate_notification.product_id')
            ->join('product','product_update_notification.product_id','=','product.product_id')
            ->where('affiliate_id',$user_id)
            ->orderBy('product_update_notification.created_at','desc')
            ->paginate(15);
        return view('admin.affilate.pagination_productNotification', compact('notifications'));
    }


    public function pagination_productNotification(Request $request){

        if ($request->ajax()) {
            $user_id=session::get('id');
            $notifications=  DB::table('product_update_affiliate_notification')
                ->select('product_update_affiliate_notification.status','product_affiliate_notification_id','folder','feasured_image','product_title','previous_price','present_price','product_affiliate_notification_id')
                ->join('product_update_notification','product_update_notification.product_id','=','product_update_affiliate_notification.product_id')
                ->join('product','product_update_notification.product_id','=','product.product_id')
                ->where('affiliate_id',$user_id)
                ->orderBy('product_update_notification.created_at','desc')
                ->paginate(15);
            return view('admin.affilate.pagination_productNotification', compact('notifications'));
        }
    }
    public function hot_deals(){
        $data['main'] = 'Top Deals';
        $data['active'] = 'All Top Deals';
        $data['products'] = DB::table('product')
            ->where('status',1)
            ->where('vendor_id','=',0)
            ->where('top_deal','>',0)
            ->where('product_stock', '>', 0)
            ->orderBy('top_deal', 'desc')
            ->paginate(18);
        $data['categories'] = DB::table('category')
            ->orderBy('category_id', 'ASC')->get();
        return view('admin.affilate.hot_deals', $data);
    }


    public function pagination_hot_deals(Request $request){
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->where('status',1)->where('top_deal','>',0)
                ->where('product_stock', '>', 0)
                ->where('product_title', 'LIKE', '%' . $query . '%')
                ->orderBy('top_deal', 'desc')
                ->paginate(18);
            return view('admin.affilate.hot_product_pagination', compact('products'));
        }
    }

    public function products_pagination_category_hot(Request $request){
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->join('product_category_relation','product_category_relation.product_id','=','product.product_id')
                ->where('product.top_deal','>',0)
                ->where('vendor_id','=',0)
                ->where('product_category_relation.category_id',$query)
                ->orderBy('.product_category_relation.product_id', 'desc')
                ->paginate(10);
            return view('admin.affilate.product_pagination', compact('products'));
        }
    }


    public function products(){
        $search_query=1;
        $data['main'] = 'Product Link Generator';
        $data['active'] = 'All Product';
        $data['products'] = DB::table('product')
            ->where('status','=',1)
            ->where(function ($query) use ($search_query) {
                return $query->where('vendor_id','=',0);
            })->orderBy('product_id', 'desc')->paginate(18);
        $data['categories'] = DB::table('category')
            ->orderBy('category_id', 'ASC')->get();
        return view('admin.affilate.products', $data);
    }



    public function products_pagination(Request $request){
        if ($request->ajax()) {
            $query_id = $request->get('query');
            $query_id = str_replace(" ", "%", $query_id);
            $products = DB::table('product')
                ->where('status','=',1)
                ->where('vendor_id','=',0)
                ->where(function ($query) use ($query_id) {
                    return
                        $query->orWhere('sku', 'LIKE', '%' . $query_id . '%')
                            ->orWhere('product_title', 'LIKE', '%' . $query_id . '%');
                })
                ->orderBy('product_id', 'desc')->paginate(18);
            return view('admin.affilate.product_pagination', compact('products'));
        }
    }


    public function tendingProducts(){
        $data['main'] = 'Tending Products';
        $data['active'] = 'Tending Products';
        $data['products'] = DB::table('product')
            ->where('status','=',1)
            ->where('vendor_id','=',0)
            ->where('product_order_count','>',0)
            ->orderBy('product_order_count', 'desc')->paginate(12);
        $data['categories'] = DB::table('category')
            ->orderBy('category_id', 'ASC')->get();
        return view('admin.affilate.tendingProducts', $data);
    }



    public function tendingProductsPagination(Request $request){
        if ($request->ajax()) {
            $query_id = $request->get('query');
            $query_id = str_replace(" ", "%", $query_id);
            $products = DB::table('product')
                ->where('status','=',1)
                ->where('vendor_id','=',0)
                ->where('product_order_count','>',0)
                ->where(function ($query) use ($query_id) {
                    return
                        $query->orWhere('sku', 'LIKE', '%' . $query_id . '%')
                            ->orWhere('product_title', 'LIKE', '%' . $query_id . '%');
                })
                ->orderBy('product_order_count', 'desc')->paginate(12);
            return view('admin.affilate.tendingProductPagination', compact('products'));
        }
    }


    public function products_pagination_hot(Request $request){
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')->where('product.top_deal','>',0)->Where('product_title', 'LIKE', '%' . $query . '%')
                ->orderBy('product_id', 'desc')->paginate(12);
            return view('admin.affilate.product_pagination', compact('products'));
        }
    }

    public function buy_products(){


        $data['main'] = 'Buy Products';
        $data['active'] = 'All Product';

        $data['products'] = DB::table('product')->where('status','=',1)->orderBy('product_id', 'desc')->paginate(12);
        $data['categories'] = DB::table('category')->orderBy('category_id', 'ASC')->get();


        return view('admin.affilate.buy_products', $data);
    }

    public function buy_products_pagination(Request $request){

        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->where('status','=',1)
                ->where('sku', 'LIKE', '%' . $query . '%')
                ->orWhere('product_title', 'LIKE', '%' . $query . '%')
                ->orderBy('product_id', 'desc')->paginate(12);
            return view('admin.affilate.buy_products_pagination', compact('products'));
        }
    }

    public function single_product($product_name){

        $data['main'] = 'Buy Products';
        $data['active'] = 'All Product';
        $data['product'] = DB::table('product')
            ->where('product_name','=',$product_name)
            ->where('status','=',1)
            ->first();
        if( $data['product']){
            return view('admin.affilate.single_product', $data);
        }
        return redirect()->back();


    }







    public function buy_products_pagination_category(Request $request){

        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                    ->join('product_category_relation','product_category_relation.product_id','=','product.product_id')
                -where('status','=',1)
                    ->where('product_category_relation.category_id',$query)
                    ->orderBy('.product_category_relation.product_id', 'desc')
                    ->paginate(10);
            return view('admin.affilate.buy_products_pagination', compact('products'));
        }
    }
    public  function product_link_id(Request $request)
    {

        $product_id = $request->get('product_id');

        $product = DB::table('product')->select('product_name')->where('product_id',$product_id)
            ->first();
        $product_link_check=DB::table('product_link_info')->where('product_id',$product_id)->where('user_id',Session::get('id'))->first();
        if ($product_link_check) {

        }else{
            $data['product_id']=$product_id;
            $data['user_id']=Session::get('id');
            $data['create_date']=date('Y-m-d h:i:s');
            $data['product_link']="https://zakwanbd.com/".$product->product_name.'/'.Session::get('id');
            DB::table('product_link_info')->insert($data);         }

        return view('admin.affilate.product_link_id', compact('product'));


    }


    public function products_pagination_category(Request $request){

        if ($request->ajax()) {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->join('product_category_relation','product_category_relation.product_id','=','product.product_id')
                ->where('product_category_relation.category_id',$query)
                ->where('product.status','=',1)
                ->orderBy('.product_category_relation.product_id', 'desc')
                ->paginate(150);
            return view('admin.affilate.product_pagination', compact('products'));
        }
    }





    public  function orderhistory(){
        $data['main'] = 'Affilate';
        $data['active'] = 'Purchase History';
        $data['orders'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'new')
            ->orderBy('order_id', 'desc')->paginate(10);

        $data['new'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'new')
            ->count();
        $data['processing'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'processing')
            ->count();
        $data['courier'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'on_courier')
            ->count();
        $data['phone_pending'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'phone_pending')
            ->count();

        $data['failed'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'failed')
            ->count();

        $data['delivered'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'delivered')
            ->count();
        $data['refund'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'refund')
            ->count();
        $data['completed'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'completed')
            ->count();
        $data['cancled'] = DB::table('order_data')
            ->where('user_id', Session::get('id'))
            ->where('order_status', 'cancled')
            ->count();
        return view('admin.affilate.order_history', $data);

    }

    public function walletHistory()
    {
        $data['main'] = 'Wallet  History';
        $data['active'] = 'Wallet  History';

        $wallets = DB::table('wallet_history')
            ->select('wallet_history.*','name','email','phone')
            ->join('users_public','users_public.id','=','wallet_history.affiliate_id')
            ->where('affiliate_id',Session::get('id'))
            ->orderBy('wallet_history_id', 'desc')->paginate(10);
        return view('admin.affilate.wallet_history', compact('wallets'));


    }


    public function orderhistory_pagination(Request $request)
    {
        if ($request->ajax()) {

            $orders = DB::table('order_data')
                ->where('user_id',Session::get('id'))
                ->where('order_status', 'new')
                ->orderBy('order_id', 'desc')->paginate(10);

            return view('admin.affilate.order_history_pagination', compact('orders'));
        }

    }
    public function paginationByOrderStatus(Request $request)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
     
            $orders = DB::table('order_data')
                ->where('order_status', $status)
                ->where('user_id',Session::get('id'))
                ->orderBy('order_id', 'desc')
                ->paginate(25);
            return view('admin.affilate.order_history_pagination', compact('orders'));
        }

    }

    public function teamSummary(){
        $data['main'] = 'Team Summary';
        $data['active'] = 'Team Summary';
        $user_id= Session::get('id');

        // order from  customer
        $customer_query=DB::table('users')->where('affiliate_id',$user_id);
        $data['total_customers']=$customer_query->count();
        $data['total_active_customers_order']=$customer_query->where('status',1)->count();
        $total_active_customer_ids=$customer_query->pluck('id');
        $data['affiliate_commision_from_customer']=$customer_query->where('status',1)->sum('affiliate_commision_from_customer');
        $data['customer_total_sells']=DB::table('order_data')->where('order_status','completed')->whereIn('customer_id',$total_active_customer_ids)->count();
        // end customer

        // first  level affiliate
        $first_level_affiliate_query=DB::table('users_public')->where('parent_id',$user_id);
        $data['total_first_level_affiliate']=  $first_level_affiliate_query->count();
        $data['total_first_level_affiliate_active']=  $first_level_affiliate_query->where('status',1)->count();
        $fist_level_affiliate_ids=  $first_level_affiliate_query->pluck('id');
        $total_first_level_affiliate_sells_query=DB::table('order_data')->where('order_status','completed')->whereIn('user_id',$fist_level_affiliate_ids);
        $data['total_first_level_affiliate_sells']=$total_first_level_affiliate_sells_query->count();

        // end first  level affiliate

        // second  level affiliate =======================

        $first_level_affiliate_query=DB::table('users_public')->where('parent_id',$user_id);
        $second_affiliates_ids=  $first_level_affiliate_query->pluck('id');
        $second_affiliate_query1=DB::table('users_public')->whereIn('parent_id',$second_affiliates_ids);
        $data['total_second_level_affiliate']=  $second_affiliate_query1->count();
        $second_level_affiliate_ids=  $second_affiliate_query1->pluck('id');
        $data['total_second_level_affiliate_active']=  $second_affiliate_query1->where('status',1)->count();
        $total_second_level_affiliate_sells_query=DB::table('order_data')->where('order_status','completed')->whereIn('user_id',$second_level_affiliate_ids);

        $data['total_second_level_affiliate_sells']=$total_second_level_affiliate_sells_query->count();


        // end second  level affiliate

        // third  level affiliate =======================

        $third_level_affiliate_query=DB::table('users_public')->whereIn('parent_id',$second_level_affiliate_ids);
        $data['total_third_level_affiliate']=  $third_level_affiliate_query->count();
        $third_level_affiliate_ids=  $third_level_affiliate_query->pluck('id');
        $data['total_third_level_affiliate_active']=  $third_level_affiliate_query->where('status',1)->count();
        $total_third_level_affiliate_sells_query=DB::table('order_data')->where('order_status','completed')->whereIn('user_id',$third_level_affiliate_ids);

        $data['total_third_level_affiliate_sells']=$total_third_level_affiliate_sells_query->count();

        // end third  level affiliate



        $data['user'] = DB::table('users_public')->select('income_of_lebel_1', 'income_of_lebel_2', 'income_of_lebel_3', 'income_of_lebel_4')->where('id', $user_id)->first();


        return view('admin.affilate.affiliate_team_summary', $data);

    }
    public function earnings(){
        $data['main'] = 'Affilate';
        $data['active'] = 'Earnings';
        // Session::get('user_id')
        $data['earning_history'] = DB::table('earning_history')
            ->where('earning_for_id',Session::get('id'))->orderBy('date', 'desc')->paginate(10);
        return view('admin.affilate.earnings', $data);

    }
    public  function  orderProductShow(Request $reauest){
        $order_id= $reauest->order_id;
        $product_permission_report=DB::table('product_permission_report')
            ->select('product_title','comission','feasured_image','folder')
            ->join('product','product.product_id','=','product_permission_report.product_id')
            ->where('order_id',$order_id)->get();
        return view('admin.affilate.orderProductShow',compact('product_permission_report','order_id'));

    }

    public  function  orderhistoryDetails($id){

        $wallet_blance= DB::table('users_public')->select('ewallet_balance')->where('id',Session::get('id'))->first();
        $data['wallet']= $wallet_blance->ewallet_balance;
        $data['orders']=DB::table('order_data')->where('order_id', $id)->first();
        return view('admin.affilate.order_details', $data);

    }

    public  function  orderhistoryDetailsStore(Request $request,$id){
        $amount=$request->amount;
        $wallet=$request->wallet;
        if($wallet < $amount){
            return redirect()->back()->with("error","Insufficent  wallet balance");
        }

        $wallet_blance= DB::table('users_public')->select('ewallet_balance')->where('id',Session::get('id'))->first();
        $befor_blance=$wallet_blance->ewallet_balance;
        $data['ewallet_balance']=$befor_blance-$amount;
        DB::table('users_public')->where('id',Session::get('id'))->update($data);
        $order=DB::table('order_data')->select('order_total','advabced_price')->where('order_id', $id)->first();
        $beforeAdvanded=$order->advabced_price;
        $beforeTotalOrder=$order->order_total;
        $row_data['advabced_price']=$beforeAdvanded+$amount;
        $row_data['order_total']=$beforeTotalOrder-$amount;
        DB::table('order_data')->where('order_id', $id)->update($row_data);
        $history['transaction_id']=$id;
        $history['amount']=$amount;
        $history['affiliate_id']=Session::get('id');
        $history['status']=1;
        $history['created_at']=date("y-m-d");
        DB::table('wallet_history')->insert($history);
        return redirect()->back()->with("success","Payment successfull");
    }







    public function withdraw(){
        $data['main'] = 'Affilate';
        $data['active'] = 'Withdraw';
        $data['user'] = DB::table('users_public')->where('id',Session::get('id'))->first();
        $data['mobile_row'] = DB::table('mobile_ac')->where('user_id',Session::get('id'))->first();
        $data['bank'] = DB::table('bank_ac')->where('user_id',Session::get('id'))->first();
        $data['withdraws'] = DB::table('withdraw_history')->where('from_user_id','=',Session::get('id'))->orderBy('id','desc')->paginate(10);
        return view('admin.affilate.withdraw', $data);

    }
    public function editmobile(){
        $data['main'] = 'Affilate';
        $data['active'] = 'Mobile edit';
// Session::get('user_id')
        $data['mobile_row'] = DB::table('mobile_ac')->where('user_id',Session::get('id'))->first();
        $data['bank_row'] = DB::table('bank_ac')->where('user_id',Session::get('id'))->first();


        return view('admin.affilate.mobile_account', $data);

    }
    public  function userMessage(){
        $data['main'] = 'User Message ';
        $data['active'] = 'User Message';
        $data['title'] = '';
        $data['messages'] =   DB::table('message_to_affilates')->where('affiliate_id',Session::get('id'))->get();
        return view('admin.affilate.userMessage', $data);

    }
    public  function messageSeen($id){

        DB::table('message_to_affilates')->where('id',$id)->update(['status'=>1]);

    }


    public function mobile_store(Request $request){

        $request->validate([
            'ac_number' => 'required||max:12|min:11',

        ]);

        $data['ac_name']=$request->ac_name;
        $data['ac_number']=$request->ac_number;
        // $data['ac_type']=$request->ac_type;
        $data['service_name']=$request->service_name;
        $data['user_id']=Session::get('id');
        $mobile_row = DB::table('mobile_ac')->where('user_id',Session::get('id'))->first();
        if($mobile_row){
            DB::table('mobile_ac')->where('user_id',Session::get('id'))->update($data);
        } else {

            DB::table('mobile_ac')->insert($data);

        }




        return redirect('editmobile')->with('success','Your Mobile Acount added successfully');



    }

    public function bank_update(Request $request){
        $data_banck['ac_name']=$request->ac_name;
        $data_banck['ac_number']=$request->ac_number;
        $data_banck['ac_branch']=$request->ac_branch;
        $data_banck['bank_name']=$request->bank_name;
        $data_banck['user_id']=Session::get('id');
        $bank_ac_row = DB::table('bank_ac')->where('user_id',Session::get('id'))->first();

        if($bank_ac_row){

            DB::table('bank_ac')->where('user_id',Session::get('id'))->update($data_banck);

        } else {

            DB::table('bank_ac')->insert($data_banck);

        }
        return redirect('editmobile')->with('banK_success','Your Bank Acount added successfully');


    }




    public function money_transfer(Request $request){
        $base_balances = DB::table('users_public')
            ->select('earning_balance','ewallet_balance')->where('id',Session::get('id'))
            ->first();
        $data_banck['status']=0;
        $data_banck['amount']=$request->amount;
        $data_banck['from_user_id']=Session::get('id');
        $data_banck['from_user_ac']=Session::get('email');
        $data_banck['date']=date("Y-m-d H:i:s");
        $base_balance = $base_balances->earning_balance;
        //dd($base_balance);

        //$base_balance=$request->base_balance;
        $amount=$request->amount;
        $payment_to=$request->payment_to;
        if($payment_to==1){
            $mobile_row = DB::table('mobile_ac')->where('user_id',Session::get('id'))->first();
            if($mobile_row) {
                if(strlen($mobile_row->ac_number) < 11){
                    return redirect('withdraw')->with('w_error','Please Add Valid Mobile Information');
                }

                $data_banck['account_number']=$mobile_row->ac_number;
                $data_banck['to_user_ac'] = $mobile_row->service_name;
                $data_banck['account']=$mobile_row->ac_name;
            } else {

                return redirect('withdraw')->with('w_error','Please Add Mobile Information');
            }
        } else if($payment_to==2){
            $bank_row = DB::table('bank_ac')->where('user_id',Session::get('id'))->first();
            if($bank_row) {
                $data_banck['account_number']=$bank_row->ac_number;
                $data_banck['account']=$bank_row->ac_name;
                $data_banck['to_user_ac'] =  $bank_row->bank_name . '-' . $bank_row->ac_branch ;
            } else {
                return redirect('withdraw')->with('w_error','Please Add Bank Information');
            }
        }
        else{

            $data_banck['to_user_ac'] ="Wallet Transfer";
            $data_banck['status']=1;
            if($amount <=499){
                return redirect('withdraw')->with('w_error','Minimum Withdraw is 500 Taka');
            }


            if($base_balance < $amount){
                return redirect('withdraw')->with('w_error','Your Main Blance is Low');
            } else {
                $data['earning_balance']=$base_balance-$amount;
                $data['ewallet_balance']=$base_balances->ewallet_balance+$amount;

                DB::table('withdraw_history')->insert($data_banck);
                DB::table('users_public')->where('id',Session::get('id'))->update($data);
                return redirect('withdraw')->with('w_success','Your  Blance is Transfer to Wallet  Successfully');

            }

        }

        if($base_balance < $amount){
            return redirect('withdraw')->with('w_error','Your Main Blance is Low');
        } elseif ($amount < 500){
            return redirect('withdraw')->with('w_error','Minimum withdrow blance 500 Taka');
        } else {
            $data['earning_balance']=$base_balance-$amount;
            DB::table('withdraw_history')->insert($data_banck);
            DB::table('users_public')->where('id',Session::get('id'))->update($data);
            return redirect('withdraw')->with('w_success','Withdraw  successfully wait for admin approved ');

        }
    }

    public function addWalletBalance(Request $request)
    {
        $data['transaction_id']=$request->transaction_id;
        $data['sender_number']=$request->sender_number;
        $data['created_at']=date("Y-m-d");
        $data['status']=0;
        $data['note']=$request->note;
        $data['amount']=$request->amount;
        $data['affiliate_id']=session::get('id');
        $result= DB::table('wallet_history')
            ->insert($data);
        if($result){
            return response()->json(['success'=>true]);
        } else {
            return response()->json(['success'=>false]);
        }
    }

    public function earnings_pagination(Request $request)
    {
        if ($request->ajax()) {

//            $query = $request->get('query');
//            $query = str_replace(" ", "%", $query);
            //$users = DB::table('users_public')->where('parent_id',Session::get('id'))->orderBy('id', 'desc')->paginate(15);

            $earning_history = DB::table('earning_history')->where('earning_for_id',Session::get('id'))->orderBy('date', 'desc')->paginate(10);

            return view('admin.affilate.earnings_pagination', compact('earning_history'));
        }

    }

    public function statistics()
    {

        $data['main'] = 'Statistics';
        $data['active'] = 'Statistics';
        $data['title'] = '  ';
        // Session::get('user_id')

        $data['level_1'] = 0;
        $data['level_2'] = 0;
        $data['level_3'] = 0;
        $data['level_4'] = 0;
        $data['level_5'] = 0;

        $data['level_11'] = 0;
        $data['level_21'] = 0;
        $data['level_31'] = 0;
        $data['level_41'] = 0;
        $data['level_51'] = 0;
        $data['total_income'] = 0;
        $puser=Session::get('id');
        $earningResults=$this->earning_history_by_id($puser);
        foreach ($earningResults as $earningResult){
            if($earningResult->earner_position==1){
                $data['level_11']+= $earningResult->amount;
            } elseif ($earningResult->earner_position==2){
                $data['level_21']+= $earningResult->amount;
            }
            elseif ($earningResult->earner_position==3){
                $data['level_31']+= $earningResult->amount;
            }
            elseif ($earningResult->earner_position==4){
                $data['level_41']+= $earningResult->amount;
            }
            else {
                $data['level_51']+= $earningResult->amount;
            }

        }
        $data['total_income'] = $data['level_11'] +
            $data['level_21'] +
            $data['level_31'] +
            $data['level_41'] +
            $data['level_51'] ;


        for ($i=0; $i < sizeof($this->getChild($puser)); $i++) {

            $data['level_1']+=1;
            for ($j=0; $j < sizeof($this->getChild($this->getChild($puser)[$i]->id)); $j++) {
                $data['level_2']+=1;
                for ($k=0; $k < sizeof($this->getChild($this->getChild($this->getChild($puser)[$i]->id)[$j]->id)); $k++) {
                    $data['level_3']+=1;
                    for ($l=0; $l < sizeof($this->getChild($this->getChild($this->getChild($this->getChild($puser)[$i]->id)[$j]->id)[$k]->id)); $l++) {
                        $data['level_4']+=1;
                        for ($m=0; $m < sizeof($this->getChild($this->getChild($this->getChild($this->getChild($this->getChild($puser)[$i]->id)[$j]->id)[$k]->id)[$l]->id)); $m++) {
                            $data['level_5']+=1;
                        }
                    }
                }
            }
        }



        return view('admin.affilate.statistics', $data);
    }

    public function getChild($parent_id){

        return $result = DB::table('users_public')->select('id')->where('parent_id', $parent_id)->get();

    }


    public function earning_history_by_id($id){



        return $result = DB::table('earning_history')->select('amount','earner_position')->where('earning_for_id', $id)->get();
    }

    public function dasboard_status_changed(){

        $session_id=Session::get('id');
        $data['dashboard_staus'] = 'type-1';
        DB::table('users_public')->where('id', $session_id)->update($data);

        return redirect('/dashboard')->with('success', 'You are successfully Entered to dashboard 1 !');

    }


    public function myreferrel()
    {

        // echo "jabbir";
        // exit();
        $session_id=Session::get('id');
        if ($session_id) {

            $data['main'] = 'My Referrals';
            $data['active'] = 'All Referrals';
            $data['title'] = '  ';
            $data['users'] = DB::table('users_public')
                ->Where('parent_id',Session::get('id'))
                ->orderBy('id', 'desc')->paginate(10);
            $data['totals'] = DB::table('users_public')->select('id')
                ->Where('referrer',Session::get('id'))
                ->Where('parent_id',Session::get('id'))
                ->count();
            return view('admin.affilate.myreferrel', $data);

        }


    }


    public function top_referrers()
    {

        $data['main'] = 'My Referrals';
        $data['active'] = 'All Referrals';
        $data['title'] = '  ';

        $data['users'] = DB::table('users_public')
            ->select(DB::raw('parent_id,name, count(parent_id) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('parent_id')
            ->paginate(15);


        return view('admin.affilate.top_referrers', $data);

    }

    public function top_earner(){
        // echo "string";
        $data['main'] = 'Top Earner';
        $data['active'] = 'Top Earner';
        $data['title'] = '  ';

        $data['users']=DB::table('users_public')
            ->select('id','name','life_time_earning')
            ->orderBy('life_time_earning', 'desc')
            ->paginate(13);

        //dd($data['users']);
        return view('admin.affilate.top_earner', $data);
    }




    public function topAffilites()
    {
        $data['main'] = 'Top Affiliates';
        $data['active'] = 'Top Affiliates';
        $data['users'] =  DB::table("order_data")
            ->select('user_id','name'
                ,DB::raw("count(order_data.user_id) as total"))
            ->join('users_public','users_public.id','=','order_data.user_id')
            ->where('order_status','completed')
            ->where('status','=',1)
            ->whereNotIn('user_id',[1,2])
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->paginate(20);
        $data['fund'] =  DB::table("royalty_fund")
            ->first();
        $data['position'] =DB::table("royalty_fund_commision")
            ->first();
        return view('admin.affilate.topAffilites', $data);
    }

    public function superOffer()
    {
        $data['main'] = 'Supper Offer';
        $data['active'] = 'Supper Offer';
        $data['title'] = '';
        $data['account']=DB::table('super_offer')
            ->where('user_id',Session::get('id'))
            ->orderBy('super_offer_id','desc')
            ->first();
        return view('admin.affilate.superOffer', $data);
    }
    public  function storeSuperOffer(Request $request){

        $data['user_id']=Session::get('id');
        $data['amount']=$request->amount;
        $data['sender_number']=$request->sender_number;
        $data['transaction_id']=$request->transaction_id;
        $data['acount_type']=$request->acount_type;
        $data['status']=0;
        $data['created_at']=date('Y-m-d');
        $result=DB::table('super_offer')->insert($data);
        if($result){
            return redirect('/user/affilite/supper')->with('success', 'Your Registration has been successfully wait for admin approved');


        } else {

        }
    }
    public function referral_contest()
    {
        $data['main'] = 'My Referrals';
        $data['active'] = 'All Referrals';
        $data['title'] = '  ';
        $data['from']= get_option('contest_first_date');
        $to=get_option('contest_last_date');
        $data['to']=get_option('contest_last_date');

        $data['contest_fund']=DB::table("contest_fund")
            ->sum('amount');
        $data['position']=DB::table("context_found_commision")->first();
        $data['sponsor']=DB::table("sponsors")->first();


        $data['contests']=DB::table("leadership_contest")
            ->orderBy('total_point', 'desc')
            ->whereNotIn('affilite_id', [1,2])
            ->paginate(20);

        return view('admin.affilate.referral_contest', $data);
    }

    public function myreferrel_pagination(Request $request)
    {
        $session_id=Session::get('id');
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $users = DB::table('users_public')
                ->Where('parent_id',Session::get('id'))
                ->where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(10);
            return view('admin.affilate.myreferrel_pagination', compact('users'));
        }
    }



    public function orderEditHistory($id)
    {
        $data['orders'] = DB::table('order_edit_track')
            ->where('order_id', $id)
            ->orderBy('order_edit_track_id', 'desc')
            ->get();
        return view('admin.affilate.orderEditHistory', $data);

    }



    public function orderForCustomer()
    {

        $data['main'] = 'Order For Customer';
        $data['active'] = 'Order For Customer';
        $data['products'] = DB::table('product')
            ->where('status',1)
            ->where('vendor_id','=',0)
            ->where('product_stock', '>', 0)
            ->orderBy('top_deal', 'desc')
            ->paginate(18);
        $data['categories'] = DB::table('category')->orderBy('category_id', 'ASC')->get();
        return view('admin.affilate.orderForCustomer', $data);
    }





    public function affiliateComplain(){
        $affiliate_id=Session::get('id');
        $complains= DB::table('complain')
            ->where('affiliate_id',$affiliate_id)
            ->orderBy('complain_id', 'desc')
            ->paginate(10);
        return view('admin.affilate.affiliateComplain', compact('complains'));
    }


    public function complainStore(Request $request){
        $affiliate_id=Session::get('id');
        $data['affiliate_complain']=$request->affiliate_complain;
        $data['affiliate_id']=$affiliate_id;
        $data['created_at']=date("Y-m-d");
        $data['status']="Pending";
        $complains= DB::table('complain')->insert($data);
        return redirect( )->back()->with('success','Your Complain Submited successfully');
    }


    public function orderForCustomer_pagination(Request $request){
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->where('status',1)
                ->where('vendor_id','=',0)
                ->where('product_stock', '>', 0)
                ->where('product_title', 'LIKE', '%' . $query . '%')
                ->orderBy('top_deal', 'desc')
                ->paginate(18);
            return view('admin.affilate.orderForCustomer_pagination', compact('products'));
        }
    }


    public function order_for_customer_pagination_category(Request $request){

        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $products = DB::table('product')
                ->join('product_category_relation','product_category_relation.product_id','=','product.product_id')
                ->where('status','=',1)
                ->where('product_category_relation.category_id',$query)
                ->orderBy('product_category_relation.product_id', 'desc')
                ->paginate(10);
            return view('admin.affilate.orderForCustomer_pagination', compact('products'));
        }
    }




    public function pay_point_to_admin(){
        $affilite_id= Session::get('id');
        $points_balance= DB::table('users_public')->where('id',$affilite_id)->sum('users_public.shopping_point');
        if($points_balance < 100){
            echo "Insufficent Point Blance Please Shopping At least 100 Point";
        } else {

            $data['shopping_point']=$points_balance-100;
            $row_data['user_id']=$affilite_id;
            $row_data['point']=100;
            $affilite_commission_lavel['commision']=15;
            $affilite_commission_lavel['user_id']=$affilite_id;
            $affilite_commission_lavel['lavel']=2;


            $points_balance= DB::table('users_public')->where('id',$affilite_id)->update($data);
            DB::table('point_pay')->insert($row_data);
            DB::table('affilite_commission_lavel')->insert($affilite_commission_lavel);
            echo 'ok';

        }
    }


    public function upgrade_2(){

        $affilite_id= Session::get('id');
        $row_data['active']=1;

        $affilite_commission_lavel= DB::table('affilite_commission_lavel')->where('user_id',$affilite_id)->update($row_data);
        if($affilite_commission_lavel){

            echo 'ok';

        }
    }

    public function upgrade_3(){

        $affilite_id= Session::get('id');
        $row_data['active']=1;

        $affilite_commission_lavel= DB::table('affilite_commission_lavel')->where('user_id',$affilite_id)->update($row_data);
        if($affilite_commission_lavel){

            echo 'ok';

        }
    }



    public function pay_point_to_admin_in_lavel_3(){

        $affilite_id= Session::get('id');
        $points_balance= DB::table('users_public')->where('id',$affilite_id)->sum('users_public.shopping_point');
        if($points_balance < 100){
            echo "Insufficent Point Blance Please Shopping At least 100 Point";
        } else {

            $data['shopping_point']=$points_balance-100;
            $row_data['user_id']=$affilite_id;
            $row_data['point']=100;
            $affilite_commission_lavel['commision']=20;
            $affilite_commission_lavel['user_id']=$affilite_id;
            $affilite_commission_lavel['lavel']=3;

            $points_balance= DB::table('users_public')->where('id',$affilite_id)->update($data);
            DB::table('point_pay')->insert($row_data);
            DB::table('affilite_commission_lavel')->insert($affilite_commission_lavel);
            echo 'ok';

        }
    }





    public function logout()
    {
        Session::put('id', '');
        $url = URL::current();
        return redirect('/')->with('success', 'You are successfully Logout !')->with('current', $url);;
    }

    public function super_offer_save(Request $request){

        $affilite_id= Session::get('id');
        $data['user_id']=$affilite_id;
        $data['amount']=10;
        $data['created_at']=date('Y-m-d');
        $insert_result  =DB::table('super_offer')->insert($data);
        if($insert_result){
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    public  function chat(){
        $data['main'] = 'chat ';
        $data['active'] = 'chat ';
        $from_user =Session::get('id');
        $data['admin_id'] =Session::get('id');
        DB::table('messages')
            ->where('messages.affiliate_id',$from_user)
            ->update(['is_read'=>1]);
        $data['messages']=DB::table('messages')
            ->select('*')
            ->where('messages.affiliate_id',$from_user)
            ->get();
        return view('admin.affilate.affilite_chat', $data);

    }

    public  function customers(){
        $data['main'] = 'Customers ';
        $data['active'] = 'Customers ';
        $from_user =Session::get('id');
        $data['customers'] = DB::table('users')
            ->where('affiliate_id',$from_user)
            ->orderBy('id','desc')
            ->paginate(10);
        return view('admin.affilate.customers', $data);
    }
    public  function getchat(){

        $from_user =Session::get('id');
        $data['admin_id'] =Session::get('id');
        $data['messages']=DB::table('messages')
            ->select('*')
            ->where('messages.affiliate_id',$from_user)
            ->get();

        return view('admin.affilate.affilite_chat_message', $data);
    }
    public  function contestResult($status){
        $data['status']=$status;
        return view('admin.affilate.contestResult',$data);
    }


    public  function user_chat_count(){

        $from_user =Session::get('id');

        $count=DB::table('messages')
            ->where('messages.affiliate_id',$from_user)
            ->where('messages.is_read','=',0)
            ->count();

        return $count;
    }

    public function sendChatMessage(Request $request)
    {
        $from =Session::get('id');
        date_default_timezone_set('Asia/Dhaka');

        $message = $request->message;
        $admin_user= DB::table('messages')->select('admin_id')->where('affiliate_id',$from)->first();
        if($admin_user){
            $admin_user=$admin_user->admin_id;
        } else {
            $admin_user='';
        }
        $to = $admin_user;

        $data['affiliate_id'] = $from;
        $data['admin_id'] = $to;
        $data['message'] = $message;
        $data['is_read']  = 0; // message will be unread when sending message
        $data['message_status']  = 0; // message will be unread when sending message
        $data['created_at']  = date("Y-m-d H:i:s"); // message will be unread when sending message

        DB::table('messages')->insert($data);

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);

    }

}

