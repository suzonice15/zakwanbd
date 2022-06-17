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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function productSelectionChange(Request $request)
    {
        $total_quntity=0;
        $subtotall=0;
        $product_ids = explode(",", $request->product_ids);
        $product_qtys = explode(",", $request->product_qtys);
        $data['shipping_charge'] = $request->shipping_charge;
        $data['order_id'] = $request->order_id;

        $data['order']= DB::table('order_data')->where('order_id', $request->order_id)->first();

        $pqty = array_combine($product_ids, $product_qtys);
        $data['pqty']=$pqty;
        //$data['shipping_charge']=$shipping_charge;
        $data['products']= DB::table('product')->whereIn('product_id',$product_ids)->get();
        return view('admin.order.product_selection_change',$data);

    }

    public function newProductUpdate(Request $request)
    {
        $total_quntity=0;
        $subtotall=0;
        $product_ids = explode(",", $request->product_ids);
        $product_qtys = explode(",", $request->product_qtys);
        $data['shipping_charge'] = $request->shipping_charge;
        $data['order_id'] = $request->order_id;

        $data['order']= DB::table('order_data')->where('order_id', $request->order_id)->first();

        $pqty = array_combine($product_ids, $product_qtys);
        $data['pqty']=$pqty;
        //$data['shipping_charge']=$shipping_charge;
        $data['products']= DB::table('product')->whereIn('product_id',$product_ids)->get();
        return view('admin.order.newProductUpdateChange',$data);

    }

    public function newProductSelection(Request $request)
    {
        $product_ids = explode(",", $request->product_id);
        //$qty = $this->input->post('product_quantity');
        $data['qty'] = $request->product_quantity;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['order_id'] = $request->order_id;

        $data['products']= DB::table('product')->whereIn('product_id',$product_ids)->get();
        $data['order']= DB::table('order_data')->where('order_id', $request->order_id)->first();

        return view('admin.order.new_ajax_order',$data);
 
    }


    public  function productSelection(Request $request){
       // $item_count=0;
        $product_ids = explode(",", $request->product_id);
        //$qty = $this->input->post('product_quantity');
        $data['qty'] = $request->product_quantity;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['order_id'] = $request->order_id;

        $data['products']= DB::table('product')->whereIn('product_id',$product_ids)->get();
        $data['order']= DB::table('order_data')->where('order_id', $request->order_id)->first();

        return view('admin.order.product_selection',$data);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
        //
    }
}
