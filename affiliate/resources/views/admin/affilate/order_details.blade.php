@extends('layouts.master')
@section('pageTitle')
    Order Details
@endsection
@section('mainContent')

<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> SohojAffiliate
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          {{$orders->created_by}}
          <address>
            <strong>{{$orders->customer_name}}</strong><br>
            Phone: {{ $orders->customer_phone }}<br>
            Address: @if($orders->order_area=='inside')
                            Inside Dhaka @else Outside Dhaka @endif
          </address>
        </div>
     
        <div class="col-sm-4 invoice-col">
        </div>
     
        <div class="col-sm-4 invoice-col">
          <br>
          <b>Order ID:</b> {{$orders->order_id}}<br>
          <b>Order Date:</b> {{date('d-m-Y H:i a',strtotime($orders->created_time))}}<br>
          <b>Order Status: </b>
          <?php 
            if($orders->order_status=='pending_payment'){
                ?>

            <span   style="background-color:yellow">{{ $orders->order_status }}</span>
            <?php  } elseif ($orders->order_status=='new') { ?>
            <span   class="label label-info">{{ $orders->order_status }}</span>

            <?php  } elseif ($orders->order_status=='processing') { ?>
            <span   class="label label-info">{{ $orders->order_status }}</span>

            <?php  } elseif ($orders->order_status=='on_courier') { ?>

            <span   class="label label-danger">{{ $orders->order_status }}</span>
            <?php  } elseif ($orders->order_status=='delivered') { ?>
            <span   class="label label-success">{{ $orders->order_status }}</span>

            <?php  } elseif ($orders->order_status=='refund') { ?>

            <span   class="label label-danger">{{ $orders->order_status }}</span>
            <?php  } elseif ($orders->order_status=='cancled') { ?>
            <span   class="label label-danger">{{ $orders->order_status }}</span>
            <?php } else {  ?>

            <span   class="label label-success">{{ $orders->order_status }}</span>
        <?php } ?>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
            <tr>
                <th>Sl</th>
              <th>Product Details</th>
              <th>Image</th>
              <th>Note</th>
              <th>qnt</th>
              <th>Price</th>
              <th>SubTotall</th>
            </tr>
            </thead>
            <tbody>
                <?php

                $order_items = unserialize($orders->products);



                $html = null;
                $subtotal=0;
                $quint=0;
                $count=0;
                if(is_array($order_items['items'])) {
                    foreach ($order_items['items'] as $product_id => $item) {
                        $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;
                        $product_ids[] = $product_id;
                        $product_code = 0;
                        $product_id_select = array_unique($product_ids);
                        

                        $totall = intval(preg_replace('/[^\d.]/', '', isset($item['subtotal']) ? $item['subtotal'] : null));

                        $product = single_product_information($product_id);

                        $name = $product->product_name;

                        $subtotal +=($item['subtotal']/$item['qty'])*$item['qty'];
                        $quint +=($item['qty']);
                ?>
            <tr>
              <td><?=++$count?> </td>
              <td>
                <a target="_blank" href="{{URL::to('/product'.'/'.$name)}}">{{$name}}</a></td>
              <td>
                <a target="_blank" href="{{URL::to('/product'.'/'.$name)}}">
                <img src="<?php echo $featured_image ?>"
                height="30" width="30"></a>
              </td>
              <td>{{$orders->order_note}}</td>
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
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-8">



            <form method="post" action="{{url('/')}}/admin/affilite/orderhistory/{{$orders->order_id}}" >
                @csrf

                <div class="form-group row">
                    <label   class="col-sm-4 col-form-label" style="color:red" >{{session::get('error')}}</label>
                    <label   class="col-sm-4 col-form-label" style="color:green" >{{session::get('success')}}</label>

                </div>
                <div class="form-group row">
                    <label   class="col-sm-4 col-form-label">Wallet blance</label>
                    <div class="col-sm-6">
                        <p>{{$wallet}}</p>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">Pay from Wallet</label>
                    <div class="col-sm-6">
                        <input type="number"  required name="amount" id="amount" class="form-control" value="0"  placeholder="Amount">
                        <input type="hidden" name="wallet"  value="{{$wallet}}">

                    </div>
                </div>



                <div class="form-group row">
                    <label   class="col-sm-4 col-form-label"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>


        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                {{--<tr>--}}
                    {{--<th style="width:50%">Totall Qnt:</th>--}}
                    {{--<td><?php echo $quint;?></td><br>--}}
                {{--</tr>--}}
              <tr>
                <th style="width:50%">Sub-Total:</th>
                <td> <span id="subtotal"><?php echo $subtotal;?></span> Tk</td>
              </tr>
                <tr>
                    <th style="width:50%">Paid:</th>
                    <td><span id="advanced_price"><?php echo $orders->advabced_price;?></span> Tk</td>
                </tr>

                <tr>
                    <th style="width:50%">Due:</th>
                    <td><span id="due"><?php echo $orders->order_total;?></span> Tk</td>
                </tr>

            </tbody>
        </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    {{--<script>--}}
        {{--$('#amount').on('input',function () {--}}
            {{--const amount = $(this).val();--}}


            {{--const subtotal = $("#subtotal").text();--}}
            {{--const advanced_price = $("#advanced_price").text();--}}
            {{--const due = $("#due").text();--}}
                {{--const total_advanced=parseInt(advanced_price)+parseInt(amount)--}}
            {{--$("#advanced_price").text(total_advanced);--}}
            {{--$("#due").text();--}}



        {{--})--}}
    {{--</script>--}}



@endsection

