@extends('website.master')
@section('mainContent')
    <section class="slider-section all-content-hide" id="sliderBgChangAbale">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-md-12 col-lg-2 col-xxl-2">

                </div>

                <div class="col-xl-10 col-md-12 col-lg-10 col-xxl-10">
                <div class="slider">
                    <div id="carouselExampleDark" class="carousel  slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @if($sliders)
                                @foreach($sliders as $key=>$slider)
                                    <div class="carousel-item {{$key==0? 'active':''}}" data-bs-interval="10000">
                                        <img src="{{ url('public/uploads/sliders')}}/{{$slider->homeslider_picture}}"
                                             class="d-block w-100 img" slide-bg-color="{{$slider->slider_color}}" alt="...">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleDark"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleDark"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                </div>


            </div>
        </div>
    </section>

    @include('website.home_hot_deal_product')

    <section class="home-product-section all-content-hide">
        <div class="container">
            <span class="home_page_category home_page_category_product"></span>
        </div>
    </section>
    <script>
        setInterval(homeSliderCngBg, 0);
        function homeSliderCngBg(color, geadient) {
            var color = $(".active img").attr("slide-bg-color");
            var geadient = $(".active img").attr("slide-bg-gradient");
            $("#sliderBgChangAbale").css("background-color", color).css("background-image", geadient);
        }
        jQuery.ajax({
            url: "{{url('/home_page_category_ajax')}}",
            type: "get",
        }).done(function (data) {
            if (data.html == " ") {
            }
            jQuery(".home_page_category_product").html(data.html);
        });
    </script>
@endsection