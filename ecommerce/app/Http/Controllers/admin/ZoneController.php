<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zone;
use DB;

class ZoneController extends Controller
{
    public function index()
    { 
        $data['main'] = 'Zone';
        $data['active'] = 'All Zone';
        $data['title'] = '  '; 
        $data['zones']= Zone::orderBY('id','desc')->get();
        return view('admin.zone.index',$data);
    } 
     
    public function create()
    { 
        $data['main'] = 'Categories';
        $data['active'] = 'All Categories';
        $data['title'] = '  ';
      
        return view('admin.zone.create', $data); 
    }
 
    public function store(Request $request)
    {
       
        $result = Zone::create($request->all());
  
        if ($result) {
            return redirect('admin/zone')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/zone')
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
         

        $data['zone']=Zone::where('id',$id)->first();
        $data['main'] = 'Zone';
        $data['active'] = 'Update Zone';
        $data['title'] = 'Update Zone Information';        
        return view('admin.zone.edit', $data);
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
        
        $result=  Zone::find($id)->update($request->all());

        if ($result) {
            return redirect('admin/shop')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/shop')
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
            return redirect('admin/categories')
                ->with('success', 'Deleted successfully.');
        } else {
            return redirect('admin/categories')
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
