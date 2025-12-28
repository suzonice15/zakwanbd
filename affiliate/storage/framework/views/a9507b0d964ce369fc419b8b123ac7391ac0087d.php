<div class="container-fluid text-center">
    <div class="row">
        <?php if($supend_account) {
        if($supend_account->status) {
        ?>
        <div class="box" style="border:2px solid #ddd">
            <div  style="background-color:red;color:white" class="box-header with-border">
                <h4 class="box-title">Your account has been suspended
                </h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><?php echo e($supend_account->message); ?></p>
                    </div>
                    <div class="col-md-6">
                        Suspention period:
                        <?php if($supend_account->life_time==1) {
                        ?>
                        For Life Time
                        <?php } else { ?>
                        from <?=date('d-m-Y',strtotime($supend_account->start_date))?>  to <?=date('d-m-Y',strtotime($supend_account->end_date))?>
                        <?php } ?>


                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <?php  } } ?>
        <div class="col-lg-3 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua" style="height: 120px">
                <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Lifetime Earning </a>
                <div class="inner">
                    <h3 style="font-size: 30px;"><?php $lifeEarn=($user->life_time_earning);
                        echo number_format($lifeEarn, 2); ?> Tk</h3>
                </div>
                <div class="icon">
                    <i class="fa fa-line-chart"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-xs-12">

            <!-- small box -->
            <div class="small-box bg-green" style="height: 120px">
                <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Total Withdraw</a>
                <div class="inner">
                    <h3 style="font-size: 30px;"> <?php echo number_format($total_withdraw, 2); ?> Tk</h3>


                </div>
                <div class="icon">
                    <i class="fa fa-won"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-xs-12">

            <!-- small box -->
            <div class="small-box bg-yellow" style="height: 120px">
                <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Sales Team Partner</a>
                <div class="inner">
                    <h3 style="font-size: 30px;"> <?php echo e($totals_refer); ?></h3>


                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-xs-12">

            <!-- small box -->
            <div class="small-box bg-red" style="height: 120px">
                <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">My Desination</a>
                <div class="inner">
                    <h3 style="font-size: 20px;">  Retail & Seller</h3>


                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>

            </div>
        </div>
    </div>



    <div class="box box-success" style="border: none">
        <div class="box-header box-success" style="background-color: #094579d9">
            <h3 class="box-title" style="text-align:center;font-weight: bold;display:block;color:#fff">My Available Balances</h3>
        </div>


        <div class="row" style="padding-top: 20px">

            <div class="col-lg-3 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-aqua" style="height: 120px">
                    <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Earning Balance</a>
                    <div class="inner">
                        <h3 style="font-size: 30px;"> <?php echo number_format($user->earning_balance, 2); ?> Tk</h3>


                    </div>
                    <div class="icon">
                        <i class="fa fa-dollar"></i>
                    </div>

                </div>
            </div>


            <div class="col-lg-3 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-green" style="height: 120px">
                    <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Bonus Balance</a>
                    <div class="inner">
                        <h3 style="font-size: 30px;"> <?php echo number_format($user->bonus_balance, 2); ?> Tk</h3>


                    </div>
                    <div class="icon">
                        <i class="fa fa-gift"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-yellow" style="height: 120px">
                    <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Total Sell  </a>
                    <div class="inner">
                        <h3 style="font-size: 30px;"><?php

                            echo $order_count; ?> </h3>


                    </div>
                    <div class="icon">
                        <i class="fa fa-suitcase"></i>
                    </div>

                </div>
            </div>

            <div class="col-lg-3 col-xs-12">

                <!-- small box -->
                <div class="small-box bg-red" style="height: 120px">
                    <a class="small-box-footer" style="color: white; font-weight: bold; font-size: 18px">Wallet Balance</a>
                    <div class="inner">
                        <h3 style="font-size: 30px;"> <?php echo number_format($user->ewallet_balance, 2); ?>Tk</h3>


                    </div>
                    <div class="icon">
                        <i class="fa fa-google-wallet"></i>
                    </div>

                    <div class="other">
                        <button type="button"   style="
    margin-top: -10px;
"  class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-money">
                            Add Money
                        </button>
                    </div>


                </div>
            </div>
        </div>


    </div>

</div>

<div class="row">
     <div class="col-md-6 col-12">
     <table class="table table-bordered">
        <thead>
              <tr>
                <th colspan="2" class="text-center" style="background:#ddd">
                    <span style="font-size:20px">Monthly Salary Report</span>
                    <br/>
Target-Based Salary Statement </th> 
            </tr>
            <tr>
                <th class="text-center">Designation      </th>
                <th class="text-center">Monthly Salary</th>  
            </tr>
        </thead>
        <tbody>
            

                        <?php

                                        
                    $levelTitles = [
                        1 => 'Sales Executive',
                        2 => 'Marketing Executive',
                        3 => 'Marketing Manager',
                        4 => 'Sales & Marketing Supervisor',
                        5 => 'HR',
                        6 => 'AGM',
                        7 => 'GM',
                    ];
 

                    $incomeTypes = [ 
                        '1st Label  ' => '1',
                        '2nd Label  ' => '2',
                        '3rd Label  ' => '3',
                        '4th Label  ' => '4',
                        '5th Label  ' => '5',
                        '6th Label  ' => '6',
                        '7th Label  ' => '7',
                        // '8th Label  ' => '8'  
                    ];
                    $savedData = collect([])->keyBy('type');

                ?>

               

                <?php
    // Reverse the array to start checking from 7 down to 1
    $reversedIncomeTypes = array_reverse($incomeTypes, true);
    $shown = false; 
?>

<?php $__currentLoopData = $reversedIncomeTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $value = $user->{'income_layer_' . $type};
         $finalLabel = $levelTitles[$type] ?? "";
    ?>

    
    <?php if(!empty($value) && !$shown): ?>
        <tr>
            <th class="text-center"><?php echo e($finalLabel); ?></th>
            <th class="text-center">
                <?php echo e($value); ?> 
            </th>
        </tr>
        <?php $shown = true; ?> 
        <?php break; ?> 
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
    </table>
     </div> 
</div>

<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/layouts/affiliate_dashboard_top.blade.php ENDPATH**/ ?>