@extends('website.master')
@section('mainContent')
    <?php
    $vendor_id = $product->vendor_id;
    $review_count = DB::table('review')->where('product_id', $product->product_id)->count();
    $reviews = DB::table('review')->where('product_id', $product->product_id)->get();
    if ($vendor_id > 0) {
        $vendor = DB::table('vendor')->select('vendor_link', 'vendor_shop')->where('vendor_id', $vendor_id)->first();
        $shop_link = $vendor->vendor_link;
        $shop_name = $vendor->vendor_shop;
    }
    /*# product stock availability #*/
    $product_availabie = $product->product_stock;
    $product_availability = '<span class="text-success"> In Stock</span>';
    
    $product_id_related = $product->product_id;
    ?>
    @include('website.product.product_breadcumb')
    <div class="container my-2 all-content-hide">
        <div class="row">
            @include('website.product.product_image_section')
            @include('website.product.product_right_section')
       </div>
    </div>
    <div class="container my-2 all-content-hide" style="background-color:white">
        @include('website.product.product_description_section')
      </div>
        <span id="related_product" class="all-content-hide my-2" style="background-color:white"></span>
    <input type="hidden" id="related_product_id" name="product_id" value="<?php echo $product_id_related; ?>">
    <script type="text/javascript"
            src="{{ asset('assets/font_end/')}}/dist/jquery.floating-social-share.min.js"></script>
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/font_end/')}}/dist/jquery.floating-social-share.min.css"/>
    <script type="text/javascript" src="{{ asset('assets/font_end/')}}/dist/xzoom.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/font_end/')}}/dist/xzoom.css"/>


    <?php
    $customer=Session::get('customer_id');
    if($coin > 0 && $customer > 0 ){   ?>
   
    <?php } ?>
    <script>
        $(".xzoom").xzoom({tint: '#333', Xoffset: 15});
        jQuery(document).ready(function () {
            var url = window.location.href;
            $("body").floatingSocialShare({
                buttons: [
                    "facebook", "linkedin", "pinterest",
                    "twitter", "whatsapp"
                ],
                text: "share with:",
                url: document.URL,

            });
            var product_id = jQuery('#related_product_id').val();
           setTimeout(AjaxFuntion, 2000);
          function  AjaxFuntion(){
                $.ajax({
                    url: "{{url('/product/click')}}?product_id=" + product_id,
                    method: "get",
                    success: function (data) {

                    }
                });
                $.ajax({
                    url: "{{url('related/product')}}?product_id=" + product_id,
                    method: "get",
                    success: function (data) {
                        jQuery("#related_product").html(data.html);
                    }
                });

            }


        });

        $('#reviewbtn').on('click', function () {
            var rating = $('input[name=rating]:checked').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var comment = $('#comment').val();
            var product_id = $('#product_review_id').val();
            var base_url = '{{url('/')}}/';
            if (typeof (rating) == 'undefined') {
                alert("Enter rating value");
                return false;
            }
            if (comment == '') {
                alert("Enter your comment")
                return false;
            }
            var ajax_url = base_url + 'add_to_review';
            $.ajax({
                type: 'POST',
                data: {
                    "rating": rating,
                    "name": name,
                    "email": email,
                    "comment": comment,
                    "product_id": product_id,
                    "_token": "{{ csrf_token() }}"
                },
                url: ajax_url,

                success: function (result) {

                    location.reload();
                }
            });
        });

        function IncrementFunction() {
            var quantity = parseInt($("#quantity").text());

            if (quantity) {
                quantity = quantity + 1;
            }
            let product_stock = $('#limit_stock_product').val();
            if(product_stock >=quantity) {
                $("#quantity").text(quantity);
            } else {
                alert("Only "+ product_stock +" available ")
            }
        }
        function DecrementFunction() {
            var quantity = parseInt($("#quantity").text());

            if (quantity > 1) {
                quantity = quantity - 1;
            }
            $("#quantity").text(quantity);
        }
        $(document).on('click', '.thum_image_hover', function () {

            const image = $(this).attr('src');

            $(".xzoom").attr('src', image);
            $(".xzoom").attr('xoriginal', image);
        })
    </script>
@endsection
