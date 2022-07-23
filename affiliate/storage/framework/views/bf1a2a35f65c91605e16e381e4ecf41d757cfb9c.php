
<?php $__env->startSection('pageTitle'); ?>
   Product Notification Delete list
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <!-- general form elements -->
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Product Notification Delete Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo e(url('/')); ?>/admin/product/notification/delete" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="box-body">

                            <div class="form-group">
                             <h3 style="color:red"> <?php echo e(Session::get('success')); ?></h3>

                             </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="date" placeholder="Enter your date" required>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

        </div>


    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/notificationDelete.blade.php ENDPATH**/ ?>