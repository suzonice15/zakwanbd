@extends('layouts.master')
@section('pageTitle')
    All Products   List
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">

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

            <div class="col-md-2">
                <a href="{{url('/')}}/cart">

                <img src="https://www.dhakabaazar.com/images/juri.png">

                <?php  $items = \Cart::getContent();



                $total = 0;
                $quantity = 0;
                foreach ($items as $row) {

                    $total = \Cart::getTotal();

                    $quantity = Cart::getContent()->count();

                }

                ?>

                <span class="buy_product_count" style="font-size: 21px;
position: absolute;
background-color: red;
width: 14%;
border-radius: 50%;
left: 37px;
height: 76%;
color: white;
text-align: center;font-weight:bold;">{{$quantity}}</span>

                </a>

                </div>

            <div class="col-md-4 ">
                <input type="text" id="serach" name="search" placeholder="Search Product By Product Code Or Product Name" class="form-control" >
            </div>
        </div>
        <br/>
        <hr/>
        <div class="row" id="link_products">

                @include('admin.affilate.buy_products_pagination')


        </div>


<style>
    .name{
        height: 33px;


    }
    </style>


        </div>
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />



    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('buy_products/products/pagination')}}?page="+page+"&query="+query,
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
                        url:"{{url('buy_products/pagination/category')}}?page="+page+"&query="+query,
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
        $(document).on('click','.add_to_cart',function () {
            let product_id=  $(this).data("product_id"); // will return the number 123
            let picture=  $(this).data("picture"); // will return the number 123


                quntity=1;



            $.ajax({
                type:"GET",
                url:"{{url('add-to-cart')}}?product_id="+product_id+"&picture="+picture+"&quntity="+quntity,

                success:function(data)
                {


                    $('body .buy_product_count').text(data.result.count);

                }
            })

        })
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
                    window.location.assign("{{ url('/') }}/checkout")
                    $('body .buy_product_count').text(data.result.count);

                }
            })

        })
    </script>


@endsection

