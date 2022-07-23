@extends('layouts.master')
@section('pageTitle')
   Order Reports
@endsection
@section('mainContent')

 
    <div class="box-body">


        <form action="{{url('/')}}/admin/report/stockReport">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email">Product status</label>                   
                    <select class="form-control" id="product_status" name="product_status" >  
                        <option @if($selected_product_status==1) selected @endif value="1">Available</option>
                        <option @if($selected_product_status==0) selected @endif  value="0">UnAvailable</option>                        
                        <option @if($selected_product_status==2) selected @endif  value="2">Limited Stock</option>                        
                    </select>
                  </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="email">Zone</label>                  
                    <select onchange="getShopData(this.value)" class="form-control select2" id="zone_id" name="zone_id" >  
                    <option value="">Select Option</option>
                        @foreach($zones as $zone)
                        <option   @if($selected_zone_id==$zone->id) selected @endif value="{{$zone->id}}">{{$zone->zone_name}}</option>
                       @endforeach                       
                    </select>
                  </div>
            </div>

            <div class="col-md-3">
            <div class="form-group">
                                <label for="zone_id">Shop</label>
                                <select required class="form-control select2 " name="shop_id" id="shop_id"  >
                                    <option value="" >Select Option</option>                                    
                                </select>
                     </div>
            </div> 

            <div class="col-md-2">
                <br>
                <div class="form-group">
                    <button type="submit" id="filter_oreder_report" class="btn btn-success">Filter</button>
                </div>
            </div>
        </div>

        </form>
      <span id="order_report_by_ajax">  
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
        <th>Stock</th> 
    </tr>
    </thead>
    <tbody>

<?php $total_quntity=0; ?>
                @if(isset($products))
     @foreach ($products as $key=>$product)
     <?php 
     if($selected_product_status==1 || $selected_product_status==2) {
     $total_quntity +=$product->stock; 
     }
     
     ?>
        <tr>

            <td> {{ ++$key }} </td>
            <td>{{ $product->sku }}</td>
            <td>
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                <a target="_blank" href="{{ url('/') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

            </td>  
            <td>@if( $product->discount_price > 0 )  {{ $product->discount_price }}  @else  {{ $product->product_price }}   @endif </td> 
            <td><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
            <td>
                @if($selected_product_status==1)              
                {{$product->stock }}
                @elseif($selected_product_status==2)         
                {{$product->stock }}
                <br/>
                <button type="button" class="btn btn-info" data-toggle="modal" onclick="ProductDemand({{$product->product_id}})" data-target="#modal-default">Demand</button>

                @else
                
     <button type="button" class="btn btn-info" data-toggle="modal" onclick="ProductDemand({{$product->product_id}})" data-target="#modal-default">Demand</button>
                 @endif
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

    <div class="modal fade in" id="modal-default" style="padding-right: 17px;">
            <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Product Demand </h4>
              </div>
            <div class="modal-body" id="stock_update">
                <div class='form-group'>
                    <label>Quantity</label>
                    <input type="number" class='form-control' name="demand"  id="demand"/>
                    <input type="hidden" class='form-control' name="product_id" id="product_id" />
                </div>            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="update_product_demand" class="btn btn-primary">Update</button>
            </div>
            </div>

            </div>

</div>


    <script> 



    function ProductDemand(product_id){
        $("#product_id").val(product_id) 
    }

    $("#update_product_demand").click(function(){
       let product_id=$("#product_id").val();
       let demand=$("#demand").val();
       $.ajax({
        url:"{{url('/')}}/admin/report/ProductDemand",
        data:{
            product_id:product_id,
            demand:demand,
        },
        success:function(data){   
            console.log(data)    
            $("#demand").val('');    
            if(data='success'){
                alert("Successfully Inserted");
                $("#modal-default").modal('hide')
            }
        }
       })
        
    })


getShopData({{$selected_zone_id}});

function getShopData(zone_id){
    $.ajax({
        url:"{{url('admin/getShopData')}}/"+zone_id,
        success:function(data){
            $("#shop_id").html(data);
            $("#shop_id").val({{$selected_shop_id}});
            
        }
    })


}

    </script>



@endsection


