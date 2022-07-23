
<?php $__env->startSection('pageTitle'); ?>
   Service Charge List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">

    <div class='row'>
        <div class="col-md-6">
            <h3>Total :<?php echo e($charge->amount); ?></h3>
        </div>
        <div class="col-md-6">
            <a  href="<?php echo e(url('/')); ?>/admin/getServiceChargeFromAffiliate"  class="btn btn-success">Get Charge</a>  
        </div>
    </div>



        <div class="table-responsive">
            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>                   
                    <th>Name</th>
                    <th>ID</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Date</th>                           
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(++$key); ?></td>
                        <td><?php echo e($charge->name); ?></td>
                        <td><?php echo e($charge->id); ?></td>
                        <td><?php echo e($charge->phone); ?></td>
                        <td><?php echo e($charge->amount); ?></td>
                        <td><?php echo e(date("d/m/Y",strtotime($charge->created_date))); ?></td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
                </tbody>
            </table>
        </div> 
    </div>

 


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/getCharge.blade.php ENDPATH**/ ?>