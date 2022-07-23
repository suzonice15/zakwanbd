<?php $__currentLoopData = $affiliates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affiliate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($affiliate->user_id); ?></td>
    <td><?php echo e($affiliate->name); ?></td>
    <td><?php echo e($affiliate->phone); ?></td>
    <td><?php echo e($affiliate->address); ?></td>
    <td>
        <?php if($affiliate->achivement_id==1): ?>
            T shart
      <?php elseif($affiliate->achivement_id==2): ?>
            Smart Watch
            <?php endif; ?>
    </td>
    <td><?php if($affiliate->status==0): ?>
    Pending
            <?php else: ?>
        Paid
            <?php endif; ?>
    </td>
    <td><?php echo e(date("d-m-Y H:i:s a",strtotime($affiliate->create_time))); ?></td>
    <td>
        <?php if($affiliate->status==0): ?>
        <a  onclick="return confirm('Are you want to paid ?')" href="<?php echo e(url('/')); ?>/admin/achivementComplete/<?php echo e($affiliate->id); ?>" class="btn btn-success">Paid</a>
            <?php endif; ?>
    </td>

</tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<tr><td colspan="9"><?php echo $affiliates->links(); ?></td></tr><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/achievement_pagination.blade.php ENDPATH**/ ?>