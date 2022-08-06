<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MenuPermission extends Controller
{
     
    public function index()
    {         
        $data['roles']= DB::table('roles')->orderBy('id', 'desc')->get();
        return view('admin.menu.index',$data);
    }
    
    public function edit($id)
    { 
        $data['role']=DB::table('roles')->where('id', $id)->first();
      $data['role_menu']=  DB::table('role_details')->where('role_id',$id)->pluck('menu_id')->toArray();
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
        $data=[];
        $data['role_id']=$id; 
        DB::table('role_details')->where('role_id',$id)->delete();
        foreach($request->parent as $key=>$parent_row){  

            if(isset($request->menu[$key])){
 

                $data_1['menu_id']=$key;                    
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

       $parents= DB::table('role_details')->where('role_id',$id)->where('menu_status',0)->get();

       $htmls='';
      
       $url= $request->root().'/';

       foreach($parents as $parent_row){

       $seconds_menu=DB::table('role_details')->where('menu_status',$parent_row->menu_id)->where('role_id',$id)->get();
       if(count($seconds_menu) >0){

        $htmls .='<li class="treeview">
        <a href="#">
            <i class="'.$parent_row->manu_icon.'"></i>
            <span>'.$parent_row->manu_name.'</span>
            <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
        </a>
        <ul class="treeview-menu">';
        foreach($seconds_menu as $secend_row){
            $htmls .='<li><a href="'.$url.$secend_row->menu_url.'"><i class="fa fa-arrow-circle-right"></i>'.$secend_row->manu_name.'</a>
            </li>';
        }
        $htmls .='</ul>
        </li>';     

       }else{

        $htmls .='<li>
        <a href="'.$url.$parent_row->menu_url.'">
            <i class="'.$parent_row->manu_icon.'"></i> <span>'.$parent_row->manu_name.'</span>
            <span class="pull-right-container">
    </span>
        </a>
    </li>';
       }


       }



$result=DB::table('roles')->where('id',$id)->update(['html'=>$htmls]); 
 
        if ($result) {
            return redirect('admin/menuPermission')
                ->with('success', 'Updated successfully.');
        } else {
            return redirect('admin/menuPermission')
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
