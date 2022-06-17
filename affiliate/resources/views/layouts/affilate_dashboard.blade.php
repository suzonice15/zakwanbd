@extends('layouts.master')
@section('pageTitle')
    Affiliate  Dashboard
@endsection
@section('mainContent')
    <br xmlns="http://www.w3.org/1999/html">

    <style>

        .comming_soon {
            position: absolute;
            right: 50px;
            top: -11px;
            font-size: 20px;
            font-weight: bold;
            margin-top: 16px;
        }

        .number {
            position: absolute;
            margin-top: 16px;
        }

        .horizontal_border {
            border-top: 1px dashed red;
            margin-bottom: 2px;
        }

        fieldset {
            border: 1px solid #000;
        }

        ol li {
            font-size: 18px;
            margin-bottom: 6px;
        }

    </style>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 30%;
            top: 0;
            width: 60%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */

        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: red;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }


    </style>

    <div class="box-body">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Lifetime Earning </div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align:center">
                                <?php $lifeEarn=($total_withdraw+$user->earning_balance+$user->cash_back+$user->bonus_balance);
                                echo number_format($lifeEarn, 2); ?> Tk
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Total Withdraw</div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align:center">  <?php echo number_format($total_withdraw, 2); ?> Tk</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Earning Balance</div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align: center"><?php echo number_format($user->earning_balance, 2); ?>
                                Tk</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Wallet Balance</div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align:center"> <?php echo number_format($user->ewallet_balance, 2); ?>
                                Taka</h4>
                        </div>
                    </div>
                </div>


                


            </div>

            <div class="row">

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Shopping Points</div>
                        <div class="panel-body color-green" style="background-color: #e6e6e6;">

                            <h4 style="text-align: center"> <?php echo number_format($user->shopping_point, 2); ?>
                                SP</h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Cash Back</div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align:center">  <?php echo number_format($user->cash_back, 2); ?> Tk</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Bonus Balance</div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align: center"><?php echo number_format($user->bonus_balance, 2); ?>
                                Tk</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="font-weight: bold">Total Referrals</div>
                        <div class="panel-body" style="background-color: #e6e6e6;">

                            <h4 style="text-align:center">{{$totals_refer}}
                                </h4>
                        </div>
                    </div>
                </div>


                


            </div>


        </div>

        <div class="row">

            <div class="col-md-12">



                <div class="alert alert-danger" role="alert">
                    Are you  want to convert to dashboard 1 when you conver dashboard 1 you can not back dasboard 2 commision lavel


                    <a href="{{url('/')}}/dasboard/status_changed" > Click here....</a>

                </div>
            </div>



        </div>

        <div class="row">

            <div class="col-md-4">
                <br/>
                <span style="/*! font-weight: bold; */font-size:20px;margin-left: 11px;">Your Refferar Code: <?php echo $user->id; ?> </span>

            </div>

            <div class="col-md-5">
                Your referer link:
                <input id="link_id" style="font-size: 18px;" type="text"
                       value="{{url('/')}}/reffer/<?php echo $user->id; ?>"
                       class="form-control">

            </div>
            <div class="col-md-3">
                <br/>
                <input type="button" value="Copy" onclick="myFunction()" class="btn btn-success">

            </div>


        </div>
        <hr style="border:1px solid green">
        <div class="row">
            
            <div class="col-md-10">
                <h1 style="text-align: center;">Hot Products</h1>
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
        </div>
        <div class="row">
        @foreach ($products as $product)

            <div class="col-md-3">


                    <img src="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/thumb/{{ $product->feasured_image }}">
                <br/>
                <p style="margin-top: 5px;">Cash Back : {{$product->cash_back.'%'}}</p>
                <p class="name"> <a href="{{ env('APP_ECOMMERCE') }}{{$product->product_name}}"> {{$product->product_title}} </a>
                </p>
                <p style="margin-top: -5px;">Price :
                    <?php

                    if($product->discount_price){
                        $sell_price=  $product->discount_price;
                    } else {
                        $sell_price=$product->sell_price;
                    }

                    echo $sell_price;


                    ?>




                </p>

                <p style="margin-top: -5px;">Point :{{$product->product_point}}</p>

                <div class="" style="margin-top: -5px;">

                    <a data-product_id="{{ $product->product_id}}" data-picture="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-primary add_to_cart"
                       href="javascript:void(0)" >  ADD TO CART</a>
                    <a href="javascript:void(0)" data-product_id="{{ $product->product_id}}" data-picture="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image}}" class="btn btn-success buy-now-cart "
                    > BUY NOW  </a>
                    </div>
            </div>

        @endforeach
        </div>
        <hr style="border:1px solid green">

        <div class="row">

            <?php


            if ($leve_users) {
                $lave_l_user = 0;

                foreach ($leve_users as $leve_user) {
                    if ($leve_user->lavel == 2) {
                        $lave_l_user++;
                    }

                }
            }

            if ($right_level_active) {
                $right_level_active_status = 0;

                foreach ($right_level_active as $right_level) {

                        $right_level_active_status++;


                }
            }


            ?>

            <div class="col-md-6" style="padding-left: 36px;">

                <div class="rank" style="border: 3px solid #ddd;padding: 10px;text-align: center;">

                    <?php

                    if(empty($user_level_active)){


                    ?>

                    <h3> Your Cureent Rank : Level 1 <br> <br>Your commission is 10%</h3>
                        <h3>  Generation Income 0%</h3>

                    <?php } elseif($user_level_active->lavel==2){ ?>

                    <h3> Your Cureent Rank : Level 2 <br><br> Your commission is 15%</h3>
                        <h3>  Generation Income 0%</h3>

                    <?php } elseif($user_level_active->lavel==3){ ?>

                    <h3> Your Cureent Rank : Level 3 <br> <br>Your commission is 20%</h3>



                        <h3>  Generation Income 5%</h3>

                    <?php } elseif($user_level_active->lavel==4) { ?>
                    <h3> Your Cureent Rank : Level 4 <br> Your commission is 25%</h3>


                    <?php } ?>

                    <br/>
                    <br/>


                </div>


                <?php

                if(empty($user_level_active)){
                ?>


                        <!-- level 2 start-->

                <div class="level_2" style="border: 3px solid #ddd;
margin-top: 10px;
padding: 13px;">

                    <p style="text-align:center;color:#0d0d0d63;font-weight:bold">Target</p>

                    <h4>Increase your commission by completing tasks</h4>

                    <h3><i class="fa fa-fw fa-arrow-right"></i> Level 2 + 5% </h3>
                    <ol>


                        <li>Complete Profile
                            @if($profile_success_count==6)
                                <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>
                            @endif
                        </li>
                        <li>Invite 5 People
                            @if($invite_count>4)
                                <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>
                            @endif

                            <div class="progress progress-md active" style="width: 80%;">
                                <div class="progress-bar progress-primary " role="progressbar"
                                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$level_1}}"
                                     style="width: {{$level_1}}%">
                                    <span class="sr-only">{{$level_1}}% Complete</span>
                                </div>

                                <span> &nbsp;&nbsp;&nbsp;{{$level_1}}%</span>
                            </div>
                        </li>
                        <li>Pay 100 Shopping Point

                            <?php


                            ?>


                            @if($point_pay >1)
                                <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>
                            @else
                                <input type="button" class="btn btn-success btn-sm" value="Pay" id="pay_shopping_point">
                            @endif

                        </li>
                    </ol>


                    <?php
                    if(($profile_success_count == 6) && ($invite_count > 4) && ($point_pay > 1) ){



                    ?>

                    <input type="button" id="upgrade_2" class="btn btn-success" style="margin-left: 57px;"
                           value="Upgrade to Level 2  ">

                    <?php } else { ?>
                    <input type="button" class="btn btn-default" style="margin-left: 57px;"
                           value="Upgrade to Level 2 ">
                    <?php } ?>


                </div>

                <?php } elseif($user_level_active->lavel==2){ ?>


                <div class="level_3" style="border: 3px solid #ddd;
margin-top: 10px;
padding: 13px;">
                    <h4>Increase your commission by completing tasks</h4>

                    <h3><i class="fa fa-fw fa-arrow-right"></i> Level 3 </h3>

                    <span style="font-size: 15px;font-weight: normal;">+5% of your referrals earnings </span>
                    <br/>
                    <br/>
                    <ol>


                        <li>Total referrals 10
                            @if($invite_count>9)
                                <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>
                            @endif

                            <div class="progress progress-md active" style="width: 300px;">
                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$level_3_reffers}}"
                                     style="width: {{$level_3_reffers}}%">
                                    <span class="sr-only">{{$level_3_reffers}}% Complete</span>
                                </div>

                                <span> &nbsp;&nbsp;&nbsp;{{$level_3_reffers}}%</span>
                            </div>
                        </li>
                        <li>Team sell 2000 taka @if($team_sells>1999)
                                <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>
                            @endif


                            <div class="progress progress-md active" style="width: 300px;">
                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                     aria-valuenow="100" aria-valuemin="0" aria-valuemax="{{$team_sells}}"
                                     style="width: {{$team_sells}}%">
                                    <span class="sr-only">{{$team_sells}}% Complete</span>
                                </div>

                                <span> &nbsp;&nbsp;&nbsp;{{$team_sells}}%</span>
                            </div>

                        </li>

                        <li>

                            1 Lavel 2 associate

                            <?php if($lave_l_user >0){?>

                            <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>
                            <?php } ?>


                        </li>
                        <li>Pay 100 Shopping Point

                            <?php
                         //   if(($team_sells > 1999) && ($invite_count > 9) && ($point_pay > 199)){

                             if($point_pay > 199){


                            ?>
                            <i style="color:green;font-size:20px" class="fa fa-fw fa-check"></i>

                            <?php }  else {   ?>

                            <input type="button" class="btn btn-success btn-sm" value="Pay" id="pay_shopping_point_in_lavel_3">

                        <?php } ?>



                        </li>




                    </ol>


                    <?php
                    if(($team_sells > 1999) && ($invite_count > 9) && ($point_pay > 199) &&($lave_l_user > 1)){



                    ?>

                    <input type="button" id="upgrade_3" class="btn btn-success" style="margin-left: 57px;"
                           value="Upgrade to Level 3  ">

                    <?php } else { ?>
                    <input type="button" class="btn btn-default" style="margin-left: 57px;"
                           value="Upgrade to Level 3 ">
                    <?php } ?>

                </div>

                <?php }  else{ ?>

                <h3><i class="fa fa-fw fa-arrow-right"></i> Level 4 Comming soon</h3>

                <?php } ?>


            </div>
            <div class="col-md-6">
                <ul class="timeline">


                    <li>


                    </li>


                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">

                                        <div style="height: 250px;width:250px;border:2px solid green;margin-left: -2px;">


                                            <img src="{{url('/')}}/images/next.jpg"
                                                 style="padding: 5px;height: 248px;margin-left: 2px;" width="100%">

                                        </div>
                                        <h3>Next Levels <i class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i></h3>

                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>


                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 10   <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +4%   </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 9   <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +4%   </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 8    <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +4%  </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 7    <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +4%   </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 6   <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +4%    </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 5   <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +5%    </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 4   <i
                                                        class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">+5% of your referrals earnings  </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>

                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 3

                                                <?php

                                                if($right_level_active_status >1){


                                                ?>
                                                Completed
                                            <i
                                                    style="color:green;font-size:20px"
                                                    class="fa fa-fw fa-check"></i>
                                                <?php } else { ?>

                                                <i class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i>
                                                <?php }   ?>


                                                <br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">+5% of your referrals earnings </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>


                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 2
                                                <?php

                                                if($right_level_active_status >0){



                                                ?>
                                                Completed
                                            <i
                                                    style="color:green;font-size:20px"
                                                    class="fa fa-fw fa-check"></i>


                                                <?php } else { ?>

                                                <i class="fa fa-lock" style="color: #3e3d3d;
font-size: 27px;" aria-hidden="true"></i>

                                                <?php }  ?>

                                                <br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision +5%  </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>


                    <li>

                        <div class="timeline-item">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="timeline-body">
                                        <p style="font-size: 20px;"><span style="font-weight: bold">Level 1  Completed  <i
                                                        style="color:green;font-size:20px"
                                                        class="fa fa-fw fa-check"></i><br/> </span>
                                            <span style="font-size: 15px;font-weight: normal;">Affiliate  Commision 10%  </span>
                                        </p><br/>


                                    </div>

                                </div>

                            </div>


                        </div>
                    </li>


                </ul>

            </div>

        </div>
    </div>





    <!--         level 2 modal              ************* -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header" style="text-align: center">
                <span class="close">&times;</span>
                <h2>Congratulations!! {{Session::get('name')}}</h2>
                <h3>You are now level 2 Associate <br/> your commision increased to 15%</h3>
            </div>
            <div class="modal-body">
                <img width="100%" src="{{url('/')}}/images/star.gif">
            </div>

        </div>

    </div>

    <script>
        function myFunction() {
            var copyText = document.getElementById("link_id");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");

        }
    </script>


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("upgrade_2");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("upgrade_3");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <script>
        $("#pay_shopping_point").click(function () {

            $("#pay_shopping_point").val('Please Wait....');
            $("#pay_shopping_point").prop("disabled", true);

            $.ajax({

                url: "{{url('/')}}/pay_point_to_admin",
                type: "get",
                success: function (data) {
                    if (data == 'ok') {
                        location.reload();
                    } else {
                        $("#pay_shopping_point").val('Pay');

                        alert(data);
                    }
                }

            });


        });

    </script>




    <script>
        $("#upgrade_2").click(function () {

            $("#upgrade_2").val('Please Wait....');
            $("#upgrade_2").prop("disabled", true);

            $.ajax({

                url: "{{url('/')}}/affilite/upgrade_2",
                type: "get",
                success: function (data) {
                    if (data == 'ok') {


                        setInterval(function () {
                            location.reload();
                        }, 1000);


                    } else {


                        alert(data);
                    }
                }

            });


        });

    </script>

    <script>
        $("#upgrade_3").click(function () {

            $("#upgrade_3").val('Please Wait....');
            $("#upgrade_3").prop("disabled", true);

            $.ajax({

                url: "{{url('/')}}/affilite/upgrade_3",
                type: "get",
                success: function (data) {
                    if (data == 'ok') {


                        setInterval(function () {
                            location.reload();
                        }, 1000);


                    } else {


                        alert(data);
                    }
                }

            });


        });

    </script>

    <script>
        $("#pay_shopping_point_in_lavel_3").click(function () {

            $("#pay_shopping_point_in_lavel_3").val('Please Wait....');
            $("#pay_shopping_point_in_lavel_3").prop("disabled", true);

            $.ajax({

                url: "{{url('/')}}/pay_point_to_admin_in_lavel_3",
                type: "get",
                success: function (data) {
                    if (data == 'ok') {
                        location.reload();
                    } else {
                        $("#pay_shopping_point_in_lavel_3").val('Pay');

                        alert(data);
                    }
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

