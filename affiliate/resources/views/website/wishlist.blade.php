
@extends('layouts.master')
@section('pageTitle')
   Wishlist Products
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-lg-12">
    <h3 class="text-start fs-5">Wishlist</h3>
                <div class="table-responsive">
            <table    class="table table-bordered ">
          <tr>
            <th width="40%">Product</th>
            <th width="10%">Availability</th>
            <th width="20%" >Price</th>
            <th width="20%">Action</th>
        </tr>
        </thead>

        <tbody id="wishlist">
        @if($products)
            @foreach($products as $product)

<?php
    $product_stock=$product->product_stock;
                if ($product->discount_price) {
                $sell_price = $product->discount_price;
                } else {
                $sell_price = $product->product_price;
                }
                ?>
        <tr>
            <td class="name">
                <a href="{{ url('/product') }}/{{ $product->product_title }}">
                    <img
                        src="{{ url('https://www.sohojbuy.com/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"
                        alt="Menz full sleev polo-shirt-4327" width="30"> {{ $product->product_title }} </a></td>
            <td class="quantity">
                <div class="availability">@if($product_stock >0) In Stock @else Out of Stock @endif</div>
            </td>
            <td class="price">@money($sell_price)</td>
            <td class="total">
                <a href="javascript:void(0)" data-product_id="{{ $product->product_id}}" data-picture="{{ url('https://www.sohojbuy.com/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image}}" class="btn btn-primary  btn btn-sm add_to_cart icon"
                > <i   class=" text-white fa fa-shopping-cart"></i> </a>
                <a href="javascript:void(0)" class="remove_wish_list"   date-product_id="{{ $product->product_id}}">
                    <span class="fa fa-trash btn btn-danger"></span> </a>
            </td>
        </tr>
        @endforeach

        @else
            <tr>

                <td colspan="3" class="quantity">
               There are no product to your whislised
                </td>


            </tr>
            @endif
        </tbody>
    </table>

   </div>
   </div>
            </div>
   </div>
</div>

<script>
    $(document).on('click','.remove_wish_list',function () {

         let product_id= document.querySelector('.remove_wish_list').getAttribute('date-product_id');
        $.ajax({
            type:"GET",
            url:"{{url('remove-to-wishlist')}}?product_id="+product_id,
            success:function(data)
            {
                document.getElementById('wishlist_count').innerText=data.count.length

                jQuery("#wishlist").html(data.html);


            }
        })

    })
</script>

    <script>
        $(document).on('click', '.add_to_cart', function () {
            let product_id = $(this).data("product_id"); // will return the number 123
            let picture = $(this).data("picture"); // will return the number 123

            let quntity = 1;

            $.ajax({
                type: "GET",
                url: "{{url('add-to-cart')}}?product_id=" + product_id + "&picture=" + picture + "&quntity=" + quntity,

                success: function (data) {
                    console.log(data)

                    $('#cart_count').text(data.result.count);
                    $('.total-price .value').text(data.result.total);
                }
            })

        })
    </script>

    @endsection
