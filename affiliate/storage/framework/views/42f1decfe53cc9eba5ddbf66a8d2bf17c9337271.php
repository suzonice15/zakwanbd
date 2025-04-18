
<?php $__env->startSection('pageTitle'); ?>
Commision Setting
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<div class="box-body">

<form action="<?php echo e(url('admin/commisionSetting')); ?>" method="post" >
    <?php echo csrf_field(); ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Income Type</th>
                <th>Person</th>
                <th>Income</th>
                <th>Income Limit</th>
            </tr>
        </thead>
        <tbody>
            

        <?php
    $incomeTypes = [
        'Direct Income' => 'direct',
        '1st Label Income' => '1st',
        '2nd Label Income' => '2nd',
        '3rd Label Income' => '3rd',
        '4th Label Income' => '4th',
        '5th Label Income' => '5th',
        '6th Label Income' => '6th',
        '7th Label Income' => '7th',
        // '8th Label Income' => '8th' 
    ];
    $savedData = collect($savedIncomeData ?? [])->keyBy('type');

?>

<?php $__currentLoopData = $incomeTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $data = $savedData->get($type, ['referar' => '', 'pay_per_order' => '', 'pay_limit' => '']);
?>
<tr>
    <th><?php echo e($label); ?></th>
    <th>
        <input type="hidden" name="type[]" value="<?php echo e($type); ?>" />
        <input type="text" name="referar[]"  value="<?php echo e($data['referar']); ?>" class="form-control" />
    </th>
    <th><input type="text" name="pay_per_order[]" value="<?php echo e($data['pay_per_order']); ?>" class="form-control" /></th>
    <th><input type="text" name="pay_limit[]"  value="<?php echo e($data['pay_limit']); ?>"  class="form-control" /></th>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

        </tbody>
    </table>

    <button type="submit" class="form-control btn btn-info">Update</button>

</form>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/commisionSetting.blade.php ENDPATH**/ ?>