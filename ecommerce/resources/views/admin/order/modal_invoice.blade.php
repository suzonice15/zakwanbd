


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
                /*position: absolute;*/
                /*left: 0;*/
              /*  top: -100px;*/
            }

        }

        table, th, td {
            border: 1px solid #a8a5a5;
        }

    </style>

    <section class="invoice"  id="printInvoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img  src="https://sohojbuy.com/public/uploads/logo f.png" > sohojbuy.com
                    <small class="pull-right">Date: <?=date('d/m/Y')?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>sohojbuy.com </strong><br>
                    Office - 1417, Level 13, Shah Ali Plaza,<br> Mirpur 10, Dhaka 1216
                    <br>

                    Phone:01300884747<br>
                    Phone:01407011239<br>
                    Email: support@sohojbuy.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{$order->customer_name}}</strong><br>
                    {{$order->customer_address}}
                    <br/>

                    Phone:   {{$order->customer_phone}}<br>
                    Email:  {{$order->customer_email}}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #sb{{$order->order_id}}</b><br>
                <br>
                <b>Order ID:</b> {{$order->order_id}}<br>
                <b>Courier :</b>
                <?php
                if ($orderData) {
                    echo $orderData->courier_name;
                    if ($orderData->courier_status=='2') {
                        echo " Outside";
                    }else{
                        echo " Inside";
                    }
                }else{
                    echo "From-Office";
                }

                ?>
                <br>
                <b>Date :</b> {{date('d/m/Y',strtotime($order->shipment_time))}}<br>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="10">Sl</th>
                        <th  width="40" >Product Name</th>
                        <th  width="10" >Product Code</th>
                        <th  width="10">Qnt</th>
                        <th  width="10">Price</th>
                        <th  width="10">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $order_items = unserialize($order->products);



                    $html = null;
                    $subtotal=0;
                    $count=0;
                    if(is_array($order_items['items'])) {
                    foreach ($order_items['items'] as $product_id => $item) {
                    $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                    //  $_product_title =  substr($item['name'], 0, 150);

                    $product_ids[] = $product_id;
                    $product_code = 0;
                    $product_id_select = array_unique($product_ids);
                    $products_sku = DB::table('product')->select('sku')->where('product_id',$product_id)->first();
                    $product_code = $products_sku->sku;

                    $totall = intval(preg_replace('/[^\d.]/', '', isset($item['subtotal']) ? $item['subtotal'] : null));

                    //  $subtotal_price += $totall;


                    $product = single_product_information($product_id);

                    $name = $product->product_title;

                    $subtotal +=($item['subtotal']/$item['qty'])*$item['qty'];
                    ?>
                    <tr>
                        <td><?=++$count?></td>
                        <td>{{$name}}</td>
                        <td>{{$product_code}}</td>

                        <td>{{$item['qty']}}</td>
                        <td><?php echo  $item['subtotal']/$item['qty']; ?> Tk</td>
                        <td><?php echo ($item['subtotal']/$item['qty'])*$item['qty']; ?> Tk</td>


                    </tr>

                    <?php } }?>

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">

            </div>
            <!-- /.col -->
            <div class="col-xs-6">


                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Subtotal:</th>
                            <td><?php echo $subtotal;?> Tk</td>
                        </tr>
                        <tr>
                            <th> Advance Price :</th>
                            <td>{{$order->advabced_price}} Tk</td>
                        </tr>
                        <tr>
                            <th> Discount Price:</th>
                            <td>{{$order->discount_price}} Tk</td>

                        </tr>
                        <tr>
                            <th>  Delivery Cost :</th>
                            <td>{{$order->shipping_charge}} Tk</td>

                        </tr>
                        <?php
                        if($order->payWith=='bonus'){
                        ?>

                        <tr>
                            <th>  Bonus Amount :</th>
                            <td>- {{$order->bonus_balance}} Tk</td>

                        </tr>
                        <?php
                        }else if($order->payWith=='cashback'){
                        ?>

                        <tr>
                            <th>  Cashback Amount :</th>
                            <td>- {{$order->cashback_balance}} Tk</td>

                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <th>Due:</th>
                            <td>{{$order->order_total-$order->cashback_balance-$order->bonus_balance}} Tk</td>

                        </tr>
                        <tr>
                            <th>Due:</th>
                            <td>{{$order->order_total-$order->cashback_balance-$order->bonus_balance}} Tk</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <hr style="color: black;">




        <div id="notPrint" style="text-align: right;">
            <button type="button"  class="btn btn-info" onclick="printPage()">Print</button>
        </div>
    </section>

    <script>

        function printPage() {
            window.print();

        }


    </script>

