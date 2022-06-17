@extends('layouts.master')
@section('pageTitle')
    All Products   List
@endsection
@section('mainContent')
    <div class="box-body">
        <hr/>
        <div class="row" id="link_products">
            @foreach ($products as $product)


                <div id="ad_wrapper" style="font-size:1em">
                    <a href="{{ env('APP_ECOMMERCE') }}<?php echo $product->product_name."/".Session::get('id') ?>"><img style="margin:5px 0;display:block" src="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" width="110" height="60"></a>
                    <a style="font-weight:bold;display:block" href="{{ env('APP_ECOMMERCE') }}<?php echo $product->product_name."/".Session::get('id') ?>">{{$product->product_name}}</a>
                </div>

            @endforeach

        </div>



        <style>
            .name{
                height: 33px;


            }
        </style>


    </div>



@endsection

