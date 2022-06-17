@extends('website.master')
@section('mainContent')
<?php

                                            $items = \Cart::getContent();



$indhaka=array();
$outdhaka=array();


$items = \Cart::getContent();
//Cart::clear();
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
$delivery=$indhaka;
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
<div class="container my-3 all-content-hide">
    <form   action="{{url('/chechout')}}" id="checkout" name="checkout" method="post">
        @csrf
    <div class="row">
        <div class="col-md-6 col-12 col-sm-12 col-lg-6 col-xl-6">
            <div class="card">
                <div class="text-start fw-bold ms-3 fs-4"><b>Order Review</b>
                </div>
                <div class="card-body">
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
                                        <th class="name" width="30%">Sub-Total</th>
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
                                            <a href="{{url('/product')}}/{{$name}}">{{ $row->name }}</a>
                                        </td>
                                        <td><?=$sku?></td>
                                        <td>
                                            <div class="quantity-action ">
                                                <div class="col-md-1">
                                                    <span id="quantity_value_{{$row->id}}">	<?php echo $row->quantity;?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>      <span id="per_poduct_price">  @money($row->price)</span>

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
                                        <input type="hidden" class="shipping_charge_in_dhaka" value="<?php if($indhaka=='0'){echo "60"; }else{echo $indhaka;} ?>">
                                        <input type="hidden" class="shipping_charge_out_of_dhaka" value="<?php if($outdhaka=='0'){echo "120"; }else{echo $outdhaka;} ?>">
                                    </tr>



                                    </tbody>
                                </table>

                            </div>



                            <table class="table  text-end table-bordered review_cost">
                                <tbody>


                                <tr >
                                    <td>
                                        <span class="extra bold ">Sub-Total</span>
                                    </td>
                                    <td class="text-end"><span class="bold">Tk <?=$subTotal?></span>
                                        <input type="hidden" id="subtotal_price" value="<?=$subTotal?>">
													</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                                <span class="extra bold">Delivery Cost
                                            </span></td>
                                    <td class="text-end">
                                        <span class="bold">৳  <span id="delivery_cost"> {{$delivery}}</span></span>


                                        <input type="hidden" id="shipping_charge" name="shipping_charge" value="{{$delivery}}">
                                    </td>
                                </tr>

                                <tr class="couponclassHide">
                                    <td>
                                                <span class="extra bold">Coupon Discount
                                            </span></td>
                                    <td class="text-end">
                                        <span class="bold">  <span id="couponDiscountPrice" style="color:red"> </span></span>


                                        <input type="hidden" id="shipping_charge" name="shipping_charge" value="{{$delivery}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="extra bold totalamout">Total</span>
                                    </td>
                                    <td class="text-end">
                                                <span class="bold totalamout">৳  <span id="total_cost">

                                                         {{$total}}
                                                    </span></span>


                                        <input type="hidden" name="payment_type" value="cash_on_delivery">
                                        <input type="hidden"  id="order_total" name="order_total" value="{{$total}}">

                                    </td>
                                </tr>



                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 col-sm-12 col-lg-6 col-xl-6">

            <div class="card ">
                <div class="card-heading text-start fw-bold ms-3 fs-4"><b>Customer Information</b>
                </div>
                <div class="card-body">

                    <div class="checkoutstep mb-3">
                        <div class="form-group">
                            <label for="billing_name"><b>Name</b></label>
                            <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                            <input required="" type="text" id="customer_name" name="customer_name" value="{{$customer_name}}" class="form-control " placeholder="Type Your Name">
                        </div>
                        <div class="form-group">
                            <label for="billing_name"><b>Mobile</b></label>
                            <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                            <input required="" type="number" id="customer_phone" name="customer_phone" value="{{$customer_phone}}" class="form-control " placeholder="Type Your Mobile">
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
                                <option value="">Select Your Area</option>
                                <option value="inside">In Dhaka City</option>
                                <option value="outside">Out Of Dhaka City</option>
                                <option value="office">Office delivery</option>


                            </select>
                        </div>



                        <div class="form-group">
                            <label for="billing_name"><b>Delivery Address</b></label>
                            <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                            <textarea  required=""  name="customer_address"  class="form-control" placeholder="Type Your Address">{{$customer_address}}</textarea>

                        </div>

                        <div class="form-group">
                            <label for="customer_order_note"><b>Order Note</b></label>
                            <textarea    name="customer_order_note"  class="form-control" placeholder="Order Note"></textarea>

                        </div>
                        <div class="form-group row mt-3">
                          <div class="col-lg-3 col-12">
                              <label for="customer_order_note"><b>Coupon Code</b></label>
                          </div>
                            <div class="col-lg-6 col-12">
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Enter Coupon Code" />
                            </div>

                            <div class="col-lg-3 col-12">
                                <button type="button" id="coupon_submit" class="btn btn-success" >Apply Now</button>
                            </div>
                            <input type="hidden" name="affiliate_discount" id="affiliate_discount" >

                        </div>

                        <div class="form-group">

                            <p id="coupon_message"></p>
                        </div>




                    </div>
                    <button type="submit" class="btn btn-info text-white">Confirm Order</button>
                    <a href="{{url('/')}}" style="background-color:#FF6061;border: none" class="btn btn-info text-white">Continue   Shopping</a>

                </div>
            </div>
        </div>



    </div>


    </form>

</div>




<script>
    $(".couponclassHide").hide();

    jQuery('#coupon_submit').on('click', function () {
     let coupon_code=$("#coupon_code").val();
        if(coupon_code ==""){
            alert("Please Enter Coupon Code")
        } else {
            $.ajax({
                url:"{{url('/')}}/checkCouponCode/"+coupon_code,
                success:function (data) {
console.log(data)
                    if(data.dicount){
                        $(".couponclassHide").show();

                        $("#affiliate_discount").val(data.dicount)
                        $("#couponDiscountPrice").text("-"+data.dicount)
                      let order_total=  $("#order_total").val()
                        let finalDiscount=order_total-data.dicount;
                        $("#order_total").val(finalDiscount)
                        jQuery('#total_cost').text(finalDiscount.toFixed(2));
                        $("#coupon_submit").attr('disabled','disabled')


                    } else {
                        $("#affiliate_discount").val("0")

                    }
                    if(data.message_success){
                        $("#coupon_message").html("<strong style='color:green'>"+data.message_success+"</strong>")
                    } else {
                        $("#coupon_message").html("<strong style='color:red'>"+data.message+"</strong>")
                    }


                }
            })
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



        } else if (order_area == 'outside'){


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



        } else {
            var charge = 0;
            jQuery('.shipping_charge_out_of_dhaka').each(function () {
                charge = Number(jQuery(this).val());
            });
            charge = 0;


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
@endsection
