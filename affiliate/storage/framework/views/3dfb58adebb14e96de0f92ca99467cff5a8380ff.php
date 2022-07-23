<?php if(isset($products)): ?>
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>

            <td> <?php echo e(++$i); ?> </td>
            <td><?php echo e($product->sku); ?></td>
            <td>
                <img src="<?php echo e(env('APP_ECOMMERCE')); ?>/public/uploads/<?php echo e($product->folder); ?>/thumb/<?php echo e($product->feasured_image); ?>">
                <a href="<?php echo e(url('/')); ?>/<?php echo e($product->product_name); ?>"> <?php echo e($product->product_title); ?> </a>

            </td>
            <td><?php echo e($product->purchase_price); ?></td>
            <td><?php echo e($product->product_price); ?></td>
            <td><?php echo e($product->discount_price); ?></td>
            <td><?php echo e($product->product_profite); ?></td>

            <td><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
            <td><?php echo e(date('d-m-Y H:m s',strtotime($product->created_time))); ?></td>
            <td>
                <a title="edit" href="<?php echo e(url('admin/affilite/editProduct')); ?>/<?php echo e($product->product_id); ?>">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
            </td>
        </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <td colspan="9" align="center">
            <?php echo $products->links(); ?>

        </td>
    </tr>
<?php endif; ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/product_list_pagination.blade.php ENDPATH**/ ?>