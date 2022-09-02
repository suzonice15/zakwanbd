@extends('layouts.master')
@section('pageTitle')
Product Sell Report
    @endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        @if (count($errors) > 0)
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    @foreach ($errors->all() as $error)

                        <li style="list-style: none">{{ $error }}</li>

                    @endforeach

                </ul>
            </div>
        @endif

        <div class="col-md-12">
            <form action="{{ url('admin/ProductSellReport') }}" class="form-horizontal"  
                  enctype="multipart/form-data">
                

                <div class='row'>
                    <div class='col-md-4'>

                     
                                <label for="zone_id">Zone</label>
                                <select onchange="getShopData(this.value)" required class="form-control select2 " name="zone_id"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option value="" >Select Option</option>
                                    @foreach($zones as $zone)
                                        <option @if($zone_id==$zone->id) selected @endif  value="{{$zone->id}}">{{$zone->zone_name}}</option>
                                    @endforeach
                                </select>
                     

    </div>
    <div class='col-md-4'>
   
                                <label for="zone_id">Shop</label>
                                <select required class="form-control select2 " name="shop_id" id="shop_id"  >
                                    <option value="" >Select Option</option>
                                    
                                </select>
                      
    </div>
    <div class='col-md-3'>
    
                                        <label> Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" name="date" class="form-control pull-right withoutFixedDate" value="@if($date) {{date("m-d-Y",strtotime($date))}} @endif">
                                        </div>
                                   
    </div>
    <div class='col-md-1'>  
    <button  style="margin-top: 28px;" type="submit" name="submit"  value="submit"   class='btn btn-success btn-sm '>Search</button>
   
    </div> 
    </form>

    

    </div> 

    <br/>
    <br/>
    <div class='row'>

    <div class="table-responsive">

<table  class="table table-bordered table-striped   ">
    <thead>
    <tr>
        <th class='text-center'>Sl</th>  
        <th class='text-center'>Product Code</th>   
        <th class='text-left'>Product Name</th>   
        <th class='text-center'>Product</th>  
        <th class='text-center'>Sell Price</th>  
        <th class='text-center'>Total Quantity</th> 
        <th class='text-center'>Total Amount</th> 
    </tr>
    </thead>
    <tbody> 
        <?php
$total_amount=0;
$total_amount_sum=0;

?>
@foreach ($products as $key=>$product_row)

<?php
$product=DB::table('product')->where('product_id',$product_row->product_id)->first();
$total_amount +=$product_row->total_quanitty;
$total_amount_sum +=$product_row->sub_total;
?>
<tr>


    <td class='text-center'> {{ ++$key }} </td> 
    <td class='text-center'> {{ $product->sku }}</td>  
    <td class='text-left'> {{ $product->product_title }}</td>    
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
    <td class='text-center'>{{ $product_row->total_quanitty}}</td>
    <td class='text-center'>{{ $product_row->sub_total}}</td>
     
</tr>
@endforeach 

<tr>
<td colspan="5" class="text-right">Total</td>
<td class="text-center">{{$total_amount}}</td>
<td class="text-center">{{$total_amount_sum}}</td>
 
    </tr>
    </tbody>

</table>

</div>
    </div>
 
          


        </div>
    </div>

    <script>
        getShopData({{$zone_id}});

function getShopData(zone_id){
            $.ajax({
                url:"{{url('admin/getShopData')}}/"+zone_id,
                success:function(data){
                    $("#shop_id").html(data);
                    $("#shop_id").val({{$shop_id}});
                    
                }
            })


        } 
    </script>



@endsection


