<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use  Session;
use Image;
//use AdminHelper;
use URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;

class SettingController extends Controller
{
    public  function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set("Asia/Dhaka");
    }
    public function homePageSetting(Request $request)
    {
        $user_id =5;// AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }

//unset($request->_token);
        $all_home_page_data = $request->all();
        if ($all_home_page_data) {
            Arr::forget($all_home_page_data, '_token');
            foreach ($all_home_page_data as $key => $val) {
                $data['option_name'] = $key;
                $data['option_value'] = $val;
                $single_result = DB::table('affilate_options')->select('option_name')->where('option_name', $key)->get();
                if (count($single_result) > 0) {
                    DB::table('affilate_options')->where('option_name', $key)->update($data);
                } else {
                    DB::table('affilate_options')->insert($data);
                }
            }
        }
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        return view('admin.setting.home_page_setting', $data);
    }




    public function sponsor()
    {
         
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        $data['sponsor'] = DB::table('sponsors')->first();
        return view('admin.setting.sponsors', $data);

       

    }

    public function sponsorUpdate(Request $request)
    {
        $data['sponsor_1']=$request->sponsor_1;
        $data['sponsor_2']=$request->sponsor_2;
        $data['sponsor_3']=$request->sponsor_3;
        $data['sponsor_4']=$request->sponsor_4;
        $data['sponsor_5']=$request->sponsor_5;
        $data['sponsor_6']=$request->sponsor_6;
        $data['sponsor_7']=$request->sponsor_7;
        $data['sponsor_add']=$request->sponsor_add;
        DB::table('sponsors')->update($data);
       return   redirect('/admin/sponsor');
    }



    public function defaultSetting(Request $request)
    {
        $user_id =5;// AdminHelper::Admin_user_autherntication();
      
        $all_home_page_data = $request->all();
        if ($all_home_page_data) {
            Arr::forget($all_home_page_data, '_token');
            foreach ($all_home_page_data as $key => $val) {
                $data['option_name'] = $key;
                $data['option_value'] = $val;
                $single_result = DB::table('affilate_options')->select('option_name')->where('option_name', $key)->get();
                if (count($single_result) > 0) {
                    DB::table('affilate_options')->where('option_name', $key)->update($data);
                } else {
                    DB::table('affilate_options')->insert($data);
                }
            }
        }
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        $redirect=$request->redirect;
        if($redirect=="contest"){
            return redirect()->back();
        }


        return view('admin.setting.deafualt_setting', $data);

    }

    public function registerOffer(){
        $registerInfo=DB::table('register_offer')
                            ->where('id',1)
                            ->first();
        return view('admin.setting.registerOffer',compact('registerInfo'));
    }

    public function bonusOffer(){
        $bonusInfo=DB::table('bonus_offer')
                            ->where('id',1)
                            ->first();
        return view('admin.setting.bonusOffer',compact('bonusInfo'));
    }

    public function cashbackOffer(){
        $bonusInfo=DB::table('cashback_offer')
                            ->where('id',1)
                            ->first();
        return view('admin.setting.cashbackOffer',compact('bonusInfo'));
    }

    public function socialSetting(Request $request)
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();
        }
//unset($request->_token);
        $all_home_page_data = $request->all();
        if ($all_home_page_data) {
            Arr::forget($all_home_page_data, '_token');
            foreach ($all_home_page_data as $key => $val) {
                $data['option_name'] = $key;
                $data['option_value'] = $val;
                $single_result = DB::table('affilate_options')->select('option_name')->where('option_name', $key)->get();
                if (count($single_result) > 0) {
                    DB::table('affilate_options')->where('option_name', $key)->update($data);
                } else {
                    DB::table('affilate_options')->insert($data);
                }
            }
        }
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        return view('admin.setting.social_media_setting', $data);
}


public function registerOfferSubmit(Request $request){
    $data=array();
    $data['user_amount']=$request->user_amount;
    $data['referrer_amount']=$request->referrer_amount;
    $data['status']=$request->status;
    $update=DB::table('register_offer')
                    ->where('id',1)
                    ->update($data);    
       return redirect()->back();
  

}

public function bonusOfferSubmit(Request $request){
    $data=array();
    $data['offer']=$request->offer;
    $data['status']=$request->status;
    $update=DB::table('bonus_offer')
                    ->where('id',1)
                    ->update($data);    
       return redirect()->back(); 

}

public function cashbackOfferSubmit(Request $request){
    $data=array();
    $data['offer']=$request->offer;
    $data['status']=$request->status;
    $update=DB::table('cashback_offer')
                    ->where('id',1)
                    ->update($data);    
       return redirect()->back(); 

}



}
