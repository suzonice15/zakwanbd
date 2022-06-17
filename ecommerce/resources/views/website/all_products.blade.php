@extends('website.master')
@section('mainContent')
        <div class="container my-2 all-content-hide">
            <div class="row">
                <div class="col-md-6 col-12 col-lg-6 col-xl-6 d-flex justify-content-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active " aria-current="page"><a href="{{url('/all-products/')}}">All Products</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-12 col-lg-6 col-xl-6 d-flex justify-content-end">
                    <span class="mt-2">  Sort By</span>
                    <select id="sorting" style="height: 37px;width: 200px;" class="form-control" onchange="sorting(this.value)">
                        <option value="default">Default</option>
                        <option value="name_asc">Name A-Z</option>
                        <option value="name_desc">Name Z-A</option>
                        <option value="price_asc">Pirce Low to High</option>
                        <option value="price_desc">Pirce High to Low</option>
                    </select>
                </div>
            </div>
        </div>
         <div class="container all-content-hide"><span id="post-data">@include('website.all_product_by_ajax')</span>
            </div>
        </div>
        <input type="hidden"  id="order_by"   value="modified_time">
    <script type="text/javascript" >
        function sorting(order){
            $("#order_by").val(order)
                jQuery("#post-data").empty();
            loadMoreData(1);
        }
        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function () {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });
        function loadMoreData(page) {
            var order_by=$('#order_by').val();
            jQuery.ajax(
                    {    url: "{{url('/all_ajax_products')}}?page=" + page+"&order_by="+order_by,
                        type: "get",
                      }).done(function (data) {
                         if (data.html == " ") {
                            jQuery('.ajax-load').html("No more records found");
                            return;
                        }
                        jQuery('.ajax-load').hide();
                        jQuery("#post-data").append(data.html);
                    }).fail(function (jqXHR, ajaxOptions, thrownError) {

                    });
        }

    </script>
@endsection
