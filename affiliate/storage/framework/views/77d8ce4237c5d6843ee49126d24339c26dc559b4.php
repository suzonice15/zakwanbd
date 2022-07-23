
<?php $__env->startSection('pageTitle'); ?>
    All Education Post List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<div class="box-body">
    <div class="table-responsive" >
        <table   class="table table-bordered table-striped table-responsive ">
            <thead>
            <tr>
                <th  width="2%">Sl</th>
                <th width="10%">Education Type</th>
                <th  width="40%">Details / Link </th>
                <th  width="10%"> Created Date </th>
                <th  width="10%"> Status </th>
                <th  width="10%">Action </th>
            </tr>
            </thead>
            <tbody>

                <?php if(isset($educations)): ?>
<?php $i=0;?>
            <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($education->education_type); ?> </td>
                <td><?php echo "{$education->education_details}"; ?></td>
                <td><?php echo e(date('d-m-Y',strtotime($education->created_time))); ?></td>
                <td>
                	<?php if($education->status == 1): ?>
	                    <a type="button" class="btn btn-info btn-sm" href="<?php echo e(url('/admin/education/active/'.$education->id)); ?>">Active</a>
                    <?php else: ?>
	                    <a type="button" class="btn btn-danger btn-sm" href="<?php echo e(url('/admin/education/inactive/'.$education->id)); ?>">Inactive</a>
                    <?php endif; ?>
                </td>
                <td>
                    <a title="edit" href="<?php echo e(url('/admin/education-edit/')); ?>/<?php echo e($education->id); ?>">
                        <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>


                    <a title="delete" href="<?php echo e(url('/admin/education/delete')); ?>/<?php echo e($education->id); ?>" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                        <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                    </a></td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/Education/index.blade.php ENDPATH**/ ?>