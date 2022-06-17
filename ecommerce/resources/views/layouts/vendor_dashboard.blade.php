@extends('layouts.master')
@section('pageTitle')
   Vendor Dashboard
@endsection
@section('mainContent')
    <br>
    <?php
    if ($verify->nid_image=='' && $verify->bank_image=='') {
    ?>
    <a href="{{url('vendor/profile')}}/{{ Session::get('id') }}">
    <div class="row" style="font-size:25px ">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-danger" role="alert">
              
              Please verify your first verification upload nid and bank statement image.
              
            </div>
        </div>
    </div>
    </a>
    <?php
    }else if($verify->first_verify=='0'){
    ?>
    <div class="row">
        <div class="col-lg-12 col-xs-12" style="font-size:25px ">
            <div class="alert alert-warning" role="alert">
              
              Please waiting for admin verification.
              
            </div>
        </div>
    </div>
    <?php
    }else if($verify->m_name==''||$verify->b_name==''){
    ?>
    <a href="{{url('vendor/bank-account')}}">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-danger" role="alert">
              Please verify your second verification.
            </div>
        </div>
    </div>
    </a>
    <?php
    }else if($verify->m_number==''||$verify->b_number==''){
    ?>
    <a href="{{url('vendor/bank-account')}}" style="font-size:25px ">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-danger" role="alert">
              Please verify your second verification.
            </div>
        </div>
    </div>
    </a>
    <?php
    }else if($verify->m_type==''||$verify->b_branch==''){
    ?>
    <a href="{{url('vendor/bank-account')}}" style="font-size:25px ">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-danger" role="alert">
              Please verify your second verification.
            </div>
        </div>
    </div>
    </a>
    <?php
    }else if($verify->m_service==''||$verify->b_bank==''){
    ?>
    <a href="{{url('vendor/bank-account')}}" style="font-size:25px ">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-danger" role="alert">
              Please verify your second verification.
            </div>
        </div>
    </div>
    </a>
    <?php 
    }else if($verify->second_verify=='0'){
    ?>

    <div class="row">
        <div class="col-lg-12 col-xs-12" style="font-size:25px ">
            <div class="alert alert-danger" role="alert">
              Please waiting for admin verification.
            </div>
        </div>
    </div>

    <?php
    }
    ?>
    <div class="row">
        <div class="container-fluid">
            <h3 style="text-align: center;background-color: green;color: white;height: 2%;padding: 5px;size: auto;">{{$myBalance->vendor_shop}}</h3>
            <!-- ./col -->
            <a href="{{ url('vendor/products/show') }}">
                <div class="col-md-3">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$products}}</h3>
                            <h4></h4>

                            <p>My Products</p>
                        </div>
                        
                    </div>
                </div>
            </a>
            

            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$verify->life_time_earning}}</h3>
                        <h4></h4>

                        <p>Life Time Earing</p>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$totalWithdrawAmount}}</h3>
                        <h4></h4>

                        <p>Life Time Withdrow</p>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{round($myBalance->amount)}}</h3>
                        <h4></h4>

                        <p>My Balance</p>
                    </div>
                    
                </div>
            </div>
            <a href="{{ url('vendor/orders/show') }}">
                <div class="col-md-3">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$total_orders}}</h3>
                            <h4>  </h4>

                            <p>Total Order</p>
                        </div>

                    </div>
                </div>
            </a>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$total_phone_pending}}</h3>
                        <h4></h4>

                        <p>Total Phone Pending</p>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$total_pending_payment}}</h3>
                        <h4></h4>

                        <p>Total Pending Payment</p>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$total_on_courier}}</h3>
                        <h4></h4>

                        <p>Total On Courier Order</p>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$total_new}}</h3>
                        <h4></h4>

                        <p>Total New Order</p>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box" style="background-color: red;color:white">
                    <div class="inner">
                        <h3>{{$total_refund}}</h3>
                        <h4></h4>

                        <p>Refund Order</p>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box" style="background-color: red;color:white">
                    <div class="inner">
                        <h3>{{$total_cancled}}</h3>
                        <h4></h4>

                        <p>Cancel Order</p>
                    </div>

                </div>
            </div>
            <div class="col-md-3">
                <!-- small box -->
                <div class="small-box " style="background-color: green;color:white">
                    <div class="inner">
                        <h3>{{$total_completed}}</h3>
                        <h4></h4>

                        <p>Approved Order</p>
                    </div>
                    
                </div>
            </div>


        </div>

    </div>

@endsection

