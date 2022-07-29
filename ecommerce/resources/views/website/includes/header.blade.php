<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $customer_id = Session::get('customer_id');
    if (isset($page_title)) {
        $title = $page_title . '-' . get_option('site_title');
    } else {
        $title = get_option('site_title');
    }
    ?>            <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta meta name="viewport" content=
    "width=device-width, user-scalable=no" />
    <title><?=$title?></title>
    <link rel="shortcut icon" href="<?=get_option('icon')?>">
    <!-- Bootstrap Core CSS -->
    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('assets/font_end/')}}/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/font_end/')}}/css/stellarnav.css">
    <meta name="title" content="<?php if (isset($seo_title)) {
        echo $seo_title;
    }?>"/>
    <meta name="keywords" content="<?php if (isset($seo_keywords)) {
        echo $seo_keywords;
    }?>"/>
    <meta name="description" content="<?php if (isset($seo_description)) {
        echo $seo_description;
    }?>"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_base_url" content="{{ url('/') }}">
    <meta name="robots" content="index,follow"/>
    <link rel="canonical" href="{{url()->current()}}"/>
    <meta property="og:locale" content="EN"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="<?php if (isset($seo_description)) {
        echo $seo_description;
    }?>"/>
    <meta property="og:title" content="<?php if (isset($seo_title)) {
        echo $seo_title;
    }?>"/>
    <meta property="og:description" name="description" content="<?php if (isset($seo_description)) {
        echo $seo_description;
    }?>"/>
    <meta property="og:image" content="<?php if (isset($share_picture)) {
        echo $share_picture;
    } ?>"/>
    <meta property="og:site_name" content="<?php if (isset($seo_keywords)) {
        echo $seo_keywords;
    }?>"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"><link rel="stylesheet" as="font" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    @yield('css')
</head>
<body>

<style>

    .blink_mee {
        animation: blinker 1s linear infinite;
        margin-top: -4px;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>

<header class="bg-white">
    <section class="header-top text-white font-weight-bold py-1" style="background: #5B5959;height: 32px;">
        <div class="container">
            <div class="row">
                <div class="col-5 col-md-8 col-lg-9 col-xl-9 col-xxl-9">
                    <a href="tel:+8809602444444" class="text-white font-weight-bold text-start">
                        <i class="fa fa-phone text-white font-weight-bold"></i> &nbsp;01970010605
                    </a>
                </div>
                <div class="col-7 col-md-3 col-lg-3 col-xl-3 col-xxl-3 text-end">
                    <ul class="header-right-ul">
                        <li class="">
                            <a href="https://www.affiliate.zakwanbd.com/" class="text-reset py-2 text-white font-weight-bold">Affiliate</a>
                        </li>
                        <li class="">
                            <a href="{{url('/')}}/category/offer" class="text-reset py-2 text-white font-weight-bold">Offer</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container desktop-header d-none d-md-block d-lg-block d-xl-block d-xxl-block">
        <div class="row px-5 pt-3 pb-3">
            <div class="col-md-2 col-lg-2 col-xl-2 col-xxl-2  d-none d-md-block d-lg-block d-xl-block d-xxl-block">
                <a href="{{url('/')}}"> <img class="img-fluid logo-image"   src="{{get_option('logo')}}"></a>
            </div>
            <div class="col-8 col-md-8 col-lg-8 col-xl-9 col-xxl-9">
                <form autocomplete="off" action="{{ url('search') }}" method="get">
                    <div class="input-group">
                        <input style="border: 1px solid #e91b2a;height: 40px;
"  type="text" name="search" required  class="form-control searchbox desktop-search-field"
                               placeholder="Search For Products">
                        <div class="input-group-append">
                            <button class="btn btn-secondary search" style="background-color: #e91b2a;border: #e91b2a;height: 40px;border-radius: 3px;" type="submit">
                                <i class="fa fa-search" style="color:white;"></i>
                            </button>
                        </div>
                    </div>
                    <ul class="desktop-search-menu">
                    </ul>
                </form>
            </div>
            <?php  $items = \Cart::getContent();
            $total = 0;
            $quantity = 0;
            foreach ($items as $row) {
                $total = \Cart::getTotal();
                $quantity = Cart::getContent()->count();
            }
            ?>
            <div class="col-lg-2 col-md-2  col-xl-1 col-xxl-1 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
                <div class="d-flex justify-content-between mt-2">
                    <a href="{{url('/')}}/wishlist" class="me-3"> <i class="fs-5 fw-bold far fa-heart"></i>

                        @if(Session::get('total_wishlist_count')>0)
                            <span id="cart_count">{{Session::get('total_wishlist_count')}}</span>
                        @endif
                    </a>
                    <a href="{{url('/')}}/cart" class="me-3">
                        <i class="fs-5 fw-bold far fa-cart-plus"></i>
                            <span id="cart_count">{{$quantity}}</span>
                    </a>
                    @if(Session::get('customer_id'))
                        <a href="{{url('/')}}/customer/dasboard" class="me-3">
                            <?php
                            $picture=Session::get('picture');
                            if($picture){
                            ?>
                            <img   style="border-radius: 50%;width: 50px;position: absolute;top: 39px;height: 50px;"   class="img-fluid"  src="{{url('/')}}/public/uploads/users/{{$picture}}">
                            <?php } else { ?>
                            <img  style="border-radius: 50%;width: 50px;position: absolute;top: 39px;height: 50px;"   class="img-fluid"  src="data:image/png;base64,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">

                            <?php } ?>

                        </a>
                    @else
                    <a href="{{url('/')}}/customer/login" class="me-3"> <i class="fs-5 fw-bold fal fa-user"></i></a>
                        @endif
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid mobile-header d-block d-md-none d-sm-block d-lg-none d-xl-none ">
        <div class="row p-2 " style="border-bottom: 1px solid #9c9a9a;">
            <div class="col-1">
            </div>
            <div class="col-11">
                <form autocomplete="off" action="{{ url('search') }}" method="get">
                <div class="input-group">
                    <input style="border: 1px solid red;height: 37px;" type="text" name="search" required class="form-control searchbox desktop-search-field desktop_seac"  placeholder="Search Product">
                    <div class="input-group-append">
                        <button style="background-color: #c9151b;border: 2px solid #c9151b;/*! color: white; */height: 38px;border-radius:none;" class="btn btn-secondary search" type="submit">
                            <i  style="color: white;" class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <ul class="desktop-search-menu">
                </ul>
              </form>
            </div>
        </div>
        <div class="stellarnav mobile-menu-responsive">
            <ul>
                <li><a href="{{url('/')}}/category/free-delivery">Free Delivery </a></li>
                <li><a href="{{url('/')}}/category/buy-one-get-one">Buy 1 get 1 Free </a></li>
                <li><a href="{{url('/')}}/category/offer">Hot Deals </a></li>
                <li><a href="https://zakwanaffiliate.com/">Affiliate </a></li>
                <li><a href="{{url('/track-your-order')}}">Track My Order</a></li>

                <li><a href="{{url('/all-products')}}">All Products</a></li>
                <?php
                $categories = getAllParentCategoryForWebsite();
                if($categories){
                foreach ($categories as $first){
                $secondCategories = getChaildCategory($first->category_id);
                if(count($secondCategories) > 0){
                ?>
                <li><a href="{{url('/category')}}/{{$first->category_name}}">{{$first->category_title}}</a>
                    <ul>
                        <?php foreach ($secondCategories as $second){

                        $thirdCategories = getChaildCategory($second->category_id);
                        if(count($thirdCategories) > 0){
                        ?>
                        <li><a href="#">{{$second->category_title}}</a>
                            <ul>
                                <?php foreach ($thirdCategories as $third) {?>
                                <li><a href="{{url('/category')}}/{{$third->category_name}}">{{$third->category_title}}</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li><a href="{{url('/category')}}/{{$second->category_name}}">{{$second->category_title}}</a></li>
                        <?php } }?>
                    </ul>
                </li>
                <?php } else { ?>
                <li><a href="{{url('/category')}}/{{$first->category_name}}">{{$first->category_title}}</a></li>
                <?php
                }
                }
                }
                ?>
            </ul>
        </div>
    </div>
<section class="d-none d-lg-block d-xl-block d-xxl-block d-sm-none d-md-none" style="background-color:#99cf16;height: 46px;">
    <div class="container d-none d-md-block d-lg-block d-xl-block d-xxl-block" >
        <div class="row px-2 pt-3 pb-3 col-md-12">
            <div class="col-md-3  col-lg-2  col-xl-3 col-xxl-3">
                <div class="d-block text-white desktopMenuCategoryClickShow"
                     style="cursor: pointer;height: 47px;background-color: #E91B2A;margin-top: -17px;width: 221px;padding: 12px 1px;margin-left: -8px;">
                    <div class="d-inline p-2 ms-4">
                        <i class="fa fa-list-ul fs-6 fw-bold text-white"></i>
                    </div>
                    <div class="d-inline MenuCategory text-xl text-center ps-2 p-2 text-uppercase fs-6 fw-bold">
                        Categories
                    </div>
                    <div class="d-inline p-2 " style="float:right;margin-top:-8px;margin-right:21px">
                        <i class="fa fa-angle-down fs-6 fw-bold text-white"></i>
                    </div>
                </div>
                <?php $other_route = URL::current() != url('/');   ?>
                <div class="desktop-menu" style='@if ($other_route !=1) display:block @else display:none @endif'>
                    <ul class="">
                        <?php

                        if($categories){
                        foreach ($categories as $first){
                        $secondCategories =getChaildCategory($first->category_id);
                        if(count($secondCategories) > 0){
                        ?>
                        <li class="">
                            <a href="{{url('/category')}}/{{$first->category_name}}">{{$first->category_title}} </a>
                            <span class="right-main-menu-icon"><i class="fas fa-caret-right"></i></span>
                            <ul class="sub-menu-ul">
                                <?php foreach ($secondCategories as $second){
                                $secondCategory_id = $second->category_id;
                                $thirdCategories = getChaildCategory($second->category_id);
                                if(count($thirdCategories)>0){
                                ?>
                                <li class="">
                                    <a href="{{url('/category')}}/{{$second->category_name}}">{{$second->category_title}} </a>
                                    <span class="right-main-menu-icon"><i style="color:black" class="fas fa-caret-right"></i></span>
                                    <ul class="sub-sub-menu-ul">
                                        @foreach($thirdCategories as $thirdCategory)
                                            <li class="">
                                                <a href="{{url('/category')}}/{{$thirdCategory->category_name}}">{{$thirdCategory->category_title}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li> <?php }  else { ?>
                                <li class="">
                                    <a href="{{url('/category')}}/{{$second->category_name}}"> {{$second->category_title}}</a>
                                </li>
                                <?php } } ?>
                            </ul>
                        </li>
                        <?php } else { ?>
                        <li class="">
                            <a  href="{{url('/category')}}/{{$first->category_name}}">{{$first->category_title}}</a>
                        </li>
                        <?php
                        }
                        }
                        }
                        ?>
                    </ul>
                </div>

            </div>
            <div class="col-md-9 col-xl-9 col-xxl-9 col-lg-10 header-menu-anchore-parent" >
                <a href="{{url('/')}}/category/free-delivery" class="header-menu-anchore"  >Free Delivery</a>
                <a href="{{url('/')}}/category/buy-one-get-one" class="header-menu-anchore" >Buy   1 get 1 Free</a>
                <a href="{{url('/')}}/category/offer" class="header-menu-anchore"  >Hot Deals</a>
                <a href="{{url('/')}}/all-products" class="header-menu-anchore"> All Product</a>

              </div>
        </div>
    </div>
</section>
</header>
<section class="ajax-search">
    <div class="container">
            <span class="main_content_for_ajax_search"></span>
    </div>
</section>