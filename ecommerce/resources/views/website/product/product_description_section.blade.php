<div class="row">
    <div class=" col-12 col-lg-7 col-xl-7 col-xxl-7 mt-2 ">
        <ul class="nav single-product-tab nav-tabs" id="myTab" style="background:#ddd;" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Description
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">terms & condition
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">Review
                </button>
            </li>
            <?php if($product->product_video){?>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button"
                        role="tab" aria-controls="video" aria-selected="false">Video
                </button>
            </li>
            <?php } ?>
        </ul>
        <div class="tab-content" id="myTabContent" style="border: 1px solid #ddd;margin-top: -1px !important;padding: 9px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                {!! $product->product_description !!}
                <img style="width: 100%;" class="img-fluid border p-1 mt-2"   src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->feasured_image }}"/>
                @if($product->galary_image_1)
                    <img  style="width: 100%;" class="img-fluid border p-1 mt-2"  src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_1 }}"/>
                @endif
                @if($product->galary_image_2)
                    <img style="width: 100%;" class="img-fluid border p-1 mt-2"  src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_2 }}"/>
                @endif

                @if($product->galary_image_3)
                    <img  style="width: 100%;" class="img-fluid border p-1 mt-2"
                          src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_3 }}"/>
                @endif
                @if($product->galary_image_4)
                    <img style="width: 100%;" class="img-fluid border p-1 mt-2"    src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_4 }}"/>
                @endif
                @if($product->galary_image_5)
                    <img style="width: 100%;" class="img-fluid border p-1 mt-2"    src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_5 }}"/>
                @endif
                @if($product->galary_image_6)
                    <img  style="width: 100%;" class="img-fluid border p-1 mt-2"     src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_6 }}"/>
                @endif

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php echo get_option('default_product_terms'); ?>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                <div class="col-sm-12 text-left" style="padding:0 20px">
                    <div class="col-sm-6 col-xs-12 review-right">
                        <div class="rating-overall-desc">
                            <div class="rating"><span style="width:0%"></span></div>
                            <p>{{$review_count}} Customer Reviews</p></div>
                        <ul class="commentlist">
                            <?php
                            if($reviews){
                            foreach ($reviews as $review){
                            ?>
                            <li class="comment even thread-even depth-1">
                                <div class="review-user review-header">
                                    <div class="rating">
                                        <span style="width:<?php echo 20 * $review->rating ?>%"></span>
                                    </div>
                                    <br/>
                                    <h5 itemprop="author">{{$review->name}}</h5>
                                    <em class="verified">verified</em>
                                    <small>{{date('d-M-Y h:i:s',strtotime($review->created_time))}}</small>
                                </div>
                                <div class="review-body">
                                    <div class="review-text" itemprop="description">
                                        <p>{{$review->comment}}</p>
                                    </div>
                                </div>
                            </li>
                            <?php } } ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                <p>
                    <iframe width="500" height="345"
                            src="https://www.youtube.com/embed/<?php echo $product->product_video;?>">
                    </iframe>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-5 col-xl-5 col-xxl-5 mt-1">
        <div class="row p-1">
            <div class="alert alert-success"  style="border:none;margin-bottom: 4px;font-size: 15px;color:black;font-weight: bold;padding: 8px;background-color: #ddd" role="alert">
                Hot Products
            </div>
            <div class="hot-single-all-product " style="border: 1px solid #ddd;margin-top: -7px;">
                <span id="hot_product"></span>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(AjaxFuntion, 1000);
    function  AjaxFuntion(){
        $.ajax({
            url: "{{url('hotProductList')}}",
            method: "get",
            success: function (data) {
                jQuery("#hot_product").html(data);
            }
        });
    }
</script>