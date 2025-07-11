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
                    <h3>{{$totalOrderCount}}</h3>
                    <p>Total Complete Order</p>
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
                    <p>Total Complete Sells Amount</p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{round($earning_balance,2)}}</h3>
                    <p> Earnings Balance  </p>
                    <div class="icon">
                        <i class="ion ion-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$pendingWithdraw}}</h3>
                    <p> Pending Withdraw  </p>
                    <div class="icon">
                        <i class="ion ion-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$paidWithdraw-$withdrawCharge}}</h3>
                    <p> Complete Withdraw  </p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$withdrawCharge}}</h3>
                    <p>   Withdraw Charge </p>
                    <div class="icon">
                        <i class="ion ion-man"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ./col -->
    </div>


@endsection

