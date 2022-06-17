<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use AdminHelper;
use URL;

class PageController extends Controller
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
        $data['main'] = 'Pages';
        $data['active'] = 'All Pages';
        $data['title'] = '  ';
        $data['pages']=DB::table('page')->orderBy('page_id','desc')->get();
        return view('admin.page.index', $data);
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

        $data['main'] = 'Pages';
        $data['active'] = 'Add Slider';
        $data['title'] = 'User registration form';
        return view('admin.page.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['page_content'] = $request->page_content;
        $data['page_name'] = $request->page_name;
        $data['page_link'] = $request->page_link;
        $data['created_time'] = date('Y-m-d h:i:s');
        $result = DB::table('page')->insert($data);
        if ($result) {
            return redirect('admin/pages')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/pages')
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
        $data['page']=DB::table('page')->where('page_id',$id)->first();

        $data['main'] = 'Pages';
        $data['active'] = 'Update Pages';
        $data['title'] = 'Update Pages Registration Form';
        return view('admin.page.edit', $data);
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

        $data['page_content'] = $request->page_content;
        $data['page_name'] = $request->page_name;
        $data['page_link'] = $request->page_link;

        $result= DB::table('page')->where('page_id',$id)->update($data);
        if ($result) {
            return redirect('admin/pages')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/pages')
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
        $result=DB::table('page')->where('page_id',$id)->delete();
        if ($result) {
            return redirect('admin/pages')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/pages')
                ->with('error', 'No successfully.');
        }
    }
}
