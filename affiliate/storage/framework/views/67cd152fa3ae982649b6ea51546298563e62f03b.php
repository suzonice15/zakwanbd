
<?php $__env->startSection('pageTitle'); ?>
  Dashboard View
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<br>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($affilites); ?></h3>

                    <p>Total Affilates</p>
                </div>
                <div class="icon">
                    <i class="ion ion-man"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($online_now); ?></h3>
                    <p>Online Now</p>
                </div>
                <div class="icon">
                    <i class="ion ion-man"></i>
                </div>
                
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">

                    <h3><?php echo e($today_visitor); ?></h3>
                    <p>Today Visitors</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
                   </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($last_week); ?></h3>
                    <p>This Week</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
                       </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">

                    <h3><?php echo e($this_mount_user); ?></h3>
                    <p>This Month</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
                       </div>
        </div>


   <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($totalOrderCount); ?></h3>
                    <p>Total Complete Order</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($total_sell); ?></h3>
                    <p>Total Complete Sells Amount</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e(round($earning_balance,2)); ?></h3>
                    <p> Earnings Balance  </p>
                    <div class="icon">
                        <i class="ion ion-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo e($pendingWithdraw); ?></h3>
                    <p> Pending Withdraw  </p>
                    <div class="icon">
                        <i class="ion ion-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e($paidWithdraw-$withdrawCharge); ?></h3>
                    <p> Complete Withdraw  </p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e($withdrawCharge); ?></h3>
                    <p>   Withdraw Charge </p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ./col -->
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>