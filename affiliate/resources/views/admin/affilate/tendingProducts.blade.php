@extends('layouts.master')
@section('pageTitle')
   Tending Products
@endsection
@section('mainContent')


    <style>

        @media (max-width: 776px){
            .searchbar{
                position: absolute;
                top: -34px;
                width: 236px  !important;
                right: 5px;
            }
            .top-section{
                margin-top: 6px;
            }
            .tending-section{
                position: absolute;
                right: 8px;
                top: -35px;
            }
        }
    </style>
    <div class="box-body" style="background: #f2f2f2;">


        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <label> Category list</label>
                <select name="category_id" id="category_id" class=" form-controll select2">
                    <option value="">
                        select categoy

                    </option>
                    <?php foreach ($categories as $category) { ?>
                    <option value="{{$category->category_id}}">{{$category->category_title}}</option>
                    <?php } ?>
                </select>

            </div>
            <div class="col-lg-3 col-sm-6 ">
                <a href="{{url('/user/product/hot-deals')}}" class="btn btn-success  top-section">Top Deals </a>
                <a href="{{url('/user/tending/products')}}" class="btn btn-success tending-section">Tending Products</a>
            </div>
            <div class="col-lg-6  col-sm-6  ">
                <input type="text" id="serach" name="search" placeholder="Search Product By Product Code Or Product Name" class="form-control searchbar" >
            </div>
        </div>


        <div class="row" id="link_products">

            @include('admin.affilate.tendingProductPagination')


        </div>


        <style>
            .name{
                height: 33px;


            }
        </style>


    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Product Link Generator</h4>
                </div>
                <div class="modal-body" id="view_page">

                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    </div>

    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('user/tending/productPagination')}}?page="+page+"&query="+query,
                    success:function(data)
                    {
                        $('#link_products').html('');
                        $('#link_products').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serach', function(){
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                if(query.length >0) {
                    fetch_data(page, query);
                } else {
                    fetch_data(1, '');
                }
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                fetch_data(page, query);
            });

            $(document).on('change', '#category_id', function(){
                var query = $('#category_id').val();
                var page = $('#hidden_page').val();
                if(query.length >0) {
                    $.ajax({
                        type:"GET",
                        url:"{{url('products/pagination/category')}}?page="+page+"&query="+query,
                        success:function(data)
                        {
                            $('#link_products').html('');
                            $('#link_products').html(data);
                        }
                    })
                } else {
                    fetch_data(1, '');
                }
            });




        });
    </script>



    <script>

        $(document).on('click', '.add-to-wishlist', function () {
            let product_id = $(this).data("product_id"); // will return the number 123
            $.ajax({
                type: "GET",
                url: "{{url('add-to-wishlist')}}?product_id=" + product_id,
                success: function (data) {
                   // document.getElementById('wishlist_count').innerText=data.count.length
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Successfully product added to your wishlist ',
                        showConfirmButton: false,
                        timer: 1000
                    })


                }
            })

        })

        function link_generator(id) {

            $.ajax({
                type:"GET",
                url:"{{url('product/link/id')}}?product_id="+id,
                success:function(data)
                {

                    $('#view_page').html(data);
                }
            });

        }
    </script>


    <script>
        $(document).on('click','.buy-now-cart',function () {
            let product_id=  $(this).data("product_id"); // will return the number 123
            let picture=  $(this).data("picture"); // will return the number 123
            let quntity =$('#quantity_of_sell').val();


            quntity=1;

            $.ajax({
                type:"GET",
                url:"{{url('add-to-cart')}}?product_id="+product_id+"&picture="+picture+"&quntity="+quntity,
                success:function(data)
                {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Product added to cart successfully',
                        showConfirmButton: false,
                        timer: 1000
                    })
                    setTimeout(()=>{
                        window.location.assign("{{ url('/') }}/cart")
                },1000)
                }
            })

        })
    </script>




@endsection

