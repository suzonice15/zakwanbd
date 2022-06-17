@extends('website.master')
@section('mainContent')
<style type="text/css">
    @media print {
  body * {
    visibility: hidden;
  }
  #printInvoice, #printInvoice * {
    visibility: visible;
  }
  #notPrint, #notPrint *{
    visibility: hidden;
  }
  #printInvoice {
    position: absolute;
    left: 0;
    top: 0;
  }

}
</style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">


                <div class="breadcrumb">
                    <div class="container">
                        <div class="breadcrumb-inner">
                            <ul class="list-inline list-unstyled">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li style="display: initial;" class='active'>অর্ডার ট্র্যাক করুন</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <article class="txt"><p
                        style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: SolaimanLipi, Helvetica, Verdana, sans-serif !important; text-align: justify !important; color: black !important;">
                        ১। পণ্যের ডেলিভারী আপডেট পেতে আপনার Mobile Number নাম্বার দিয়ে অর্ডার ট্র্যাক করুন।</p>
                    <p style="box-sizing: border-box; margin: 0px; padding: 0px; font-family: SolaimanLipi, Helvetica, Verdana, sans-serif !important; text-align: justify !important; color: black !important;">
                        ২। আপনার অর্ডার করা পণ্যের ডেলিভারীর বর্তমান অবস্থা জানতে নিম্নের “টেক্সট বক্স” এ Mobile নাম্বার
                        টি প্রদান করুন এবং “ট্র্যাক অর্ডার” বাটনে ক্লিক করুন।</p>
                    <hr class="break break30">
                    <form method="post" action="{{ url('/track-your-order') }}">
                        @csrf
                        <div class="row row5" style="margin-left: -15px;height: 55px;">
                            <div class="col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <input required type="text"
                                           style="background-color: #ddd;border-color: green;border-radius: 13px"
                                           class="form-control" name="mobile"
                                           placeholder="Enter Mobile Number"></div>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <button type="submit" id="trackOrder" class="btn btn-success form-control">Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </article>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
            </div>
          <?php if(isset($order)) { ?>
            <div class="col-md-6" id="printInvoice">
                <div class="panel-body">
                    <div class="cart-info">

                        <table class="table table-striped table-bordered">
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
                                    <span class="extra bold totalamout"><b>Order Status</b></span>
                                </td>
                                <td class="text-right" style="width:50%">
                                    <span class="bold totalamout"><b><?php echo $order->order_status; ?></b></span>
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


                        <div style="overflow-x: scroll;">
                            <table class="table table-striped table-bordered">
                                <tr>

                                    <th class="name" width="40%">Products</th>
                                    <th class="name" width="10%">Product Code</th>
                                    <th class="name" width="1%">Qnt</th>
                                    <th class="name" width="20%">Price</th>
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

                                    <td>


                                        <img src="<?= $featured_image ?>" height="30" width="30"/>
                                        <a target="_blank" href="{{url('/')}}/{{$name}}"> <?= $item['name'] ?>
                                        </a>

                                    </td>



                                    <td> {{$sku}} </td>
                                    <td>   <?= $item['qty'] ?></td>
                                    <td>  @money($item['price'])  </td>
                                    <td>  @money($item['subtotal'])     </td>

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
                <button  style="margin-left: 204px;margin-bottom: 2px;" onclick="window.print()" class="btn btn-success print  d-print-none" id="notPrint"><i class="fa fa-download"></i>DOWNLOAD</button>
            </div>
<?php } else { ?>
            <?php if(isset($mobile)) { ?>
            <div style="
    font-size: 25px;
    font-weight: bold;
        margin-left: 492px;


" class="text-danger">There are no order </div>

            <?php } ?>
            <?php } ?>
        </div>
        </div>
    </div>
@endsection
