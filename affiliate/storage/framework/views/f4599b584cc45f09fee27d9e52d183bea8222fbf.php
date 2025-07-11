
<?php $__env->startSection('pageTitle'); ?>
    Affiliate list

<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">

        <br/>

        <div class="container">

            <div class="row">

                <div class="col-md-7">

                    </div>
                <div class="col-md-4">
                    <form autocomplete="off">
<input 
    type="text" 
    class="form-control" 
    id="serachDb" 
    name="search_affiliate" 
    autocomplete="new-password" 
    placeholder="search here...">
                    </form>

                </div>
            </div>

            </div>
        <div class="table-responsive " style="margin-top: 10px;">
            <table  id="main_table" class="table table-bordered table-striped   ">
                <thead>
                <tr> 
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th> 
                    <th>Phone</th> 
                     <th>Designation</th>
                    <th>LT. Income</th>
                    <th>E. Balance</th>
                    <th>LT. Withdraw</th> 
                    <!-- <th>Skill Point</th> -->
                    <th>Date</th>
                      <th>Status</th>
                    <th>Action</th> 
                </tr>
                </thead>
                <tbody id="main_data">


              <?php echo $__env->make('admin.affilate.affilator_list_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                    url:"<?php echo e(url('/admin/affilite/affilite_pagination')); ?>?page="+page+"&query="+query,
                    success:function(data)
                    {
                        $('#main_data').html('');
                        $('#main_data').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serachDb', function(){
                var query = $('#serachDb').val();
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
                var query = $('#serachDb').val();
                fetch_data(page, query);
            });

        });




            $(document).on('click', '#affilite_id', function(){
                var affilite_id=  $(this).attr("data-id") // will return the string "123" 
            if(affilite_id) {   
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('/admin/affilite/affilite/show')); ?>?affilite_id=" + affilite_id,
                    success: function (data) {  
                        $('.affilite_details_id').empty();
                        $('.affilite_details_id').html(data); 
                    }
                })
            }

        });

        $(document).on('click', '#suspend_id', function(){
            var affilite_id=  $(this).attr("data-id") // will return the string "123"


            if(affilite_id) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('/admin/affilite/suspend/show')); ?>?affilite_id=" + affilite_id,
                    success: function (data) {

                        $('.suspend_id').empty();
                        $('.suspend_id').html(data);
                    }
                })
            }

        });
    </script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/affilator_list.blade.php ENDPATH**/ ?>