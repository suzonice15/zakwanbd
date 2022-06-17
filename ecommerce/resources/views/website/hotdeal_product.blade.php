<h3 class="section-title">hot deals</h3>
<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">


    <?php foreach ($products as $product) {

    if ($product->discount_price) {
        $sell_price = $product->discount_price;
    } else {
        $sell_price = $product->product_price;
    }

    ?>
    <div class="item">
        <div class="products">
            <div class="hot-deal-wrapper">
                <div class="image">
                    <img
                        src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->feasured_image }}"
                        alt="">                                            </div>
                <div class="sale-offer-tag"><span>{{$product->discount}}%<br>off</span></div>
                <div class="timing-wrapper">

                </div>
            </div>
            <!-- /.hot-deal-wrapper -->
            <div class="product-info text-left m-t-20">

                <div class="product-price">
                                                    <span class="price">
                                                   @money($sell_price)
                                                    </span>
                    <?php


                    if ($product->discount_price) {

                    ?>
                    <span class="price-before-discount">  @money($product->product_price)</span>
                    <?php }?>
                    <br/>                     Code:{{$product->sku}}
                </div>
                <h3 class="name">
                    <a href="{{ url('/') }}/{{$product->product_name}}">

                        {{ $product->product_title }}
                    </a>
                </h3>

                <!-- /.product-price -->
            </div>
            <!-- /.product-info -->
{{--            <div class="cart clearfix animate-effect">--}}
{{--                <div class="action">--}}
{{--                    <div class="add-cart-button btn-group">--}}
{{--                        <button data-product_id="{{ $product->product_id}}" data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary add_to_cart"--}}
{{--                                type="button">Add to cart--}}
{{--                        </button>--}}
{{--                        <button data-product_id="{{ $product->product_id}}" data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary buy-now-cart icon"--}}
{{--                                data-toggle="dropdown"--}}
{{--                                type="button">--}}
{{--                            <i class="fa fa-shopping-cart"></i>--}}
{{--                        </button>--}}
{{--                        <button data-product_id="{{ $product->product_id}}"  class="btn btn-success add-to-wishlist icon"--}}
{{--                                data-toggle="dropdown"--}}
{{--                                type="button">--}}
{{--                            <i class="icon fa fa-heart"></i>--}}
{{--                        </button>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.action -->--}}
{{--            </div>--}}
{{--            <!-- /.cart -->--}}
        </div>
    </div>
    <?php } ?>
</div>
<!-- /.sidebar-widget -->
