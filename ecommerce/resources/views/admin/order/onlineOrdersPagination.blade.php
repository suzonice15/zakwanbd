
@if(isset($orders))
    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
    @foreach ($orders as $order)
        <tr id="order_row_id_{{ $order->order_id }}" style="-webkit-box-shadow: 1px 2px 5px 1px #000000;
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
                <?php
                $admin_user_status=Session::get('status');
                if($admin_user_status !='office-staff' || $admin_user_status !='editor') {
                ?>
                <input style="width: 15px;text-align: center" type="checkbox" value="{{ $order->order_id }}" class="checkAll ">

                <?php } ?>

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
    <span class="label label-info" style="width: 200px;display: block;overflow: hidden;" >{{ $product->product_title }}</span>
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
             <td class='text-center'> 
                {{$order->advabced_price}}  
           
                </td> 

            <td class='text-center'>   
            @if($order->is_paid==1)             
                <span class="badge bg-success" style="background:green">Paid</span>
                @else
                <span class="badge bg-danger" style="background:red">UnPaid</span>
                @endif
                </td> 

            <td>
                @if($order->is_paid==1)
                <a title="edit" target="_blank" href="{{ url('admin/order') }}/{{ $order->order_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
              
                @else

                <a title="print" onclick="confirmPayment({{ $order->order_id }})"   href="#">
                    <span class="glyphicon glyphicon-check btn btn-success"></span>
                </a>  
                <a title="Cancel" onclick="Cancil({{ $order->order_id }})"   href="#">
                    <span class="btn btn-danger">Cancel</span>
                </a>                
              
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

        function confirmPayment(order_id){

            let confirm_messeage=  confirm("Are you sure ! you want to conform Payment.")
      if(confirm_messeage){
        $.ajax({
            url:"{{url('/')}}/admin/order/confirmPayment/"+order_id,
            success:function(data){
                $("#order_row_id_"+order_id).hide();
                location.reload();

               
            }
        })
      }  

        }

      function Cancil (id){
      let confirm_messeage=  confirm("Are you sure you want to cancel this Order ?")
      if(confirm_messeage){
        $.ajax({
            url:"{{url('/')}}/admin/order/status/changed/cancled/"+id,
            success:function(data){
                $("#order_row_id_"+id).hide();
               
            }
        })
      }  
      }
    </script>


