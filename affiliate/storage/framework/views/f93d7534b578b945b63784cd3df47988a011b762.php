
<?php $__env->startSection('pageTitle'); ?>
    Changed Password
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <div class="box-body">

        <div class="row">
            <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form onsubmit ="return verifyPassword()" method="POST" action="<?php echo e(url('channedPassword')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
<?php if(isset($success)): ?>
                                <div class="alert alert-success" role="alert">
 <?php echo e($success); ?>

</div>
<?php endif; ?>
                                <div class="form-group">
                                    <label for="username">Old Password:</label>
                                    <input type="password" name="old_password" value="" class="form-control"
                                           id="old_password" placeholder="Old Password">
                                </div>

                                <div class="form-group">
                                    <label for="username">New Password:</label>
                                    <input type="password" name="new_password" value="" class="form-control"
                                           id="new_password" placeholder="New  Password">
                                </div>
                                <div class="form-group">
                                    <label for="username">Confirm Password:</label>
                                    <input type="password" name="confirm_password" value="" class="form-control"
                                           id="confirm_password" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success">Update </button>
                                </div>
                                <div>
                                    <p id="message" style="color:red"></p>
                                </div>
                            </form>
                        </div>
                    </div>

            </div>

        </div>


    </div>

    <script>
        function verifyPassword() {

            var pw = document.getElementById("new_password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            //check empty password field
            if(pw == "") {
                document.getElementById("message").innerHTML = "**Fill the password please!";
                return false;
            }
            if(pw != confirm_password) {
                document.getElementById("message").innerHTML = "** New Password    and Confirm Password does not matched";
                return false;
            } 
            return true;
 
        }
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/channedPassword.blade.php ENDPATH**/ ?>