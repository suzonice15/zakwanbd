
<?php $__env->startSection('pageTitle'); ?>
   Affiliate Complain
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <div class="box-body">
        <div class="row">
        <div class="col-md-8">

            <form action="<?php echo e(url("affiliate/complainStore")); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="form-group">
                    <h4 style="color:green"><?php echo e(session::get('success')); ?></h4>
                       </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Enter Your Complain</label>
                    <textarea  required name="affiliate_complain" class="form-control" placeholder="Enter Your Complain" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">

                    <input type="submit" class="btn btn-success" value="Submit">



                  </div>
            </form>



        </div>
        </div>
        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>

                    <th>Complain Name</th>

                    <th>Complain Answer</th>
                    <th>Status</th>
                    <th>Created at</th>

                </tr>
                </thead>
                <tbody>


                <?php $i=$complains->perPage() * ($complains->currentPage()-1);?>

                <?php


                if (!empty($complains))
                {
                foreach ($complains as $complain)
                {

                ?>
                <tr>
                    <td><?= ++$i?></td>

                    <td><?= $complain->affiliate_complain?></td>
                    <td><?= $complain->affiliate_answer?> </td>
                    <td><?= $complain->status?> </td>


                    <td><?= date('d-m-Y  h:i a',strtotime($complain->created_at))?></td>


                </tr>

                <?php }
                        }

                ?>


                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>




<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/affiliateComplain.blade.php ENDPATH**/ ?>