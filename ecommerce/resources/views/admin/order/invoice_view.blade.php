
@extends('layouts.master')
@section('pageTitle')
    Add New Order

@endsection
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
    /*position: absolute;*/
    /*left: 0;*/
    top: -100px;
  }

}

table, th, td {
  border: 1px solid #a8a5a5;
}
.invoice {  
  -ms-transform: rotate(0deg); /* IE 9 */
  transform: rotate(0deg);
}

</style>

<section class="invoice" id="printInvoice" style="margin-top:50px">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-3">
          
                <img  style="width: 86px;" src="{{url('/')}}/public/logo/logo_shop.jpg" >
                
        </div>

        <div class="col-xs-6">
           
                 
                <p style="text-align:center;font-size: 21px;">Zakwan Pharma & Supershop  </p>
                <p style="text-align:center;font-size: 16px;margin-top: -11px;">জাকওয়ান ফার্মা এন্ড সুপারশপ </p>    
                <p style="margin-top: -12px;text-align:center;font-size: 16px;
                font-weight: bold;">www.zakwanbd.com</p>
                 
            </h2>
        </div>

        <div class="col-xs-3"> 
                <small class="pull-right">Date: <?=date('d/m/Y')?></small>             
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>zakwanbd.com </strong><br>
                Hazrat Shah Ali Girls College Market,<br> Mirpur-1, Dhaka-1216
                Phone: 01970010605 <br>                
                Email: support@zakwanbd.com 
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
                    <th  width="10" style="text-align: center">  Code</th>
                    <th  width="10" style="text-align: center">Qnt</th>
                    <th  width="10" style="text-align: center">Price</th>
                    <th  width="10" style="text-align: center">Subtotal</th>
                </tr>
                </thead>
                <tbody>

                <?php

                 
                $order_items = DB::table('order_details')->where('order_id',$order->order_id)->get();     


                $html = null;
                $subtotal=0;
                $count=0;
              
                    foreach ($order_items as $product_id => $item) {  
                          
                        $product = single_product_information($item->product_id);
                        $name = $product->product_title;
                        $subtotal +=$item->qnt*$item->price;
                ?>
                <tr>
                    <td><?=++$count?></td>
                    <td><span style="height:23px;overflow: hidden;display: block;">{{$name}}</span></td>
                    <td style="text-align: center">{{$product->sku}}</td>

                    <td style="text-align: center">{{$item->qnt}}</td>
                    <td style="text-align: right">{{$item->price}} Tk</td>
                    <td style="text-align: right">{{$item->qnt * $item->price}} Tk</td> 
                </tr>

                <?php   } ?>

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
                    <tbody>
                    <tr>
                        <th style="width:50%">Sub Total:</th>
                        <td><?php echo $subtotal;?> Tk</td>
                    </tr>
                    <tr>
                        <th>  Delivery Cost :</th>
                        <td>{{$order->shipping_charge}} Tk</td>
                    </tr>
                    @if($order->discount_price)
                    <tr>
                        <th> Discount  :</th>
                        <td>{{$order->discount_price}} Tk</td>
                    </tr>
                    @endif
                    <tr>
                        <th>  Total :</th>
                        <td>{{$order->shipping_charge+$subtotal-$order->discount_price}} Tk</td>
                    </tr>
                   
                    @if($order->advabced_price)
                    <tr>
                        <th> Paid   :</th>
                        <td>{{$order->advabced_price}} Tk</td>
                    </tr>
                    @endif
                   
                    <tr>
                        <th>Due:</th>
                        <td>{{$order->order_total}} Tk</td>
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


@endsection

