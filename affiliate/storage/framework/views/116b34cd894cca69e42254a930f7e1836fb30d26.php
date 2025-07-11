
<?php $__env->startSection('pageTitle'); ?>
     Withdraw  Status Change
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<div class="box-body">
<br/>
	<div class="row  justify-content-center">
		<div class="col-md-3">
			</div>
	    <div class="col-md-5">
			<form method="post" action="<?php echo e(url('/admin/updateWithdrawStatus')); ?>">
			<?php echo csrf_field(); ?>
				<input type="hidden" name="id" value="<?php echo e($id); ?>">
			    <div class="form-group">
			      <select class="form-control" id="" name="status">
			        <option value="0">Request</option>
			        <option value="1">Paid</option>
			        <option value="2">Rejected</option>
			      </select>
			    </div>
				<?php if($withdraw_data->status==1): ?>
					<button type="button" class="btn btn-info btn-lg">You already Paid</button>

				<?php else: ?>
			    <button type="submit" class="btn btn-info btn-lg">update</button>
					<?php endif; ?>
			</form>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/editWithdrawStatus.blade.php ENDPATH**/ ?>