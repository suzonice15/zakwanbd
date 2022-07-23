<?php if(isset($withdraws)): ?>
    <?php $i = $withdraws->perPage() * ($withdraws->currentPage() - 1);?>
    <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>



            <td><?php echo e($withdraw->id); ?></td>
            <td><?php echo e($withdraw->order_id); ?></td>
            <td><?php echo e($withdraw->date); ?></td>



            <td><?php echo e($withdraw->to_user_ac); ?></td>
            <td><?php echo e($withdraw->account); ?></td>
            <td><?php echo e($withdraw->account_number); ?></td>
            <td><?php echo e($withdraw->amount); ?></td>

            <td><?php

                    if($withdraw->status==1){

                ?>

                <button class="btn btn-success">
                    Paid
                    </button>
                <?php } elseif($withdraw->status==0) { ?>

                <button class="btn btn-info">
                  Request
                </button>
                <?php } else { ?>

                <button class="btn btn-danger">
                 Rejected
                </button>
                <?php } ?>
            </td>


        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <td colspan="9" align="center">
            <?php echo $withdraws->links(); ?>

        </td>
    </tr>
<?php endif; ?>


<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/withdraw_pagination.blade.php ENDPATH**/ ?>