@extends('layouts.master')
@section('pageTitle')
Product Demand View
@endsection
@section('mainContent') 
    <div class="box-body"> 
      <form  method="post" action="{{url('/admin/report/userProductDemand')}}/{{$product_row->id}}">  
        @csrf
            <div class="box" style="border: 2px solid #ddd;">
            <div class="table-responsive">

<table  class="table table-bordered table-striped   ">
    <thead>
    <tr>
        <th>Sl</th> 
        <th>Product Code</th>
        <th>Product</th> 
        <th>Sell Price</th> 
        <th>Published Status</th>
        <th class='text-center'>Demand</th> 
        <th class='text-center'>Permission</th> 
    </tr>
    </thead>
    <tbody>

<?php 
$total_quntity=0;
$total_given_quntity=0;
 ?>
                @if(isset($products))
     @foreach ($products as $key=>$product)

     <?php
     $total_quntity +=$product->demand;
     $total_given_quntity +=$product->given;
     ?>
     
        <tr>
            <td> {{ ++$key }} </td>
            <td>{{ $product->sku }}</td>
            <td>
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                <a target="_blank" href="{{ url('/') }}/{{$product->product_name}}"> {{$product->product_title}} </a>
            </td>  
            <td>@if( $product->discount_price > 0 )  {{ $product->discount_price }}  @else  {{ $product->product_price }}   @endif </td> 
            <td class='text-center'><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
            <td class='text-center'>{{ $product->demand }}</td>
            <td style="width: 50px;" class='text-center'> 
                <input style="width: 100px;" type="number" name="product_id[{{$product->id}}]" class='form-control' value="{{ $product->given }}" /> 
            </td>
        </tr>

    @endforeach

    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class='text-center'>{{$total_quntity}} </td>
        <td class='text-center'>{{$total_given_quntity}} </td>
    </tr>

  
@endif
<tbody>

                </table>

                </div>

            </div>
            <div class='form-group col-md-2'>
                <label>Send Status</label>
                    <select  required class="form-select form-control" name="status" aria-label="Default select example">
                        
                        <option value="">Select Option</option>
                        <option @if($product_row->status==0) selected @endif  value="0">Pending</option>
                        <option  @if($product_row->status==1) selected @endif value="1">Received</option>
                        
                    </select>
            </div>
            @if($product_row->status==0)
            <div class='form-group col-md-2' style="margin-top:25px"> 
                <input type="submit" class='btn btn-success btn-sm' value="Submit"> 
            </div>
            @endif

</form>

    </div>
 

@endsection


