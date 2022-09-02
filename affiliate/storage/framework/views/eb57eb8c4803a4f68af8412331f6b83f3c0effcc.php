
<?php $__env->startSection('pageTitle'); ?>
    Top Earner  List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style type="text/css">
        tr {
            border: 1px solid #1D96B2;
        }

        th {
            border: 1px solid #1D96B2;
            border: 1px solid #fff;
        }

       .table tbody td {
            border: 1px solid #1D96B2 !important;
            height: 50px;
            font-size: 17px;
            color: #000
        }

        thead {
            background-color: #1d96b2;
            color: #fff
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <div class="table-responsive">
        <table  class="table table-striped table-bordered" style="width:100%;margin-top:0%;">
            <thead>
            <tr>
                <th style="text-align: center">Sl</th>

                <th>Name</th>

                <th style="text-align: center">Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $counter=1;
            ?>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php

        if($user->id==1 || $user->id==2 || $user->id==3){
            continue;
        }

$widtrow=DB::table('withdraw_history')
        ->where('from_user_id',$user->id)
        ->sum('withdraw_history.amount')
?>

                <tr>
                    <td style="text-align: center"><?php echo e($counter); ?></td>

                  <?php

                        $counter++;
                      ?>



                    <td><?php echo e($user->name); ?></td>

                    <td style="text-align: center"><?php echo e(number_format(round($user->life_time_earning,2))); ?></td>

                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/top_earner.blade.php ENDPATH**/ ?>