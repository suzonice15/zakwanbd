@extends('website.master')
@section('mainContent')

    <style type="text/css">
        @media print
        {
            body * { visibility: hidden; }
            .noprint_section  *{ display: none; }
            .tank_you_print * { visibility: visible;margin-right: 50px }

        }
    </style>
<style>
    .home_print_mobile_class{

    }
    .thank_you_class{
        font-size: 15px;
        background-color: green;
        width: 66%;
        height: auto;
        margin-top: 28px;
        color: white;
        padding: 10px 12px;
        margin-left: 193px;
        text-align: left;
    }

    @media (max-width: 576px) {
        .thank_you_class{
            width: 100%;
            height: auto;
            margin-top: 28px;
            color: white;
            padding: 8px 8px;
            margin-left: 0px;
        }
        .order_tank_you_class{
            width: 107%;
        }
    }
</style>

<div class="container tank_you_print" style="background-color: white;margin-top: 10px;padding-top: 2px;">
    
    <div class="row  order_tank_you_class">


        <?php
        if ((isset($order))) { ?>

<div class="col-md-2">
</div>
        <div class="col-md-8 col-12">
        <p  style="background-color:green;color:white;padding:9px;margin-top:10px"
    >
        প্রিয় ক্রেতা,


        কেনাকাটার মাধ্যম হিসেবে zakwanbd – কে বেছে নেবার জন্য আপনাকে আন্তরিক ধন্যবাদ।আপনার অর্ডারটি সফলভাবে গ্রহন করা হয়েছে। এখন থেকে পরবর্তী ২৪ ঘন্টার মধ্যে আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করবেন । যে কোনো প্রয়োজনে কল করুন 
        01970010605
        ধন্যবাদ ।

        </p>

                <div class="card panel-primary">
                    <div class="card-heading text-start ms-5"><b>
                            Order Details
                        </b>
                    </div>

                    <div class="card-body">

                   
                <div class="card-body">
                    <div class="cart-info">

                        <table class="table  table-bordered">
                            <tbody>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Order Number</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                    <span class="bold totalamout"><b><?php echo $order->order_id; ?></b></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Customer Name</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b> <?= $order->customer_name; ?></b></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Customer Phone</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_phone ?></b></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Customer Email</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_email ?></b></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Customer Address</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b><?= $order->customer_address ?></b></span>
                                </td>
                            </tr>

                            </tbody>
                        </table>


                        <div>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th class="name" width="1%">Sl</th>
                                    <th class="name" width="15%">picture</th>
                                    <th class="name" width="40%">Products</th>
                                    <th class="name" width="10%">Code</th>

                                    <th class='text-center' class="name" width="25%">Sub-Total</th>
                                </tr>
                                <?php                              
                               $subtotal=0;
                                foreach ($order_items  as $key => $item) { 
                                $product=single_product_information($item->product_id);
                                $sku=$product->sku;
                                $name=$product->product_name;
                                $subtotal +=$item->price*$item->qnt;
                                ?>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td> 
                                        <img width="120" src="{{url('/')}}/public/uploads/{{$product->folder}}/thumb/{{$product->feasured_image}}"  />
                                        
                              </td>  

                                    <td> 
                                         <a target="_blank" href="{{url('/')}}/{{$name}}"> <?= $name ?>
                                        </a>
                                        <br/>
                                        @money($item->price)✖  <?= $item->qnt ?>
                                         </td> 
                                    <td> {{$sku}} </td> 
                                    <td class='text-center'>  @money($item->sub_total) </td>

                                </tr>
                                <?php
                                 
                                }
                                ?>

                            <tr>
                                    <td colspan='4' class='text-end'>
                                        <span class="extra bold totalamout"><b>Sub Total</b></span>
                                    </td>
                                    <td class="text-center" style="width:50%">
                                        <span class="bold totalamout"><b>@money($subtotal)      </b></span>
                                    </td>
                            </tr>
                            <tr>
                            <td colspan='4' class='text-end'>
                                    <span class="extra bold totalamout"><b>Delivery Cost</b></span>
                                </td>
                                <td class="text-center" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b>@money($order->shipping_charge) </b></span>
                                </td>
                            </tr>
                            <tr>

                            <td colspan='4' class='text-end'>
                                    <span class="extra bold totalamout"><b>Total</span>
                                </td>
                                <?php 
                                
                                $total=$subtotal+$order->shipping_charge;
                                ?>
                                <td class="text-center" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b>@money($total) </b></span>
                                </td>
                            </tr>
                            <td colspan='4' class='text-end'>
                                    <span class="extra bold totalamout"><b>Due</span>
                                </td>
                                <td class="text-center" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b>0</b></span>
                                </td>
                            </tr>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <?php
        } else {
        ?><h1 class="error">Invalid Order Request!</h1><?php
        }
        ?>


    </div>
    </div>
</div>


@endsection



