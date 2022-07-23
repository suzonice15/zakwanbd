@extends('layouts.master')
@section('pageTitle')
   Order Reports
@endsection
@section('mainContent') 
    <div class="box-body"> 
      <span id="order_report_by_ajax">  
            <div class="box" style="border: 2px solid #ddd;">
            <div class="table-responsive"> 
<table  class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Sl</th> 
        <th>Zone</th>
        <th>Shop</th> 
        <th class="text-center"> Demand Quantity</th> 
        <th class="text-center"> Given Quantity</th> 
        <th class="text-center">Status</th>
        <th class="text-center">Date</th> 
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>

<?php $total_quntity=0; ?>
                @if(isset($products))
     @foreach ($products as $key=>$product)

     <?php
    $total_given= DB::table('product_demand_details')->where('product_demand_id',$product->id)->sum('given');
     ?>     
        <tr>
            <td> {{ ++$key }} </td>
            <td>{{optional($product->zone)->zone_name}}</td>
             <td>{{optional($product->shop)->shop_name}}</td> 
             <td class="text-center">{{$product->quantity}}</td> 
             <td class="text-center">{{$total_given}}</td> 
             <td class="text-center">
                @if($product->status==0)
                Pending 
                @else
                Received
                @endif
             </td>
             <td class="text-center">{{date('d F Y',strtotime($product->date)) }}</td> 
             <td> 
                <a href="{{url('/')}}/admin/report/userProductDemand/{{$product->id}}" class="btn btn-success" >View</a>
              
                </td> 
        </tr>

    @endforeach

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{$total_quntity}} </td>
    </tr>

  
@endif
<tbody>

                </table>

                </div>

            </div>


        </span>

    </div>
 


@endsection


