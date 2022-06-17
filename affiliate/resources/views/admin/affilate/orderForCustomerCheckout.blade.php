@extends('layouts.master')
@section('pageTitle')
   Checkout page
@endsection
@section('mainContent')
    <div class="box-body">

        <?php
        $indhaka=get_option('shipping_charge_in_dhaka');
        $outdhaka=get_option('shipping_charge_out_of_dhaka');
        $delivery=$indhaka;

        $items = \Cart::getContent();
        //Cart::clear();
        $count=0;
        foreach($items as $row) {

            ++$count;
        }

        if($count > 2){
            $indhaka=0;
            $outdhaka=0;
            $delivery=$indhaka;
        }

        $customer_name='';
        $customer_phone='';
        $customer_address='';
        $customer_email='';



        ?>
        <br/>
        <div class="container-fluid">

            <div class="row">
                <?php
                if ( !Cart::isEmpty()){
                ?>
                <form style="z-index: 10000000000" action="{{url('/orderCustomer/checkout')}}" id="checkout" name="checkout" method="post">
                    @csrf
                    <div class="col-md-6">

                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Order Review</b>
                            </div>

                            <div class="panel-body">

                                <div class="checkoutstep">
                                    <div class="cart-info">
                                        <div class="table-responsive">
                                            <table class="table  table-bordered">
                                                <tbody>
                                                <tr>
                                                    <th class="name" width="29%">Products</th>
                                                    <th class="name" width="10%">Product Code</th>
                                                    <th class="name" width="1%">Qnt</th>
                                                    <th class="name" width="30%">Price</th>
                                                    <th class="name" width="15%">Cash Back</th>
                                                    <th class="name" width="15%">Sub-Total</th>
                                                </tr>
                                                <?php



                                                $affilate_id=Session::get('id');

                                                $total_affilite_order = DB::table('order_data')
                                                        ->select('order_id')
                                                        ->where('order_status', '=','completed')
                                                        ->where(function ($query) use ($affilate_id) {
                                                            return $query->where('user_id', $affilate_id);
                                                        })->count();
                                                // check commision
                                                $totalCommision=0;

                                                if($total_affilite_order >-1 && $total_affilite_order <=9){

                                                    $commistion=3;
                                                } else if($total_affilite_order >=10 && $total_affilite_order <=19) {
                                                    $commistion=4;
                                                } else if($total_affilite_order >=20 && $total_affilite_order <=29) {
                                                    $commistion=5;
                                                } else if($total_affilite_order >=30 && $total_affilite_order <=39) {
                                                    $commistion=6;
                                                } else if($total_affilite_order >=40 && $total_affilite_order <=49) {
                                                    $commistion=7;
                                                } else if($total_affilite_order >=50 && $total_affilite_order <=59) {
                                                    $commistion=8;
                                                }else  {
                                                    $commistion=8;
                                                }

                                                $items = \Cart::getContent();
                                                     //   print_r($items);exit();
                                                //Cart::clear();
                                                foreach($items as $row) {

                                                $subTotal = \Cart::getSubTotal();
                                                $total = \Cart::getTotal();
                                                $subTotal_price=$row->price*$row->quantity;
                                                $imagee=$row->attributes['picture'];
                                                $product_id=$row->id;
                                                $total +=$delivery;

                                                $product=single_product_information($product_id);
                                                $sku=$product->sku;
                                                $name=$product->product_name;




                                                $hotdeal_commision=DB::table('product')->select('top_deal')
                                                        ->where('product_id',$product_id)
                                                        ->first();
                                                if($hotdeal_commision->top_deal >0){
                                                    $commision_price=$hotdeal_commision->top_deal*$row->quantity;
                                                    $totalCommision += $commision_price;

                                                    $hotdeal="hot deal";
                                                } else {

                                                    /* vendor product commistion distribution */
                                                    $vendorProductCheck=DB::table('product')
                                                            ->select('product_profite','vendor_id')
                                                            ->where('product_id', $product_id)
                                                            ->first();
                                                    if($vendorProductCheck->vendor_id >0){
                                                        $commision_price= $vendorProductCheck->product_profite/2;

                                                        $totalCommision +=$commision_price;
                                                    } else {

                                                        $commision_price=($commistion*$row->quantity*$row->price)/100;
                                                        $totalCommision +=$commision_price;

                                                    }

                                                    $hotdeal="";

                                                }




                                                ?>

                                                <tr id="{{ $row->id }}">
                                                    <td>
                                                        <img src="<?=$imagee?>"
                                                             width="30">

                                                        <a href="{{ env('APP_ECOMMERCE') }}product/{{$name}}">{{ $row->name }}</a>
                                                    </td>
                                                    <td><?=$sku?></td>

                                                    <td>
                                                        <div class="quantity-action ">

                                                            <div class="col-md-1">
                                                                <span id="quantity_value_{{$row->id}}">	<?php echo $row->quantity;?></span>
                                                            </div>



                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span id="per_poduct_price">  @money($row->price)</span>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        // echo $product_id;
                                                        $cashBack=DB::table('product')
                                                                ->where('product_id',$product_id)
                                                                ->first();
                                                        if ($cashBack->cash_back==0) {
                                                            echo '0';
                                                        }else{
                                                        $priceQun=($row->price*$row->quantity);
                                                        $percentage = ( $priceQun / 100 ) * $cashBack->cash_back;
                                                        echo $percentage;
                                                        ?>
                                                        <input type="hidden" name="cash_back" value="<?php echo $percentage; ?>">
                                                        <?php
                                                        }
                                                        ?>

                                                    </td>
                                                    <td>
												<span id="per_poduct_total_price_181">

                                                @money($subTotal_price)
                                                </span>

                                                    </td>
                                                    <input type="hidden" name="product_id[]" value="<?=$product_id?>">
                                                    <input type="hidden" name="products[items][<?=$product_id?>][featured_image]" value="<?=$imagee?>">
                                                    <input type="hidden" id="product_quantity" name="products[items][<?=$product_id?>][qty]" value="<?php echo $row->quantity;?>">
                                                    <input type="hidden" id="product_price" name="products[items][<?=$product_id?>][price]" value="<?php echo $row->price;?>">
                                                    <input type="hidden" name="products[items][<?=$product_id?>][subtotal]" value="<?=$subTotal_price?>">
                                                    <input type="hidden" name="products[items][<?=$product_id?>][name]" value="<?php echo $row->name;?>">


                                                </tr>

                                                <?php } ?>


                                                <tr>
                                                    <input type="hidden" class="shipping_charge_in_dhaka" value="<?=$indhaka?>">
                                                    <input type="hidden" class="shipping_charge_out_of_dhaka" value="<?=$outdhaka?>">
                                                    <input type="hidden" class="shipping_charge_virtual_product" value="0">
                                                </tr>



                                                </tbody>
                                            </table>

                                        </div>



                                        <table class="table  table-bordered review_cost">
                                            <tbody>


                                            <tr>
                                                <td>
                                                    <span class="extra bold">Sub-Total</span>
                                                </td>
                                                <td class="text-right">
													<span class="bold">

														<span id="subtotal_cost"> @money($subTotal)



                                                        </span>


													</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                <span class="extra bold">Delivery Cost
                                            </span></td>
                                                <td class="text-right">
                                                    <span class="bold">৳  <span id="delivery_cost"> {{$delivery}}</span></span>


                                                    <input type="hidden" id="shipping_charge" name="shipping_charge" value="{{$delivery}}">
                                                </td>
                                            </tr>



                                            <tr>
                                                <td>
                                                    <span class="extra bold totalamout">Total </span>
                                                </td>
                                                <td class="text-right">
                                                <span class="bold totalamout">৳  <span id="total_cost">
                                                    {{$total}}
                                                    </span></span>
                                                    <input type="hidden"  id="order_total" name="order_total" value="{{$total}}">
                                                    <input type="hidden" id="subtotal_price" value=" <?=$subTotal?>">
                                                    <input type="hidden" name="payment_type" value="cash_on_delivery">
                                                </td>
                                            </tr>

                                            <tr>

                                  </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 ">

                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Customer Information </b>
                            </div>
                            <div class="panel-body">
                                <div class="checkoutstep">
                                    <div class="form-group">
                                        <label for="billing_name"><b>Name</b></label>
                                        <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                                        <input required="" type="text" id="customer_name" name="customer_name" value="{{$customer_name}}" class="form-control " placeholder="Type Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_name"><b>Mobile </b></label>
                                        <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                                        <input required="" type="text" id="customer_phone" name="customer_phone" value="{{$customer_phone}}" class="form-control " placeholder="Type Your Mobile">
                                        <p id="customer_phone_error" class="text-danger"></p>
                                    </div>
                                    <div class="form-group" >
                                        <label for="billing_name"><b>Email</b></label>

                                        <input type="text" name="customer_email" id="customer_email" value="{{$customer_email}}" class="form-control " placeholder="Email">
                                        <p id="customer_email_error" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_name"><b>Location</b></label>
                                        <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                                        <select required=""  name="order_area" id="city" class="form-control">
                                            <option value="">Select Delivery Area</option>
                                            <option value="inside">In Dhaka City</option>
                                            <option value="outside">Out Of Dhaka City</option>
                                            <option value="virtual">Virtual Product</option>
                                            <option value="office">Office delivery</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="billing_name"><b>Wallet</b>(<span id="total_wallet">{{$wallet_blance}}</span>)<span id="wallet_message"></span></label>
                                        <input type="hidden" name="wallet_amount" id="wallet_amount" value="{{$wallet_blance}}">
                                        <input type="hidden" name="advabced_price" id="advabced_price" value="">
                                        <select   name="order_wallet" id="order_wallet" class="form-control">
                                            <option value="">Select Wallet </option>
                                            <option value="product">Product Price</option>
                                            <option value="charge">Delivery Charge</option>

                                        </select>
                                    </div>




                                    <div class="form-group">
                                        <label for="billing_name"><b>Delivery Address</b></label>
                                        <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                                        <textarea  required=""  name="customer_address"  class="form-control" placeholder="Type Your Address">{{$customer_address}}</textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="billing_name"><b>Order Note </b></label>

                                        <textarea     name="affiliate_order_note"  class="form-control" placeholder="Order Note"></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="billing_name"> Discount </label>

                                        <input  type="text" id="affiliate_discount" name="affiliate_discount" value="0" class="form-control " placeholder="If you want to give discount">

                                        <input  type="hidden" id="total_commision"   value="{{$totalCommision}}" class="form-control " placeholder="If you want to give discount">

                                    </div>
                                    <div class="form-group">
                                        <label for="billing_name"><b>Your Affiliate Income</b></label>
                                        <span style="color:green;font-size: 18px;margin-left:5px;position: absolute;">  <span id="total_commision_show"> {{$totalCommision}} </span> Taka</span>

                                    </div>



                                </div>
                                <button type="button" id="order_submit_button" class="btn btn-info">Confirm Order</button>
                                <a href="{{url('/')}}/admin/affilite/buy_products" style="background-color:#FF6061;border: none" class="btn btn-info">Continue   Shopping</a>

                            </div>
                        </div>
                    </div>


                </form>
                <?php } else { ?>
                <div class="col-md-12 text-center"><a href="{{ url('/') }}"><img style="margin-bottom: -68px"
                                                                                 src="{{ env('APP_ECOMMERCE') }}public/uploads/stop.png"/></a>
                </div>
                <div class="col-md-12 mt-5 text-center">


                    <br/>
                    <br/>
                    <br/>
                    <h1 class="text-danger text-center text-capitalize">You have no product in your cart.
                    </h1>
                    <a class="text-center text-capitalize btn btn-info" href="{{ url('/admin/affilite/buy_products') }}"> Buy Continue</a>
                </div>
                <?php } ?>
            </div>




        </div>

        <script>


            $("body").on('click', '#order_submit_button', function () {
                var customer_name= $("#customer_name").val();
                var customer_phone= $("#customer_phone").val();
                var customer_address= $("#customer_address").val();
                var city= $("#city").val();
                if(city ==''){
                    alert("Please   Enter Your Location")
                    return false
                }

                if(customer_name ==''){
                    alert("Please   Enter Your Name")
                    return false
                }
                if(customer_phone =='' ){
                    // $("#discount_price").val(0);
                    alert("Please   Enter Your Phone")
                    return false
                }

                if(customer_address =='' ){
                    //  $("#shipping_charge").val(0);
                    alert("Please Enter   Your Addrees ")
                    return false

                }
                $("#order_submit_button").attr('disabled','disabled');

                $("#checkout").submit()

            });


            jQuery('#affiliate_discount').on('input', function () {
                var affiliate_discount = jQuery('#affiliate_discount').val();
                var total_commision = jQuery('#total_commision').val();
                if (affiliate_discount >= 0){
                    if(affiliate_discount ==''){
                        affiliate_discount=0
                    } else {
                        var affiliate_discount = jQuery('#affiliate_discount').val();
                    }
                    var total_commision = jQuery('#total_commision').val();
                var final_affiliate_commision = parseFloat(total_commision) - parseFloat(affiliate_discount);
                jQuery('#total_commision_show').text(final_affiliate_commision);
                    var subtotal_price = jQuery('#subtotal_price').val();
                    var shipping_charge = jQuery('#shipping_charge').val();
                   var final_total_commision=parseFloat(shipping_charge) +parseFloat(subtotal_price) - parseFloat(affiliate_discount);
                    jQuery('#total_cost').text(final_total_commision);
                   jQuery('#order_total').val(final_total_commision);
                }
            })
            jQuery('#order_wallet').on('change blur', function () {
                var order_wallet = jQuery(this).children("option:selected").val();
                var wallet_amount = jQuery("#wallet_amount").val();
                  wallet_amount = parseInt(wallet_amount);
                var total_wallet = jQuery("#total_wallet").text();
               var shipping_charge= jQuery('#shipping_charge').val();
                var subtotal_price = jQuery("#subtotal_price").val();
                  total_wallet = parseInt(total_wallet);
                var city = jQuery("#city").val();
                if(city ==''){
                    $("#wallet_message").html("<b><span style='color:red;margin-left:5px'>Please Select Your location</span></b>")
                      return false
                    jQuery("#advabced_price").val("");
                }
                $("#wallet_message").html("")
                //product login
                if(order_wallet=='product'){
                    var totalPayablePrice=parseInt(shipping_charge)+parseInt(subtotal_price);
                    if(totalPayablePrice > wallet_amount){
                        $("#wallet_message").html("<b><span style='color:red;margin-left:5px'>Your Wallet Blance is low please recharge</span></b>")
                        jQuery("#advabced_price").val("");
                        return false
                    } else {
                        var afterPaymentWallet=wallet_amount-totalPayablePrice;
                        var str1 = " Advanced Payment ";
                        var str2 = totalPayablePrice;
                        var str3 = " Taka";
                        var res1 = str1.concat(str2);
                        var res = res1.concat(str3);
                        document.getElementById("wallet_message").innerText = res;
                        document.getElementById("wallet_message").style = "color:green";

                        jQuery("#total_wallet").text(afterPaymentWallet);
                         jQuery("#advabced_price").val(totalPayablePrice);

                    }

                } else if(order_wallet=='charge') {

                    var totalPayablePrice=parseInt(shipping_charge);
                    if(totalPayablePrice > wallet_amount){
                        $("#wallet_message").html("<b><span style='color:red;margin-left:5px'>Your Wallet Blance is low please recharge</span></b>")
                        jQuery("#advabced_price").val("");
                        return false

                    } else {
                        var afterPaymentWallet=wallet_amount-totalPayablePrice;
                        var str1 = " Advanced Payment ";
                        var str2 = totalPayablePrice;
                        var str3 = " Taka";
                        var res1 = str1.concat(str2);
                        var res = res1.concat(str3);
                        document.getElementById("wallet_message").innerText = res;
                        document.getElementById("wallet_message").style = "color:green";
                        jQuery("#total_wallet").text(afterPaymentWallet);
                        jQuery("#advabced_price").val(totalPayablePrice);
                    }
                }

                else {

                    var totalPayablePrice=parseInt(shipping_charge);
                    if(totalPayablePrice > wallet_amount){
                        $("#wallet_message").html("")
                        jQuery("#advabced_price").val("");
                        return false

                    } else {
                        var afterPaymentWallet=wallet_amount-totalPayablePrice;
                        var str1 = " Advanced Payment ";
                        var str2 = totalPayablePrice;
                        var str3 = " Taka";
                        var res1 = str1.concat(str2);
                        var res = res1.concat(str3);
                        document.getElementById("wallet_message").innerText = "";
                        document.getElementById("wallet_message").style = "color:green";

                        jQuery("#advabced_price").val("");
                    }
                }

                if(city.length==0){
                    jQuery('#city_eroor').text('Please select your city ');
                } else {
                    jQuery('#city_eroor').text('');
                }

            });


            jQuery('#city').on('change blur', function () {
                var order_area = jQuery(this).children("option:selected").val();
                if(city.length==0){
                    jQuery('#city_eroor').text('Please select your city ');
                } else {
                    jQuery('#city_eroor').text('');

                }
                if (order_area == 'inside') {
                    $('#citypay').val(null).trigger('change');
                    jQuery('#bonusTr').hide();
                    jQuery('#cashbackTr').hide();
                    var charge = 0;
                    jQuery('.shipping_charge_in_dhaka').each(function () {
                        charge = Number(jQuery(this).val());
                    });
                    var total_cost = jQuery('#subtotal_price').val();
                    var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
                    jQuery('#delivery_cost').text(charge);
                    jQuery('#total_cost').text(total.toFixed(2));
                    jQuery('input[name=order_total]').val(total);
                    jQuery('#shipping_charge').val(charge);
                } else if (order_area == 'outside') {
                    $('#citypay').val(null).trigger('change');
                    jQuery('#bonusTr').hide();
                    jQuery('#cashbackTr').hide();
                    var charge = 0;
                    jQuery('.shipping_charge_out_of_dhaka').each(function () {
                        charge = Number(jQuery(this).val());
                    });
                    var total_cost = jQuery('#subtotal_price').val();
                    var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
                    jQuery('#delivery_cost').text(charge);
                    jQuery('#total_cost').text(total.toFixed(2));
                    jQuery('input[name=order_total]').val(total);
                    jQuery('#shipping_charge').val(charge);
                }else{
                    $('#citypay').val(null).trigger('change');
                    jQuery('#bonusTr').hide();
                    jQuery('#cashbackTr').hide();
                    var charge = 0;
                    jQuery('.shipping_charge_virtual_product').each(function () {
                        charge = Number(jQuery(this).val());
                    });
                    var total_cost = jQuery('#subtotal_price').val();
                    var total = parseFloat(charge) + parseFloat(total_cost.replace(/,/g, ''));
                    jQuery('#delivery_cost').text(charge);
                    jQuery('#total_cost').text(total.toFixed(2));
                    jQuery('input[name=order_total]').val(total);
                    jQuery('#shipping_charge').val(charge);
                }

            });

        </script>

        <script>




            jQuery('#citypay').on('change blur', function () {
                var payWith = jQuery(this).children("option:selected").val();
                if(payWith.length==0){
                    var total_cost = jQuery('#subtotal_price').val();
                    var shipping_charge = jQuery('#shipping_charge').val();
                    var total = parseFloat(shipping_charge) + parseFloat(total_cost.replace(/,/g, ''));
                    jQuery('#total_cost').text(total.toFixed(2));
                    jQuery('input[name=order_total]').val(total);
                    jQuery('#bonusTr').hide();
                    jQuery('#cashbackTr').hide();
                } else {
                    jQuery('#city_eroor').text('');

                }
                if (payWith == 'bonus') {
                    var charge = 0;
                    jQuery('.bonusAmountDec').each(function () {
                        charge = Number(jQuery(this).val());
                    });
                    var total_cost = jQuery('#subtotal_price').val();
                    var shipping_charge = jQuery('#shipping_charge').val();
                    var total1 =parseFloat(total_cost.replace(/,/g, '')- parseFloat(charge));
                    var total=total1+parseFloat(shipping_charge);
                    jQuery('#total_cost').text(total.toFixed(2));
                    jQuery('input[name=order_total]').val(total);
                    jQuery('#bonusTr').show();
                    jQuery('#cashbackTr').hide();
                } else if (payWith == 'cashback'){
                    var charge = 0;
                    jQuery('.cashbackAmountDec').each(function () {
                        charge = Number(jQuery(this).val());
                    });
                    console.log(charge);
                    var total_cost = jQuery('#subtotal_price').val();
                    console.log(total_cost);
                    var shipping_charge = jQuery('#shipping_charge').val();
                    console.log(shipping_charge);
                    var total1 = parseFloat(total_cost.replace(/,/g, '')- parseFloat(charge));
                    var total=total1+parseFloat(shipping_charge);
                    jQuery('#total_cost').text(total.toFixed(2));
                    jQuery('input[name=order_total]').val(total);
                    jQuery('#cashbackTr').show();
                    jQuery('#bonusTr').hide();
                }

            });

        </script>

        <script>

            jQuery('form#checkout #customer_phone').on('blur', function () {

                var customer_phone= jQuery('#customer_phone').val();


                if (!/^01\d{9}$/.test(customer_phone)) {
                    jQuery('#customer_phone_error').html("<b>Invalid phone number: must have exactly 11 digits and begin with </b>");
                } else {
                    jQuery('#customer_phone_error').text(" ");

                }

                $.ajax({
                    url:"{{url('/')}}/user/affilite/check/"+customer_phone,
                    success:function(data){
                       if(data.result==true){

                       } else {
                           jQuery('#customer_phone_error').html("<b>This Phone Number Already registered by Another Affilate</b>");

                       }
                    }

                })

            });


        </script>


        <script>
            jQuery('#customer_email').blur(function () {
                var error_email = '';
                var email = jQuery('#customer_email').val();
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!filter.test(email)) {
                    jQuery('#customer_email_error').html('<label class="text-danger">email address format is not correct</label>');


                } else {
                    jQuery('#customer_email_error').html('');

                }
            });
        </script>

    </div>




@endsection

