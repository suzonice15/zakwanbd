<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use AdminHelper;
use URL;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();
        if($user_id < 1){        
            Redirect::to('admin')->with('redirect',$url)->send();
        }
        $data['main'] = 'Sliders';
        $data['active'] = 'All Sliders';
        $data['title'] = '  ';
        $data['sliders']=DB::table('homeslider')->orderBy('modified_time','desc')->get();
        return view('admin.slider.index', $data);
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

        $data['main'] = 'Sliders';
        $data['active'] = 'Add Slider';
        $data['title'] = 'User registration form';
        return view('admin.slider.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['homeslider_title'] = $request->homeslider_title;
        $data['target_url'] = $request->target_url;
        $data['status'] = $request->status;

        $data['created_time'] = date('Y-m-d');
        $data['modified_time'] = date('Y-m-d');
        $image = $request->file('slider_picture');
        if ($image) {

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/sliders');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->save($destinationPath . '/' . $image_name);


            $data['homeslider_picture'] = $image_name;
        }


        $result = DB::table('homeslider')->insert($data);
        if ($result) {
            return redirect('admin/sliders')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/sliders')
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
        $data['slider']=DB::table('homeslider')->where('homeslider_id',$id)->first();

        $data['main'] = 'Sliders';
        $data['active'] = 'Update Sliders';
        $data['title'] = 'Update Sliders Registration Form';
        return view('admin.slider.edit', $data);
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

        $data['homeslider_title'] = $request->homeslider_title;
        $data['target_url'] = $request->target_url;
        $data['status'] = $request->status;
        $data['modified_time'] = date('Y-m-d');
        $image = $request->file('slider_picture');
        $old_picture= public_path('/uploads/sliders').'/'.$request->old_picture;

        if($image) {
            if(file_exists($old_picture)){

                unlink($old_picture);
            }
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/sliders');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->save($destinationPath . '/' . $image_name);
            $data['homeslider_picture']=$image_name;
        }
        $result= DB::table('homeslider')->where('homeslider_id',$id)->update($data);
        if ($result) {
            return redirect('admin/sliders')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/sliders')
                ->with('error', 'No successfully.');
        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result=DB::table('homeslider')->where('homeslider_id',$id)->delete();
        if ($result) {
            return redirect('admin/sliders')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/sliders')
                ->with('error', 'No successfully.');
        }
    }
}
