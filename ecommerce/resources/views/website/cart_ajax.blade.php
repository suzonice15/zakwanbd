
<div class="container" id="cart">

    <div class="row order_tank_you_class my-3">
        <?php



        if ( !Cart::isEmpty()){ ?>

        <div class="col-md-12  col-lg-12 col-12 ">


            <div class="card">
            <div class="card-heading text-start fw-bold ms-3 fs-4"><b>Order Review</b>
                </div>
                <div class="card-body">

					<span class="checkout-fields">


							<div class="checkoutstep">
                                <div class="cart-info" >
<div class="table-responsive">
                                    <table class="table table-striped table-bordered" >
                                        <tbody>
                                        <tr>
                                            <th width="1%" class="name">Sl</th>
                                            <th   width="30%"  class="name">Products</th>
                                            <th  width="10%" class="name">Product Code</th>
                                            <th  width="20%" class="name">Quantity</th>
                                            <th   width="15%" class="name">Price</th>
                                            <th   width="15%" class="name">Total</th>
                                            <th   width="5%" class="total text-right">Remove </th>
                                        </tr>

                                        <?php
                                        $quntity = 0;
                                        $count=0;
                                        $items = \Cart::getContent();

                                        foreach ($items as $row) {
                                        //    $subTotal = \Cart::getSubTotal();
                                        $total = \Cart::getTotal();
                                        $subTotal_price=$row->price*$row->quantity;
                                        $imagee=$row->attributes['picture'];
                                        $product_id=$row->id;

                                        $product=      single_product_information($product_id);
                                        $sku=$product->sku;
                                        $name=$product->product_name;
                                        ?>
                                              <tr id="<?=$row->id?>">
                                                <td>


                                                    <?php echo ++$count; ?>
                                                </td>
                                                <td>
                                                    <img src="<?=$imagee?>" width="30">

                                                    <a href="{{ url('/') }}/{{$name}}" target="_blank"><?=$row->name?></a>
                                                </td>
                                                <td>
                                                  <?=$sku?>
                                                </td>


                                                  <td>
                                <a class="btn btn-sm btn-info  plus_cart_item" id="<?=$row->id;?>" href="javascript:void(0);">
                                     <span class="fa fa-plus text-white"></span>
                                </a>
                                <span id="cart_quantity_{{$row->id}}"> <?=$row->quantity;?></span>
                                                      <input type="hidden" value="{{$product->product_stock}}" id="limit_stock_{{$row->id}}" >
                                <a class="btn  btn-sm btn-danger minus_cart_item" id="<?=$row->id;?>" href="javascript:void(0);">
                                    <span class="fa fa-minus text-white"></span>
                                </a>
                            </td>  <td> <span  id="per_poduct_price">  @money($row->price)</span>
                                                </td>
                                                <td>
												<span id="per_poduct_total_price_<?= $row->id?>">

												 @money($subTotal_price)

													</span>



                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       onclick="CartDataRemove('<?= $row->id?>')"
                                                       style="color:red ;font-weight: bold;padding: 2px 5px;margin-left: 12px;">
                                                        <span class="fa fa-trash btn btn-danger"></span>
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
													<span class="bold totalamout"> <span
                                                            id="total_cost"> @money($total)</span></span>


                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
									  <a style="margin-left: 1px;" href="{{ url('/') }}/checkout"  class="btn btn-info">Checkout</a>


                    <a  href="{{ url('/') }}"    style="background-color:#FF6061;border: none" class="btn btn-info" >continue shopping</a>
                                </div>
                            </div>

                    </span>

                </div>


            </div>
            <?php } else { ?>
            <div class="col-md-12 text-center"><a href="{{ url('/') }}"><img style="margin-bottom: -68px"
                                                                             src="{{ url('/') }}images/stop.png"/></a>
            </div>
            <div class="col-md-12 mt-5 text-center">
                <h1 class="text-danger text-center text-capitalize">You have no product in your cart.
                </h1>
                <a class="text-center text-capitalize btn btn-info" href="{{ url('/') }}"> back to home</a>
            </div>
            <?php } ?>

        </div>

    </div>

</div>
<script>
    $('.plus_cart_item').click(function () {
        let product_id= $(this).attr('id');
        let quantity=$('#cart_quantity_'+product_id).text();
        quantity=quantity.trim();
        let product_stock = $('#limit_stock_' + product_id).val();
        if(product_stock >quantity) {
            jQuery.ajax(
                    {

                        url: "{{url('/plus_cart_item')}}?product_id=" + product_id,
                        type: "get",


                    })

                    .done(function (data) {
                        console.log(data)

                        jQuery("#cart").html(data.html);

                    })

                    .fail(function (jqXHR, ajaxOptions, thrownError) {

                        // alert('server not responding...');

                    });
        } else {
            alert("Only "+product_stock +" available ")

        }


    })
</script>

<script>
    $('.minus_cart_item').click(function () {
        let product_id= $(this).attr('id');
        let quantity=$('#cart_quantity_'+product_id).text();
        quantity=quantity.trim();

        jQuery.ajax(

            {

                url:"{{url('/minus_cart_item')}}?product_id="+product_id,
                type: "get",


            })

            .done(function(data)

            {
                console.log(data)

                jQuery("#cart").html(data.html);

            })

            .fail(function(jqXHR, ajaxOptions, thrownError)

            {

                // alert('server not responding...');

            });


    })
</script>

<script>
    function CartDataRemove(id){


        jQuery.ajax(

            {

                url:"{{url('/remove_cart_item')}}?product_id="+id,
                type: "get",


            })

            .done(function(data)

            {
                console.log(data)

                jQuery("#cart").html(data.html);

            })

            .fail(function(jqXHR, ajaxOptions, thrownError)

            {

                // alert('server not responding...');

            });


    }
</script>

