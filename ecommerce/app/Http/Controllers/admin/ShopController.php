<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Zone;
use DB;

class ShopController extends Controller
{
    public function index()
    { 
        $data['main'] = 'Shop';
        $data['active'] = 'All shop';
        $data['title'] = '  ';    
        $data['shops'] =Shop::latest()->get();   
        return view('admin.shop.index',$data);
    } 
     
    public function create()
    { 
        $data['main'] = 'Shop';
        $data['active'] = 'All Shop';
        $data['title'] = '  ';
        $data['zones']= Zone::latest()->get();
        $data['admins']=  DB::table('admin')->get();         
        return view('admin.shop.create', $data); 
    }
 
    public function store(Request $request)
    {      
        $result = Shop::create($request->all());  
        if ($result) {
            return redirect('admin/shop')
                ->with('success', 'created successfully.');
        } else {
            return redirect('admin/shop')
                ->with('error', 'No successfully.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    { 
        $data['shop']=Shop::where('id',$id)->first();
        $data['main'] = 'Shop';
        $data['active'] = 'Update Shop';
        $data['title'] = 'Update Shop Information';   
        $data['zones']= Zone::latest()->get();
        $data['admins']=  DB::table('admin')->get();        
        return view('admin.shop.edit', $data);
    }

    
    public function update(Request $request, $id)
    {
        
        $result=  Shop::find($id)->update($request->all());

        if ($result) {
            return redirect('admin/zone')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/zone')
                ->with('error', 'No successfully.');
        }
    }
     
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
