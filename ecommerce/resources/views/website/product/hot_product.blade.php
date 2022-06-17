<div class="row">
    @foreach($products as $product)
        <?php
        if ($product->discount_price) {
            $sell_price = $product->discount_price;

        } else {
            $sell_price = $product->product_price;
        }
        ?>
        <div class="col-md-4 col-lg-6 col-xl-6 col-xxl-4 col-6 p-1">
            <div class="card ">
                @if ($product->discount_price)
                    <div class="freepeoduct"> <strong>-</strong> {{$product->product_price- $product->discount_price}} Tk</div>
                @endif
                <div class="box">
                    <a  href="{{ url('/') }}/{{$product->product_name}}" >
                        <img style="width: 100%;" class="img-fluid p-2" src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
                    </a> </div>
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
    @endforeach
</div>