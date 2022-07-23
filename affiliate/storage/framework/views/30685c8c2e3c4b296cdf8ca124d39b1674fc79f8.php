
<?php $__env->startSection('pageTitle'); ?>
   Online Users ( <span id="total_affilate"><?php echo e($affilates_total); ?></span>)

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">

        <br/>


        <div class="table-responsive">




            <table  id="main_table" class="table table-bordered table-striped   ">
                <thead>
                <tr>


                    <th>User Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Login Time</th>

                </tr>
                </thead>
                <tbody>




<?php echo $__env->make('admin.affilate.online_user_ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



                </tbody>

            </table>

        </div>



    </div>


    <script>
        $(document).ready(function(){

            function fetch_data()
            {
                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('/admin/online/ajax')); ?>",
                    success:function(data)
                    {
                        console.log(data);
                        $('tbody').html('');
                        $('tbody').html(data);
                    },
                    error:function (data) {
                        console.log(data)

                    }
                });
                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('/admin/online/ajax_total')); ?>",
                    success:function(data)
                    {
                       $('#total_affilate').text(data);
                    },
                    error:function (data) {


                    }
                });


            }

            setInterval(fetch_data, 160000);


        });
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/online_user.blade.php ENDPATH**/ ?>