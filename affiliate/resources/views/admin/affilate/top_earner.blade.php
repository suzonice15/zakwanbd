@extends('layouts.master')
@section('pageTitle')
    Top Earner  List
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

       .table tbody td {
            border: 1px solid #1D96B2 !important;
            height: 50px;
            font-size: 17px;
            color: #000
        }

        thead {
            background-color: #1d96b2;
            color: #fff
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <div class="table-responsive">
        <table  class="table table-striped table-bordered" style="width:100%;margin-top:0%;">
            <thead>
            <tr>
                <th style="text-align: center">Sl</th>

                <th>Name</th>

                <th style="text-align: center">Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $counter=1;
            ?>
            @foreach ($users as $user)

<?php

        if($user->id==1 || $user->id==2 || $user->id==3){
            continue;
        }

$widtrow=DB::table('withdraw_history')
        ->where('from_user_id',$user->id)
        ->sum('withdraw_history.amount')
?>

                <tr>
                    <td style="text-align: center">{{$counter}}</td>

                  <?php

                        $counter++;
                      ?>



                    <td>{{ $user->name }}</td>

                    <td style="text-align: center">{{ number_format(round($user->life_time_earning,2))}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );

    </script>
@endsection

