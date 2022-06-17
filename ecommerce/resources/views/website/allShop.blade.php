@extends('website.master')
@section('mainContent')

    <div class="container my-2 all-content-hide">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active " aria-current="page">All Shop</li>
            </ol>
        </nav>
    </div>
    <div class="container all-content-hide">
        <div class="row px-2">
            @if($shops)
                @foreach($shops as $shop)
                    <div class="col-md-4 col-lg-2 col-xl-2 col-xxl-2 col-sm-6 col-6 p-1">
                        <div class="card ">
                            <div class="box">
                                <a  href="{{ url('/') }}/shop/{{$shop->vendor_link}}" >
                                    @if($shop->vendor_shop_image)
                                    <img class="img-fluid p-1" src="{{ url('/public/uploads/users') }}/{{ $shop->vendor_shop_image }}" alt="{{$shop->vendor_shop}}">
                                    @else
                                        <?php
                                            $product=DB::table('product')->where('vendor_id','=',$shop->vendor_id)->first();
                                            if($product){
                                            ?>
                                            <img class="img-fluid p-2" src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="{{$product->product_title}}">
                                        <?php } ?>
                                    @endif
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="product-title"><a  href="{{ url('/') }}/shop/{{$shop->vendor_link}}" >{{$shop->vendor_shop}} </a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
