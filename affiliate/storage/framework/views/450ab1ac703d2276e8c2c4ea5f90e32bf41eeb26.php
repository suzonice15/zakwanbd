<style>
    .fs-large{
        font-size: 20px;
        font-weight: bold;
    }
    .fs-small{
        font-size: 18px;
        font-weight: bold;
    }
</style>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="background-color: #9f29ff">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
               $image= Session::get('picture');
                    if($image){
                ?>
                <img src="<?php echo e(url('public/uploads/')); ?>/<?php echo e(Session::get('picture')); ?>" class="img-circle"
                     alt="User Image">

                <?php } else { ?>

                    <img  src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads/user.png" class="img-circle"
                         alt="User Image">

                <?php } ?>
            </div>
            <div class="pull-left info">
                <p style="color:white;font-weight: bold"><?php echo e(Session::get('name')); ?></p>
                <?php
                $status= Session::get('status');
                ?>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                <?php if($status=='user'): ?>
                <br>
                <a href="<?php echo e(url('/profile')); ?>">
                <?php if(Session::get('accountVarificationStatus')==1): ?>
                    <span style="color:green">Verified</span>
                    <?php elseif(Session::get('accountVarificationStatus')==2): ?>
                    <span style="color:green">National Id Verified</span>
                <?php elseif(Session::get('accountVarificationStatus')==3): ?>
                    <span style="color:green">Address  Verified</span>
                <?php elseif(Session::get('accountVarificationStatus')==4): ?>
                    <span style="color:red">Pending</span>
                    <?php else: ?>
                        <span style="color:red">Verify your account</span>
                    <?php endif; ?>
                </a>
                    <?php endif; ?>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li>
                <a href="<?php echo e(url('/dashboard')); ?>">
                    <i class=" fs-large fa fa-dashboard"></i> <span>&nbsp Dashboard</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
             <?php
                 if($status =='user'){
                ?>
           <?php echo $__env->make('layouts.includes.affiliate_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php
                }
            if($status =='super-admin'){
            ?>
            <?php echo $__env->make('layouts.includes.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php }

            if($status =='office-staff' || $status =='editor' ){

                ?>

            <li>
                <a href=" <?php echo e(url('admin/chat/')); ?>"><i class="fa fa-user" style="font-size: 20px"></i>&nbsp &nbsp Chat </a>
            </li>
            <li>
                <a href=" <?php echo e(url('/admin/marketing/metarial')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i>   Member Marketing Material  </a>
            </li>
            <li>
                <a href=" <?php echo e(url('admin/affilator_list')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i>  Affilator list</a>
            </li>


            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


<script >

    function withdraw_count() {

        $.ajax({
            url:"<?php echo e(url('/')); ?>/withdraw/notification/count",
            success:function (data) {
                $('#withdraw_count').text(data)
            }
        })
    }
    function user_chat_count() {

        $.ajax({
            url:"<?php echo e(url('/')); ?>/user_chat_count",
            success:function (data) {
                if(data>0){
                    $('#user_chat_count').text(data)

                } else {

                    $('#user_chat_count').hide()
                }

            }
        })
    }


    window.onload = function(e){
        withdraw_count()
        user_chat_count()
    }

</script>
<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/layouts/includes/sidebar.blade.php ENDPATH**/ ?>