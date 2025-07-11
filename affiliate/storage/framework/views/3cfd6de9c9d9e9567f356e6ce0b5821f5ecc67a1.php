
<?php $__env->startSection('mainContent'); ?>


    <div class="container-fluid" id="cart">

        <div class="row order_tank_you_class">

            <br>
            <br>


            <?php


            if ( !Cart::isEmpty()){ ?>

            <div class="col-md-12  col-lg-12 col-12 ">


                <div class="panel panel-primary">
                    <div class="panel-heading"><b>Order Review</b>
                    </div>
                    <div class="panel-body">


					<span class="checkout-fields">


							<div class="checkoutstep">
                                <div class="cart-info">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th width="1%" class="name">Sl</th>
                                                <th width="30%" class="name">Products</th>
                                                <th width="10%" class="name">Product Code</th>
                                                <th width="20%" class="name">Quantity</th>
                                                <th width="15%" class="name">Price</th>
                                                <th width="15%" class="name">Total</th>
                                                <th width="5%" class="total text-right">Remove</th>
                                            </tr>

                                            <?php
                                            $quntity = 0;
                                            $count = 0;
                                            $items = \Cart::getContent();

                                            foreach ($items as $row) {
                                            //    $subTotal = \Cart::getSubTotal();
                                            $total = \Cart::getTotal();
                                            $subTotal_price = $row->price * $row->quantity;
                                            $imagee = $row->attributes['picture'];
                                            $product_id = $row->id;

                                            $product = single_product_information($product_id);
                                            $sku = $product->sku;
                                            $name = $product->product_name;


                                            ?>
                                            <tr id="<?=$row->id?>">
                                                <td>


                                                    <?php echo ++$count; ?>
                                                </td>
                                                <td>
                                                    <img src="<?=$imagee?>" width="30">

                                                    <a href="<?php echo e(url('/')); ?>/<?php echo e($name); ?>"
                                                       target="_blank"><?=$row->name?></a>
                                                </td>
                                                <td>
                                                    <?=$sku?>
                                                </td>


                                                <td>
                                                    <a class="btn btn-xs btn-info  plus_cart_item" id="<?=$row->id;?>"
                                                       href="javascript:void(0);">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </a>
                                                    <input type="hidden" value="<?php echo e($product->product_stock); ?>" id="limit_stock_<?php echo e($row->id); ?>" >
                                                    <span id="cart_quantity_<?php echo e($row->id); ?>"> <?=$row->quantity;?></span>
                                                    <a class="btn  btn-xs btn-danger minus_cart_item"
                                                       id="<?=$row->id;?>" href="javascript:void(0);">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                    </a>
                                                </td>

                                                <td>
													<span
                                                            id="per_poduct_price">  <?php echo '৳ ' . number_format($row->price, 2); ?></span>

                                                </td>
                                                <td>
												<span id="per_poduct_total_price_<?= $row->id?>">

												 <?php echo '৳ ' . number_format($subTotal_price, 2); ?>

													</span>


                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       onclick="CartDataRemove('<?= $row->id?>')"
                                                       style="color:red ;font-weight: bold;padding: 2px 5px;margin-left: 12px;">
                                                        <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                                                    </a>
                                                </td>

                                            </tr>
                                            <?php } ?>

                                            </tbody>
                                        </table>

                                    </div>

                                    <table class="table table-striped table-bordered review_cost">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span class="extra bold totalamout">Total</span>
                                            </td>
                                            <td class="text-right">
		 <span class="bold totalamout"><span id="total_cost">  <?php echo '৳ ' . number_format($total, 2); ?>    </span></span>


                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="row text-center">

                                        <div class="col-md-4">
                                            <a style="margin-left: 1px; margin-bottom: 5px;"
                                               href="<?php echo e(url('/')); ?>/orderCustomer/checkout" class="btn btn-danger">Order
                                                For Customer</a>
                                            <p>কাস্টমারের জন্য অর্ডার করুন</p>

                                        </div>                                       
                                        <div class="col-md-4">
                                            <a style="margin-bottom: 5px;"
                                               href="<?php echo e(url('/admin/affilite/buy_products')); ?>"
                                               style="background-color:#FF6061;border: none" class="btn btn-info">Continue
                                                Shopping</a>
                                            <p>আরো কেনাকাটা করুন</p>

                                        </div>
                                    </div>


                                </div>
                            </div>

                    </span>

                    </div>


                </div>
                <?php } else { ?>
                <div class="col-md-12 text-center"><a href="<?php echo e(url('/')); ?>"><img style="margin-bottom: -68px"
                                                                                 src="<?php echo e(env('APP_ECOMMERCE')); ?>public/uploads/stop.png"/></a>
                </div>
                <div class="col-md-12 mt-5 text-center">

                    <br/>
                    <br/>
                    <br/>
                    <h1 class="text-danger text-center text-capitalize">You have no product in your cart.
                    </h1>
                    <a class="text-center text-capitalize btn btn-info"
                       href="<?php echo e(url('/admin/affilite/buy_products')); ?>"> Buy Continue</a>
                </div>
                <?php } ?>

            </div>

        </div>

    </div>
    <script>
        $('.plus_cart_item').click(function () {
            let product_id = $(this).attr('id');
            let quantity = $('#cart_quantity_' + product_id).text();

            quantity = parseInt(quantity.trim());
            let product_stock = $('#limit_stock_' + product_id).val();
            if(product_stock >quantity) {
                jQuery.ajax(
                        {
                            url: "<?php echo e(url('/plus_cart_item')); ?>?product_id=" + product_id,
                            type: "get",
                        }).done(function (data) {
                    $('body .count').text(data.result.count);
                    $('body .value').text(data.result.total);
                    jQuery("#cart").html(data.html);
                }).fail(function (jqXHR, ajaxOptions, thrownError) {

                    // alert('server not responding...');

                });
            } else {
                alert("Only "+product_stock +" available ")

            }


        })
    </script>

    <script>
        $('.minus_cart_item').click(function () {
            let product_id = $(this).attr('id');
            let quantity = $('#cart_quantity_' + product_id).text();
            quantity = quantity.trim();

            jQuery.ajax(
                    {

                        url: "<?php echo e(url('/minus_cart_item')); ?>?product_id=" + product_id,
                        type: "get",


                    }).done(function (data) {
                        $('body .count').text(data.result.count);
                        $('body .value').text(data.result.total);

                        jQuery("#cart").html(data.html);

                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {

                        // alert('server not responding...');

                    });


        })
    </script>

    <script>
        function CartDataRemove(id) {


            jQuery.ajax(
                    {

                        url: "<?php echo e(url('/remove_cart_item')); ?>?product_id=" + id,
                        type: "get",


                    })

                    .done(function (data) {

                        $('body .count').text(data.result.count);
                        $('body .value').text(data.result.total);

                        jQuery("#cart").html(data.html);

                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {

                        // alert('server not responding...');

                    });


        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/website/cart.blade.php ENDPATH**/ ?>