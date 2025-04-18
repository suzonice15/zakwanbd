<?php if(isset($incomes)): ?>
    <?php $i=$incomes->perPage() * ($incomes->currentPage()-1);?>
    <?php $__currentLoopData = $incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e(@$income->incomeFor->name); ?>(<?php echo e(@$income->incomeFor->id); ?>)</td>
            <!-- <td><?php echo e(@$income->incomeFor->email); ?></td> -->
            <!-- <td><?php echo e(@$income->incomeFor->phone); ?></td> -->
            <td><?php echo e(@$income->incomeFrom->name); ?>(<?php echo e(@$income->incomeFrom->id); ?>)</td>
          
            <td class="text-center"><?php echo e($income->previous_income > 0  ? $income->previous_income : 0); ?> Tk.</td>
            <td class="text-center"><?php echo e($income->amount); ?> Tk.</td>
            <td class="text-center"><?php echo e($income->after_income); ?> Tk.</td>
            <td class="text-center"><?php echo e($income->order_id); ?></td> 
            <td class="text-center"><?php echo e($configs[$income->layer] ?? ''); ?></td> 
            </td>
            <td><?php echo e(date('d-m-Y h:ia',strtotime($income->created_at))); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td colspan="13" align="center">
            <?php echo $incomes->links(); ?>

        </td>
    </tr>
<?php endif; ?>


<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/admin_labelHistoryPagination.blade.php ENDPATH**/ ?>