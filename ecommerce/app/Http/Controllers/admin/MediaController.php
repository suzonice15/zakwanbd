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

class MediaController extends Controller
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
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $data['main'] = 'Media';
        $data['active'] = 'All Media';
        $data['title'] = '  ';
        $medias= DB::table('media')->orderBy('media_id', 'desc')->paginate(10);
        return view('admin.media.index', compact('medias'),$data);
    }
    public  function  pagination(Request $request){
        if($request->ajax())
        {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
           $medias= DB::table('media')->Where('product_code','LIKE','%'.$query.'%')
                ->orWhere('media_title', 'like', '%'.$query.'%')->orderBy('media_id', 'desc')->paginate(10);
           // $medias= DB::table('media')->Where('product_code',$query)
           //   ->paginate(10);
            return view('admin.media.pagination', compact('medias'));
        }

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

        $data['main'] = 'Media';
        $data['active'] = 'All media';
        $data['title'] = '  ';

        return view('admin.media.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $orginalpath=public_path().'/uploads/';
        $data['media_title']=$request->media_title;
        $media_path_orgianal = $request->file('media_path');
        if($media_path_orgianal) {

            $media_image = $media_path_orgianal->getClientOriginalName();
            $destinationPath = $orginalpath;
            $resize_image = Image::make($media_path_orgianal->getRealPath());
            $resize_image->save($destinationPath . '/' . $media_image);


            $data['media_path']="uploads".'/'.$media_image;

            $data['created_time']=date('Y-m-d H:i:s');
            $data['modified_time']=date('Y-m-d H:i:s');

            $result= DB::table('media')->insert($data);
            if ($result) {
                return redirect('admin/media')
                    ->with('success', 'created successfully.');
            } else {
                return redirect('admin/media')
                    ->with('error', 'No successfully.');
            }



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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $result=DB::table('media')->where('media_id',$id)->delete();
        if ($result) {
            return redirect('admin/media')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/media')
                ->with('error', 'No successfully.');
        }

    }
}
