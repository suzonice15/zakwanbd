<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MenuPermission extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
        $data['roles']= DB::table('roles')->orderBy('id', 'desc')->get();
        return view('admin.menu.index',$data);
    }
    
    public function edit($id)
    { 
        $data['category_title']="";
        return view('admin.menu.edit', $data);
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

        //dd($request->all());
        $data=[];
        $data['role_id']=$id; 
        DB::table('role_details')->where('role_id',$id)->delete();
        foreach($request->parent as $key=>$parent_row){  

            if(isset($request->menu[$key])){

                $data['menu_id']=$key;                    
                $array_1 = explode(',', $parent_row);
                $data_1['manu_name']=$array_1[0];    
                $data_1['manu_icon']=$array_1[1];  
                $data_1['menu_status']=0; 
                $data_1['role_id']=$data['role_id']; 
                $data_1['created_at']=date("Y-m-d H:i:s"); 
              

                DB::table('role_details')->insert($data_1);

             foreach($request->menu[$key] as $menuKey=>$menuData){   
             
                $data_2['menu_id']=$menuKey;    
                $data_2['menu_status']=$key;  
                $array_1 = explode(',', $menuData);
                $data_2['manu_name']=$array_1[0];  
                $data_2['menu_url']=$array_1[1]; 
                $data_2['role_id']=$data['role_id']; 
                $data_2['created_at']=date("Y-m-d H:i:s"); 

                DB::table('role_details')->insert($data_2); 
             }
            }else{
               
                $data['menu_id']=$key;    
                $data['menu_status']=0; 
                $array_3 = explode(',', $parent_row);
                $data['manu_name']=$array_3[0];    
                $data['menu_url']=$array_3[1];    
                $data['manu_icon']=$array_3[2];  
                $data['role_id']=$data['role_id'];  
                $data['created_at']=date("Y-m-d H:i:s"); 

                DB::table('role_details')->insert($data);
            }

             

        }
      
        exit();

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
        $share_image = $request->file('share_image');
        if ($image) {

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/category');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(81, 81, function ($constraint) {

            })->save($destinationPath . '/' . $image_name);
            $data['medium_banner']=$image_name;

        }

        if ($share_image) {

            $image_name = time() . '.' . $share_image->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/category');

            $resize_image = Image::make($share_image->getRealPath());

            $resize_image->save($destinationPath . '/' . $image_name);
            $data['share_image']='public/uploads/category/'.$image_name;


        }

        $result= DB::table('category')->where('category_id',$id)->update($data);
        if ($result) {
            return redirect('admin/categories')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/categories')
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
        //
    }
}
