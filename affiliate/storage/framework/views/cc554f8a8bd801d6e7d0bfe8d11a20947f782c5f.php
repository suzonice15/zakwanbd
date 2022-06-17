<div class="box box-success">
    <div class="box-header text-center" style="background-color: #ddd">
        <h3 class="box-title">Join With Us On Social Platform</h3>
    </div>
    <div class="box-body">
        <div class="row text-center ">

            <div class="col-md-3 col-sm-6 col-xs-6 ">
                <a href="<?=sohojby_get_option('youtube')?>" target="_blank">
                    <img   src="<?php echo e(url('/')); ?>/images/youtube.png">
                </a>


            </div>
            <div class="col-md-3 col-sm-6  col-xs-6">
                <a href="<?=sohojby_get_option('facebook')?>" target="_blank">
                    <img    src="<?php echo e(url('/')); ?>/images/facebook_page.png">
                </a>


            </div>
            <div class="col-md-3 col-sm-6  col-xs-6">
                <a href="<?=sohojby_get_option('linked')?>" target="_blank">
                    <img    src="<?php echo e(url('/')); ?>/images/facebook_gorup.jpg">
                </a>


            </div>
            <div class="col-md-3 col-sm-6  col-xs-6">
                <a href="<?=sohojby_get_option('twitter')?>" target="_blank">
                    <img   src="<?php echo e(url('/')); ?>/images/jibonpata.png">
                </a>
            </div>
        </div>
    </div>
</div>



<div class="box box-success">
    <div class="box-header text-center" style="background-color: #ddd">
        <h3 class="box-title">Hot Products</h3>
    </div>
    <div class="box-body">
        <div class="text-center ">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-md-2 col-sm-6 col-xs-6">


                    <img class="img-responsive" src="<?php echo e(env('APP_ECOMMERCE')); ?>/public/uploads/<?php echo e($product->folder); ?>/thumb/<?php echo e($product->feasured_image); ?>">
                    <br/>

                    <p class="name" style="height: 38px;text-align: center;overflow: hidden;" > <a href="<?php echo e(env('APP_ECOMMERCE')); ?>/<?php echo e($product->product_name); ?>"> <?php echo e($product->product_title); ?> </a>
                    </p>
                    <p  style="text-align: center;" >Price :
                        <?php

                        if($product->discount_price){
                            $sell_price=  $product->discount_price;
                        } else {
                            $sell_price=$product->sell_price;
                        }

                        echo $sell_price;
                        ?>
                        Tk

                    </p>
                    <p style="text-align: center;color: #9622de;" >
                        Profit:
                        <?php echo   $product->top_deal;?>Tk
                    </p>
                    

                    <button type="button" style="margin-bottom: 15px;margin-left:22px;"onclick="return link_generator(<?php echo e($product->product_id); ?>)" class="btn btn-success" data-toggle="modal" data-target="#modal-productShare">
                        Get Link
                    </button>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>
</div>


<script>
    function link_generator(id) {

        $.ajax({
            type:"GET",
            url:"<?php echo e(url('product/link/id')); ?>?product_id="+id,
            success:function(data)
            {

                $('#view_page').html(data);
            }
        });
    }
</script><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/layouts/affiliate_dashboard_hot_product_social_media.blade.php ENDPATH**/ ?>