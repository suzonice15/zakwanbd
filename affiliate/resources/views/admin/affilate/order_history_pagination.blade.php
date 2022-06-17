@if(isset($orders))
    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
    @foreach ($orders as $order)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $order->order_id }}</td>
            <td>
                {{ $order->customer_name }}
            </td>

            <td><?php

                $total_amount=($order->order_total+$order->shipping_charge)-$order->shipping_charge;
                $order_items = unserialize($order->products);
                $quintity=0;
                if(is_array($order_items['items'])) {
                foreach ($order_items['items'] as $product_id => $item) {
                $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                $quintity +=($item['qty']);

                ?>
                        <!-- Product details and product image -->

                <?php
                }
                }


                ?>

                {{$item['name']}}

            </td>
            <td><?php echo $quintity;?></td>
            <td> @money($total_amount)
            </td>
            <td>
                <button type="button" class="btn btn-info orderEditModal" data-order_id="<?=$order->order_id?>" data-toggle="modal" data-target="#orderEditModal">
                    View Order Note
                </button>
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
                <?php } elseif( $order->order_status=='failed') {  ?>

                <span   class="btn btn-info" style="background-color:#ffad55;color: black;border: none;"  >Failded Delevery</span>
                <?php }  else {  ?>

                <span   class="label label-success">{{ $order->order_status }}</span>
                <?php } ?>


            </td>
            <td>{{date('d-m-Y H:i a',strtotime($order->created_time))}}</td>
            <td>
                <a title="view" href="{{ url('admin/affilite/orderhistory') }}/{{ $order->order_id }}">
                    <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
                </a>
            </td>


        </tr>

    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $orders->links() !!}
        </td>
    </tr>
@endif

<script>

    $(document).on('click','.orderEditModal',function () {

        var order_id= $(this).data("order_id")

        $.ajax({
            url:"{{url('/affiliate/orderEditHistory')}}/"+order_id,
            method:"GET",
            success:function (data) {
                console.log(data)
                $('.ordereditshow').html(data);

            }

        })
    })
</script>


