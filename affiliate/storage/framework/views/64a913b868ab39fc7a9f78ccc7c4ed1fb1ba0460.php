<?php if(isset($orders)): ?>
    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e($order->order_id); ?></td>
            <td>
                <?php echo e($order->customer_name); ?>

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

                <?php echo e($item['name']); ?>


            </td>
            <td><?php echo $quintity;?></td>
            <td> <?php echo '৳ ' . number_format($total_amount, 2); ?>
            </td>
            <td>
                <button type="button" class="btn btn-info orderEditModal" data-order_id="<?=$order->order_id?>" data-toggle="modal" data-target="#orderEditModal">
                    View Order Note
                </button>
            </td>

            <td>
                <?php if($order->order_status=='pending_payment'){
                ?>

                <span   style="background-color:yellow"><?php echo e($order->order_status); ?></span>
                <?php  } elseif ($order->order_status=='new') { ?>
                <span   class="label label-info"><?php echo e($order->order_status); ?></span>

                <?php  } elseif ($order->order_status=='processing') { ?>
                <span   class="label label-info"><?php echo e($order->order_status); ?></span>

                <?php  } elseif ($order->order_status=='on_courier') { ?>

                <span   class="label label-danger"><?php echo e($order->order_status); ?></span>
                <?php  } elseif ($order->order_status=='delivered') { ?>
                <span   class="label label-success"><?php echo e($order->order_status); ?></span>

                <?php  } elseif ($order->order_status=='refund') { ?>

                <span   class="label label-danger"><?php echo e($order->order_status); ?></span>
                <?php  } elseif ($order->order_status=='cancled') { ?>
                <span   class="label label-danger"><?php echo e($order->order_status); ?></span>
                <?php } elseif( $order->order_status=='failed') {  ?>

                <span   class="btn btn-info" style="background-color:#ffad55;color: black;border: none;"  >Failded Delevery</span>
                <?php }  else {  ?>

                <span   class="label label-success"><?php echo e($order->order_status); ?></span>
                <?php } ?>


            </td>
            <td><?php echo e(date('d-m-Y H:i a',strtotime($order->created_time))); ?></td>
            <td>
                <a title="view" href="<?php echo e(url('admin/affilite/orderhistory')); ?>/<?php echo e($order->order_id); ?>">
                    <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
                </a>
            </td>


        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <td colspan="13" align="center">
            <?php echo $orders->links(); ?>

        </td>
    </tr>
<?php endif; ?>

<script>

    $(document).on('click','.orderEditModal',function () {

        var order_id= $(this).data("order_id")

        $.ajax({
            url:"<?php echo e(url('/affiliate/orderEditHistory')); ?>/"+order_id,
            method:"GET",
            success:function (data) {
                console.log(data)
                $('.ordereditshow').html(data);

            }

        })
    })
</script>


<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/order_history_pagination.blade.php ENDPATH**/ ?>