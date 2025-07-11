<?php if(isset($withdraws)): ?>
    <?php $i=$withdraws->perPage() * ($withdraws->currentPage()-1);?>
    <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php

       $amount= $withdraw->amount;
       $payableAmount=($amount- ($withdraw->amount * $deduction)/100);

        


      $name=  DB::table('users_public')->where('id',$withdraw->from_user_id)->value('name');

        ?>
        <tr style="<?php if($withdraw->status==1): ?> background-color: green;color:white <?php endif; ?>">
            <td><?php echo e(++$i); ?></td> 
            <td><?php echo e($name); ?> (<?php echo e($withdraw->from_user_id); ?>)</td>
            <td><?php echo e($withdraw->id); ?></td>
            <td><?php echo e($withdraw->to_user_ac); ?></td>
            <td><?php echo e($withdraw->account); ?></td>
             <td >
                <?php if($withdraw->account_number): ?>
                <input type="text"   <?php if($withdraw->status == 1): ?>  style="color:#000" <?php endif; ?> id="<?php echo e($withdraw->id); ?>" value="<?php echo e($withdraw->account_number); ?>">
                <?php if($withdraw->status == 0): ?>
                <button class="btn btn-success btn-sm" onclick="return AccountNumberCopy(<?php echo e($withdraw->id); ?>)">Copy</button>
                <br/>
                <span  style="color:green;font-weight:bold" id="result_<?php echo e($withdraw->id); ?>"></span>
                <?php endif; ?>
                    <?php endif; ?>
            </td>
            <td>
                <?php if($withdraw->status != 3): ?>
                <?php echo e($withdraw->amount); ?>

                <?php endif; ?>
            
            </td>
            <td>
              <?php if($withdraw->status != 3): ?>
              <?php echo e($payableAmount); ?>

              <?php else: ?> 
               <?php echo e($withdraw->amount); ?>

              <?php endif; ?>
            </td>
            
           <td>
    <?php if($withdraw->status == 1): ?>
        <span class="btn btn-success btn-sm">Paid</span>
    <?php elseif($withdraw->status == 0): ?>
        <span class="btn btn-info btn-sm">Request</span>
    <?php elseif($withdraw->status == 3): ?>
        <span class="btn btn-warning btn-sm">Charge</span>
    <?php else: ?>
        <span class="btn btn-danger btn-sm">Rejected</span>
    <?php endif; ?>
</td>

            </td>
            <td><?php echo e(date('d-F-Y H:i:s a',strtotime($withdraw->date))); ?></td>
            <td>
                 <?php if(in_array($withdraw->status,[0,2])): ?>
                <a href="<?php echo e(url('/admin/editWithdrawStatus/'.$withdraw->id)); ?>" >
                    <button type="button" class="btn btn-info btn-sm">Edit</button>
                </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td colspan="13" align="center">
            <?php echo $withdraws->links(); ?>

        </td>
    </tr>
<?php endif; ?>
<script>
    function AccountNumberCopy(account_id) {
        /* Get the text field */
        var copyText = document.getElementById(account_id);
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        document.getElementById("result_"+account_id).innerText="Copied";
        $("#result_"+account_id).fadeOut(5000);


    }
</script>


<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/admin_withdraw_pagination.blade.php ENDPATH**/ ?>