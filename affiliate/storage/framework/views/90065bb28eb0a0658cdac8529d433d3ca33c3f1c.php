
<?php $__env->startSection('pageTitle'); ?>
    Super Offer(<?=$total_user?>
    )
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">

        <br/>

        <div class="container">

        </div>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>

                    <th>Phone</th>

                    <th>Acount Type</th>
                    <th>Sender Number</th>
                    <th>Transaction Id</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th> Date</th>
                    <th>Action</th>


                </tr>
                </thead>
                <tbody>

                <?php echo $__env->make('admin.affilate.admin_super_offer_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>

    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('/admin/super/offer/pagination')); ?>?page="+page+"&query="+query,
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serach', function(){
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                if(query.length >0) {
                    fetch_data(page, query);
                } else {
                    fetch_data(1, '');
                }
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                fetch_data(page, query);
            });

        });
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/admin_super_offer.blade.php ENDPATH**/ ?>