@extends('layouts.master')
@section('pageTitle')
    All Orders  List
@endsection
@section('mainContent')
    <div class="box-body">

        <div class="table-responsive">

            <table  class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Vendor</th>
                     <th>Amount</th>
                     <th>Payment Status</th>
                    <th>Status</th>
                    <th>Order Date</th>

                </tr>
                </thead>
                <tbody>

                @if(isset($orders))
                    <?php $i=0;?>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>
                                {{ $order->customer_name }}
                                <br>
                                <span class="label label-info">{{ $order->customer_phone }}</span>
                                    <br>
                            <span class="label label-success">@if($order->order_area=='inside')
                                    Inside Dhaka @else Outside Dhaka @endif
                </span>
                            </td>

                            <td>
                                <?php

                                $paymentStatus=DB::table('vendor_price_commution')
                                        ->select('status')
                                        ->where('order_id',  $order->order_id)->first();
                                    if($paymentStatus){
                                        $paymentStatusShow=$paymentStatus->status;
                                        if($paymentStatusShow==0){
                                            $paidStaus='Unpaid';
                                        } else {
                                            $paidStaus='Paid';
                                        }
                                    } else {
                                        $paidStaus='';
                                    }

                                $order_items = unserialize($order->products);

                                if(is_array($order_items['items'])) {
                                foreach ($order_items['items'] as $product_id => $item) {
                                $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                                $product = single_product_information($product_id);
                                $sku = $product->sku;
                                $name = $product->product_name;

                                ?>
                                <a  target="_blank" href="{{URL::to('/'.$name)}}">


                                    <span class="label label-info" style="height: 20px; width:150px;display: block;overflow: hidden" ><?=($item['name'])?></span>


                                    <br/>
                                    <img  src="<?=$featured_image?>" />
                                    ✖
                                    <?=($item['qty'])?>
                                </a>
                                <br>





                                <?php
                                }
                                }


                                ?>



                            </td>


                            <td><?php

                                $order_items = unserialize($order->products);

                                if(is_array($order_items['items'])) {
                                foreach ($order_items['items'] as $product_id => $item) {

                                $product = single_product_information($product_id);
                                $vendor_id=$product->vendor_id;
                                if($vendor_id==0){
                                    $owner=" Sohojbuy Product";
                                } else {
                                    $vendor_result= DB::table('vendor')->where('vendor_id',$vendor_id)->first();
                                }

                                ?>

                                <?php
                                if($vendor_id==0){

                                ?>

                                <span class="label label-success"><?php echo $owner; ?></span>

                                <?php  }  else {


                                ?>
                                <a  target="_blank" href="{{URL::to('/admin/vendor/view'.'/'.$vendor_id)}}">
                                    <span class="label label-primary"><?php echo $vendor_result->vendor_f_name; ?></span>
                                </a>
                                <br>
                                <?php } ?>





                                <?php
                                }
                                }


                                ?>



                            </td>



                            <td> @money($order->order_total)
                            </td>

                            <td>
                                <?php if($order->order_status=='pending_payment'){
                                ?>

                                <span   style="background-color:yellow">{{ $order->order_status }}</span>
                                <?php  } elseif ($order->order_status=='new') { ?>
                                <span   class="label label-info">{{ $order->order_status }}</span>

                                <?php  } elseif ($order->order_status=='processing') { ?>
                                <span   class="label label-info">{{ $order->order_status }}</span>

                                <?php  } elseif ($order->order_status=='on_courier') { ?>

                                <span   class="label label-danger">{{ $order->order_status }}</span>
                                <?php  } elseif ($order->order_status=='delivered') { ?>
                                <span   class="label label-success">{{ $order->order_status }}</span>

                                <?php  } elseif ($order->order_status=='refund') { ?>

                                <span   class="label label-danger">{{ $order->order_status }}</span>
                                <?php  } elseif ($order->order_status=='cancled') { ?>
                                <span   class="label label-danger">{{ $order->order_status }}</span>
                                <?php } else {  ?>

                                <span   class="label label-success">{{ $order->order_status }}</span>
                                <?php } ?>


                            </td>
                            <td>


                               {{ $paidStaus }}

                            </td>
                            <td>{{date('d-m-Y h:i a',strtotime($order->created_time))}}</td>



                        </tr>

                    @endforeach

                    <tr>
                        <td colspan="13" align="center">

                            <?php
                            echo $orders->links();
                            ?>

                        </td>
                    </tr>
                @endif



                </tbody>

            </table>

        </div>


    </div>



@endsection

