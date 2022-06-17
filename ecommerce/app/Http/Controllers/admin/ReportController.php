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

class ReportController extends Controller
{


    public  function __construct()
    {
        $this->middleware('Admin');
    }

     

    public function order_report()
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
              Redirect::to('admin')->with('redirect',$url)->send();

        }

        $data['main'] = 'Reports';
        $data['active'] = 'All Reports';
        $data['title'] = '  ';
       // $data['users']=DB::table('category')->orderBy('cateo','desc')->get();
      //  return view('admin.user.index', $data);
        $today=date('Y-m-d');
       $data['reports']= DB::table('order_data')->where('order_date',$today)->orderBy('order_id', 'desc')->get();
       $data['orders']= DB::table('order_data')->where('order_date',$today)->orderBy('order_id', 'desc')->paginate(10);
        return view('admin.report.order_report',$data);
    }

    public function limited_product()
    {
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $data['main'] = 'Limited Products';
        $data['active'] = 'Limited Products';
        $data['title'] = '';         
     
        $data['products']= DB::table('product')->where('product_stock','=',0)->orderBy('product_id', 'desc')->get();
         return view('admin.report.stock_product',$data);
    }




    public function order_report_by_ajax(Request $request){


        if($request->ajax())
        {

            $order_status=$request->order_status;
            $date_from=$request->date_from;
            $date_to=$request->date_to;
            if($order_status) {


                $data['reports'] = DB::table('order_data')->where('order_status', $order_status)->orderBy('order_id', 'desc')->get();
                $data['orders'] = DB::table('order_data')->where('order_status', $order_status)->orderBy('order_id', 'desc')->get();
            } else if($order_status and $date_to){
                $to=date('Y-m-d',strtotime($date_to));
                $from=date('Y-m-d',strtotime($date_from));
                $data['reports'] = DB::table('order_data')->where('order_status', $order_status)->whereBetween('order_date', [$from, $to])->orderBy('order_id', 'desc')->get();
                $data['orders'] = DB::table('order_data')->where('order_status', $order_status)->whereBetween('order_date', [$from, $to])->orderBy('order_id', 'desc')->get();

            } else {
                $to=date('Y-m-d',strtotime($date_to));
                $from=date('Y-m-d',strtotime($date_from));
                $data['reports'] = DB::table('order_data')->whereBetween('order_date', [$from, $to])->orderBy('order_id', 'desc')->get();
                $data['orders'] = DB::table('order_data')->whereBetween('order_date', [$from, $to])->orderBy('order_id', 'desc')->get();

            }
            $view = view('admin.report.order_report_by_ajax',$data)->render();

            return response()->json(['html'=>$view]);
        }
        // $today=order_status;
           }

    public  function  fetch_data(Request $request){
        if($request->ajax())
        {

            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $Reports = DB::table('category')
                ->orWhere('category_title', 'like', '%'.$query.'%')->paginate(10);
            return view('admin.category.pagination', compact('Reports'));
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

        $data['main'] = 'Reports';
        $data['active'] = 'All Reports';
        $data['title'] = '  ';
        $data['Reports']=DB::table('category')->orderBy('category_title','ASC')->get();
        return view('admin.category.create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['category_title']=$request->category_title;
        $data['category_name']=$request->category_name;
        $data['parent_id']=$request->parent_id;
        $data['rank_order']=$request->rank_order;
        $data['status']=$request->status;
        $data['seo_title']=$request->seo_title;
        $data['seo_meta_title']=$request->seo_meta_title;
        $data['seo_keywords']=$request->seo_keywords;
        $data['seo_content']=$request->seo_content;
        $data['seo_meta_content']=$request->seo_meta_content;

        $image = $request->file('featured_image');
        if ($image) {

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/category');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($destinationPath . '/' . $image_name);
            $data['medium_banner']=$image_name;

        }


            $data['registered_date']=date('Y-m-d');
        $result =DB::table('category')->insert($data);
        if ($result) {
            return redirect('admin/Reports')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/Reports')
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
        $user_id=AdminHelper::Admin_user_autherntication();
        $url=  URL::current();

        if($user_id < 1){
            //  return redirect('admin');
            Redirect::to('admin')->with('redirect',$url)->send();

        }

        $data['category']=DB::table('category')->where('category_id',$id)->first();
        $data['main'] = 'Users';
        $data['active'] = 'Update user';
        $data['title'] = 'Update User Registration Form';
        $data['Reports']=DB::table('category')->orderBy('category_title','ASC')->get();
        return view('admin.category.edit', $data);
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
        $data['category_title']=$request->category_title;
        $data['category_name']=$request->category_name;
        $data['parent_id']=$request->parent_id;
        $data['rank_order']=$request->rank_order;
        $data['status']=$request->status;
        $data['seo_title']=$request->seo_title;
        $data['seo_meta_title']=$request->seo_meta_title;
        $data['seo_keywords']=$request->seo_keywords;
        $data['seo_content']=$request->seo_content;
        $data['seo_meta_content']=$request->seo_meta_content;

        $data['registered_date']=date('Y-m-d');

        $image = $request->file('featured_image');
        if ($image) {

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/category');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(200, 200, function ($constraint) {

            })->save($destinationPath . '/' . $image_name);
            $data['medium_banner']=$image_name;

        }

        $result= DB::table('category')->where('category_id',$id)->update($data);
        if ($result) {
            return redirect('admin/Reports')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/Reports')
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

        $result=DB::table('category')->where('category_id',$id)->delete();
        if ($result) {
            return redirect('admin/Reports')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/Reports')
                ->with('error', 'No successfully.');
        }

    }
    public function destroy($id)
    {
        //
    }
    public  function  urlCheck(Request $request){
        $category_name = $request->get('url');
      $result= DB::table('category')->where('category_name',$category_name)->first();
        if($result){
            echo 'This category exit';
        } else {
            echo '';
        }


    }


}
