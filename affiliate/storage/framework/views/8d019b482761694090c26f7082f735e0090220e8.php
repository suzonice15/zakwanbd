<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
    .freepeoduct{background: #18ac4f !important;
        width: 48px !important;
        height: 43px !important;
        overflow: hidden !important;
        text-align: center !important;
        float: right !important;
        padding: 5px !important;
        border-radius: 50px !important;
        color: white !important;
        font-size: 10px !important;
        z-index: 999;
        position: absolute;
        right: 0;
        top: 5px;}
</style>
<?php if(isset($products)): ?>
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-2 col-xs-6" style="padding: 5px;">
            <div class="freepeoduct"><strong>৳</strong> <?php echo e($product->product_price- $product->discount_price); ?> ছাড়</div>
            <div class="single-product" style="background-color: white;padding: 9px 14px;">
                <img class="img-responsive" style="width: 100%" src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads/<?php echo e($product->folder); ?>/thumb/<?php echo e($product->feasured_image); ?>">
                <br/><p class="product-title"> <a href="<?php echo e(url('/product')); ?>/<?php echo e($product->product_name); ?>"> <?php echo e($product->product_title); ?> </a>
                </p>
                <style type="text/css">
                    @media(max-width: 375px) and (min-width: 335px){
                        .code{
                            margin-top: 25px;
                        }
                    }
                    @media(max-width: 334px){
                        .code{
                            margin-top: 40px;
                        }
                    }
                    .product-title  {
                        height: 38px;
                        overflow: hidden;
                    }
                </style>
                <p class="code" style="text-align:center" >Code :<?php echo e($product->sku); ?> <span style="color:green">Sold:<?php echo e($product->product_order_count); ?></span></p>

                <?php
                if($product->discount_price){
                    $sell_price=  $product->discount_price;
                } else {
                    $sell_price=$product->sell_price;
                }

                ?>
                <div class="text-center price "  style="display: flex;flex-direction: row;justify-content: space-between;">
                    <?php
                    if($product->discount_price){
                    ?>
                    <p   style="font-weight: bold;color: red;font-size: 12.3px;"> <?php echo '৳ ' . number_format($product->product_price, 2); ?></p>
                    <?php
                    }
                    ?>
                    <p  style="font-weight: bold;color: black;font-size: 12.3px;"> <?php echo '৳ ' . number_format($sell_price, 2); ?></p>
                </div>


                <div style="
    display: flex;
    justify-content:start;
">


                <span style="text-align: center;font-size: 12px;color: #9622de;">Profit :
                    <?php echo e($product->top_deal); ?> Tk
                   </span>
                    <button type="button" style="margin-bottom: 15px" onclick=" return link_generator(<?php echo e($product->product_id); ?>)" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default">
                        Get Link
                    </button>

                </div>

                <div style="
    display: flex;
    justify-content: space-between;
">
                    <button type="button"    class="btn btn-success btn-sm add-to-wishlist"  data-product_id="<?php echo e($product->product_id); ?>">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </button>
                    <?php if($product->product_stock  <=0 ): ?>
                        <button type="button"
                                class="btn btn-danger  icon" >
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Out of Stock
                        </button>
                    <?php else: ?>
                        <button type="button"     href="javascript:void(0)"
                                data-product_id="<?php echo e($product->product_id); ?>"
                                data-picture="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                class="btn btn-success buy-now-cart icon" >
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Buy Now
                        </button>
                    <?php endif; ?>


                </div>



            </div>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <td colspan="9" align="center">
            <?php echo $products->links(); ?>

        </td>
    </tr>
<?php endif; ?>
<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/tendingProductPagination.blade.php ENDPATH**/ ?>