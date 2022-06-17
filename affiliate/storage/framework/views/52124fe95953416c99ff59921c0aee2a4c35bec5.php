
<?php $__env->startSection('pageTitle'); ?>


   <?php echo substr($product->product_title,5) ?>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>


    <?php


    $vendor_id = $product->vendor_id;
    $review_count = DB::table('review')->where('product_id', $product->product_id)->count();
    $reviews = DB::table('review')->where('product_id', $product->product_id)->get();

    if ($vendor_id > 0) {
        $vendor = DB::table('vendor')->select('vendor_link', 'vendor_shop')->where('vendor_id', $vendor_id)->first();
        $shop_link = $vendor->vendor_link;
        $shop_name = $vendor->vendor_shop;
    }

    /*# product stock availability #*/
    $product_availabie = $product->product_stock;
    $product_availability = '<span class="text-success"> In Stock</span>';
    if ($product_availabie == 0) {
        $product_availability = '<span class="text-danger">Out Of Stock</span>';
    }
    $product_id_related = $product->product_id;
    ?>
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <div id="owl-single-productg">
                    <div class="single-product-gallery-item ">
                        <img class="xzoom img-responsive" alt=""
                             src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->feasured_image); ?>"
                             xoriginal="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->feasured_image); ?>"/>


                    </div>

                </div>

                <style>

                    ul >li {
                        list-style: none;
                    }
                </style>
                <br>
                <br>
                     <ul style="
    display: inline-flex;
" >
                        <?php
                        if($product->galary_image_1){
                        ?>

                        <li>
                            <img class="img-responsive thum_image_hover" src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads/<?php echo e($product->folder); ?>/<?php echo e($product->feasured_image); ?>" width="85" alt=""
                                  />

                        </li>
                        <?php } ?>
                        <?php
                        if($product->galary_image_1){
                        ?>

                        <li>
                            <img class="img-responsive thum_image_hover"  src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads/<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_1); ?>" width="85" alt=""
                                />

                        </li>
                        <?php } ?>
                        <?php
                        if($product->galary_image_2){
                        ?>
                        <li>
                            <img class="img-responsive thum_image_hover " width="85" alt=""
                                src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_2); ?>"/>

                        </li>
                        <?php } ?>
                        <?php
                        if($product->galary_image_3){
                        ?>

                        <li>
                            <img class="img-responsive thum_image_hover " width="85" alt=""
                                 src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_3); ?>"/>

                        </li>
                        <?php } ?>
                        <?php
                        if($product->galary_image_4){
                        ?>

                        <li>
                            <img class="img-responsive thum_image_hover " width="85" alt=""
                                 src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_4); ?>"/>

                        </li>
                        <?php } ?>
                        <?php
                        if($product->galary_image_5){
                        ?>

                        <li>
                            <img class="img-responsive thum_image_hover " width="85" alt=""
                                 src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_5); ?>"/>

                        </li>
                        <?php } ?>
                        <?php
                        if($product->galary_image_6){
                        ?>

                        <li>
                            <img class="img-responsive thum_image_hover " width="85" alt=""
                                src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/<?php echo e($product->galary_image_6); ?>"/>

                        </li>
                        <?php } ?>

                     </ul>

            </div>


            <div class='col-md-7'>
                <h3 class="name"><?php echo e($product->product_title); ?></h3>
                <p style="font-size: 16px;background: #64C284;color: #fff; display: inline-block;padding: 7px 12px;border-radius: 20px;">
                    Product Code: <?php echo e($product->sku); ?></p>
                <div class="detail-block">
                    <div class="row">

                        <!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                         <h4>Availability :<?=$product_availability?></h4>
                                </div>
                            <div class="product-info">
                                <h4 style="font-weight: bold;color: green;">Product Stock :<?=$product->product_stock?></h4>
                            </div>
                                <!-- /.stock-container -->
                                <?php if($product->product_specification): ?>
                                    <div class="description-container m-t-20">

                                        <?php echo $product->product_specification ?>

                                    </div>
                                    <?php endif; ?>
                                            <!-- /.description-container -->
                                    <div class="price-container info-container m-t-2">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <div class="price-box">
                                                    <?php
                                                    if ($product->discount_price) {
                                                        $sell_price = $product->discount_price;
                                                    } else {
                                                        $sell_price = $product->product_price;
                                                    }
                                                    ?>
                                                    <span class="price" style="color:black">


                                  <?php echo '৳ ' . number_format($sell_price, 2); ?>
                                </span>


                                                    <?php
                                                    if($product->discount_price){


                                                    ?>
                                                    <span class="price-strike"
                                                          style="color:red;font-weight: bold">  <?php echo '৳ ' . number_format($product->product_price, 2); ?> </span>

                                                    <?php


                                                    }
                                                    ?>
                                                    <br>
                                                    <?php if($product->product_point > 0) { ?>
                                                    <span style="color:#f96b25;font-weight:bold"> Earn <?php echo $product->product_point;?>
                                                        Shopping Points </span>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.price-container -->
                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <?php
                                            if($product->product_stock <= 0)
                                            {
                                            ?>

                                            <div class="col-md-12">
                                                
                                                
                                                <a data-picture="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                                   class="btn btn-danger btn disabled"
                                                   href="javascript:void(0)"> ADD TO CART</a>
                                                <a href="javascript:void(0)"
                                                   data-picture="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                                   class="btn btn-danger btn disabled"
                                                > BUY NOW </a>

                                            </div>
                                            <?php
                                            }else{
                                                    if($product->product_promotion_active==1){
                                            ?>
                                            <div class="col-md-12">

                                                <a class="btn btn-primary add_to_cart"
                                                   href="https://www.sohojbuy.com/<?php echo e($product->product_name); ?>"> ADD TO CART</a>
                                                <a href="https://www.sohojbuy.com/<?php echo e($product->product_name); ?>"
                                                   class="btn btn-success buy-now-cart icon"
                                                > BUY NOW </a>

                                            </div>
                                            <?php
                                            } else{

                                                    ?>

                                                <div class="col-md-12">
                                                    <a data-product_id="<?php echo e($product->product_id); ?>"
                                                       data-picture="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                                       class="btn btn-primary add_to_cart"
                                                       href="javascript:void(0)"> ADD TO CART</a>
                                                    <a href="javascript:void(0)"
                                                       data-product_id="<?php echo e($product->product_id); ?>"
                                                       data-picture="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads//<?php echo e($product->folder); ?>/small/<?php echo e($product->feasured_image); ?>"
                                                       class="btn btn-success buy-now-cart icon"
                                                    > BUY NOW </a>
                                                </div>

                                                <?php
                                                }
                                                }
                                            ?>
                                        </div>
                                        <!-- /.row -->
                                    </div>

                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12" style="padding:0">


                                                <div class="col-sm-12 col-md-12  col-xs-12" style="padding: 0">
                                                    <img style="width: 60px;padding: 10px"
                                                         class="img-responsive pull-left mobile-icon"
                                                         src="http://www.egbazar.com//front_asset/d.png"
                                                         alt="Call azibto" title="Call azibto">
                                                    <h3 class="font-size-title-mobile"
                                                        style="font-weight: bold;font-size: 18px;text-align:left">
                                                        ঢাকায় ডেলিভারি খরচ:
                                                        ৳ <?=$product->delivery_in_dhaka?></h3>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-xs-12" style="padding:0">
                                                    <img style="width: 60px;padding: 10px"
                                                         class="img-responsive pull-left  mobile-icon"
                                                         src="http://www.egbazar.com//front_asset/od.png"
                                                         alt="Call azibto" title="Call azibto">
                                                    <h3 class="font-size-title-mobile"
                                                        style="font-weight: bold;font-size: 18px;text-align:left">
                                                        ঢাকার বাইরের ডেলিভারি খরচ: ৳<?=$product->delivery_out_dhaka?>
                                                    </h3>
                                                </div>

                                                <div class="col-sm-12 col-md-12 col-xs-12" style="padding:0">
                                                    <img style="width: 60px;padding: 10px"
                                                         class="img-responsive pull-left  mobile-icon"
                                                         src="http://www.egbazar.com//front_asset/bk.png"
                                                         alt="Call azibto" title="Azibto  ">
                                                    <h3 class="font-size-title-mobile"
                                                        style="font-weight: bold;font-size: 18px;text-align:left">
                                                        বিকাশ নাম্বার: 01300884747
                                                    </h3>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /.row -->
                                    </div>

                                    <!-- /.quantity-container -->
                            </div>
                            <!-- /.product-info -->
                        </div>
                        <!-- /.col-sm-7 -->
                    </div>
                    <!-- /.row -->
                </div>




        </div>

        <div class="row">
            <div class="col-sm-5">

                <!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-7">

                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                    <?php if($product->product_video){?>

                    <li><a data-toggle="tab" href="#video">Video</a></li>
                    <?php }?>
                    <li><a data-toggle="tab" href="#tearm">terms and condition</a></li>
                    

                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane in active">
                        <div class="product-tab">

                            <?php echo $product->product_description; ?>

                        </div>
                    </div>
                    <?php if($product->product_video){?>

                    <div id="video" class="tab-pane">
                        <div class="product-tab">

                            <iframe width="500" height="345"
                                    src="https://www.youtube.com/embed/<?php echo $product->product_video;?>">
                            </iframe>

                        </div>
                    </div>
                    <?php }?>

                    <div id="tearm" class="tab-pane">
                        <div class="product-tab">

                            <?php echo get_option('default_product_terms'); ?>

                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div id="review" class="tab-pane">
                        <div class="product-tab">
                            <div class="col-sm-12 text-left" style="padding:0 20px">

                                <?php

                                $user_id = Session::get('user_id');
                                if($user_id){
                                ?>


                                <div class="col-sm-6  col-xs-12 review-left" style="padding-left: 0;">
                                    <h4 class="heading3">Write a Review</h4>
                                    <form class="form-vertical reviewform">
                                        <?php echo csrf_field(); ?>
                                        <fieldset class="field field-rating srating">
                                            <input type="radio" id="star5" name="rating" value="5">
                                            <label class="full" for="star5" title="5 stars"></label>
                                            <input type="radio" id="star4" name="rating" value="4">
                                            <label class="full" for="star4" title="4 stars"></label>
                                            <input type="radio" id="star3" name="rating" value="3">
                                            <label class="full" for="star3" title="3 stars"></label>
                                            <input type="radio" id="star2" name="rating" value="2">
                                            <label class="full" for="star2" title="2 stars"></label>
                                            <input type="radio" id="star1" name="rating" value="1">
                                            <label class="full" for="star1" title="1 star"></label>
                                        </fieldset>
                                        <div class="form-group">
                                            <input type="hidden" name="name" id="name"
                                                   class="form-control field field-name"
                                                   value="<?php echo e(Session::get('name')); ?>" placeholder="Name"
                                                   style="width: 100% !important;">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="email" id="email"
                                                   class="form-control field field-email"
                                                   value="<?php echo e(Session::get('email')); ?>" placeholder="Email"
                                                   style="width: 100% !important;">
                                        </div>
                                        <div class="form-group">
                                                            <textarea rows="3" name="comment" id="comment"
                                                                      class="form-control field field-comment"
                                                                      placeholder="Comments"></textarea>
                                        </div>

                                        <input type="hidden" name="product_id" id="product_review_id"
                                               value="<?php echo e($product->product_id); ?>">

                                        <button style="background:#4267b2;color:#fff;border-radius:5px;margin-top:10px;margin-bottom:20px"
                                                type="button" id="reviewbtn"
                                                class="btn btn-new form-control">continue
                                        </button>
                                    </form>
                                </div>
                                <?php } else {  ?>
                                <a href="<?php echo e(URL::to('customer/login')); ?>" target="_blank"
                                   class="btn btn-success">To Write A Review Login First</a>
                                <?php }?>



                            </div>

                        </div>
                        <!-- /.product-tab -->
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->



        <script>
            $(document).on('click','.buy-now-cart',function () {
                let product_id=  $(this).data("product_id"); // will return the number 123
                let picture=  $(this).data("picture"); // will return the number 123
                let quntity =$('#quantity_of_sell').val();


                quntity=1;

                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('add-to-cart')); ?>?product_id="+product_id+"&picture="+picture+"&quntity="+quntity,
                    success:function(data)
                    {
                        window.location.assign("<?php echo e(url('/')); ?>/cart")
                        $('body .buy_product_count').text(data.result.count);

                    }
                })

            })
        </script>

        <script>
            $(document).on('click','.add_to_cart',function () {
                let product_id=  $(this).data("product_id"); // will return the number 123
                let picture=  $(this).data("picture"); // will return the number 123


                quntity=1;



                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('add-to-cart')); ?>?product_id="+product_id+"&picture="+picture+"&quntity="+quntity,

                    success:function(data)
                    {


                        $('body .buy_product_count').text(data.result.count);

                    }
                })

            })
        </script>






        <script>
            $(".thum_image_hover").on("mouseover", function () {
                let image = $(this).attr('src');

                $(".xzoom").attr('src', image);
                $(".xzoom").attr('xoriginal', image);
            });


        </script>


    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/single_product.blade.php ENDPATH**/ ?>