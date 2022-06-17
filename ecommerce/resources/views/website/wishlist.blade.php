
@extends('website.master')
@section('mainContent')
<div class="container-fluid my-3" id="wishlist" style="height: 400px;">
    <h3 class="text-start fs-5">Wishlist</h3>
    <table class="table   table-bordered">


        <thead>
        <tr>
            <th class="name">Product</th>
            <th class="quantity">Availability</th>
            <th class="price">Price</th>
            <th class="total text-center">Action</th>
        </tr>
        </thead>

        <tbody>

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
                <a href="{{ url('/') }}/{{ $product->product_title }}">
                    <img
                        src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"
                        alt="Menz full sleev polo-shirt-4327" width="30"> {{ $product->product_title }} </a></td>
            <td class="quantity">
                <div class="availability">@if($product_stock >0) In Stock @else Out of Stock @endif</div>
            </td>
            <td class="price">@money($sell_price)</td>
            <td class="total text-center" width="8%">
                <a href="javascript:void(0)" data-product_id="{{ $product->product_id}}" data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image}}" class="btn btn-primary  btn btn-sm add_to_cart icon"
                > <i
                        class=" text-white fa fa-shopping-cart"></i> </a> <a href="javascript:void(0)" class="remove_wish_list"
                                                                 date-product_id="{{ $product->product_id}}"> <span class="fa fa-trash btn btn-danger"></span> </a></td>
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

<script>
    $(document).on('click','.remove_wish_list',function () {
        let product_id=  $(this).data("product_id"); // will return the number 123
        $(this).css("background-color", "red");

        $.ajax({
            type:"GET",
            url:"{{url('remove-to-wishlist')}}?product_id="+product_id,
            success:function(data)
            {
                jQuery("#wishlist").html(data.html);


            }
        })

    })
</script>

    @endsection
