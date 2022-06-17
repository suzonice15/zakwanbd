@extends('layouts.master')
@section('pageTitle')
    Affiliate Statistics
@endsection
@section('mainContent')

    <div class="box-body">
        <div class="table-responsive" >

            <table class="table  table-bordered table-striped" style="text-align: center;">
                <thead>
                <th style="text-align: center;">Referral Level</th>
                <th style="text-align: center;">My Commission (%)</th>
                <th style="text-align: center;">Total Referrals</th>
                <th style="text-align: center;">Total Earnings</th>
                </thead>
                <tbody>
                <tr>
                    <td>Level 1</td>
                    <td>35 %</td>
                    <td><?= $level_1 ?></td>
                    <td><?= $level_11 ?></td>
                </tr>
                <tr>
                    <td>Level 2</td>
                    <td>8 %</td>
                    <td><?= $level_2 ?></td>
                    <td><?= $level_21 ?></td>
                </tr>
                <tr>
                    <td>Level 3</td>
                    <td>4 %</td>
                    <td><?= $level_3 ?></td>
                    <td><?= $level_31 ?></td>
                </tr>
                <tr>
                    <td>Level 4</td>
                    <td>2 %</td>
                    <td><?= $level_4 ?></td>
                    <td><?= $level_41 ?></td>
                </tr>
                <tr>
                    <td>Level 5</td>
                    <td>1 %</td>
                    <td><?= $level_5 ?></td>
                    <td><?= $level_51 ?></td>
                </tr>
                <tr>
                    <td colspan="2"><b></b></td>
                    <td ><b>Total:</b></td>
                    <td><b><?=$total_income?></b></td>

                </tr>
                </tbody>
            </table>

        </div>



    </div>


@endsection
