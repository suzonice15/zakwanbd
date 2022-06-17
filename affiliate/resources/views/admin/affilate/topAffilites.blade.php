@extends('layouts.master')
@section('pageTitle')
    Top Affiliates

@endsection
@section('mainContent')
    <style type="text/css">
        tr {
            border: 1px solid #1D96B2;
        }

        th {
            border: 1px solid #1D96B2;
            border: 1px solid #fff;
        }

        td {
            border: 1px solid #1D96B2;
            height: 50px;
            font-size: 17px;
            color: #000
        }

        thead {
            background-color: #1d96b2;
            color: #fff
        }
    </style>
         <div class="row" style="background-color: green;
padding: 2px;
color: white;
margin-left: 1px;
margin-bottom: 9px;
margin-right: 1px;
text-align: center;
">



        <div class="col-md-6">


            <h4  >Royalty Fund Balance ={{$fund->amount}}
                Taka </h4>

        </div>
        <div class="col-md-6" style="background-color: #13660c;border:1px solid #13660c ">


            <h4 style=""> Distributing in  <span class='countdown' value='<?= get_option('ending_date_of_royalty_fund') ?>'></span></h4>

        </div>
    </div>
     <div class="row">


        <div class="col-md-12">


                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="text-center" scope="col">Position</th>
                            <th class="text-center" scope="col">Name</th>
                            <th class="text-center" scope="col">Total Order</th>
                            <th class="text-center" scope="col">Total Sell Amount</th>
                            <th class="text-center" scope="col">Royalty Commission (Eid Bonus) </th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
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


                        ?>
                        @foreach ($users as $user)

                            <?php
                            if ($counter == 1) {
                                $position_amount_1 = ($fund->amount * $position->commistion_lavel_1) / 100;
                            } elseif ($counter == 2) {
                                $position_amount_2 = ($fund->amount * $position->commistion_lavel_2) / 100;

                            } elseif ($counter == 3) {
                                $position_amount_3 = ($fund->amount * $position->commistion_lavel_3) / 100;

                            } elseif ($counter == 4) {
                                $position_amount_4 = ($fund->amount * $position->commistion_lavel_4) / 100;

                            } elseif ($counter == 5) {
                                $position_amount_5 = ($fund->amount * $position->commistion_lavel_5) / 100;

                            } elseif ($counter == 6) {
                                $position_amount_6 = ($fund->amount * $position->commistion_lavel_6) / 100;

                            } elseif ($counter == 7) {
                                $position_amount_7 = ($fund->amount * $position->commistion_lavel_7) / 100;

                            } elseif ($counter == 8) {
                                $position_amount_8 = ($fund->amount * $position->commistion_lavel_8) / 100;

                            } elseif ($counter == 9) {
                                $position_amount_9 = ($fund->amount * $position->commistion_lavel_9) / 100;

                            } elseif ($counter == 10) {
                                $position_amount_10 = ($fund->amount * $position->commistion_lavel_10) / 100;

                            }
                            elseif ($counter == 11) {
                                $position_amount_11 = ($fund->amount * $position->commistion_lavel_11) / 100;

                            }
                            elseif ($counter == 12) {
                                $position_amount_12 = ($fund->amount * $position->commistion_lavel_12) / 100;

                            }
                            elseif ($counter == 13) {
                                $position_amount_13 = ($fund->amount * $position->commistion_lavel_13) / 100;

                            }
                            elseif ($counter == 14) {
                                $position_amount_14 = ($fund->amount * $position->commistion_lavel_14) / 100;

                            }elseif ($counter == 15) {
                                $position_amount_15 = ($fund->amount * $position->commistion_lavel_15) / 100;

                            }elseif ($counter == 16) {
                                $position_amount_16 = ($fund->amount * $position->commistion_lavel_16) / 100;

                            }elseif ($counter == 17) {
                                $position_amount_17 = ($fund->amount * $position->commistion_lavel_17) / 100;

                            }elseif ($counter == 18) {
                                $position_amount_18 = ($fund->amount * $position->commistion_lavel_18) / 100;

                            }elseif ($counter == 19) {
                                $position_amount_19 = ($fund->amount * $position->commistion_lavel_19) / 100;

                            }else {
                                $position_amount_20 = ($fund->amount * $position->commistion_lavel_20) / 100;

                            }



                            $name = '';
                            $total_order_sell = DB::table('order_data')
                                    ->where('user_id', '=', $user->user_id)
                                    ->where('order_status', '=', 'completed')
                                    ->sum('order_data.order_total');
                            ?>
                            <tr>
                                <td class="text-center">{{$counter}}</td>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->total}}</td>
                                <td class="text-center">{{ round($total_order_sell) }}</td>

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

