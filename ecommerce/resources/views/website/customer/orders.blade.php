@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="text-center">

                        <th scope="col">Order ID</th>

                        <th scope="col">Amount</th>

                        <th scope="col">Order Status</th>
                        <th scope="col">Payment</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Order Note</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if($orders)
                        @foreach($orders as $order)
                    <tr class="text-center">
                        <td>{{$order->order_id}}</td>
                        <td>    @if($order->order_total==0)
                                 {{$order->advabced_price}}
                                @else
                                 {{ $order->order_total}}
                               @endif

                                Tk.</td>
                        <td>{{$order->order_status}}</td>
                        <td>
                            @if(($order->order_status =="new") || ($order->order_status =="processing") || ($order->order_status =="phone_pending") || ($order->order_status =="on_courier") || ($order->order_status =="pending_payment"))
                                <span class="badge rounded-pill bg-danger">Unpaid </span>
                            @else
                                <span class="badge rounded-pill bg-success">Paid</span>

                            @endif


                        </td>
                        <td>{{$order->created_time}}</td>
                        <td>{{$order->customer_order_note}}</td>


                        <td>
                            @if($order->bonus_balance==null || $order->bonus_balance==0)
                          <a class="btn  btn-success btn-sm text-white" href="{{url('/')}}/customer/order/pay/{{$order->order_id}}">View </a>
                            @else
                                @endif
                            @if($order->order_status=='new')
                            <a class="btn  btn-danger btn-sm text-white" href="{{url('/')}}/customer/order/cancel/{{$order->order_id}}">Order Cancel</a>
                           @endif
                        </td>



                    </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>


        </div>

    </div>

@endsection