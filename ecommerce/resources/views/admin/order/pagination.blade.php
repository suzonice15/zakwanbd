
@if(isset($orders))
    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
    @foreach ($orders as $order)
        <tr style="-webkit-box-shadow: 1px 2px 5px 1px #000000;
box-shadow: 1px 2px 5px 1px #000000;"> <td><span  style="background: red !important;"  class="label label-danger">{{ $order->order_id }}</span>
                <br> {{date('d-F-Y h:i:s a',strtotime($order->created_time))}}

            <br>
                    @if($order->order_area=='inside')
                    <span  class="label label-success" style="background-color: green  !important;">Inside Dhaka</span>
                    @elseif($order->order_area=='office')
                    <span  class="label label-success" style="background-color: #ec6c0f  !important;">Office</span>
                    @else
                    <span  class="label label-success" style="background-color: #5f046c !important;">Outside Dhaka</span>
                    @endif
                

            </td>
            <td>{{ $order->customer_name }} <br>
                <span style="color:green"> {{ $order->customer_phone }}</span>
                    <br>
                      <span style="color:black"> {{ $order->customer_address }}</span>

                <br><span style="color:black;font-size: 12px;">Order From:</span>

                <span  style="color: black;font-size: 12px;">{{$order->order_from}}</span>
                <br>
                @if($order->payment_method)
               Payment Method <span  style="color: #770745;font-size: 12px;">{{$order->payment_method}}</span>
                    @endif
                @if($order->transaction_id)
                    <br>Transaction ID <span  style="color: #770745;font-size: 12px;">{{$order->transaction_id}}</span>
                @endif
            </td>  <td><?php
                $order_items = getOrderDetails($order->order_id);               
                if(isset($order_items)) {
                    foreach ($order_items as $key => $item) {                        
                        $product = single_product_data($item->product_id);
                        $featured_image=url('/public/uploads').'/'. $product->folder.'/thumb/'.$product->feasured_image;
                    

                        ?>
<a  target="_blank" href="{{url('/')}}/{{ $product->product_name }}">
    <span class="label label-info" style="width: 150px;display: block;overflow: hidden;" >{{ $product->product_title }}</span>
    <br/>
    <img  src="<?=$featured_image?>"  width="50"/>
    ✖
    {{ $item->qnt }}
</a>
                <br>
                <?php
                        }
                    }
                ?>
            </td>
            <td> 
<span style="border-top:1px solid #ddd;display: block;"></span>
                <br>
                <?php
                $affilite=  DB::table('users_public')->select('id','name','phone')->where('id',$order->user_id)->first();
                if($affilite){
                ?>
                <span style="color:green">{{ $affilite->name }} ({{ $affilite->id }} ) <br>{{ $affilite->phone }}</span>
                <?php  } else { ?>

                <span style="color:red">  Non Affilite</span>
                <?php
                }
                ?>
            </td>
            <td>
        <?php

        $stuff=  DB::table('admin')->select('name','admin_id')->where('admin_id',$order->staff_id)->first();
        if($stuff){
           $order_edit_check=  DB::table('order_edit_track')->where('order_id',$order->order_id)->count();
            ?>
          
                <span class="badge badge-info">Order Created By <br> <?=$order->created_by?></span>

                <button type="button" class="btn btn-info orderEditModal" data-order_id="<?=$order->order_id?>" data-toggle="modal" data-target="#orderEditModal">
                    <?=$stuff->name?>
                </button>
                @if($order_edit_check==0)
                    <button style="background-color:red" class="btn btn-danger blink_me">New</button>
                    @endif
             
            <?php
                }  else { ?>
            
                <span class="badge badge-info"> Order Created By <br/> <?=$order->created_by?></span>
          
         <?php
                }
            ?>
            <br/>
            <div class='' style="border: 1px solid red;padding: 5px;margin-top: 5px;">
            Payment Method: {{$order->payment_method}}
            <br/>
            Account Number: {{$order->account_number}}
            <br/>
            Transaction ID: {{$order->transaction_id}}
            </div>

             </td> 
            <td> @money($order->order_total)
                </td>
            <td>
                <?php if($order->order_status=='pending_payment'){
                    ?>
                <span   class="btn btn-info" style="background-color:#ffad55;color: black;border: none;" >Payment Pending</span>
                <?php  } elseif ($order->order_status=='new') { ?>
                    <span   class="btn btn-info">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='processing') { ?>
                    <span   class="btn btn-info">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='on_courier') { ?>
                    <span   class="btn btn-success">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='delivered') { ?>
                    <span   class="btn btn-success">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='refund') { ?>
                    <span   class="btn btn-danger">{{ $order->order_status }}</span>
                <?php  } elseif ($order->order_status=='cancled') { ?>
                    <span   class="btn btn-danger">{{ $order->order_status }}</span>
                    <?php  } elseif ($order->order_status=='phone_pending') { ?>
                    <span    class="btn btn-info" style="background-color:#ffad55;color: black;border: none;" >Phone Pending </span>
                    <?php  } elseif ($order->order_status=='failed') { ?>
                    <span    class="btn btn-danger"  >Failded Delevery </span>
                    <?php  } else {  ?>
                    <span   class="btn btn-success">{{ $order->order_status }}</span>
                <?php } ?>
                        <br>
            </td>


            <td>
                @if($order->is_paid==1)
                <a title="edit" target="_blank" href="{{ url('admin/order') }}/{{ $order->order_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
                <a title="print" target="_blank" href="{{ url('admin/order/invoice-print') }}/{{ $order->order_id }}">
                    <span class="glyphicon glyphicon-print btn btn-success"></span>
                </a>
                <div class="input-group input-group-lg">


                    <div class="input-group-btn">
                        <button  style="width: 42px;height: 34px;padding: 3px;margin-top: 2px;" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="fa fa-eye"></span></button>
                        <ul class="dropdown-menu">
                            @if($order->order_status=='new')
                                <li><a href="{{url('/')}}/admin/order/status/changed/cancled/{{$order->order_id}}">Cancel</a></li>
                                
                                
                                <li><a href="{{url('/')}}/admin/order/status/changed/processing/{{$order->order_id}}">processing</a></li>
                            @elseif($order->order_status=='phone_pending')
                                <li><a href="{{url('/')}}/admin/order/status/changed/cancled/{{$order->order_id}}">Cancel</a></li>
                                
                                <li><a href="{{url('/')}}/admin/order/status/changed/processing/{{$order->order_id}}">processing</a></li>
                            @elseif($order->order_status=='processing')
                                <li><a href="{{url('/')}}/admin/order/status/changed/on_courier/{{$order->order_id}}">On Courier</a></li>
                                <li><a href="{{url('/')}}/admin/order/status/changed/cancled/{{$order->order_id}}">Cancel</a></li>
                            @elseif($order->order_status=='on_courier')
                                <li><a href="{{url('/')}}/admin/order/status/changed/completed/{{$order->order_id}}" class="btn btn-success" style="color:white;border:none">Completed</a></li>
                                <li><a href="{{url('/')}}/admin/order/status/changed/failed/{{$order->order_id}}" class="btn btn-danger" style="color:white;border:none">Failed</a></li>
                            @elseif($order->order_status=='delivered')
                                <li><a href="{{url('/')}}/admin/order/status/changed/refund/{{$order->order_id}}">Refund</a></li>

                            @elseif($order->order_status=="pending_payment")
                                <li><a href="{{url('/')}}/admin/order/status/changed/processing/{{$order->order_id}}">processing</a></li>
                                <li><a href="{{url('/')}}/admin/order/status/changed/cancled/{{$order->order_id}}">Cancel</a></li>
                            @elseif($order->order_status=="failed")
                           <li><a href="{{url('/')}}/admin/order/status/changed/new/{{$order->order_id}}">New</a></li>
                            @elseif($order->order_status=="cancled")
                                <li><a href="{{url('/')}}/admin/order/status/changed/new/{{$order->order_id}}">New</a></li>
                            @elseif($order->order_status=="delivered")
                                {{--<li><a href="{{url('/')}}/admin/order/status/changed/refund/{{$order->order_id}}">Refund</a></li>--}}
                             @else

                            @endif


                        </ul>
                    </div>
                </div>
                @endif
            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $orders->links() !!}
        </td>
    </tr>
@endif

<!-- /.modal -->

<script>

        $(document).on('click','.orderPrint',function () {

            var order_id= $(this).data("order_id")

            $.ajax({
                url:"{{url('/admin/orderModalPrint')}}/"+order_id,
                method:"GET",
                success:function (data) {
                    $('#orderModalPrint').html(data);

                }

            })
        })
    </script>

    <script>

        $(document).on('click','.orderEditModal',function () {

            var order_id= $(this).data("order_id")

            $.ajax({
                url:"{{url('/admin/orderEditHistory')}}/"+order_id,
                method:"GET",
                success:function (data) {
                    console.log(data)
                     $('.ordereditshow').html(data);

                }

            })
        })
    </script>


