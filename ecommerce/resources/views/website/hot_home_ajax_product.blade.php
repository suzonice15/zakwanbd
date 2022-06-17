<!-- BEST SELLER  -->
<div class="best-deal wow  outer-bottom-xs">
    <h3 class="section-title"> <a  class="category_title_section" href="#"> Best seller</a></h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
            @if($products)
                @foreach($products as $product)
                    <?php

                    if ($product->discount_price) {
                        $sell_price = $product->discount_price;
                    } else {
                        $sell_price = $product->product_price;
                    }

                    ?>

                    <div class="item">
                        <div class="products best-product">

                            <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col col-xs-5">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ url('/') }}/{{$product->product_name}}">

                                                        <img  src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2 col-xs-7">
                                            <div class="product-info">
                                                <h3 class="name"><a href="{{ url('/') }}/{{$product->product_name}}">{{ $product->product_title }}</a></h3>
                                               <br/>
                                                <p>Product Code:  {{$product->sku}}</p>
                                                <div class="product-price">
                                <span class="price">
                              @money($sell_price) 				</span>
                                                    <?php
                                                    if($product->discount_price){


                                                    ?>
                                                    <span class="price-before-discount"
                                                          style="color:red">  @money($product->product_price)</span>

                                                    <?php


                                                    }
                                                    ?>
                                                </div>
                                            </div>


                                            {{--<div class="cart clearfix animate-effect"  style="margin-top: 43px;">--}}
                                                {{--<div class="action">--}}
                                                    {{--<ul class="list-unstyled">--}}

                                                        {{--<li class="add-cart-button">--}}
                                                            {{--<button data-product_id="{{ $product->product_id}}" data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary add_to_cart"--}}
                                                                    {{--type="button">Add to cart--}}
                                                            {{--</button>--}}
                                                        {{--</li>--}}
                                                        {{--<li class="add-cart-button btn-group">--}}

                                                            {{--<button data-product_id="{{ $product->product_id}}" data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary buy-now-cart icon"--}}
                                                                    {{--data-toggle="dropdown"--}}
                                                                    {{--type="button">--}}
                                                                {{--<i class="fa fa-shopping-cart"></i>--}}
                                                            {{--</button>--}}

                                                        {{--</li>--}}
                                                        {{--<li class="lnk wishlist">--}}
                                                            {{--<a class="add-to-wishlist" data-product_id="{{ $product->product_id}}" href="javascript:void(0)" title="Wishlist">--}}
                                                                {{--<i class="icon fa fa-heart"></i>--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}

                                                    {{--</ul>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
<!-- FEATURED PRODUCTS  -->
