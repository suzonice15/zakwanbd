<?php

if($reports){
    $new=0;
    $on_courier=0;
    $cancled=0;
    $completed=0;
    $refund=0;
    $delivered=0;
    $pending_payment=0;
    $processing=0;
    $new_sum=0;
    $pending_sum=0;
    $processing_sum=0;
    $on_courier_sum=0;
    $delivered_sum=0;
    $refund_sum=0;
    $cancled_sum=0;
    $completed_sum=0;
    foreach ($reports as $report){
        if($report->order_status=='new'){
            $new++;
            $new_sum +=$report->order_total;
        } else if($report->order_status=='pending_payment'){
            $pending_payment++;
            $pending_sum +=$report->order_total;
        }
        else if($report->order_status=='processing'){
            $processing++;
            $processing_sum +=$report->order_total;
        }
        else if($report->order_status=='on_courier'){
            $on_courier++;
            $on_courier_sum +=$report->order_total;
        }
        else if($report->order_status=='delivered'){
            $delivered++;
            $delivered_sum +=$report->order_total;
        }
        else if($report->order_status=='refund'){
            $refund++;
            $refund_sum +=$report->order_total;
        }
        else if($report->order_status=='cancled'){
            $cancled++;
            $cancled_sum +=$report->order_total;
        } else {
            $completed++;
            $completed_sum +=$report->order_total;
        }




    }
}
?>
<div class="box-body">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$new}}</h3>
                    <h4>@money($new_sum)</h4>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$pending_payment}}</h3>
                    <h4>@money($pending_sum)</h4>

                    <p>Pending for Payment</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$processing}}</h3>
                    <h4>@money($processing_sum)</h4>

                    <p>On Process</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$on_courier}}</h3>
                    <h4>@money($on_courier_sum)</h4>

                    <p>With Courier</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$delivered}}</h3>
                    <h4>@money($delivered_sum)</h4>

                    <p>Delivered</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$refund}}</h3>
                    <h4>@money($refund_sum)</h4>

                    <p>Refunded</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$cancled}}</h3>
                    <h4>@money($cancled_sum)</h4>

                    <p>Cancelled</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$completed}}</h3>
                    <h4>@money($completed_sum)</h4>

                    <p>Completed</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
    </div>


    <div class="box" style="border: 2px solid #ddd;">
        <div class="table-responsive">

            <table  class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Created By</th>
                    <th>Amount</th>
                    <th>Delivery Charge</th>
                    <th>Status</th>
                    <th>Order Date</th>

                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                @if(isset($orders))
                    <?php $i=0 ;?>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td><span class="label label-info">{{ $order->customer_phone }}<span class="label label-success"></span></td>
                            <td><span class="label label-success">@if($order->order_area=='inside')
                                        Inside Dhaka @else Outside Dhaka @endif
                </span></td>
                            <td>{{ $order->customer_address }}</td>
                            <td>{{$order->created_by}}</td>
                            <td> @money($order->order_total)
                            </td>
                            <td> @money($order->shipping_charge)</td>
                            <td><span class="label label-success">{{ $order->order_status }}</span></td>
                            <td>{{date('d-F-Y H:i:s a',strtotime($order->created_time))}}</td>

                            <td>
                                <a title="edit" href="{{ url('admin/order') }}/{{ $order->order_id }}">
                                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                                </a>

                                {{--<a title="delete" href="{{ url('admin/product/delete') }}/{{ $order->product_id }}" onclick="return confirm('Are you want to delete this Product')">--}}
                                {{--<span class="glyphicon glyphicon-trash btn btn-danger"></span>--}}
                                {{--</a>--}}
                            </td>
                        </tr>

                    @endforeach


                @endif


            </table>

        </div>

    </div>


</div>
