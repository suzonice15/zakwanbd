<?php if(isset($offers)): ?>
    <?php $i=$offers->perPage() * ($offers->currentPage()-1);?>
    <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e(++$i); ?></td>
            <td><?php echo e($offer->name); ?></td>
             <td><?php echo e($offer->phone); ?></td>
            <td><?php echo e($offer->acount_type); ?></td>
            <td><?php echo e($offer->sender_number); ?></td>
            <td><?php echo e($offer->transaction_id); ?></td>
            <td><?php echo e($offer->amount); ?></td>
            <td><?php echo  $offer->status==1? 'Active':"Pendding"; ?></td>
            <td><?php echo e($offer->created_at); ?></td>
            <td>

                <?php
                if( $offer->status==1) {
                ?>
                <a href="<?php echo e(url('/admin/super/offer/inactive/'.$offer->super_offer_id)); ?>" >
                    <button type="button" class="btn btn-info">Inactive</button>
                </a>
                    <?php }  else { ?>
                    <a href="<?php echo e(url('/admin/super/offer/active/'.$offer->super_offer_id)); ?>" >
                        <button type="button" class="btn btn-success">Active</button>
                    </a>

                    <?php } ?>
                <a href="<?php echo e(url('/admin/super/offer/delete/'.$offer->super_offer_id)); ?>" onclick="return confirm('Are you want to delete')" >
                    <button type="button" class="btn btn-danger">Delete</button>
                </a>
            </td>




            </td> 
        </tr>


    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <td colspan="13" align="center">
            <?php echo $offers->links(); ?>

        </td>
    </tr>
<?php endif; ?>


<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/admin_super_offer_pagination.blade.php ENDPATH**/ ?>