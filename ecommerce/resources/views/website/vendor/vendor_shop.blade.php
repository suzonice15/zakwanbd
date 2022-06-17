@extends('website.master')
@section('mainContent')
    <div class="container my-2">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>


                <li class="breadcrumb-item " aria-current="page"><a href="{{url('/shops')}}" >Shops</a></li>

                <li class="breadcrumb-item active " aria-current="page">{{$vendor_link}}</li>

            </ol>
        </nav>




    </div>



    <div class="container">







               <span id="post-data">

                                                  @include('website.vendor.vendor_shop_ajax')

           </span>





    </div>



    <input type="hidden"  id="vendor_link" name="vendor_link" value="{{$vendor_link}}">

    <script type="text/javascript">

        var page = 1;
        //jQuery('.ajax-load').show();
        jQuery(window).scroll(function() {


            page++;

            loadMoreData(page);



        });


        function loadMoreData(page){
            var vendor_link=$('#vendor_link').val();
            jQuery.ajax(

                {

                    url:"{{url('/vendor-shop-ajax-product')}}?page="+page+"&vendor_link="+vendor_link,

                    type: "get",

                    beforeSend: function()

                    {

                        //jQuery('.ajax-load').show();

                    }

                })

                .done(function(data)

                {
                    // console.log(data.html)
                    if(data.html == " "){

                        jQuery('.ajax-load').html("No more records found");

                        return;

                    }

                    jQuery('.ajax-load').hide();

                    jQuery("#post-data").append(data.html);

                })

                .fail(function(jqXHR, ajaxOptions, thrownError)

                {

                    // alert('server not responding...');

                });

        }

    </script>


@endsection
