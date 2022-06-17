@extends('website.customer.dashboard')
@section('profile_master')

    <style>
        .cash-on-delevery,
        .online-order {
            background-color:#e91b2a;
            font-size:12px;
            padding:1px 10px;
            border-radius:50px;
            color:#fff;
            margin-left:10px;
            font-weight:700
        }
    </style>


    <div class="row">



            <div class="col-md-12 col-lg-10 col-12  col-xl-10 col-xxl-10  col-sm-12 ">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-8">
                        <h5><b>OrderId:</b> {{$order->order_id}}
                            <small class="cash-on-delevery">Cash On Delevery</small>
                        </h5>
                        <p><b>{{date("M d Y , H:i:s a",strtotime($order->created_time))}}</b></p></div>
                    <div class="col-3 col-lg-4 text-end">
                        {{--<button type="button" class="btn btn-default btn-sm">Cancel Order</button>--}}
                    </div>
                </div>
                <div class="row d-flex justify-content-center ">
                    <div class="col-12 col-md-6 col-lg-6"><h5 class="fw-bold">Ordered From</h5><img
                                src="{{get_option('logo')}}">

                        <address>Office no 1417, Level 13<br> Shah Ali Plaza, Mirpur 10, Dhaka
                            <br>01300884747
                            <br>01300884747<br>
                            support@sohojbuy.com
                        </address>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 "><h5 class="fw-bold">Bills To</h5>
                        <div class="row">

                            <div class="col-9"><h5 class="text-capitalize">{{Session::get('name')}}</h5><h5>{{Session::get('phone')}}</h5>
                                <p>{{Session::get('address')}}</p></div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-12 col-lg-11 col-md-11 mt-3"><h4>Product Description</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr class=" text-center">
                                    <th scope="col">Sl</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" width="25%">Quantity </th>
                                    <th scope="col" width="20%">Amount</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $product_items = unserialize($order->products);
                                $count = 1;
                                $total = 0;

                                foreach ($product_items['items'] as $product_id => $item) {
                                    $totall = intval(preg_replace('/[^\d.]/', '', $item['subtotal']));
                                    $total += $totall ;
                                    $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                                    $product=      single_product_information($product_id);
                                    $sku=$product->sku;
                                    $name=$product->product_name;

                                    ?>


                                <tr class="text-center">
                                    <td>{{$count++}}</td>
                                    <td><img class="img-fluid"
                                             src="{{$featured_image}}"
                                             width="60"></td>
                                    <td>{{$item['name']}}</td>
                                    <td>Tk.{{$item['price']}} X {{$item['qty']}}</td>
                                    <td>Tk.{{$item['subtotal']}}</td>
                                </tr>


                                <?php } ?>
                                <tr  class="text-center">
                                    <td colspan="4" class="text-end">Sub Total Price</td>
                                    <td>Tk. {{$total}}</td>
                                </tr>
                                <tr  class="text-center">
                                    <td colspan="4" class="text-end">Delivery Cost</td>
                                    <td>Tk. {{$order->shipping_charge}}</td>
                                </tr>
                                <tr  class="text-center">
                                    <td colspan="4" class="text-end">Total Paid</td>
                                    <td>Tk. {{$order->advabced_price+$order->bonus_balance}}</td>
                                </tr>
                                <tr  class="text-center">
                                    <td colspan="4" class="text-end">Due</td>
                                    <td>Tk. {{$order->order_total}}</td>
                                </tr>
                                <tr  class="text-center">
                                    <td colspan="4" class="text-end">Status</td>
                                    <td>
                                       @if(($order->order_status =="new") || ($order->order_status =="processing") || ($order->order_status =="phone_pending") || ($order->order_status =="on_courier") || ($order->order_status =="pending_payment"))
                                        <span class="btn btn-danger btn-sm">Unpaid </span>
                                        @else
                                            <span class="btn btn-success btn-sm">Paid</span>

                                        @endif

                                    </td>
                                </tr>
                                <?php if($order->bonus_balance == 0 && $user->bonus_blance > 0) {
                                if(($order->order_status =="new") || ($order->order_status =="processing") || ($order->order_status =="phone_pending") || ($order->order_status =="on_courier") || ($order->order_status =="pending_payment")){


                                ?>
                                <tr>
                                    <td colspan="4" class="text-end">Payment</td>
                                    <td>
                                        <button  id="payment_now" class="btn btn-success btn-sm">Make Payment </button>
                                    </td>
                                </tr>
                                   <?php  }  } else {

                                if($order->advabced_price > 0 ||  $order->order_total !=0 && $user->bonus_blance == 0){

                                   if(($order->order_status =="new") || ($order->order_status =="processing") || ($order->order_status =="phone_pending") || ($order->order_status =="on_courier") || ($order->order_status =="pending_payment")){
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-end">Payment </td>
                                        <td>
                                            <button  id="payment_now_from_bkash" class="btn btn-success btn-sm">Make Payment </button>
                                        </td>
                                    </tr>
                             <?php  } } } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="col-12 col-lg-8 col-md-8 mt-3 form">


                        <form action="{{url('/')}}/customer/orderPayment" method="post">
                            @csrf
                            <h2 style="color:green">{{Session::get('success')}}</h2>
                            <h2 style="color:red">{{Session::get('error')}}</h2>

                            <fieldset id="payment_form_section" >
                                <?php

                                $offer=get_option('bonus');
                                $userCanExpend=(($total*$offer)/100);
                                ?>
                                <legend>My Bonus={{$user->bonus_blance}} Tk</legend>
                                <legend>Maximum payment with bonus={{$userCanExpend}} Tk</legend>

                                <input type="hidden" name="total_order" value="{{$total}}">
                                <input type="hidden" name="order_id" value="{{$order->order_id}}">
                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Pay With</label>
                                    <select   class="form-select" name="payment" id="payment">
                                        <option value="">Select</option>
                                        <option value="bonus">Bonus</option>
                                        {{--<option value="wallet">Wallet</option>--}}
                                    </select>

                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </fieldset>
                        </form>

                        <form action="{{url('/')}}/customer/orderPayByMethod" method="post">
                            @csrf

                            <fieldset id="payment_form_section_from_bkash" >



                                <input type="hidden" name="total_order" value="{{$order->order_total}}">
                                <input type="hidden" name="order_id" value="{{$order->order_id}}">

                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Pay With</label>
                                    <select   class="form-select"  required name="payment_method" id="payment_method">
                                        <option value="">Select</option>
                                        <option value="bkash">Bkash</option>
                                        {{--<option value="wallet">Wallet</option>--}}

                                    </select>
                                </div>



                                <div class="mb-3">
                                    <p>To confirm your order please make {{$order->order_total}} taka advance payment by bKash and provide the Transaction  Id and Amount. bKash number 01300884747 (Merchant)
                                    </p>

                                 </div>
                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Amount</label>
                                    <input type="number" name="advabced_price"  class="form-control" required placeholder="Enter Your Amount">
                                </div>

                                <div class="mb-3">
                                    <label for="disabledSelect" class="form-label">Transaction Id</label>
                                    <input type="text" name="transaction_id"  class="form-control" required placeholder="Enter Your Transaction Id">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </fieldset>
                        </form>

                     </div>



                </div>
            </div>


    </div>

    <script>

        $("#payment_form_section").hide();
        $("#payment_form_section_from_bkash").hide();
        $("#payment_now").click(function () {

            $("#payment_form_section").show();


        })
        $("#payment_now_from_bkash").click(function () {

            $("#payment_form_section_from_bkash").show();


        })

//        $("#payment").change(function () {
//            let paymentMethod=$(this).val();
//        alert(paymentMethod)
//
//
//
//        })

    </script>

@endsection