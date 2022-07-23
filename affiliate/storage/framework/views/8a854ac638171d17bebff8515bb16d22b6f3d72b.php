<?php $__env->startSection('pageTitle'); ?>
    All pages List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<div class="box-body">
    <div class="table-responsive" >
        <table   class="table table-bordered table-striped table-responsive ">
            <thead>
            <tr>
                <th  width="2%">Sl</th>
                <th width="10%">Page Name </th>
                <th  width="10%">Page Link </th>
                <th  width="30%">Page Description </th>
                <th  width="10%"> Created date </th>
                <th  width="10%">Action </th>
            </tr>
            </thead>
            <tbody>

                <?php if(isset($pages)): ?>
<?php $i=0;?>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($page->page_name); ?> </td>
                <td><?php echo e($page->page_link); ?> </td>
                <td><?php echo strip_tags($page->page_content); ?> </td>
                <td><?php echo e(date('d-m-Y',strtotime($page->created_time))); ?></td>

                <td>
                    <a title="edit" href="<?php echo e(url('/admin/page/')); ?>/<?php echo e($page->page_id); ?>">
                        <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>


                    <a title="delete" href="<?php echo e(url('/admin/page/delete')); ?>/<?php echo e($page->page_id); ?>" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/page/index.blade.php ENDPATH**/ ?>