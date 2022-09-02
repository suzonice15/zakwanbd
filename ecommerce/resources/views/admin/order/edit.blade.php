@extends('layouts.master')
@section('pageTitle')
    Order Update Page
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>

    <?php
               $admin_user= Session::get('status');
            if($admin_user=='super-admin' || $admin_user=='admin'){
                $affilite_commision_show="";


            } else {
                $affilite_commision_show="readonly";
            }

    ?>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
                @if($order->order_status !='completed')

                <form name="product"  id="form" action="{{ url('admin/order/update') }}/{{ $order->order_id }}" class="form-horizontal"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                @endif


                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="box box-primary" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color: #ddd;">
                                    <h3 class="box-title">Customer Info</h3>
                                    <span id="change_order_data" class="pull-right btn btn-info">Change Customer Information</span>
                                </div>
                                <div class="box-body">

                                
                                    <table class="table table-striped table-bordered table-hover">

                                        <thead>

                                        <th> Order Date</th>
                                        <th> Order Id</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Customer Email</th>
                                        <th>Customer Address</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td> 
                                                {{date('d-F-Y h:i:s a',strtotime($order->created_time))}}
                                            </td>
                                            <td>
                                                <h2 style="font-size:12px "
                                                    class="label label-success"> <?= $order->order_id; ?></h2>
                                            </td>
                                            <td>
                                                <?= $order->customer_name; ?>
                                            </td>
                                            <td>
                                                <?= $order->customer_phone; ?>
                                            </td>
                                            <td>
                                                <?= $order->customer_email; ?>
                                            </td>
                                            <td>
                                                <?= $order->customer_address; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="order_data" id="customer_info_change"
                                         style="padding: 18px;display: none">

                                         <div class='col-md-6'>
                                         <div class="form-group ">
                                            <label for="billing_name">Name </label>
                                            <input class="form-control" type="text" name="customer_name"
                                                   value="<?php echo $order->customer_name; ?>"/>
                                        </div>


                                        <div class="form-group ">
                                            <label for="billing_email">Email</label>
                                            <input type="text" class="form-control" name="customer_email"
                                                   value="<?php echo $order->customer_email; ?>"/>
                                        </div>


                                        <div class="form-group ">
                                            <label for="billing_email">Customer Phone</label>
                                            <input type="text" name="customer_phone" class="form-control"
                                                   value="<?php echo $order->customer_phone; ?>"/>
                                        </div>
                                        <div class="form-group shipping-address-group ">
                                            <label for="shipping_address1">Customer Address </label>
                                            <textarea class="form-control" rows="3" name="customer_address"
                                                      id="shipping_address1"><?= $order->customer_address ?></textarea>
                                        </div>

                                        <input type="hidden" id="orderId_for_commition" class="form-control"
                                               value="<?php echo $order->order_id; ?>"/>

                                        </div> 

                                        <div class='col-md-4' style="margin-left:5px">
                                         <div class="form-group ">
                                            <label for="payment_method">Payment Method </label>  
                                            <input  readonly class="form-control" type="text" 
                                                   value="<?php echo $order->payment_method; ?>"/>
                                        </div>

                                        <div class="form-group ">
                                            <label for="payment_method">Account Number </label>  
                                            <input  readonly class="form-control" type="text" 
                                                   value="<?php echo $order->account_number; ?>"/>
                                        </div>
                                        <div class="form-group ">
                                            <label for="payment_method">Transaction ID </label>  
                                            <input  readonly class="form-control" type="text" 
                                                   value="<?php echo $order->transaction_id; ?>"/>
                                        </div>                                       

                                        </div> 
                                    </div>
                                </div>
                            </div>                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color:#ddd">
                                    <h3 class="box-title">Order Status Information</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-2">
                                        <div class="form-group" style="padding: 12px;">
                                            <label>Courier Service</label>
                                            <select name="courier_service" id="courier_service"
                                                    class="form-control select2">
                                                <option value="">Select Courier</option>
                                                @foreach($couriers as $courier):

                                                <option
                                                        value="{{ $courier->courier_id }}">{{ $courier->courier_name }} <?php if ($courier->courier_status == 1) {
                                                        echo " -Inside Dhaka";
                                                    } else {
                                                        echo " -Outside Dhaka";
                                                    }?></option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" style="padding: 12px;">
                                            <label>Shipping Date</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <?php

                                                if($order->shipment_time){
                                                $shipment_time = date('d-m-Y', strtotime($order->shipment_time));
                                                ?>
                                                <input type="text" name="shipment_time"
                                                       class="form-control pull-right withoutFixedDate"
                                                       value="<?= $shipment_time ?>">
                                                <?php } else { ?>
                                                <input type="text" name="shipment_time"
                                                       class="form-control pull-right withoutFixedDate"
                                                       value="">
                                                <?php } ?>                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">

                                        <?php
                                        $admin_user=Session::get('status');
                                        if($order->order_status !="delivered") {
                                        ?>

                                        <div class="form-group" style="padding: 12px;">
                                            <label>Order Status</label>
                                            <select name="order_status" id="order_status" class="form-control">
                                                @if($order->order_status=="new")
                                                <option value="new">New</option>  
                                                <option value="processing">On Process</option>                                                    
                                                @elseif($order->order_status=="phone_pending")  
                                                    <option value="processing">On Process</option>                                                    
                                                @elseif($order->order_status=="processing")
                                                    <option value="processing">On Process</option>                                                    
                                                <option value="on_courier">With Courier</option>
                                                @elseif($order->order_status=="on_courier")
                                                <option value="on_courier">With Courier</option>
                                                <option value="completed">Completed</option>
                                                 <option value="failed">Failed</option>
                                                @elseif($order->order_status=="delivered")
                                                    
                                                    <option value="completed">Completed </option>
                                                    <option value="refund">Refunded</option>

                                                @elseif($order->order_status=="pending_payment")
                                                    
                                                    <option value="processing">On Process</option>
                                                    

                                                @elseif($order->order_status=="failed")
                                                    <option value="failed">Failed</option>
                                                    <option value="new">New</option>

                                                @elseif($order->order_status=="completed")

                                                    <?php
                                                    $admin_user=Session::get('status');
                                                    if($admin_user !='editor' && $admin_user !='office-staff') {   ?>

                                                    <option value="completed">Completed {{ $admin_user}}</option>
                                                    <?php } ?>
                                                @elseif($order->order_status=="cancled")
                                                    <!-- <option value="cancled">Cancled</option>
                                                    <option value="new">New</option> -->
                                                @else
                                                <option value="new">New</option>  
                                                    @endif
                                            </select>
                                        </div>

                                    <?php } ?>
                                    </div> 

                                    <div class='col-md-2'>
                                            <div class="form-group" style="padding: 12px;">
                                                <label>Zone </label> 
                                                <select  onchange="getShopData(this.value)" name="zone_id" id="zone_id" class="form-control select2"  >
                                                    <option value="">Select Option</option>
                                                            <?php foreach($zones as $zone) :                                                            
                                                            ?>
                                                            <option @if($order->zone_id==$zone->id) selected @endif value="{{$zone->id}}"
                                                            >{{$zone->zone_name}}</option>
                                                            <?php endforeach; ?>
                                                </select>
                                            </div> 
                                    </div>

                                    <div class='col-md-4 ' style="margin-top:12px">
                                            <div class="form-group">
                                                    <label for="shop_id">Shop</label>
                                                    <select required class="form-control select2 " name="shop_id" id="shop_id"  >
                                                        <option value="" >Select Option</option>
                                                        
                                                    </select>
                                            </div>
                                     </div>
                      

                                    <div class='col-md-5'>
                                            <div class="form-group" style="padding: 12px;">
                                                <label>Product List </label> 
                                                <select name="product_ids" id="product_ids" class="form-control select2 product_ids"  > 
                                                            
                                              </select>
                                            </div>                                     
                                    </div>
                                    
                                    
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="box box-primary" style="border:2px solid #ddd">
                                    <div class="box-header" style="background-color:#ddd">
                                        <h3 class="box-title">Product Information</h3>
                                    </div>
                                    <div class="box-body">
                          
                           <table class="table table-striped table-bordered">
                               <tr>
                                   <th class="name" width="30%">Product</th>
                                   <th class="name" width="5%">Code</th>
                                   <th class="image text-center" width="5%">Image</th>
                                   <th class="quantity text-center" width="10%">Qty</th>
                                   <th class="quantity text-center" width="10%">Commision</th>
                                   <th class="price text-center" width="10%">Price</th>
                                   <th class="total text-right" width="10%">Sub-Total</th>
                                   <!-- <th class="total text-right" style="display:none" width="10%">Delete</th> -->
                               </tr>
                               <tbody  id="product_show">                               
                               <?php
                $order_items = getOrderDetails($order->order_id);               
                if(isset($order_items)) {
                    foreach ($order_items as $key => $item) {                        
                        $product = single_product_data($item->product_id);
                        $featured_image=url('/public/uploads').'/'. $product->folder.'/thumb/'.$product->feasured_image;  
                        ?>
                               <tr>
                                   <td><a target="_blank"
                                          href="{{url('/')}}/{{$product->product_name}}">{{$product->product_title}}</a>                                   </td>
                                   <td>{{$product->sku}}</td>
                                   <td class="image text-center">
                                       <img src="<?php echo $featured_image ?>" height="50" width="50">
                                   </td>
                                   <td>
                                       <input type="number"   onchange="quantityChange(this.value,{{$item->product_id}})" name="products[<?php echo $item->product_id?>]"
                                              class="form-control"
                                              value="<?php echo $item->qnt;  ?>"
                                              style="width:70px;">
                                              <input type="hidden"  name="price[<?php echo $item->product_id?>]"
                                              class="form-control"
                                              value="<?php echo $item->price;  ?>"
                                              style="width:70px;">                                   </td>

                                   <td class="text-center"> 
<?php echo $item->commision; ?>
                                   </td>
                                   <td class="text-center" id="price_{{$item->product_id}}">
                                       <?php echo $item->price; ?></td>
                                   <td class="text-center subtotal_price" id="subtotal_{{$item->product_id}}">
                                       {{$item->sub_total}} </td>
                                        <!-- <td class="text-center"><button type="button" style="display:none" onclick="deleteRow(this)" class="btn btn-danger btn-sm">Delete</button></td> -->
                               </tr>

                               <?php } } ?>

                               <tr> 
                                    <td class="text-right" colspan='6'>  Total Amount</td> 
                                    <td class="text-center"><span id="total_subtotal_price"></span></td> 
                                    <td>
                                </tr>

                                <tr> 
                                    <td class="text-right" colspan='6'> Delivery Cost </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="shipping_charge" class="form-control" id="shipping_charge" value="{{$order->shipping_charge}}"> 
                                    </td> 
                                    <td>
                                </tr> 
                                <tr> 
                                    <td class="text-right" colspan='6'>Discount Price </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="discount_price" class="form-control remove_zero" id="discount_price" value="{{$order->discount_price}}"> 
                                    </td> 
                                    <td>
                                </tr> 
                                
                                <tr> 
                                    <td class="text-right" colspan='6'>Paid Amount </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="advabced_price" class="form-control remove_zero" id="advabced_price" value="{{$order->advabced_price}}"> 
                                    </td> 
                                    <td>
                                </tr>  
                                <tr> 
                                    <td class="text-right" colspan='6'>Return Amount</td> 
                                    <td class="text-center">
                                    <span id="total_amount">{{$order->order_total}}</span>
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="hidden" name="order_total" class="form-control" id="order_total" value="{{$order->order_total}}"> 

                                    </td> 
                                    <td>
                                </tr>                                 
                    </tbody>
                               
 
                           </table> 

                                    </div>
                                </div>
                                @if($order->order_status=='completed')
                                    @if($admin_user =='super-admin')
                                    <input type="radio" name="order_status" value="completed" /><label>   &nbsp; Completed</label>
                                    <input type="radio" name="order_status" value="refund" /><label>  &nbsp; Refund</label>
                                        @if($order->order_status !='completed')
                                        <button type="button" id="order_update_button" class="btn btn-primary pull-right" style="margin-right: 10px">Update</button>
                                            @endif
                                     @endif

                                @else
                                    @if($admin_user =='super-admin')
                                        @if($order->order_status=="delivered")
                                        <div class="completed" class="completed" style="position: absolute;right: 151px;margin-top: 7px;">
                                    <input type="radio" name="order_status" value="completed" /><label>   &nbsp;Completed</label>
                                            </div>

                                    <input type="radio" name="order_status" value="delivered" /><label>   &nbsp;Delivered</label>
                                    <input type="radio" name="order_status" value="refund" /><label>  &nbsp; Refund</label>
                                     @endif
                                    @endif
                                    <a href="{{url('/')}}/admin/order/invoice-print/{{$order->order_id}}" class="pull-right"> <span class="glyphicon glyphicon-print btn btn-success"></span></a>
                                        @if($order->order_status !='completed')
                                    <button type="button" id="order_update_button" class="btn btn-primary pull-right" style="margin-right: 10px">Update</button>
                                            @endif

                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <script>

                getShopData("{{$order->zone_id}}");
                function getShopData(zone_id){
                    $.ajax({
                        url:"{{url('admin/getShopData')}}/"+zone_id,
                        success:function(data){
                            $("#shop_id").html(data);
                            $("#shop_id").val("{{$order->shop_id}}");
                            
                        }
                    })
                  }
                  $("#shop_id").on('change',function(){                   
                  let shop_id=  $("#shop_id").val();

                  $.ajax({
                    url:"{{url('/')}}/admin/getProductsByShopId",
                    data:{shop_id:shop_id},
                    success:function(data){
                        console.log(data)
                        $(".product_ids").html(data);
                    },
                    error:function(data){
                        console.log(data)
                    }
                  })
                 
                  
                  })


                setTimeout(() => {
                    subTotalGenerate();
                }, 500);         

                $("body").on('click', '#order_update_button', function () {
                var order_status= $("#order_status").val();
                var order_note= $("#order_note").val();
                var advabced_price= $("#advabced_price").val();
                var discount_price= $("#discount_price").val();
                var shipping_charge= $("#shipping_charge").val();
                    if((order_status =="failed") || (order_status =="cancled") || (order_status =="refund")  ){
                        if(order_note ==''){
                            alert("Please Enter Order Note")
                            return false
                        }
                    }

                    if(discount_price =='' ){
                       // $("#discount_price").val(0);
                        alert("Please Enter   Discount Price")
                        return false
                    }
                    if(advabced_price =='' ){
                       // $("#advabced_price").val(0);
                        alert("Please Enter   advanced Price")
                        return false
                    }
                    if(shipping_charge =='' ){
                      //  $("#shipping_charge").val(0);
                        alert("Please Enter   Delivery Cost")
                        return false
                    }
                    $("#form").submit()

                });

            </script>
             <script>

function deleteRow(btn) {
   let confirm_message= confirm("Are you sure you want to delete ?")
   if(confirm_message){
    var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        subTotalGenerate();
   }              
}

function quantityChange(quantity,product_id){
    if(quantity >=1 ){                   
   let price=parseInt($("#price_"+product_id).text());
   let total_sub_total=price*quantity;
   $("#subtotal_"+product_id).text(total_sub_total)
   subTotalGenerate();
}else{
    alert("minimum 1 quantity need")
}                   
}

function subTotalGenerate(){                  
  var price = 0;
    $('.subtotal_price').each(function(){
        price += parseFloat($(this).text());  
    }); 
  $("#total_subtotal_price").text(price);  
  totalGenerate();
}
function totalGenerate(){

   let subtotal= parseInt($("#total_subtotal_price").text());   
   let shipping_charge= parseInt($("#shipping_charge").val());   
   let discount_price= parseInt($("#discount_price").val()); 
   let advabced_price= parseInt($("#advabced_price").val()); 
   
   let summation=subtotal+shipping_charge;
   let subtract=advabced_price+discount_price;

   let total=summation-subtract;

    $("#total_amount").text(total);
    $("#order_total").val(total);
    
}

$('#shipping_charge , #discount_price  , #advabced_price').on("input",function(e){
    
    totalGenerate();
})

$("#affiliate_mobile").blur(function(){
    let affiliate_mobile=$("#affiliate_mobile").val();
    affiliate_mobile = affiliate_mobile.trim();

    $.ajax({
        url:"{{url('/')}}/order/affiliateCheckByMobile/"+affiliate_mobile,
        success:function(data){
            if(data.success=='ok'){
                $("#customer_name").val(data.name)                          
                $("#customer_phone").val(data.phone)                          
                $("#user_id").val(data.id)  
            }else{
                $("#customer_name").val('')                          
                $("#customer_phone").val(affiliate_mobile)   
                $("#user_id").val(2)   
            } 
        }

    })
    
})

 
                $('#change_order_data').click(function () {
                    $('#customer_info_change').toggle();
                }); 
                
            </script>
            <script>
                $("#order_status").val("{{$order->order_status}}");
                $("#courier_service").val({{$order->courier_service}});
             </script>
              <script>
                $(document).on('change', '.product_ids', function () {    
                    return false;                
                    let product_id=$(this).val();   
                    $.ajax({
                        type: "get",
                        data: {product_id:product_id},
                        url: "{{  route('getOrderProduct')}}",
                        success: function (result) { 
                            $('#product_show').prepend(result);
                            
                                subTotalGenerate();
                                                    
                        },
                        errors: function (result) {                          
                            console.log(result)
                        }
                    });

                });

            </script>
@endsection


