@extends('layouts.master')
@section('pageTitle')
Top Sell Products
@endsection
@section('mainContent')
<div class="box-body">
     
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th class='text-center'>Sl</th>  
                <th class='text-center'>Product Code</th>   
                <th class='text-center'>Product Name</th>   
                <th class='text-center'>Product</th>  
                <th class='text-center'>Sell Price</th>  
                <th class='text-center'>Total Sold</th> 
            </tr>
            </thead>
            <tbody> 
    @foreach ($products as $key=>$product_row)

    <?php
$product=DB::table('product')->where('product_id',$product_row->product_id)->first();
     ?>
        <tr>


            <td class='text-center'> {{ ++$key }} </td> 
            <td class='text-center'> {{ $product->sku }}</td>  
            <td class='text-center'> {{ $product->product_title }}</td>    
            <td class='text-center'>
                <img width="100px"  src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"> 
            </td>
            
            <td class='text-center'>
                @if($product->discount_price > 0)
                {{ $product->discount_price  }}
                @else
                {{ $product->product_price  }}
                @endif
            </td>
            <td class='text-center'>{{ $product_row->total}}</td>
             
        </tr>

    @endforeach

      



   
            </tbody>

        </table>

    </div>

 
</div> 
@endsection

