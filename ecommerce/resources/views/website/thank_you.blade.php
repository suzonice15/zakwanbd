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
    <h2  style="background-color:green" class="   col-12 thank_you_class"
    >
        প্রিয় ক্রেতা,


        কেনাকাটার মাধ্যম হিসেবে zakwanbd – কে বেছে নেবার জন্য আপনাকে আন্তরিক ধন্যবাদ।আপনার অর্ডারটি সফলভাবে গ্রহন করা হয়েছে। এখন থেকে পরবর্তী ২৪ ঘন্টার মধ্যে আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করবেন । যে কোনো প্রয়োজনে কল করুন 
        01970010605
        ধন্যবাদ ।

    </h2>
    <div class="row  order_tank_you_class">


        <?php
        if ((isset($order))) { ?>

<div class="col-md-2">
</div>
        <div class="col-md-8 col-12">

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
                                    <th class="name" width="40%">Products</th>
                                    <th class="name" width="10%">Product Code</th>

                                    <th class="name" width="25%">Sub-Total</th>
                                </tr>
                                <?php
                                $product_items = unserialize($order->products);
                                //echo '<pre>'; print_r($product_items); echo '</pre>';
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
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td>


                                        <img src="<?= $featured_image ?>" height="30" width="30"/>
                                        <a target="_blank" href="{{url('/')}}/{{$name}}"> <?= $item['name'] ?>
                                        </a>
                                        <br/>
                                        @money($item['price'])✖  <?= $item['qty'] ?>

                                    </td>



                                    <td> {{$sku}} </td>


                                    <td>  @money($item['subtotal']) </td>

                                </tr>
                                <?php
                                $count++;
                                }
                                ?>
                            </table>
                        </div>
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Sub Total</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                    <span class="bold totalamout"><b>@money($total)      </b></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Delivery Cost</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b>@money($order->shipping_charge) </b></span>
                                </td>
                            </tr>
                            <tr>
                                <td style="75%">
                                    <span class="extra bold totalamout"><b>Total</span>
                                </td>
                                <td class="text-right" style="width:50%">
                                                    <span
                                                        class="bold totalamout"><b>@money($order->order_total) </b></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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



