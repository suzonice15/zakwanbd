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
use App\Models\Zone;
use App\Models\ProductDemand;
use App\Models\ProductDemandDetail;

class ReportController extends Controller
{


    public  function __construct()
    {
        $this->middleware('Admin');
    }

    
    public function userProductDemand()
    {         
        $data['main'] = 'User Demand';
        $data['active'] = 'User Demand';
        $data['title'] = '  '; 
        $today=date('Y-m-d');
        $zone_id= Session::get('zone_id');
        $shop_id= Session::get('shop_id'); 
        $data['products']= ProductDemand::where('shop_id',$shop_id)->orderBy('id','desc')->get();
        return view('admin.report.userDemand',$data);
    }

    public function userProductDemandView($id)
    {         
        $data['main'] = 'Product Demand View ';
        $data['active'] = 'Product Demand View';
        $data['title'] = '  ';  
        $data['product_row']= ProductDemand::find($id);
        $data['products']= ProductDemandDetail::join('product','product.product_id','=','product_demand_details.product_id')->where('product_demand_id',$id)->get();
        return view('admin.report.userProductDemandView',$data);
    }
    public function userProductDemandViewUpdate(Request $request,$id)
    {    
      $demand=ProductDemand::find($id);   
      $demand->status=$request->status;
      $demand->save();      
      foreach($request->product_id as $key=>$given){
       $data['given']=$given;
       $product_id=ProductDemandDetail::where('id',$key)->value('product_id');
       stockReduceofZone($demand->zone_id,$product_id,$given);
       
        ProductDemandDetail::where('id',$key)->update($data);

      }  
 
        return redirect('/admin/report/userProductDemand')->with('success','Updated successfully');
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

    public function stockReport(Request $request)
    {
        $data['selected_product_status']=$data['selected_zone_id']=$data['selected_shop_id']='';
        $data['zones']= Zone::latest()->get();
        
        if($request->zone_id){
            $data['selected_product_status']=$request->product_status;
            $shop_id=$request->shop_id;
            $data['selected_shop_id']= $shop_id;
            $data['selected_zone_id']= $request->zone_id;
            if($request->product_status==1){
                $data['products']=DB::table('product_stocks')
                ->join('product','product_stocks.product_id','=','product.product_id')
                ->where('shop_id', $shop_id)->get();
               

            }else if($request->product_status==2){
                // limited stock
                $data['products']=DB::table('product_stocks')->join('product','product_stocks.product_id','=','product.product_id')
                ->where('shop_id', $shop_id)
                ->where('stock', '<=',20)
                ->get();

            }
              else{ 
                $product_ids=DB::table('product_stocks')->where('shop_id', $shop_id)->where('stock', '>',0)->pluck('product_id')->toArray(); 
                $data['products']=DB::table('product')->whereNotIn('product_id', $product_ids)->get();
            }

        }


        $data['reports']= Zone::latest()->get();
        return view('admin.report.stockReport',$data);
    }
    

    public function ProductDemand(Request $request)
    {
        $zone_id= Session::get('zone_id');
        $shop_id= Session::get('shop_id');
        $today=date("Y-m-d");
        $product_id=$request->product_id;
        $demand=$request->demand; 
       $demandCheck= ProductDemand::where('shop_id',$shop_id)->where('date',  $today)->first();
       if($demandCheck){
         // update
         $data_demand['quantity']=$demandCheck->quantity+ $demand;          
         ProductDemand::where('id',$demandCheck->id)->update($data_demand);

          $data_demand_details['product_demand_id']=$demandCheck->id;
          $data_demand_details['zone_id']=$zone_id;
          $data_demand_details['shop_id']= $shop_id;
          $data_demand_details['product_id']= $product_id;
          $data_demand_details['demand']= $demand;         
          $data_demand_details['created_at']=date('Y-m-d H:i:s');         
          $data_demand_details['updated_at']= date('Y-m-d H:i:s');      
          ProductDemandDetail::insert($data_demand_details);

       } else{
        // insert 

     $product_demand=  new ProductDemand();
     $product_demand->zone_id=$zone_id;
     $product_demand->shop_id=$shop_id;
     $product_demand->date=date('Y-m-d');
     $product_demand->status=0;
     $product_demand->quantity=$demand; 
      $product_demand->save(); 

     $data_demand_details['product_demand_id']=$product_demand->id;
     $data_demand_details['zone_id']=$zone_id;
     $data_demand_details['shop_id']= $shop_id;
     $data_demand_details['product_id']= $product_id;
     $data_demand_details['demand']= $demand;         
     $data_demand_details['created_at']=date('Y-m-d H:i:s');         
     $data_demand_details['updated_at']= date('Y-m-d H:i:s');  

     ProductDemandDetail::insert($data_demand_details);


       }
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

    
 
}
