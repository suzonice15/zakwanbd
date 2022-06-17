@if(isset($products))
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    @foreach ($products as $product)

        <div class="col-md-3 col-xs-6">


                <img src="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/thumb/{{ $product->feasured_image }}">
            <br/><p class="name"> <a href="{{url('/')}}/product/{{$product->product_name}}"> {{$product->product_title}} </a>
            </p>
            <p>Price :
                <?php

                if($product->discount_price){
                    $sell_price=  $product->discount_price;
                } else {
                    $sell_price=$product->sell_price;
                }

                echo $sell_price;


                ?>




            </p>

            <p>Point :{{$product->product_point}}</p>

            <div class="">

                <?php
                    if ($product->vendor_id != '' || $product->vendor_id != 0) {
                ?>

                <a  data-picture="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary"
                   href="javascript:void(0)" >  ADD TO CART</a>
                <a href="javascript:void(0)" data-picture="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-success"
                > BUY NOW  </a>
                <?php
                    }else{
                ?>

                <a data-product_id="{{ $product->product_id}}" data-picture="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary add_to_cart"
                   href="javascript:void(0)" >  ADD TO CART</a>
                <a href="javascript:void(0)" data-product_id="{{ $product->product_id}}" data-picture="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-success buy-now-cart "
                > BUY NOW  </a>

                <?php
                    }
                ?>

                
                </div>
        </div>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $products->links() !!}
        </td>
    </tr>
@endif


