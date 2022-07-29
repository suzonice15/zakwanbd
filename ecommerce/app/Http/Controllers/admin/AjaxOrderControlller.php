<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AjaxOrderControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function __construct()
    {
        $this->middleware('Admin');
        date_default_timezone_set("Asia/Dhaka");     //Country which we are selecting.
    }
     
    public function create()
    {
        //
    }   


    public  function getOrderProduct(Request $request){
      
        $product_ids =$request->product_id;  
        $product= DB::table('product')->where('product_id',$product_ids)->first();   
        $image=url('/public/uploads').'/'. $product->folder.'/thumb/'.$product->feasured_image;
        $sell_price=$product->product_price;
        if($product->discount_price >0){
            $sell_price=$product->discount_price;
        }

        $html ='<tr>
        <td>'. $product->product_title.'</td>
        <td>Z0007</td>
        <td class="image text-center">
            <img src="'.$image.'"  style="width:100%">
        </td>
        <td class="text-center">
            <input  onchange="quantityChange(this.value,'.$product->product_id.')"   type="number" name="products['.$product->product_id.']" class="form-control" value="1"   style="width:70px;">
            <input    type="hidden" name="price['.$product->product_id.']" class="form-control" value="'.$sell_price.'"   style="width:70px;">
        </td> <td class="text-center" >'.$product->top_deal.'</td>
        <td class="text-center" id="price_'.$product->product_id.'">'.$sell_price.'</td>
       
         <td class="text-center subtotal_price" id="subtotal_'.$product->product_id.'">'.$sell_price.'</td>
         <td><button type="button" onclick="deleteRow(this)" class="btn btn-danger btn-sm">Delete</button></td>
    </tr>';
    
    echo $html;
        
    }

  
}
