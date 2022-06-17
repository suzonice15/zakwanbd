<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use URL;

class EducationController extends Controller
{
    public  function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set("Asia/Dhaka");
    }

    public function index()
    {
        $status=Session::get('status');
        if ($status=='super-admin') {
            $user_id=5;
            $url=  URL::current();

            if($user_id < 1){
                //  return redirect('admin');
                Redirect::to('admin')->with('redirect',$url)->send();

            }

            $data['main'] = 'Education';
            $data['active'] = 'All Education Details';
            $data['title'] = '  ';
            $data['educations']=DB::table('education')->orderBy('id','desc')->get();
            return view('admin.Education.index', $data);  
        }else{
            return view('login');
        }
        
    }
    public function create()
    {
        $status=Session::get('status');
        if ($status=='super-admin') {
            $user_id=5;
            $url=  URL::current();

            if($user_id < 1){
                //  return redirect('admin');
                Redirect::to('admin')->with('redirect',$url)->send();

            }

            $data['main'] = 'Education';
            $data['active'] = 'Add Education';
            $data['title'] = '';
            return view('admin.Education.create', $data); 
        }else{
            return view('login');
        }   
    }
    public function store(Request $request)
    {
        $data['education_type'] = $request->education_type;
        $data['education_details'] = $request->education_details;
        $data['created_time'] = date('Y-m-d h:i:s');
        $result = DB::table('education')->insert($data);
        if ($result) {
            return redirect('admin/education-list')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/education-list')
                ->with('error', 'No successfully.');
        }
    }
    public  function education_active($id){
        $data['status']=0;
        $status = DB::table('education')
            ->where('id', $id)
            ->update($data);
        if($status){
            return back()->with('success','Updated successfully');
        }else {
            return back()->with('success','Updated successfully');
        }
    }
    public  function education_inactive($id){
        $data['status']=1;
        $status = DB::table('education')
            ->where('id', $id)
            ->update($data);
        if($status){
            return back()->with('success','Updated successfully');
        }else {
            return back()->with('success','Updated successfully');
        }
    }
    public function delete($id)
    {
        $result=DB::table('education')->where('id',$id)->delete();
        if ($result) {
            return redirect('admin/education-list')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/education-list')
                ->with('error', 'No successfully.');
        }
    }
    public function edit($id)
    {
        $data['education']=DB::table('education')->where('id',$id)->first();

        $data['main'] = 'Education';
        $data['active'] = 'Update Education';
        $data['title'] = 'Update Education Registration Form';
        return view('admin.Education.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $data['education_type'] = $request->education_type;
        $data['education_details'] = $request->education_details;
        $result= DB::table('education')->where('id',$id)->update($data);
        if ($result) {
            return redirect('admin/education-list')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/education-list')
                ->with('error', 'No successfully.');
        }
    }
    public function font_education(){

        $educations = DB::table('education')->where('status',1)->orderBy('id','desc')->get();
        return view('admin.Education.font_view',compact('educations'));
    }
}
