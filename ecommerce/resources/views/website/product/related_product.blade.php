<div class="container mt-2">
    <div class="row" style="border: 1px solid #ddd">
        <h3 style="background: #ddd;color: black;font-size: 18px;padding: 9px;font-weight: bold;" class="section-title">Related Products</h3>

    <?php foreach ( $products->unique('product_name') as $product) {
    if ($product->discount_price) {
        $sell_price = $product->discount_price;
    } else {
        $sell_price = $product->product_price;
    }
    ?>
<div class="col-md-4 col-lg-2 col-xl-2 col-xxl-2 col-sm-6 col-6 p-1">
    <div class="card ">
        @if ($product->discount_price)
            <div class="freepeoduct"> <strong>-</strong> {{$product->product_price- $product->discount_price}} Tk</div>
        @endif
        <div class="box">
            <a  href="{{ url('/') }}/{{$product->product_name}}" >
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" class="img-fluid p-2"  alt="{{$product->product_title}}">
        </a></div>
        <div class="card-body">
            <p class="product-title"><a  href="{{ url('/') }}/{{$product->product_name}}" >{{$product->product_title}} </a></p>
            <div class="text-center price ">
                <?php
                if($product->discount_price){
                ?>
                <p class="text-danger text-decoration-line-through"> @money($product->product_price)</p>
                <?php
                }
                ?>
                <p> @money($sell_price)</p>
            </div>
            <span class="star-rating text-center "><span style="position: relative;top: 5px;">({{totalProductRiviewCount($product->product_id)}})</span></span>
        </div>
    </div>
</div>
<?php  }?>
    </div>
</div>
<!-- /.home-owl-carousel -->
