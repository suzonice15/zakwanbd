
<?php

if($affilates){
foreach($affilates as $row ){



?>

<tr>

    <td><?php echo e($row->id); ?></td>
    <td><?php echo e($row->name); ?></td>

    <td><?php echo e($row->email); ?></td>
    <td><?php echo e($row->phone); ?></td>
    <td><?php echo e($row->address); ?></td>


    <td><?php echo  date('h:i a',strtotime($row->login_time)) ?></td>



</tr>

<?php
}


} ?>
<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/online_user_ajax.blade.php ENDPATH**/ ?>