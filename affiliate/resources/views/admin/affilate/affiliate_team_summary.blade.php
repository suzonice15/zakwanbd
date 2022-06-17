@extends('layouts.master')
@section('pageTitle')
    Team Summary

@endsection
@section('mainContent')
    <div class="box-body">

        <div class="table-responsive">
            <table class="table table-bordered table-striped  table-hover " style="border: 2px solid #8000ff;">
                <thead  style="background-color:#8000ff;color:white" >
                <tr  >
                    <th  style="text-align: center">Level</th>
                    <th  style="text-align: center">Total</th>
                    <th  style="text-align: center">Active</th>
                    <th  style="text-align: center">Sells</th>
                    <th  style="text-align: center">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr  style="text-align: center">
                    <td>Level 1 Customers</td>
                    <td>{{$total_customers}}</td>
                    <td>{{$total_active_customers_order}}</td>
                    <td>{{$customer_total_sells}}</td>
                    <td>{{$user->income_of_lebel_1}}</td>
                </tr>
                <tr  style="text-align: center">
                    <td>Level 2 Affiliates</td>
                    <td>{{$total_first_level_affiliate}}</td>
                    <td>{{$total_first_level_affiliate_active}}</td>
                    <td>{{$total_first_level_affiliate_sells}}</td>
                    <td>{{$user->income_of_lebel_2}}</td>
                </tr>
                <tr  style="text-align: center">
                    <td>Level 3 Affiliates</td>
                    <td>{{$total_second_level_affiliate}}</td>
                    <td>{{$total_second_level_affiliate_active}}</td>
                    <td>{{$total_second_level_affiliate_sells}}</td>
                    <td>{{$user->income_of_lebel_3}}</td>
                </tr>

                <tr  style="text-align: center">
                    <td>Level 4 Affiliates</td>
                    <td>{{$total_third_level_affiliate}}</td>
                    <td>{{$total_third_level_affiliate_active}}</td>
                    <td>{{$total_third_level_affiliate_sells}}</td>
                    <td>{{$user->income_of_lebel_4}}</td>
                </tr>

                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>

    </div>



@endsection

