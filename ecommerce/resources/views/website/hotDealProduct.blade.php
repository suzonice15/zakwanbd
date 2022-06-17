@extends('website.master')
@section('mainContent')
    <div class="container all-content-hide">
        <div class="row mt-2 all-content-hide">
            <div class="col-12">
                <div class="alert alert-success"  style="margin-bottom: 4px;font-size: 18px;color:black;font-weight: bold" role="alert">
                      Hot Deal Products
                </div>
            </div>
            @if($products)
                @foreach($products as $product)

                    <?php
                    if ($product->discount_price) {
                        $sell_price = $product->discount_price;
                    } else {
                        $sell_price = $product->product_price;
                    }
                    ?>
                    <div class="col-md-4 col-lg-2 col-xl-2 col-sm-6 col-6 p-1">
                        <div class="card ">
                            @if ($product->discount_price)
                                <div class="freepeoduct"> <strong>-</strong> {{$product->product_price- $product->discount_price}} Tk</div>
                            @endif
                            <div class="box">
                                <a  href="{{ url('/') }}/{{$product->product_name}}" > <img  class="img-fluid p-2" src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
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
            @endif

        </div>

    </div>

@endsection