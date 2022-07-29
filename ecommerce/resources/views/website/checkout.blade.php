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
        
        <div class="col-md-7 col-12 col-sm-12 col-lg-7 col-xl-7">
            <div class="card">
                <div style="background:black;" class="text-start fw-bold   fs-4"><p class='text-center text-white'>Order Review</p>
                </div>
                <div class="card-body">
                    <div class="checkoutstep">
                        <div class="cart-info">
                            <div class="table-responsive">
                                <table class="table  table-bordered">
                                    <tbody>
                                    <tr>
                                        <th class="name"  class='text-center' width="20%">Picture</th>
                                        <th class="name"  class='text-center' width="30%">Products</th>
                                        <th class="name"  class='text-center' width="10%">Code</th>
                                        <th class="name"  class='text-center' width="1%">Qnt</th>
                                        <th class="name"  class='text-center' width="20%">Price</th>
                                        <th class="name"  class='text-center' width="20%">Sub-Total</th>
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
                                                 style="width:100%">
                                           
                                        </td>
                                        <td>
                                            
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
                                        <td  class='text-center'>      <span id="per_poduct_price">  @money($row->price)</span>

                                        </td>
                                        <td class='text-center'>
                                            <span id="per_poduct_total_price_181">@money($subTotal_price)</span>
                                        </td>
                                        <input type="hidden" name="product_id[]" value="<?php echo $product_id?>">
                                        <input type="hidden" name="products[<?php echo $product_id?>]"  value="<?=$row->quantity?>">
                                        <input type="hidden" name="price[<?php echo $product_id?>]" value="<?=$row->price?>">                                        
                                    </tr>

                                    <?php } ?>
                                    <tr>
                                        <input type="hidden" class="shipping_charge_in_dhaka" value="<?php if($indhaka=='0'){echo "60"; }else{echo $indhaka;} ?>">
                                        <input type="hidden" class="shipping_charge_out_of_dhaka" value="<?php if($outdhaka=='0'){echo "120"; }else{echo $outdhaka;} ?>">
                                    </tr>
                                    <tr >
                                    <td colspan="5" class='text-end'>
                                        <span class="extra bold ">Sub-Total</span>
                                    </td>
                                    <td class="text-center"><span class="bold">Tk <?=$subTotal?></span>
                                        <input type="hidden" id="subtotal_price" value="<?=$subTotal?>">
													</span>
                                    </td>
                                </tr>
                                <tr>
                                <td colspan="5" class='text-end'>
                                                <span class="extra bold">Delivery Cost
                                            </span></td>
                                    <td class="text-center">
                                        <span class="bold">৳  <span id="delivery_cost"> {{$delivery}}</span></span>


                                        <input type="hidden" id="shipping_charge" name="shipping_charge" value="{{$delivery}}">
                                    </td>
                                </tr>

                                <tr class="couponclassHide">
                                <td colspan="5" class='text-end'>
                                                <span class="extra bold">Coupon Discount
                                            </span></td>
                                    <td class="text-end">
                                        <span class="bold">  <span id="couponDiscountPrice" style="color:red"> </span></span>


                                        <input type="hidden" id="shipping_charge" name="shipping_charge" value="{{$delivery}}">
                                    </td>
                                </tr>
                                <tr>
                                <td colspan="5" class='text-end'>
                                        <span class="extra bold totalamout">Total</span>
                                    </td>
                                    <td class="text-center">
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
        </div>

        <div class="col-md-5 col-12 col-sm-12 col-lg-5 col-xl-5">

            <div class="card ">
                
                <div style="background:black;" class="text-start fw-bold   fs-4"><p class='text-center text-white'> Customer Information</p>
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
                            </select>
                        </div> 
                        <div class="form-group">
                            <label for="billing_name"><b>Delivery Address</b></label>
                            <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                            <textarea  required=""  name="customer_address"  class="form-control" placeholder="Type Your Address">{{$customer_address}}</textarea>

                        </div>
                        

                        <div class="form-group">
                            <label for="billing_name"><b>Payment</b></label>
                            <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                            <select required=""  name="payment_method" id="payment_method" class="form-control">
                                <option value="">Select Payment Method</option>
                                <option value="Bkash">Bkash</option>
                                <option value="Nagod">Nagod</option>
                                <option value="Bank">Bank</option>  
                            </select>
                        </div>
                        <div class="form-group mobile-payment-section">
                            <p style="color:red;margin-bottom: -2px;">Please Pay Total Bill To This <span id="bkah_number_id"></span></p>  
                            <h5 style="color:green" id="mobile_number">01571133188</h5> 
                        </div>
                        <div class='mobile-payment-section'> 

                                <div class="form-group">
                                <label for="billing_name" id="bkash_nagod_number"></label> 
                                <input type='text' class='form-control' name="account_number_mobile" placeholder="যে মোবাইল নাম্বার থেকে টাকা পাঠিয়েছেন,সেই নাম্বার টি লিখুন।" id="account_number_mobile"/>
                                </div> 

                                <div class="form-group">
                                <label for="billing_name">Transaction ID(Optional)</label> 
                                <input   type='text' class='form-control'  name="transaction_id_mobile"  id="transaction_id_mobile"/>
                                </div> 
                         
                        </div>


                        <div class="form-group bank-payment-section">
                            <p style="color:red;margin-bottom: -2px;">Please Pay Total Bill To This Bank</p>  
                            <h5 style="color:green" id="bank_name"></h5> 
                            <h5 style="color:green" id="bank_account_number"></h5> 
                        </div>
                        <div class='bank-payment-section'> 

                                <div class="form-group">
                                <label for="billing_name" id="bkash_nagod_number">Account Number</label> 
                                <input type='text' class='form-control' name="account_number"  id="account_number"/>
                                </div> 

                                <div class="form-group">
                                <label for="billing_name">Transaction ID</label> 
                               <input type='text' class='form-control'  name="transaction_id"  id="transaction_id" /> 
                                </div> 
                         
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

<?php

function getTransactionId(){
    echo '<input required type="text" class="form-control"  name="transaction_id"  id="transaction_id"/>';
}

?>


<script>
    $(".couponclassHide").hide();
    $(".mobile-payment-section").hide();
    $(".bank-payment-section").hide();
    $("#payment_method").change(function(){
        let method;
        method=this.value;
       
      if(method=="Bkash" || method=="Nagod"){
        $("#bkah_number_id").text(method+" Number")
        $("#bkash_nagod_number").text(method+" Number")
        $(".mobile-payment-section").show();
        $(".bank-payment-section").hide();
        $.ajax({
            url:"{{url('/')}}/checkoutMethod",
            data:{method:method,system:'mobile'},
            success:function (data){ 
                $("#mobile_number").text(data.number) 
            }
        })

      }else{
        $(".mobile-payment-section").hide();
        $(".bank-payment-section").show();
        $.ajax({
            url:"{{url('/')}}/checkoutMethod",
            data:{method:method,system:'bank'},
            success:function (data){ 
                $("#bank_name").text(data.bank_name) 
                $("#bank_account_number").text("Account Number: "+data.bank_account_number) 
            }
        })
      }
      

    })

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
