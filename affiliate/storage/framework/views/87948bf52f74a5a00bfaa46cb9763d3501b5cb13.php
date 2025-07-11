


<?php $__env->startSection('pageTitle'); ?>
    My Mobile Account
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">


        <div class="row">

            <div class="col-md-6">
                <div class="well well-sm">
                    <div class="panel panel-success">

                        <div class="panel-heading" style="font-weight: bold;">Mobile Account Details </div>

                        <div class="panel-body">
                            <form method="POST" action="<?php echo e(URL::to('/mobile_update')); ?>">
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul>
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="ac_name">Ac Name:</label>
                                    <input type="text" name="ac_name" value="<?php if(isset($mobile_row->ac_name)){ echo $mobile_row->ac_name;} ?>" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <label for="ac_number">Ac Number:</label>
                                    <input type="number" name="ac_number" value="<?php if(isset($mobile_row->ac_number)){ echo $mobile_row->ac_number;} ?>" class="form-control" placeholder="Rocket/Nagad=01700-000-000">
                                </div>

                                <div class="form-group">
                                    <label for="service_name">Service Name:</label>

                                    <select id="service_name" name="service_name" class="form-control">
                                        <option value="">Select Option</option>
                                        <option <?php if(isset($mobile_row->service_name)){  echo $mobile_row->service_name=='Nagad  Personal'? 'selected':'';} ?> value="Nagad  Personal">Nagad  Personal</option>
                                        <option <?php if(isset($mobile_row->service_name)){  echo $mobile_row->service_name=='Rocket   Personal'? 'selected':'';} ?> value="Rocket   Personal">Rocket   Personal</option>

                                    </select>
                                 </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                                    <br>
                                    <br>
                                    <?php if(Session::has('success')): ?>
                                        <div class=" fadeOut alert alert-success" role="alert">
                                            <?php echo e(Session::get('success')); ?>

                                        </div>

                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="well well-sm">
                    <div class="panel panel-success">

                        <div class="panel-heading" style="font-weight: bold;">Bank Account Details </div>

                        <div class="panel-body">
                            <div class="panel-body">

                                <form method="POST" action="<?php echo e(URL::to('/bank_update')); ?>">
                                    <?php echo csrf_field(); ?>


                                    <div class="form-group">
                                        <label for="ac_name">Ac Name:</label>
                                        <input type="text" name="ac_name" required="" value="<?php if(isset($bank_row->ac_name)){ echo $bank_row->ac_name;} ?>" class="form-control" id="name" placeholder="Your Account Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="ac_number">Ac Number:</label>
                                        <input type="text" name="ac_number" required="" value="<?php if(isset($bank_row->ac_number)){ echo $bank_row->ac_number;} ?>" class="form-control" id="email" placeholder="Your Account Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="ac_branch">Branch Name:</label>
                                        <input type="text" name="ac_branch" required="" value="<?php if(isset($bank_row->ac_branch)){ echo $bank_row->ac_branch;} ?>" class="form-control"   placeholder="Bank Branch Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name:</label>
                                        <input type="text" name="bank_name" required="" value="<?php if(isset($bank_row->bank_name)){ echo $bank_row->bank_name;} ?>" class="form-control" id="address" placeholder="Bank Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="save" class="btn btn-primary pull-right" value="Update">

                                        <br>
                                        <br>
                                        <?php if(Session::has('banK_success')): ?>
                                            <div class=" fadeOut alert alert-success" role="alert">
                                                <?php echo e(Session::get('banK_success')); ?>

                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <script>

        $('.fadeOut').fadeOut(5000);
    </script>


<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/mobile_account.blade.php ENDPATH**/ ?>