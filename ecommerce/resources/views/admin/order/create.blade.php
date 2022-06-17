@extends('layouts.master')
@section('pageTitle')
Add New Order

@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">


            <form name="product" action="{{ url('admin/order/store') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color: #ddd;">
                                    <h3 class="box-title">Customer Information</h3>

                                </div>
                                <div class="box-body">

                                    <div class="order_data" id="customer_info_change"
                                         style="padding: 18px;">

                                        <div class="form-group ">
                                            <label for="billing_name">Name </label>


                                            <input required class="form-control" type="text" name="customer_name"
                                                   value=" "/>
                                        </div>


                                        <div class="form-group ">
                                            <label for="billing_email">Email</label>


                                            <input type="email" class="form-control" name="customer_email"
                                                   value=""/>
                                        </div>


                                        <div class="form-group ">
                                            <label for="billing_email">Customer Phone</label>
                                            <input required type="text" name="customer_phone" class="form-control"
                                                   value=""/>
                                        </div>


                                        <div class="form-group shipping-address-group ">
                                            <label for="shipping_address1">Customer Address </label>
                                                <textarea required class="form-control" rows="2" name="customer_address"
                                                          id="shipping_address1"></textarea>
                                        </div>

                                        <div class="form-group ">
                                            <label for="billing_email">Affiliate ID </label>
                                            <input required type="text" name="user_id" class="form-control"    value=""/>
                                        </div>




                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="box box-danger" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color:#ddd">
                                    <h3 class="box-title">Actions</h3>
                                </div>
                                <div class="box-body">

                                    <div class="form-group" style="padding: 12px;">
                                        <label>Courier Service</label>
                                        <select name="courier_service" id="courier_service"
                                                class="form-control select2">
                                            <option value="">Select Courier</option>
                                            @foreach($couriers as $courier):

                                            <option value="{{ $courier->courier_id }}">{{ $courier->courier_name }} <?php if ($courier->courier_status == 1) {
                                                    echo " -Inside Dhaka";
                                                } else {
                                                    echo " -Outside Dhaka";
                                                }?></option>
                                            @endforeach

                                        </select>
                                    </div>


                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label>Shipping Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>

                                            <input type="text" name="shipment_time"
                                                   class="form-control pull-right withoutFixedDate"
                                                   value="">
                                        </div>
                                    </div>


                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label>Order Status</label>


                                        <select name="order_status" id="order_status" class="form-control">
                                            <option value="new">New</option>
                                            <option value="pending_payment">Pending for Payment</option>
                                            <option value="processing">On Process</option>
                                            <option value="on_courier">With Courier</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="refund">Refunded</option>
                                            <option value="cancled">Cancelled</option>
                                            <?php
                                            $admin_user=Session::get('status');
                                            if($admin_user !='editor' && $admin_user !='office-staff') {
                                            ?>

                                            <option value="completed">Completed {{ $admin_user}}</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label> Order Note</label>


                                            <textarea rows="3" class="form-control"
                                                      name="order_note"></textarea>

                                    </div>



                            </div>
                        </div>

                    </div>


                    </div>

                    <div class="row">



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
                                   <th class="price text-center" width="10%">Price</th>
                                   <th class="total text-right" width="10%">Sub-Total</th>
                               </tr>

                               <tr>


                           </table>

                           </span>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="product_ids" id="product_ids" class="form-control select2"
                                                        multiple="multiple"
                                                        data-placeholder="Type... product name here..."
                                                        style="width:100%;">

                                                    <?php foreach($products as $product) :

                                                    $product_title=substr($product->product_title,0,50)


                                                    ?>
                                                    <option value="{{$product->product_id}}"



                                                    >{{$product_title}} - {{$product->sku}}</option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>


                    </div>




                </div>



            </form>

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

                    var shipping_charge= $('#shipping_charge').val();
                    $.each($(".item_qty"), function () {
                        product_ids.push($(this).attr('data-item-id'));
                        product_qtys.push($(this).val());
                    });

                    product_ids = product_ids.join(",");
                    product_qtys = product_qtys.join(",");
                    //alert(_token)


                    $.ajax({
                        type: 'POST',
                        data: {
                            "product_ids": product_ids,
                            "product_qtys": product_qtys,
                            "shipping_charge":shipping_charge,
                            "_token":_token

                        },
                        url: "{{  route('newProductUpdateChange')}} ",
                        success: function (result) {
                            //  alert('success');
                            console.log('success')
                            //var response = JSON.parse(result);

                            console.log(result)
                            $('#product_html').html(result);
                        },
                        error:function (result) {
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
                    var shipping_charge= $('#shipping_charge').val();


                    $.each($("#product_ids option:selected"), function () {
                        product_ids.push($(this).val());
                    });

                    product_ids = product_ids.join(",");


                    $.ajax({
                        type: "POST",
                        data: {shipping_charge:shipping_charge,product_id: product_ids, product_quantity: 1,_token:_token},

                        url: "{{  route('newProductSelectionChange')}} ",
                        success: function (result) {

                            //  alert('success');
                            console.log('success')
                            //var response = JSON.parse(result);

                            console.log(result)
                            $('#product_html').html(result);
                        },
                        errors: function (result) {
                            console.log('error')
                            console.log(result)
                        }

                    });

                });

            </script>





@endsection


