
<?php $__env->startSection('pageTitle'); ?>
    Campaign  Report
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <div class="box-body">

        <br/>

        <div class="container">
        <div class="row align-items-center justify-content-center">

            <div class="col-md-12 justify-content-center">
            <form class="form-inline" action="<?php echo e(url('admin/campain/date_wise_report')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="date">From Date:</label>
                    <input type="date" class="form-control"  name="from_date" id="date">
                </div>
                <div class="form-group">
                    <label for="pwd">To Date:</label>
                    <input type="date" class="form-control" name="to_date" >
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>

        </div>
            </div>
        <div class="table-responsive">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Click</th>
                        <th>Sell</th>
                        <th>Commision</th>
                        <th>Campaign Created </th>
                    </tr>
                </thead>
                <tbody>
                        <?php

                    if($affilates){

                    foreach($affilates as $row ){

                    $click = DB::table('product_hit_count')->where('user_id', $row->user_id)->where('product_id', $row->product_id)->count();
                    $order = DB::table('user_order_count')->where('user_id', $row->user_id)->where('link_id', $row->id)->count();
                    $sum_order = DB::table('product_link_info')->select('commision')->join('user_commission', 'user_commission.link_id', '=', 'product_link_info.id')->join('earning_history', 'earning_history.order_id', '=', 'user_commission.order_id')->where('product_link_info.user_id', $row->user_id)->where('product_link_info.id', $row->id)->sum('earning_history.commision');

                    ?>

                    <tr>
                        <td><?php echo e($row->name); ?></td>

                        <td><?php echo e($row->product_link); ?></td>


                        <td><?php echo e($click); ?></td>
                        <td><?php echo e($order); ?></td>
                        <td><?php echo e($sum_order); ?></td>
                        <td><?php echo e(date('d/m/Y',strtotime($row->create_date))); ?></td>
                        <?php
                        }


                        } ?>
                    </tr>
                </tbody>
                
            </table>

        </div>



    </div>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/admin_campain_report.blade.php ENDPATH**/ ?>