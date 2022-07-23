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


                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-danger" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color:#ddd">
                                    <h3 class="box-title">Order Status Information</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">

                                        <?php
                                        $admin_user=Session::get('status');
                                        if($order->order_status !="delivered") {
                                        ?>

                                        <div class="form-group" style="padding: 12px;">
                                            <label>Order Status</label>
                                            <select name="order_status" id="order_status" class="form-control">
                                                @if($order->order_status=="new")
                                                <option value="new">New</option>
                                                <option value="phone_pending">Phone Pending</option>
                                                <option value="pending_payment">Pending for Payment</option>
                                                <option value="processing">On Process</option>
                                                    <option value="cancled">Cancelled</option>
                                                @elseif($order->order_status=="phone_pending")
                                                    <option value="phone_pending">Phone Pending</option>
                                                    <option value="pending_payment">Pending for Payment</option>
                                                    <option value="processing">On Process</option>
                                                    <option value="cancled">Cancelled</option>
                                                @elseif($order->order_status=="processing")
                                                    <option value="processing">On Process</option>

                                                    <option value="cancled">Cancelled</option>
                                                <option value="on_courier">With Courier</option>
                                                @elseif($order->order_status=="on_courier")
                                                <option value="on_courier">With Courier</option>
                                                <option value="delivered">Delivered</option>
                                                 <option value="failed">Failed</option>
                                                @elseif($order->order_status=="delivered")
                                                    <option value="delivered">Delivered </option>
                                                    <option value="completed">Completed </option>
                                                    <option value="refund">Refunded</option>

                                                @elseif($order->order_status=="pending_payment")
                                                    <option value="pending_payment">Pending for Payment</option>
                                                    <option value="processing">On Process</option>
                                                    <option value="cancled">Cancelled</option>

                                                @elseif($order->order_status=="failed")
                                                    <option value="failed">Failed</option>
                                                    <option value="new">New</option>

                                                @elseif($order->order_status=="completed")

                                                    <?php
                                                    $admin_user=Session::get('status');
                                                    if($admin_user !='editor' && $admin_user !='office-staff') {                                                   ?>

                                                    <option value="completed">Completed {{ $admin_user}}</option>
                                                    <?php } ?>


                                                @elseif($order->order_status=="cancled")
                                                    <option value="cancled">Cancled</option>
                                                    <option value="new">New</option>
                                                @else

                                                    @endif
                                            </select>
                                        </div>

                                    <?php } ?>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label> Order Created By</label>

                                                <br/>
                                                <b>{{$order->created_by}}</b>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label> Admin Order Note</label>


                                                <textarea id="order_note" class="form-control"
                                                          name="order_note"></textarea>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Customer Order Note</label>


                                                <p><?php echo $order->customer_order_note; ?></p>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> Affiliate Order Note</label>

                                                <p><?php echo $order->affiliate_order_note; ?></p>

                                            </div>
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
                           <span id="product_html">
                           <table class="table table-striped table-bordered">
                               <tr>
                                   <th class="name" width="30%">Product</th>
                                   <th class="name" width="5%">Code</th>
                                   <th class="image text-center" width="5%">Image</th>
                                   <th class="quantity text-center" width="10%">Qty</th>
                                   <th class="quantity text-center" width="10%">Commision</th>
                                   <th class="price text-center" width="10%">Price</th>
                                   <th class="total text-right" width="10%">Sub-Total</th>
                               </tr>
                               <?php
                               $order_ids = array();
                               $totalCommision=0;
                               $product_ids = array();
                               $product_id_select = array();
                               $proSizeList = 0;
                               $subtotal_price = 0;
                               $item_count = 0;
                               $order_id = $order->order_id;
                               $order_items = unserialize($order->products);

                               $hotdeal="";

                               $html = null;
                               if(is_array($order_items['items'])) {
                               foreach ($order_items['items'] as $product_id => $item) {
                               $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                               //  $_product_title =  substr($item['name'], 0, 150);

                               $product_ids[] = $product_id;
                               $product_code = 0;
                               $product_id_select = array_unique($product_ids);
                               $products_sku = DB::table('product')->select('sku')->first();
                               $product_code = $products_sku->sku;

                               $totall = intval(preg_replace('/[^\d.]/', '', isset($item['subtotal']) ? $item['subtotal'] : null));

                               $subtotal_price += $totall;
                               //  $subtotal_price= $subtotal_price+ $item['subtotal'] ;
                               //  $item_count = $item_count + $item['qty'];
                               $sku="";
                               $name="";
                               $product = single_product_information($product_id);
                                   if( $product){
                                       $sku = $product->sku;
                                       $name = $product->product_name;
                                   }

                                   //commition calculation of affilator
                                   $commision_price=0;
                                   if($order->user_id>0){
                                   $affilate_id=$order->user_id;
                               } else {
                               $affilate_id=0;
                               }
                               if($order->user_id >0){

                                   $hotdeal_commision=DB::table('user_commission')->select('commission')
                               ->where('user_id',$affilate_id)
                               ->where('product_id',$product_id)
                               ->where('order_id',$order->order_id)->first();
                                   if($hotdeal_commision){
                               $commision_price=$hotdeal_commision->commission*$item['qty'];
                               $totalCommision += $commision_price;
                               $hotdeal="hot deal";
                               } else {

                                   /* vendor product commistion distribution */
                               $vendorProductCheck=DB::table('product')
                               ->select('top_deal','vendor_id')
                               ->where('product_id', $product_id)
                                ->first();
                                   if($vendorProductCheck){
                               $commision_price= $vendorProductCheck->top_deal*$item['qty'];
                               $totalCommision +=$commision_price;
                                   }
                               $hotdeal="";
                               }
                               }
                               ?>
                               <tr>
                                   <td><a target="_blank"
                                          href="{{url('/')}}/{{$name}}"><?php $name = (isset($item['name']) ? $item['name'] : null);echo $name; ?></a>
                                   </td>
                                   <td>{{  $sku }}</td>
                                   <td class="image text-center">
                                       <img
                                               src="<?php echo $featured_image ?>"
                                               height="30" width="30">
                                   </td>
                                   <td>
                                       <input type="number"
                                              name="products[items][<?php echo $product_id ?>][qty]"
                                              class="form-control item_qty"
                                              value="<?php echo $quantity = isset($item['qty']) ? $item['qty'] : null;  ?>"
                                              data-item-id="<?php echo $product_id ?>"
                                              style="width:70px;">
                                   </td>

                                   <td>
                                       <?=$hotdeal?>
                                       <input type="number" readonly name="commision[]" value="{{$commision_price}}" class="form-control">
                                       <input type="hidden" name="commion_product_id[]" value="{{$product_id}}" class="form-control">

                                   </td>
                                   <td class="text-center">
                                       ৳ <?php $price = (isset($item['price']) ? $item['price'] : null);echo $price; ?></td>
                                   <td class="text-right">
                                       ৳ <?php $pricee = (isset($item['subtotal']) ? $item['subtotal'] : null);echo $pricee; ?> </td>
                               </tr>
                               <input type="hidden" name="products[items][<?=$product_id?>][featured_image]"
                                      value="<?=$featured_image?>"/>
                               <input type="hidden" name="products[items][<?=$product_id?>][price]"
                                      value="<?=$item['price']?>"/>
                               <input type="hidden" name="products[items][<?=$product_id?>][name]"
                                      value="<?php $name = (isset($item['name']) ? $item['name'] : null);echo $name; ?>"/>
                               <input type="hidden" name="products[items][<?=$product_id?>][subtotal]"
                                      value="<?=$item['subtotal']?>"/>

                               <?php
                               }
                               }
                               ?>
                               <tr>
                                   <td colspan="8"><a
                                               class="btn btn-primary pull-right update_items">Change</a></td>
                           </table>
                           <table class="table table-striped table-bordered">

                               <tbody>

                               @if($order->affiliate_discount > 0)
                               <tr >
                                   <td>Affiliate Discount</td>
                                   <td
                                           class="text-right" style="color: red;"> ৳ <span ><?php echo $order->affiliate_discount  . '.00' ?></span>
                                   </td>
                               </tr>
                               @endif

                               <tr>
                                   <td> Sub Total</td>
                                   <td
                                           class="text-right"> ৳ <span
                                               id="subtotal_price_sujon"><?php echo $subtotal_price-$order->affiliate_discount . '.00' ?></span>
                                   </td>
                               </tr>
                               <tr  >
                                   <td> <span
                                               class="extra bold">Delivery Cost</span></td>
                                   <td class="text-right"><input  style="color: green;font-weight: bold" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                               type="text" name="shipping_charge" class="form-control"
                                               id="shipping_charge"
                                               value="<?= $order->shipping_charge;?>"></td>
                               </tr>
                               <tr >
                                   <td> <span
                                               class="extra bold">Discount </span></td>
                                   <td class="text-right"><input style="color: red;font-weight: bold" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                               type="text" name="discount_price" class="form-control"
                                               id="discount_price"
                                               value="<?php echo $order->discount_price; ?>"></td>
                               </tr>
                               <tr>
                                   <td> <span
                                               class="extra bold">Paid</span></td>
                                   <td class="text-right">
                                       <input  style="color: red;font-weight: bold"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                               type="text" name="advabced_price" class="form-control"    id="advabced_price"   value="<?php echo $order->advabced_price; ?>"></td>
                               </tr>

                               <?php
                               if($order->payWith=='bonus'){
                               ?>

                               <tr>
                                   <th>Paid with  Bonus  :</th>

                                   <td class="text-left"><input readonly class="form-control" value={{-$order->bonus_balance}}>  </td>


                               </tr>
                               <?php
                               }else if($order->payWith=='cashback'){
                               ?>

                               <tr>
                                   <th>  Cashback Amount :</th>
                                   <td class="text-left"><input class="form-control" value={{-$order->cashback_balance}}>  </td>

                               </tr>
                               <?php
                               }
                               ?>
                               <tr>
                                   <td>
                                       <span class="extra bold totalamout">Affiliate Commision</span>
                                       <?php
                                           $affilateName=DB::table('users_public')->select('name','phone')->where('id',$order->user_id)->first();
                                           if($affilateName){
                                       ?>
                                       <br>
                                       <span style="color:red;font-size: 16px;font-weight: bold">
                                       {{$affilateName->name}}
                                       <br>
                                       {{$affilateName->phone}}( {{$order->user_id}})


</span>
                                       <?php } ?>


                                   </td>
                                   <td>
                                       @if($order->changed_affilite_commision)
                                           <input  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  type="text" {{$affilite_commision_show}} name="totalCommision"  class="form-control"  value="<?php echo $order->changed_affilite_commision?>">

                                       @else
                                           <input  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  type="text" {{$affilite_commision_show}} name="totalCommision"  class="form-control"  value="<?php echo ($totalCommision-$order->affiliate_discount) ?>">

                                           @endif
                                   </td>
                               </tr>
                               <tr>
                                   <td><span class="extra bold totalamout">Total</span></td>
                                   <td
                                           class="text-right"> <span class="bold totalamout"><p> ৳ <span
                                                       id="total_cost"><?php echo $order->order_total-$order->cashback_balance ?></span>
                                           </p></span>

       <input  type="hidden" name="order_total" id="order_total"  value="<?php echo $order->order_total; ?>">

                               </tr>


                               </tbody>

                           </table>
                           </span>

                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <select name="product_ids" id="product_ids" class="form-control select2"
                                                        multiple="multiple"
                                                        data-placeholder="Type... product name here..."
                                                        style="width:100%;">

                                                    <?php foreach($products as $product) :

                                                    $product_title = substr($product->product_title, 0, 50)


                                                    ?>
                                                    <option value="{{$product->product_id}}"

                                                    <?php foreach ($product_id_select as $key => $prod) {

                                                            if ($prod == $product->product_id) {
                                                            echo "selected";
                                                            } else {
                                                            echo "";
                                                            }

                                                            }?>

                                                    >{{$product_title}} - {{$product->sku}}</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


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

                $("body").on('input', '#shipping_charge', function () {
                    var subtotal_price = $('#subtotal_price_sujon').text();
                    var delivary_cost = parseInt($(this).val());

                        var total_price = delivary_cost + parseInt(subtotal_price);
                        $('#total_cost').text(total_price);
                        $('#order_total').val(total_price);


                });
                $("body").on('input', '#discount_price', function () {
                    var discount_price = parseInt($(this).val());
                    var subtotal_price = $('#subtotal_price_sujon').text();
                    var shipping_charge = $('#shipping_charge').val();
                    var total_price = parseInt(subtotal_price) + parseInt(shipping_charge);

                    var total = parseInt(total_price) - discount_price;
                    $('#total_cost').text(total);
                    $('#order_total').val(total);
                });
                $("body").on('input', '#advabced_price', function () {
                    var advabced_price = parseInt($(this).val());
                    var subtotal_price = $('#subtotal_price_sujon').text();
                    var shipping_charge = $('#shipping_charge').val();
                    var discount_price = parseInt($('#discount_price').val());
                    var total_price = parseInt(subtotal_price) + parseInt(shipping_charge) - (discount_price + advabced_price);
                    var total = parseInt(total_price)
                    $('#total_cost').text(total);
                    $('#order_total').val(total);

                });
            </script>

            <script>

                $('#change_order_data').click(function () {
                    $('#customer_info_change').toggle();
                });


                $(document).on('click', '.update_items', function () {
                    var product_ids = [];
                    var product_qtys = [];
                    var _token = $("input[name='_token']").val();
                    var order_id = $("#orderId_for_commition").val();

                    var shipping_charge = $('#shipping_charge').val();
                    $.each($(".item_qty"), function () {
                        product_ids.push($(this).attr('data-item-id'));
                        product_qtys.push($(this).val());
                    });

                    product_ids = product_ids.join(",");
                    product_qtys = product_qtys.join(",");
                    // alert(shipping_charge)


                    $.ajax({
                        type: 'POST',
                        data: {
                            "product_ids": product_ids,
                            "product_qtys": product_qtys,
                            "shipping_charge": shipping_charge,
                            "_token": _token,
                            "order_id": order_id,

                        },
                        url: "{{  route('productSelectionChange')}} ",
                        success: function (result) {

                            $('#product_html').html(result);
                        },
                        error: function (result) {
                            console.log('error')
                            console.log(result)
                        }
                    });
                });


            </script>


            <script>
                $(document).on('change', '#product_ids', function () {
                    var product_ids = [];
                    var product_qtys = [];
                    var _token = $("input[name='_token']").val();
                    var shipping_charge = $('#shipping_charge').val();

                    var order_id = $("#orderId_for_commition").val();
                    $.each($("#product_ids option:selected"), function () {
                        product_ids.push($(this).val());
                    });

                    product_ids = product_ids.join(",");


                    $.ajax({
                        type: "POST",
                        data: {
                            shipping_charge: shipping_charge,
                            product_id: product_ids,
                            product_quantity: 1,
                            _token: _token,
                            order_id: order_id,
                        },

                        url: "{{  route('productSelection')}} ",
                        success: function (result) {
                            $('#product_html').html(result);
                        },
                        errors: function (result) {
                            console.log('error')
                            console.log(result)
                        }

                    });

                });

            </script>

            <script>

                document.forms['product'].elements['order_status'].value = "{{$order->order_status}}";
                document.forms['product'].elements['courier_service'].value = "{{$order->courier_service}}";


            </script>


@endsection


