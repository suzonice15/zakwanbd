@section('css')
<link rel="stylesheet" href="{{ asset('assets/font_end/')}}/css/owl.carousel.min.css">
@endsection

<section class="best_seller_product all-content-hide" style="background-color: #ddd;padding-bottom: 10px;padding-top:0" id="main_content_area">

    <style>
        .owl-next{
            display: none;
        }
        .owl-prev{
            display: none;
        }
        @media screen and (max-width: 767px) {
            .owl-nav{
                display: none;
            }
            .price-text {

                font-weight: 600;
                display: inline-block;
                font-size: 10px !important;
                color: #fff;
                position: absolute;
                bottom: 2px!important;
                float: left;
                background-color: green;
                height: 16px !important;
                border-top-left-radius: 60px;
                border-bottom-left-radius: 60px;
                width: 38px !important;
                text-align: center;
                right: 0;
            }
            .percentage-span-new {
                background-image: url("images/flash-deal-percentage.png");
                background-repeat: no-repeat;
                width: 35px !important;
                height: 35px !important;
                position: absolute !important;
                top: 0 !important;
                right: 1px !important;
                background-size: 34px 34px !important;
                text-align: center !important;
                color: #fff !important;
                font-weight: 500 !important;
                font-size: 10px !important;
                z-index: 2;
            }
            .percentage-amount-new {
                font-size: 11px !important;;
                font-weight: 500;
                padding-left: 8px !important;;
                padding-top: 9px !important;;
                line-height: 1;
                display: inline;
            }
            .percentage-sign-new {
                font-size: 9px !important;;
                padding-top: 8px !important;;
            }
            .percentage-discount-amount-new {
                display: inline;
                width: 100%;
                font-size: 8px !important;;
                padding: 0 !important;
                margin: 0 !important;
                line-height: 5px ;
            }
        }
        .owl-next{
            outline: none;
        }
        .owl-prev{
            display: none;
        }

        .owl-nav {
            position: absolute;
            top: 39%;
            height: 0;
            font-size: 29px;
            width: 100%;
        }

        .owl-next{
            position: absolute;
            right: -30px
        }
        .percentage-span-new {
           background-image: url('assets/font_end/images/flash-deal-percentage.png');
            background-repeat: no-repeat;
            width: 45px;
            height: 45px;
            position: absolute;
            top: 0;
            right: 1px;
            background-size: 44px 44px;
            text-align: center;
            color: #fff;
            font-weight: 700;
            font-size: 12px;
            z-index: 2;
        }
        .percentage-amount-new, .percentage-discount-amount-new, .percentage-sign-new {
            font-family: SolaimanLipi,Helvetica,Verdana,'Noto Sans Bengali';
            color: #fff;
            float: left;
        }

        .percentage-amount-new {
            font-size: 15px;
            font-weight: 700;
            padding-left: 11px;
            padding-top: 9px;
            line-height: 1;
            display: inline;
        }
        .percentage-sign-new {
            font-size: 11px;
            padding-top: 10px;
        }
        .percentage-discount-amount-new {
            display: inline;
            width: 100%;
            font-size: 10px;
            padding: 0 !important;
            margin: 0 !important;
            line-height: 7px;
        }
        .price-text {
            font-weight: 600;
            display: inline-block;
            font-size: 16px;
            color: #fff;
            position: absolute;
            bottom: 10px;
            float: left;
            background-color: green;
            height: 23px;
            border-top-left-radius: 60px;
            border-bottom-left-radius: 60px;
            width: 60px;
            text-align: center;
            right: 0;
        }
        .product-ca a:hover {
            background: #08c !important;
            border-color: #08c !important;
            color: #ffffff !important;
        }
    </style>
    <div class="container pt-2">
        <div class="row" style="margin-left:0px;margin-right: 1px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xs-12  mobile-border-of" style="background: #99cf16;padding: 5px;">
                <a href="#" style="font-size: 20px; font-weight: bold; color: #F16E52;">
                    <img style="width: 100px;margin-left:6px" src="{{url('/')}}/assets/font_end/images/hot-deal-logo.gif" title="kalerhaat">
                </a>
                <a  style="color: #EF4523;font-weight: bold;font-size: 18px;float: right;padding-top: 8px;" href="{{url('/')}}/hot-deal-product">
                    সকল হট ডিল <i class="fa fa-angle-right"></i>
                </a>

                <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12" style="background:  #99cf16;padding: 0px;margin-bottom: 20px;padding-top: 15px  ">
                    <div class="sliderx">
                        <ul class="product-category owl-carousel nav owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 1.25s ease 0s; width: 2153px;">

                                    @foreach($hotDealproducts as $product)
                                        <?php
                                        if($product->hot_deal_product==2){
                                            continue;
                                        }
                                        $sell_price = $product->product_price;
                                        $discountPercent=0;
                                        if ($product->discount_price) {
                                            $discountPercent=round(($product->product_price-$product->discount_price)/100);
                                            $sell_price = $product->discount_price;

                                        }
                                        ?>
                                        <div class="owl-item" style="width: 180.667px; margin-right: 15px;">
                                            <li class="product">
                                                <a href="{{ url('/') }}/{{$product->product_name}}">
                                                    <span class="percentage-span-new"><font class="percentage-amount-new">{{$discountPercent}}</font><font class="percentage-sign-new">%</font><font class="percentage-discount-amount-new">ছাড়</font></span>
                                                    <span class="price-text">৳&nbsp; {{$sell_price}}</span>
                                                    <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
                                                </a>
                                            </li>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                                <button type="button" role="presentation" class="owl-next"><img src="http://www.kalerhaat.com.bd/image/more.png"></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></ul>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12  col-xs-12" style="background:  #99cf16;padding: 0px;margin-bottom: 20px;padding-top: 0px  ">
                    <div class="sliderx">
                        <ul class="product-category owl-carousel nav owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(-587px, 0px, 0px); transition: all 0.25s ease 0s; width: 1762px;">
                                    @foreach($hotDealproducts as $product)
                                        <?php
                                            if($product->hot_deal_product==1){
                                                continue;
                                            }
                                        $sell_price = $product->product_price;
                                        $discountPercent=0;
                                        if ($product->discount_price) {
                                            $discountPercent=round(($product->product_price-$product->discount_price)/100);
                                            $sell_price = $product->discount_price;

                                        }
                                        ?>
                                    <div class="owl-item" style="width: 180.667px; margin-right: 15px;">
                                        <li class="product">
                                            <a href="{{ url('/') }}/{{$product->product_name}}">
                                                <span class="percentage-span-new"><font class="percentage-amount-new">{{$discountPercent}}</font><font class="percentage-sign-new">%</font><font class="percentage-discount-amount-new">ছাড়</font></span>
                                                <span class="price-text">৳&nbsp; {{$sell_price}}</span>
                                                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
                                            </a>
                                        </li>
                                    </div>
                                        @endforeach
                                </div>
                            </div>
                            <div class="owl-nav">
                                <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                                <button type="button" role="presentation" class="owl-next"><img src="http://www.kalerhaat.com.bd/image/more.png"></button>
                            </div>
                            <div class="owl-dots disabled"></div>
                            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @section('js')
    <script src="{{ asset('assets/font_end/')}}/js/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            if ($('.product-category').hasClass('owl-carousel')) {
                $('.owl-carousel').owlCarousel({
                    items: 6,
                    margin: 15,
                    nav: true,
                    dots: false,
                    autoplay: true,
                    slideBy: 1,
                    autoplayHoverPause: true,
                    rewind: true,
                    responsive: {
                        0: {
                            items: 3
                        },
                        760: {
                            items: 3
                        },
                        960: {
                            items: 4
                        },
                        1170: {
                            items: 6
                        }
                    }
                })
            }
        });
    </script>
        @endsection
</section>

