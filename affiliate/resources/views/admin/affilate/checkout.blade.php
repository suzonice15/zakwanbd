@extends('layouts.master')
@section('pageTitle')
   Check Out
@endsection
@section('mainContent')
    <div class="box-body">
        <?php
        $indhaka=array();
        $outdhaka=array();
        $items = \Cart::getContent();
        $count=0;
        $delivery =0;
        foreach($items as $row) {
              $row->id;
          $product_delevery=  DB::table('product')->select('delivery_in_dhaka','delivery_out_dhaka')->where('product_id', $row->id)->first();
            $indhaka[]=$product_delevery->delivery_in_dhaka;
            $outdhaka[]=$product_delevery->delivery_out_dhaka;
            ++$count;
        }
        $indhaka= max($indhaka);
        $delivery= $indhaka;
        $outdhaka= max($outdhaka);
        $customer_name='';
        $customer_phone='';
        $customer_address='';
        $customer_email='';
        if(Session::get('name')){
            $customer_name=Session::get('name');
        }
        if(Session::get('address')){
            $customer_address=Session::get('address');
        }
        if(Session::get('phone')){
            $customer_phone=Session::get('phone');
        }
        if(Session::get('email')){
            $customer_email=Session::get('email');
        }
        ?>
        <br/>
        <div class="container-fluid">
            <div class="row">
                <?php
                if ( !Cart::isEmpty()){
                ?>
                <form style="z-index: 10000000000" action="{{url('/checkout')}}" id="checkout" name="checkout" method="post">
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
                                                $items = \Cart::getContent();
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
                                            <?php
                                                if($bonus_info){
                                                    $userBonusAmount=$bonus_amount_info->bonus_balance;
                                                    $per=($subTotal*$bonus_info->offer)/100;
                                                    $am=($per-$userBonusAmount);
                                                    if($userBonusAmount!=0){
                                                    if($am>=0){
                                                      $percent=$userBonusAmount;  
                                                    }else{
                                                        $percent=$per;
                                                    }
                                            ?>
                                            <tr style="display: none;" class="bonusTr" id="bonusTr">
                                                <td>
                                                <span class="extra bold">Bonus Amount
                                            </span></td>
                                                <td class="text-right">
                                                    <span class="bold">-৳  <span id=""> {{$percent}}</span></span>
                                                    <input type="hidden" class="bonusAmountDec" name="bonusAmountDec" value="{{$percent}}">
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                }
                                            ?>

                                            <?php
                                                if($cashback_info){
                                                    $userCashbackAmount=$cashback_amount_info->cash_back;
                                                    $per=($subTotal*$cashback_info->offer)/100;
                                                    $am=($per-$userCashbackAmount);
                                                    if($userCashbackAmount!=0){
                                                    if($am>=0){
                                                      $percent=$userCashbackAmount;  
                                                    }else{
                                                        $percent=$per;
                                                    }
                                            ?>
                                            <tr style="display: none;" class="cashbackTr" id="cashbackTr">
                                                <td>
                                                <span class="extra bold">Cashback Amount
                                            </span></td>
                                                <td class="text-right">
                                                    <span class="bold">-৳  <span id=""> {{$percent}}</span></span>
                                                    <input type="hidden" class="cashbackAmountDec" name="cashbackAmountDec" value="{{$percent}}">
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                }
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="extra bold totalamout">Total</span>
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
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 ">

                        <div class="panel panel-primary">
                            <div class="panel-heading"><b>Customer Information</b>
                            </div>
                            <div class="panel-body">


                                <div class="checkoutstep">
                                    <div class="form-group">
                                        <label for="billing_name"><b>Name</b></label>
                                        <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                                        <input required="" type="text" id="customer_name" name="customer_name" value="{{$customer_name}}" class="form-control " placeholder="Type Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_name"><b>Mobile</b></label>
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

                                    <?php
                                        if ($bonus_info && $cashback_info && $bonus_amount_info->bonus_balance !='0' && $cashback_amount_info->cash_back !='0') {
                                    ?>
                                    <div class="form-group">
                                        <label for=""><b>Pay With</b></label>
                                        <select  name="payWith" id="citypay" class="form-control">
                                            <option value="">Pay With</option>
                                            <option value="bonus">Bonus</option>
                                            <option value="cashback">Cashback</option>

                                        </select>
                                    </div>
                                    <?php
                                        }else if($cashback_info && $cashback_amount_info->cash_back !='0') {
                                    ?>

                                    <div class="form-group">
                                        <label for=""><b>Pay With</b></label>
                                        <select    name="payWith" id="citypay" class="form-control">
                                            <option value="">Pay With</option>
                                            <option value="cashback">Cashback</option>

                                        </select>
                                    </div>
                                    <?php
                                        }else if($bonus_info && $bonus_amount_info->bonus_balance !='0') {
                                    ?>

                                    
                                    <div class="form-group">
                                        <label for=""><b>Pay With</b></label>
                                        <select    name="payWith" id="citypay" class="form-control">
                                            <option value="">Pay With</option>
                                            <option value="bonus">Bonus</option>
                                        </select>
                                    </div>
                                    <?php
                                        }
                                    ?>


                                    <div class="form-group">
                                        <label for="billing_name"><b>Delivery Address</b></label>
                                        <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                                        <textarea  id="customer_address" name="customer_address"  class="form-control" placeholder="Type Your Address">{{$customer_address}}</textarea>

                                    </div>

                                    <div class="form-group">
                                        <label for="billing_name"><b>Order Note</b></label>
                                        <textarea     name="affiliate_order_note"  class="form-control" placeholder="Order Note"></textarea>
                                    </div>



                                </div>
                                <button type="button"  id="order_submit_button" class="btn btn-info">Confirm Order</button>
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
                var order_id = jQuery('#order_id').val();

                if (!/^01\d{9}$/.test(customer_phone)) {
                    jQuery('#customer_phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
                } else {
                    jQuery('#customer_phone_error').text(" ");

                }

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

