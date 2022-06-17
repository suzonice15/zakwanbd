

@extends('website.master')
@section('mainContent')

    <style>

        table tr td {
            border: 1px solid #8000ff !important;
            border-top-color: rgb(29, 150, 178);
            border-top-style: solid;
            border-top-width: 1px;
            height: 50px;
            font-size: 17px;
            color: #000;
        }
    </style>
<!--    --><?//=
//
//    get_option('contest_title')
//
//    ?><!-- -->

    <div class="container">
    <div class="contest result" style="padding: 5px;">
        <a href="{{url('/')}}/website/contest/one" class="btn btn-info ">Contest one result</a>
        <a href="{{url('/')}}/website/contest/two" class="btn btn-info ">Contest two result</a>

    </div>



    <div class="row" style="background-color: green;
padding: 2px;
color: white;
margin-left: 1px;
margin-bottom: 9px;
margin-right: 1px;
text-align: center;
">
        <div class="col-md-6">


            <h4  style="color: white;" >Total Contest Prize Fund  ={{$contest_fund}}
                Taka </h4>

        </div>
        <div class="col-md-6" style="background-color: #13660c;border:1px solid #13660c ">


            <h4 style="color: white;"> Contest ending in   <span class='countdown' value='<?php echo date('Y-m-d',strtotime(get_option('contest_last_date'))) ?>'></span></h4>

        </div>
    </div>

    @include('admin.affilate.affiliate_sponsor')

    <div class="row">
        <div class="col-md-12 ">
            <?php if($contests) {   ?>

            <div class="table-responsive">

                <table  style="width:100%;border: 2px solid #8000ff;"  class="table table-hover  table-bordered" >
                    <thead  style="background-color:#8000ff;color:white" >
                    <tr>
                        <th class="text-center">Position</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Total Affiliate</th>
                        <th class="text-center">Active Affiliate</th>
                        <th class="text-center">Completed Sell</th>
                        <th class="text-center">Point</th>
                        <th class="text-center">Contest Prize Fund</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $counter = 1;
                    $position_amount_1 = 0;
                    $position_amount_2 = 0;
                    $position_amount_3 = 0;
                    $position_amount_4 = 0;
                    $position_amount_5 = 0;
                    $position_amount_6 = 0;
                    $position_amount_7 = 0;
                    $position_amount_8 = 0;
                    $position_amount_9 = 0;
                    $position_amount_10 = 0;
                    $position_amount_11 = 0;
                    $position_amount_12 = 0;
                    $position_amount_13 = 0;
                    $position_amount_14 = 0;
                    $position_amount_15 = 0;
                    $position_amount_16 = 0;
                    $position_amount_17 = 0;
                    $position_amount_18 = 0;
                    $position_amount_19 = 0;
                    $position_amount_20 = 0;

                    @endphp

                    @foreach ($contests as $key=>$user)

                        <?php
                        if ($counter == 1) {
                            $position_amount_1 = ($contest_fund * $position->commistion_lavel_1) / 100;
                        } elseif ($counter == 2) {
                            $position_amount_2 = ($contest_fund * $position->commistion_lavel_2) / 100;

                        } elseif ($counter == 3) {
                            $position_amount_3 = ($contest_fund * $position->commistion_lavel_3) / 100;

                        } elseif ($counter == 4) {
                            $position_amount_4 = ($contest_fund * $position->commistion_lavel_4) / 100;

                        } elseif ($counter == 5) {
                            $position_amount_5 = ($contest_fund * $position->commistion_lavel_5) / 100;

                        } elseif ($counter == 6) {
                            $position_amount_6 = ($contest_fund * $position->commistion_lavel_6) / 100;

                        } elseif ($counter == 7) {
                            $position_amount_7 = ($contest_fund * $position->commistion_lavel_7) / 100;

                        } elseif ($counter == 8) {
                            $position_amount_8 = ($contest_fund * $position->commistion_lavel_8) / 100;

                        } elseif ($counter == 9) {
                            $position_amount_9 = ($contest_fund * $position->commistion_lavel_9) / 100;

                        } elseif ($counter == 10) {
                            $position_amount_10 = ($contest_fund * $position->commistion_lavel_10) / 100;

                        }
                        elseif ($counter == 11) {
                            $position_amount_11 = ($contest_fund * $position->commistion_lavel_11) / 100;

                        }
                        elseif ($counter == 12) {
                            $position_amount_12 = ($contest_fund * $position->commistion_lavel_12) / 100;

                        }
                        elseif ($counter == 13) {
                            $position_amount_13 = ($contest_fund * $position->commistion_lavel_13) / 100;

                        }
                        elseif ($counter == 14) {
                            $position_amount_14 = ($contest_fund * $position->commistion_lavel_14) / 100;

                        }elseif ($counter == 15) {
                            $position_amount_15 = ($contest_fund * $position->commistion_lavel_15) / 100;

                        }elseif ($counter == 16) {
                            $position_amount_16 = ($contest_fund * $position->commistion_lavel_16) / 100;

                        }elseif ($counter == 17) {
                            $position_amount_17 = ($contest_fund * $position->commistion_lavel_17) / 100;

                        }elseif ($counter == 18) {
                            $position_amount_18 = ($contest_fund * $position->commistion_lavel_18) / 100;

                        }elseif ($counter == 19) {
                            $position_amount_19 = ($contest_fund * $position->commistion_lavel_19) / 100;

                        }else {
                            $position_amount_20 = ($contest_fund * $position->commistion_lavel_20) / 100;

                        }


                        ?>


                        <tr>
                            <td class="text-center" >{{++$key}}</td>
                            <td class="text-center">{{$user->affilite_id}}</td>
                            <td class="text-center">{{$user->affilite_name}}</td>
                            <td class="text-center">{{$user->total_affilite}}</td>


                            <td class="text-center">{{ $user->total_active_affilite }}</td>
                            <td class="text-center">{{ $user->total_sell }}</td>
                            <td class="text-center">{{ $user->total_point }}</td>

                            @if($counter==1)
                                <td class="text-center">{{ number_format($position_amount_1,2) }}</td>
                            @elseif($counter==2)
                                <td class="text-center">{{ number_format($position_amount_2,2) }}</td>
                            @elseif($counter==3)
                                <td class="text-center">{{ number_format($position_amount_3,2) }}</td>
                            @elseif($counter==4)
                                <td class="text-center">{{  number_format($position_amount_4,2)}}</td>
                            @elseif($counter==5)
                                <td class="text-center">{{  number_format($position_amount_5,2)}}</td>
                            @elseif($counter==6)
                                <td class="text-center">{{  number_format($position_amount_6,2) }}</td>
                            @elseif($counter==7)
                                <td class="text-center">{{  number_format($position_amount_7,2) }}</td>
                            @elseif($counter==8)
                                <td class="text-center">{{  number_format($position_amount_8,2) }}</td>
                            @elseif($counter==9)
                                <td class="text-center">{{  number_format($position_amount_9,2) }}</td>
                            @elseif($counter==10)
                                <td class="text-center">{{  number_format($position_amount_10,2) }}</td>
                            @elseif($counter==11)
                                <td class="text-center">{{  number_format($position_amount_11,2) }}</td>
                            @elseif($counter==12)
                                <td class="text-center">{{  number_format($position_amount_12,2) }}</td>
                            @elseif($counter==13)
                                <td class="text-center">{{  number_format($position_amount_13,2) }}</td>
                            @elseif($counter==14)
                                <td class="text-center">{{  number_format($position_amount_14,2) }}</td>
                            @elseif($counter==15)
                                <td class="text-center">{{  number_format($position_amount_15,2) }}</td>
                            @elseif($counter==16)
                                <td class="text-center">{{  number_format($position_amount_16,2) }}</td>
                            @elseif($counter==17)
                                <td class="text-center">{{  number_format($position_amount_17,2) }}</td>
                            @elseif($counter==18)
                                <td class="text-center">{{  number_format($position_amount_18,2) }}</td>
                            @elseif($counter==19)
                                <td class="text-center">{{  number_format($position_amount_19,2) }}</td>

                            @else
                                <td class="text-center">{{  number_format($position_amount_20,2) }}</td>
                            @endif

                        </tr>

                        <?php
                        $counter++;
                        ?>

                    @endforeach
                    </tbody>
                </table>
            </div>

            <?php } ?>
        </div>


    </div>


    <div class="row">
        <div class="col-md-12 ">

            <div class="panel panel-success" style="margin-top: 50px">
                <div class="panel-heading" style="font-weight: bold;text-align: center;font-size: 20px;color:black;background-color: #ddd">Contest Details</div>
                <div class="panel-body">

                    <?=get_option('context_rules')?>
                </div>
            </div>
        </div>
    </div>


    </div>

    <script type="text/javascript" src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>

    <script>

        $(function(){

            $('.countdown').each(function(){


                $(this).countdown($(this).attr('value'), function(event) {
                    $(this).text(
                            event.strftime('%D days %H:%M:%S')
                    );
                });
            });
        });

    </script>

    @endsection
