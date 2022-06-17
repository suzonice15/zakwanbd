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

class CourierController extends Controller
{
    public  function __construct()
    {
        $this->middleware('Admin');
    }
    public function index()
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $data['main'] = 'Couriers';
        $data['active'] = 'All Courier';
        $data['title'] = '  ';
        // $data['users']=DB::table('category')->orderBy('cateo','desc')->get();
        //  return view('admin.user.index', $data);
        $couriers= DB::table('courier')->orderBy('courier_id', 'desc')->get();
        return view('admin.courier.index', compact('couriers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $data['main'] = 'Couriers';
        $data['active'] = 'New Courier';
        $data['title'] = '  ';

        return view('admin.courier.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['courier_name']=$request->courier_name;
        $data['courier_status']=$request->courier_status;
        $data['created_time']=date('Y-m-d h:i:s');


        $result= DB::table('courier')->insert($data);
        if ($result) {
            return redirect('admin/couriers')
                ->with('success', 'Added successfully.');
        } else {
            return redirect('admin/couriers')
                ->with('error', 'No successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['courier']=DB::table('courier')->where('courier_id',$id)->first();
        $data['main'] = 'Couriers';
        $data['active'] = 'Update Courier';
        $data['title'] = 'Update courier Registration Form';

        return view('admin.courier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['courier_name']=$request->courier_name;
        $data['courier_status']=$request->courier_status;
        $data['active']=$request->active;
        $data['created_time']=date('Y-m-d h:i:s');


        $result= DB::table('courier')->where('courier_id',$id)->update($data);
        if ($result) {
            return redirect('admin/couriers')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/couriers')
                ->with('error', 'No successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $result=DB::table('courier')->where('courier_id',$id)->delete();
        if ($result) {
            return redirect('admin/couriers')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/couriers')
                ->with('error', 'No successfully.');
        }
    }
}
