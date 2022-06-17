@extends('website.master')
@section('mainContent')
    <section class="all-content-hide breadcrumb-section-main"  >
        <div class="container my-2">
            <div class="row">
                <div class="col-md-6 col-12 col-lg-6 col-xl-6 d-flex justify-content-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <?php if(isset($category_name_first)) { ?>
                            <li class="breadcrumb-item " aria-current="page"><a href="{{url('/category/')}}/{{$category_name_first}}">{{$category_title_first}}</a> </li>
                            <?php } ?>
                            <?php if(isset($category_name_middle)) { ?>
                            <li class="breadcrumb-item " aria-current="page"><a href="{{url('/category/')}}/{{$category_name_middle}}" >{{$category_title_middle}}</a></li>
                            <?php } ?>
                            <li class="breadcrumb-item active " aria-current="page"><a href="{{url('/category/')}}/{{$category_name_last}}" >{{$category_title_last}}</a></li>

                        </ol>
                    </nav>

                </div>
                <div class="col-md-6 col-12 col-lg-6 col-xl-6 d-flex justify-content-end">
                   
                    <select id="sorting" style="height: 35px;width: 200px;padding: 1px;margin-top: -1px;"  class="form-control" onchange="sorting(this.value)">
                        <option value=""> Sort By</option>
                        <option value="default">Default</option>
                        <option value="name_asc">Name A-Z</option>
                        <option value="name_desc">Name Z-A</option>
                        <option value="price_asc">Pirce Low to High</option>
                        <option value="price_desc">Pirce High to Low</option>

                    </select>

                </div>
            </div>

        </div>
        </section>
    <div class="container all-content-hide">
               <span id="post-data">
             @include('website.category_ajax')
           </span>
    </div>
    <input type="hidden"  id="category_name" name="category_name" value="{{$category_name}}">
    <input type="hidden"  id="order_by"   value="modified_time">


    <?php
    $customer=Session::get('customer_id');
    if($coin > 0 && $customer >0 ){   ?>
    <link rel="stylesheet"   href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
    <script>
        setTimeout(()=>{getCoinData("<?php echo $coin; ?>")},15000)
        function getCoinData(url_existing){
            $.ajax({
                url:"{{url('/')}}/getCoinData?url="+url_existing,
                success:function(data){
                    console.log(data)
                    toastr.success('You get 100 Coin Please Claim From Coin List');
                }
            })
        }
    </script>
    <?php } ?>

    <script type="text/javascript" async>

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function() {
            if($(window).scrollTop() + $(window).height()>= $(document).height()-50) {
                page++;
                loadMoreData(page);
            }
        });


        function sorting(order){
            $("#order_by").val(order)


                jQuery("#post-data").empty();


            loadMoreData(1);

        }




        function loadMoreData(page){
   var category_name=$('#category_name').val();
   var order_by=$('#order_by').val();
            jQuery.ajax( {
                    url:"{{url('/ajax_category')}}?page="+page+"&category_name="+category_name+"&order_by="+order_by,
                    type: "get",
                }) .done(function(data){
                    if(data.html == " "){
                        jQuery('.ajax-load').html("No more records found");
                        return;
                    }
                    jQuery("#post-data").append(data.html);

                })
        }

    </script>


@endsection
