@extends('layouts.master')
@section('pageTitle')
  Dashboard View
@endsection
@section('mainContent')
<br>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$affilites}}</h3>

                    <p>Total Affilates</p>
                </div>
                <div class="icon">
                    <i class="ion ion-man"></i>
                </div>
{{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$online_now}}</h3>
                    <p>Online Now</p>
                </div>
                <div class="icon">
                    <i class="ion ion-man"></i>
                </div>
                {{--                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">

                    <h3>{{$today_visitor}}</h3>
                    <p>Today Visitors</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
                   </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$last_week}}</h3>
                    <p>This Week</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
                       </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">

                    <h3>{{$this_mount_user}}</h3>
                    <p>This Month</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
                       </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$total_withdraw}}</h3>
                    <p>Total Commision Paid</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$total_sell}}</h3>
                    <p>Total Sells</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>


@endsection

