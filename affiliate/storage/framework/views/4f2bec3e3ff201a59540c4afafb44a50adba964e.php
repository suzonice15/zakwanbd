<?php if(isset($withdraws)): ?>
    <?php $i=$withdraws->perPage() * ($withdraws->currentPage()-1);?>
    <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdraw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php

       $amount= $withdraw->amount;
      
        


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
               <?php echo e($withdraw->account_number); ?> 
                <?php if($withdraw->status == 0): ?>
                <button class="btn btn-success btn-sm" onclick="return AccountNumberCopy(<?php echo e($withdraw->id); ?>)">Copy</button>
                <br/>
                <span  style="color:green;font-weight:bold" id="result_<?php echo e($withdraw->id); ?>"></span>
                <?php endif; ?>
                    <?php endif; ?>
            </td>
            <td>
               
                <?php echo e($withdraw->amount); ?>

               
             

            </td>
            <td><?php echo e(date('d-F-Y H:i:s a',strtotime($withdraw->date))); ?></td>
            
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


<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/withdrawChargepagination.blade.php ENDPATH**/ ?>