
<?php $__env->startSection('pageTitle'); ?>
    Update Bonus Offer
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>


<div class="box-body">
    <div class="col-sm-offset-0 col-md-12">
        <form action="<?php echo e(url('admin/default/bonus-offer-submit')); ?>" class="form-horizontal"
              method="post">
            <?php echo csrf_field(); ?>
            <div class="box" style="border: 2px solid #ddd;">
                <div class="box-header with-border" style="background-color: green;color:white;">
                    <h3 class="box-title">Bonus Offer Setting</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding: 28px;">
                	<div class="form-group ">
                        <label for="site_title">Bonus Amount Percent</label>
                        <input type="text" class="form-control" name="offer" id="site_title" value="<?php echo e($bonusInfo->offer); ?>">
                    </div>
                   
                    <div class="form-group ">
                        <label for="site_title">Status</label>
                        <select class="form-control" name="status">
                        	<option value="1" <?php if($bonusInfo->status=='1'){echo "selected";} ?> >Active</option>
                        	<option value="2" <?php if($bonusInfo->status=='2'){echo "selected";} ?> >De-Active</option>
                        </select>
                    </div>
                    <div class="box-footer">
	                    <input type="submit" class="btn btn-success pull-left" value="Update">
	                </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/setting/bonusOffer.blade.php ENDPATH**/ ?>