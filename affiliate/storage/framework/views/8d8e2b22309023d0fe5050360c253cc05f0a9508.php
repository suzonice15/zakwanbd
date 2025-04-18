<?php if(isset($incomes)): ?>
    <?php $i=$incomes->perPage() * ($incomes->currentPage()-1);?>
    <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e($income->name); ?></td>
            <td><?php echo e($income->email); ?></td>
            <td><?php echo e($income->phone); ?></td>
            <td><?php echo e($income->commision); ?></td>
            <td><?php echo e($income->order_id); ?></td>

            </td>
            <td><?php echo e(date('d-F-Y H:i:s a',strtotime($income->date))); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td colspan="13" align="center">
            <?php echo $incomes->links(); ?>

        </td>
    </tr>
<?php endif; ?>


<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/admin_incomeHistoryPagination.blade.php ENDPATH**/ ?>