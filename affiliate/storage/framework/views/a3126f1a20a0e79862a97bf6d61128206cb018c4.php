
<?php $__env->startSection('pageTitle'); ?>
    Message
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <section class="invoice">

        <div class="row invoice-info">

            <div class="col-md-12">

                <form action="<?php echo e(url('/')); ?>/admin/message" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Affilator List</label>
                        <select name="user_id" class="form-control select2">

                            <option value="0">All</option>
                           <?php $__currentLoopData = $affilator; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $affilate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($affilate->id); ?>"><?php echo e($affilate->name); ?></option>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                    </div>
                    
                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="10" name="message" cols="10" class="form-control ckeditor"></textarea>

                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-success">Send</button>

                    </div>


                </form>
            </div>


        </div>




    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/message.blade.php ENDPATH**/ ?>