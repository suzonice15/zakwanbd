
<?php $__env->startSection('pageTitle'); ?>
    Achivement
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style type="text/css">
        option{
            color: #000;
        }
    </style>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12" id="orderhistory">
                <h3>Transaction History</h3>
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Achivement</th>
                            <th>Status</th>
                            <th>Created Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php echo $__env->make('admin.affilate.achievement_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
    <script type="text/javascript">

    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/achievement.blade.php ENDPATH**/ ?>