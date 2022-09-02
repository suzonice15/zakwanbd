<?php

if($affilates){
 foreach($affilates as $row ){
$skil_point=DB::table('marketing_metarial')->where('affiliate_id',$row->id)->where('status',1)->sum('marketing_metarial.skill_point');


$account_suspend=DB::table('account_suspend')->where('user_id',$row->id)->orderBy('account_suspend_id','desc')->first();
        if($account_suspend){
            $account_suspend= $account_suspend->status;

        } else {
            $account_suspend=0;

        }

?>

<tr>

    <td><?php echo e($row->id); ?></td>
    <td><?php echo e($row->name); ?></td>

    <td><?php echo e($row->email); ?></td>
    <td>
        <?php
            $lavel = DB::table('affilite_commission_lavel')->where('user_id',$row->id)->where('active', '=', 1)->orderBy('commision_lavel_id', 'desc')->first();
            if ($lavel) {
                echo $lavel->lavel;
            }else{
                echo "1";
            }
        ?>
    </td>
    <td><?php echo e($row->phone); ?></td>

    <td>
       <?php if($row->token=='ok'): ?>

            <span class = "label label-success">Active</span>
            <?php else: ?>
            <span class = "label label-danger">Inactive</span>

           <?php endif; ?>

    </td>
    <td><?php echo e($row->life_time_earning); ?></td>
    <td><?php echo e($row->withdraw_balance); ?></td>

    <td><?php echo e($skil_point); ?></td>
    <td><?php echo e(date('d,M,Y',strtotime($row->created))); ?></td>


    <td>
        <?php if($row->token=='ok'): ?>

        <?php else: ?>
            <a  href="<?php echo e(url('/')); ?>/affiliate/active/<?php echo e($row->id); ?>">
                <span class="glyphicon glyphicon-check btn btn-info"></span>
            </a>
        <?php endif; ?>
        <a id="affilite_id" data-id="<?php echo e($row->id); ?>" data-toggle="modal" data-target="#modal-default" href="#">
            <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
        </a>

        <?php if($account_suspend==1){ ?>

        <a id="suspend_id" data-id="<?php echo e($row->id); ?>" data-toggle="modal" class="btn btn-danger" data-target="#modal-suspend" href="#">

            Already Suspend
        </a>
        <?php } else { ?>
        <a id="suspend_id" data-id="<?php echo e($row->id); ?>" data-toggle="modal" class="btn btn-info" data-target="#modal-suspend" href="#">

            Suspend Now
        </a>
        <?php } ?>

    </td>

</tr>

<?php
}


} ?>

<tr>
    <td colspan="9" align="center">
        <?php echo $affilates->links(); ?>

    </td>
</tr>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Affiliate Details</h4>
            </div>
            <div class="modal-body" >

                <span class="affilite_details_id"></span>


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="modal fade" id="modal-suspend">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Affiliate  Suspend Details</h4>
            </div>
            <div class="modal-body" >

                <span class="suspend_id"></span>


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/affilator_list_pagination.blade.php ENDPATH**/ ?>