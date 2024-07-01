@extends('layouts.master')
@section('pageTitle')
Today Sell Report Product Wise
@endsection
@section('mainContent')
<div class="box-body">
     
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th class='text-center'>Sl</th>  
                <th class='text-center'>Product Code</th>   
                <th class='text-left'>Product Name</th>   
                <th class='text-center'>Product</th>  
                <th class='text-center'>Sell Price</th>  
                <th class='text-center'>Total Sold</th> 
                <th class='text-center'>Total Amount</th> 
            </tr>
            </thead>
            <tbody> 

            <?php
            $total_sell_amount=0;
            $total_sell_qnt=0;
            $total_sell_price=0;
            
            ?>
    @foreach ($products as $key=>$product_row)

    <?php
$product=DB::table('product')->where('product_id',$product_row->product_id)->first();
if($product->discount_price > 0){
  $sell_price=$product->discount_price;  
}else{
    $sell_price=$product->product_price;   
}

$total_sell_price +=$sell_price;
$total_sell_qnt +=$product_row->total;
$total_sell_amount +=$product_row->sub_total_amount;
     ?>
        <tr>


            <td class='text-center'> {{ ++$key }} </td> 
            <td class='text-center'> {{ $product->sku }}</td>  
            <td class='text-left'> {{ $product->product_title }}</td>    
            <td class='text-center'>
                <img width="100px"  src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"> 
            </td>
            
            <td class='text-center'>
               {{$sell_price}}
            </td>
            <td class='text-center'>{{ $product_row->total}}</td>
            <td class='text-center'>{{ $product_row->sub_total_amount}}</td>             
        </tr>

    @endforeach

    <tr>
        <th colspan="4" class='text-right'>Total </th>
<th class='text-center'>{{$total_sell_price}}</th>
<th class='text-center'>{{$total_sell_qnt}}</th>
<th class='text-center'>{{$total_sell_amount}}</th>
 </tr>

 <tr>
        <th colspan="6" class='text-right'>Discount Amount </th> 
<th class='text-center'>{{$discount_amount}}</th>
</tr>

<tr>
        <th colspan="6" class='text-right'>Grand Total </th> 
<th class='text-center'>{{$total_sell_amount-$discount_amount}}</th>
</tr>

      



   
            </tbody>

        </table>

    </div>

 
</div> 
@endsection

