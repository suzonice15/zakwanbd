
<?php $__env->startSection('pageTitle'); ?>
    All Products   List
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<div class="box-body">
    <div class="row">
        <div class="col-md-2">
        </div>

        <div class="col-md-5  pull-right">
            <input type="text" id="serach" name="search" placeholder="Search Product By Product Code Or Product Name" class="form-control" >
        </div>
    </div>
    <br/>
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th>

                <th>Product Code</th>
                <th>Product</th>
                <th>Purchase Price</th>
                <th>Sell Price</th>
                <th>Discount Price</th>
                <th>Product Profite</th>

                <th>Published Status</th>
                <th>Registration date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

               <?php echo $__env->make('admin.affilate.product_list_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                url:"<?php echo e(url('/admin/product_list_pagination')); ?>?page="+page+"&query="+query,
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/product_list.blade.php ENDPATH**/ ?>