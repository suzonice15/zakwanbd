<?php $__env->startSection('pageTitle'); ?>
    Profile View
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

    <div class="box-body">

        <div class="row">
            <div class="col-md-7">
                <div class="well well-sm">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="POST" action="<?php echo e(url('profile')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="username">Name:</label>
                                    <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control"
                                           id="name" placeholder="Name">
                                    <input type="hidden" name="id" value="<?php echo e($user->id); ?>" class="form-control" id="name"
                                           placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="username">Phone:</label>
                                    <input type="text" name="phone" value="<?php echo e($user->phone); ?>" class="form-control"
                                           id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="username">National ID:</label>
                                    <input type="text" name="nation_id_number" value="<?php echo e($user->nation_id_number); ?>"
                                           class="form-control" id="nation_id_number" placeholder="national id">
                                </div>
                                <div class="form-group">
                                    <label for="username">Country:</label>
                                    <input type="text" name="country" value="Bangladesh" class="form-control"
                                           id="country" placeholder="country">
                                </div>

                                <div class="form-group">
                                    <label for="username">City:</label>
                                    <input type="text" name="city" value="<?php echo e($user->city); ?>" class="form-control"
                                           id="city" placeholder="city">
                                </div>
                                <div class="form-group">
                                    <label for="username">Post Code:</label>
                                    <input type="text" name="post_code" value="<?php echo e($user->post_code); ?>"
                                           class="form-control" id="post_code" placeholder="Post Code">
                                </div>
                                <div class="form-group">
                                    <label for="username">Address:</label>
                                    <textarea class="form-control" name="address"
                                              placeholder="address"><?php echo e($user->address); ?></textarea>
                                </div>

                                <div style="text-align: center;background: #ddd;padding: 7px;margin-top: -13px;width: 100%;margin-top: 5px;font-weight:bold">Nominee Information:</div>
                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">


                                    <div class="form-group">
                                        <label for="username">Nominee Name:</label>
                                        <input type="text" name="nominee_name" value="<?php echo e($user->nominee_name); ?>" class="form-control" id="nominee_name"
                                               placeholder="Nominee Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Nominee Mobile:</label>
                                        <input type="text" name="nominee_phone" value="<?php echo e($user->nominee_phone); ?>" class="form-control" id="nominee_phone"
                                               placeholder="Nominee Mobile">
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Nominee Relation:</label>
                                        <input type="text" name="nominee_relation" class="form-control"
                                               id="nominee_relation" value="<?php echo e($user->nominee_relation); ?>"  placeholder="Nominee Relation">
                                    </div>
                                    <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                        <label for="username">Nominee Picture:</label>
                                        <input type="file" name="nominee_national_id" class="form-control">
                                        <?php if($user->nominee_national_id): ?>
                                            <img class="img-responsive"
                                                 src="<?php echo e(url('/')); ?>/public/uploads/<?php echo e($user->nominee_national_id); ?>">
                                        <?php endif; ?>
                                    </div>

                                </div>


                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <?php if($user->reject_note): ?>
                                        <p style="font-weight: bold">Rejected Note</p>
                                        <p style="color:red"><?php echo e($user->reject_note); ?></p>
                                    <?php endif; ?>

                                </div>
                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <label for="username">Picture:</label>
                                    <input type="file" name="picture" class="form-control">
                                    <?php if($user->picture): ?>
                                        <img class="img-responsive"
                                             src="<?php echo e(url('/')); ?>/public/uploads/<?php echo e($user->picture); ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <label for="username">National Id Card:</label>
                                    <input type="file" name="nationalIdPicture" class="form-control">
                                    <?php if($user->nationalIdPicture): ?>
                                        <img class="img-responsive"
                                             src="<?php echo e(url('/')); ?>/public/uploads/<?php echo e($user->nationalIdPicture); ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <label for="username">Bank Statement/Electric bill/Gas/ Wasa bill Picture:</label>
                                    <input type="file" name="addressVarifiedPicture" class="form-control">
                                    <?php if($user->addressVarifiedPicture): ?>
                                        <img class="img-responsive"
                                             src="<?php echo e(url('/')); ?>/public/uploads/<?php echo e($user->addressVarifiedPicture); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right"
                                           value="Update Profile">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <legend>
                            <img src="<?php echo e(url('/')); ?>/public/uploads/<?php echo e($user->picture); ?>">

                            My Profile
                        </legend>
                        <h4>Wallet Balance: <?php echo e($user->ewallet_balance); ?> TK</h4>
                        <h4>Earning Balance: <?php echo e($user->earning_balance); ?> TK</h4>
                        
                        <h4>Skill Points : <?php echo e($skil_point); ?> SP</h4>
                        <h4>Bonus: <?php echo e($user->bonus_balance); ?> TK</h4>

                        <div>Name: <?php echo e($user->name); ?></div>
                        <div>My Account: <?php echo e($user->email); ?></div>
                        <div>My Referral ID: <?php echo e($user->id); ?></div>
                        <div>Address: <?php echo e($user->address); ?></div>
                        <div>Email: <?php echo e($user->email); ?></div>

                        <?php
                        $referrer_name = DB::table('users_public')
                                ->where('id', '=', $user->parent_id)
                                ->first();
                        ?>
                        <div>Referrer: <?php if ($referrer_name) {
                                echo $referrer_name->name;
                            } else {
                                echo "No Referrer";
                            } ?></div>

                        <div>Created: <?php echo e($user->created); ?></div>

                    </div>
                </div>
            </div>
        </div>


    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/profile.blade.php ENDPATH**/ ?>