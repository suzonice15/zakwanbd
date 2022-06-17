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
use Illuminate\Support\Arr;

class SettingController extends Controller
{

    public  function __construct()
    {
        $this->middleware('Admin');
    }
    public function homePageSetting(Request $request)
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


                $single_result = DB::table('options')->select('option_name')->where('option_name', $key)->get();

                if (count($single_result) > 0) {
                    DB::table('options')->where('option_name', $key)->update($data);


                } else {
                    DB::table('options')->insert($data);


                }
            }
        }
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        return view('admin.setting.home_page_setting', $data);

    }

    public function defaultSetting(Request $request)
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


                $single_result = DB::table('options')->select('option_name')->where('option_name', $key)->get();

                if (count($single_result) > 0) {
                    DB::table('options')->where('option_name', $key)->update($data);


                } else {
                    DB::table('options')->insert($data);

                }
            }
        }
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        return view('admin.setting.deafualt_setting', $data);

    }



    public function CoinCreate(Request $request)
    {



        if ($request->isMethod('post')) {
            $data['coin_link']=$request->coin_link;
            $data['coin_description']=$request->coin_description;
            $data['coin_title']=$request->coin_title;


            $image = $request->file('coin_icon');
            if ($image) {

                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/category');
                $resize_image = Image::make($image->getRealPath());
                $resize_image->save($destinationPath . '/' . $image_name);
                $data['coin_icon']=$image_name;

            }
            DB::table('coin_list')->insert($data);
            return redirect('/admin/coin/setting');
        }

        $data['coins']=DB::table('coin_list')->get();
        $data['main'] = 'Coin Setting';
        $data['active'] = 'Update Coin Setting';
        $data['title'] = '  ';


        return view('admin.setting.coin.create', $data);

    }


    public function CoinEdit(Request $request,$id)
    {

        if ($request->isMethod('post')) {
            $data['coin_link']=$request->coin_link;
            $data['coin_description']=$request->coin_description;
            $data['coin_title']=$request->coin_title;
            // $data['coin_icon']=$request->coin_icon;

            $image = $request->file('coin_icon');
            if ($image) {
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/category');
                $resize_image = Image::make($image->getRealPath());
                $resize_image->save($destinationPath . '/' . $image_name);
                $data['coin_icon']=$image_name;
            }
            
            DB::table('coin_list')->where('id',$id)->update($data);
            return redirect('/admin/coin/setting');
        }

        $data['coin']=DB::table('coin_list')->where('id',$id)->first();
        $data['main'] = 'Mission';
        $data['active'] = 'Update Mission Setting';
        $data['title'] = '';
        return view('admin.setting.coin.edit', $data);

    }
    public function CoinSetting(Request $request)
    {
        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();
        if ($user_id < 1) {

            Redirect::to('admin')->with('redirect', $url)->send();

        }


        if ($request->isMethod('post')) {
            
            
            $data['coin_link']=$request->coin_link;
            $data['coin_description']=$request->coin_description;
            $data['coin_title']=$request->coin_title;
           // $data['coin_icon']=$request->coin_icon;
            DB::table('coin_list')->where('id',$request->id)->update($data);
        }

        $data['coins']=DB::table('coin_list')->orderBy('id','desc')->get();
        $data['main'] = 'Coin Setting';
        $data['active'] = 'Update Coin Setting';
        $data['title'] = '  ';
       

        return view('admin.setting.coin.index', $data);

    }



    public function mailSetting(){

        $user_id = AdminHelper::Admin_user_autherntication();
        $url = URL::current();

        if ($user_id < 1) {
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect', $url)->send();

        }

        $mailInfo=DB::table('smtp')
                        ->first();
        return view('admin.setting.mailSetting',compact('mailInfo'));
    }
    public function smtpAdd(Request $request){

        $id=$request->id;
        $data=array();
        $data['driver']=$request->driver;
        $data['host']=$request->host;
        $data['port']=$request->port;
        $data['username']=$request->username;
        $data['password']=$request->password;
        $data['encryption']=$request->encryption;
        DB::table('smtp')
            ->where('id',$id)
            ->update($data);
        return redirect()->back();
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


                $single_result = DB::table('options')->select('option_name')->where('option_name', $key)->get();

                if (count($single_result) > 0) {
                    DB::table('options')->where('option_name', $key)->update($data);


                } else {
                    DB::table('options')->insert($data);

                }
            }
        }
        $data['main'] = 'Setting';
        $data['active'] = 'Update Setting';
        $data['title'] = '  ';
        return view('admin.setting.social_media_setting', $data);


}



}
