
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
@if(isset($products))
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    @foreach ($products as $product)

        <div class="col-md-2 col-xs-6" style="padding: 5px;">
            <div class="freepeoduct"><strong>৳</strong> {{$product->product_price- $product->discount_price}} ছাড়</div>
            <div class="single-product" style="background-color: white;padding: 9px 14px;">
                <img class="img-responsive" style="width: 100%" src="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/thumb/{{ $product->feasured_image }}">
                <br/><p class="product-title"> <a href="{{url('/product')}}/{{$product->product_name}}"> {{$product->product_title}} </a>
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
                <p class="code" style="text-align:center" >Code :{{$product->sku}}</p>

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
                    <p   style="font-weight: bold;color: red;font-size: 13.3px;"> @money($product->product_price)</p>
                    <?php
                    }
                    ?>
                    <p  style="font-weight: bold;color: black;font-size: 13.3px;"> @money($sell_price)</p>
                </div>


                <div style="
    display: flex;
    justify-content: space-between;
">
   <span style="text-align: center;color: #9622de;">Profit :
       {{$product->top_deal}} Tk
                   </span>
                    <button type="button" style="margin-bottom: 15px" onclick=" return link_generator({{ $product->product_id }})" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default">
                        Get Link
                    </button>

                </div>

                <div style="
    display: flex;
    justify-content: space-between;
">
                    <button type="button"    class="btn btn-success btn-sm add-to-wishlist"  data-product_id="{{ $product->product_id}}">
                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </button>
                    @if($product->product_stock  <=0 )
                        <button type="button"     href="javascript:void(0)"

                                class="btn btn-danger   icon" >
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Out of Stock
                        </button>
                    @else
                        @if($product->product_promotion_active==0)
                        <button type="button"     href="javascript:void(0)"
                                data-product_id="{{ $product->product_id}}"
                                data-picture="{{ env('APP_ECOMMERCE') }}public/uploads//{{ $product->folder }}/small/{{ $product->feasured_image}}"
                                class="btn btn-success buy-now-cart icon" >
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Buy Now
                   </button>
                   @else
                      <a type="button"  target="_blank"   href="https://www.sohojbuy.com/{{$product->product_name}}"
                                class="btn btn-success  icon" >
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            Buy Now
                   </a>
                   @endif
                 @endif

                </div>



            </div>
        </div>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $products->links() !!}
        </td>
    </tr>
@endif

