<?php if(isset($notifications)): ?>
    <?php $i=$notifications->perPage() * ($notifications->currentPage()-1);?>
    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr class="notification" id="<?php echo e($product->product_affiliate_notification_id); ?>" >

            <td><?php echo ++$i;?></td>
            <td>  <img   src="https://www.zakwanbd.com/public/uploads/<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>" class="img-circle" alt="User Image">
            </td>
            <td><?php echo e($product->product_title); ?></td>
            <td><?php echo e($product->previous_price); ?></td>
            <td><?php echo e($product->present_price); ?></td>
            <td><?php echo e($product->present_price - $product->previous_price); ?></td>
            <td>
               <?php if($product->status==0): ?>
                    <span class="label label-danger">Unseen</span>
                    <?php else: ?>
                <span class="label label-success">Seen</span>
                <?php endif; ?>

            </td>

        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <td colspan="9" align="center">
            <?php echo $notifications->links(); ?>

        </td>
    </tr>
<?php endif; ?>




<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/pagination_productNotification.blade.php ENDPATH**/ ?>