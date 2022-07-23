     <ul class="users">


        <!--                        --><?php
        //                              echo '<pre>';
        //                        print_r($users);exit();
        //                        ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php
         $affiliate=DB::table('users_public')->select('name','email','picture')->where('id','=',$user->affiliate_id)->first();

             if($affiliate){
           $unread=DB::table('messages')->where('affiliate_id',$user->affiliate_id)->where('is_read','=',0)->count();

              if($affiliate->picture){
                  $picture=$affiliate->picture;
              } else{
                  $picture='user.png';
              }
         ?>
        <li class="user" id="<?php echo e($user->affiliate_id); ?>">

            <?php if($unread >0): ?>
            <span class="pending"><?php echo e($unread); ?></span>
            <?php endif; ?>

            <div class="media">
                <div class="media-left">
                    <img src="<?php echo e(url('/')); ?>/public/uploads/<?php echo e($picture); ?>" alt="" class="media-object">
                </div>

                <div class="media-body">
                    <p class="name"><?php echo e($affiliate->name); ?></p>
                    <p class="email"><?php echo e($affiliate->email); ?></p>
                </div>
            </div>
        </li>
         <?php }?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views//admin/affilate/getChatUser.blade.php ENDPATH**/ ?>