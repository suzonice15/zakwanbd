<div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7"
     style="background-color:white;border-radius: 2px;">
    <h1 class="single-product-title">{{$product->product_title}}</h1>
    <p  style="font-size: 16px;line-height:0;background: #41b468;color: #fff; display: inline-block;padding:0;border-top: 10px solid transparent;border-bottom: 10px solid transparent; border-right:10px solid #fff; padding: 5px;/*! font-size: 18px; */">
    <label style="margin-bottom: 0; font-weight:unset;display: inline;padding-left: 5px; padding-right: 35px;">Product Code:</label>
    <label style="margin-bottom: 0; font-weight:unset;display: inline;padding-right: 3px;">
     {{$product->sku}}    </label>
    </p>

    <div class="stock-product">
        <span style="font-size: 14px;font-weight: bold;" class="label">In Stock  :</span>
        <span style="font-weight: bold">{{$product->product_stock}}</span>
        <?php
        if(isset($shop_link)){
        ?>
        <p class="fw-bold fs-5">Shop : <a href="{{URL::to('shop/'.$shop_link)}}">{{$shop_name}}</a></p>
        <?php }?>

    </div>

    <div class="available-product">
        <span style="font-size: 14px;font-weight: bold;" class="label">Availability :</span>
        <span style="font-weight: bold"><?=$product_availability?></span>

    </div>

    @if($product->product_specification)
        <div class="product-short-description">
            <p style="margin-bottom: 2px;color: black;font-weight: normal;">Product Short Description</p>
            <?php echo $product->product_specification ?>
        </div>
    @endif

    <div class="single-price">
        <?php
        if ($product->discount_price) {
            $sell_price = $product->discount_price;

        } else {
            $sell_price = $product->product_price;
        }
        ?>
        <span class="current-price fs-3 fw-bold text-dark"> @money($sell_price)</span>
        @if($product->discount_price)
            <span class="old-price   fw-bold text-danger fs-5"> <del>@money($product->product_price) </del></span>
        @endif


    </div>

    <div class="row add-to-cart-section">

        @if($product->product_stock != 0)
            <input type="hidden" value="{{$product->product_stock}}" id="limit_stock_product" >

            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 col-xxl-4">

                @if($product->product_promotion_active !=1)

                    <div style="float: left; border: solid 1px #24b193; width: 150px; height: 39px;margin-left:5px;margin-bottom: 4px;">
                        <div style="color:orangered;font-size: 25px;text-align: center; width: 50px; float: left; cursor: pointer;font-weight: bold;"
                             onclick="DecrementFunction()">
                            -
                        </div>
                        <span style="font-size: 25px;text-align: center;color: gray; width: 50px; float: left; cursor: pointer;border-right: 1px solid #24b193;border-left: 1px solid #24b193;font-weight: bold;"
                              id="quantity">1</span>

                        <div onclick="IncrementFunction()" style="font-weight: bold;color:orangered;font-size: 25px;text-align: center; width: 40px; float: left;
                                                             cursor: pointer;">
                            +
                        </div>
                    </div>
                @endif


            </div>
        @endif
        @if($product->product_promotion_active !=1)

            @if($product->product_stock != 0)

                <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 col-xxl-8">
                    <a data-product_id="{{ $product->product_id}}"
                       data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image}}"
                       class="btn btn-primary add_to_cart text-white" href="javascript:void(0)"> ADD TO CART</a>
                    <a href="javascript:void(0)" data-product_id="{{ $product->product_id}}"
                       data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image}}"
                       class="btn btn-success buy-now-cart text-white"> BUY NOW </a>
                    <button  style="background: white;border: 1px solid red;" data-product_id="{{ $product->product_id}}" class="btn btn-success add-to-wishlist icon"
                             data-toggle="dropdown" type="button">
                        <i style="color: red;" class="icon fa fa-heart"></i>
                    </button>
                </div>
            @endif
        @endif

    </div>


    <div class="row">

        @if($product->product_promotion_active !=0)
            <div class="col-12 col-xs-12" style="padding:0">
                <a href="{{url('/')}}/customer/login" class="btn btn-success btn-sm " style="color:white !important ;width: 200px" >Order  Now</a>
            </div>
        @endif

        <div class="col-sm-12 col-xs-12">
            <h4 style="font-weight:bold;color:red;" class="mt-3">ফোনে অর্ডারের জন্য
                ডায়াল করুন
            </h4>
            <div class="col-sm-6 col-xs-12" style="padding:0">
                <h4 style="font-size:22px;margin: 15px 0 15px 0;text-align:center;color:red;font-weight:900;text-align: left">
                    <?=get_option('phone_order')?>
                </h4>
            </div>
            <div class="col-sm-12 col-md-12  col-xs-12 col-lg-12" style="display:flex;flex-direction:row;margin-top: -14px;">
                <img style="width: 47px;padding: 10px;margin-bottom: -6px;"
                     class="img-responsive pull-left mobile-icon"
                     src="http://www.egbazar.com//front_asset/d.png"
                     alt="Call azibto" title="Call azibto">
                <h3 class="font-size-title-mobile"
                    style="font-weight: bold;font-size: 14px;text-align:left;margin-top: 15px;">
                    ঢাকায় ডেলিভারি খরচ:
                    ৳ <?=$product->delivery_in_dhaka?></h3>
            </div>
            <div class="col-sm-12 col-md-12 col-xs-12" style="display:flex;flex-direction:row;">
                <img style="width: 47px;padding: 10px;margin-top: -7px;"
                     class="img-responsive pull-left  mobile-icon"
                     src="http://www.egbazar.com//front_asset/od.png"
                     alt="Call azibto" title="Call azibto">
                <h3 class="font-size-title-mobile"
                    style="font-weight: bold;font-size: 14px;text-align:left;margin-top: 8px;">
                    ঢাকার বাইরের ডেলিভারি খরচ: ৳<?=$product->delivery_out_dhaka?>
                </h3>
            </div>

            <div class="col-sm-12 col-md-12 col-xs-12" style="display:flex;flex-direction:row;">
                <img style="width: 47px;padding: 10px;margin-top: -12px;"
                     class="img-responsive pull-left  mobile-icon"
                     src="http://www.egbazar.com//front_asset/bk.png"
                     alt="Call azibto" title="Azibto  ">
                <h3 class="font-size-title-mobile"
                    style="font-weight: bold;font-size: 14px;text-align:left;margin-top: 3px;">
                    বিকাশ নাম্বার: <?=get_option('bkash')?>
                </h3>
            </div>
        </div>
    </div>
</div>
