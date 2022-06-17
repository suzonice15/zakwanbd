@extends('layouts.master')
@section('pageTitle')
    Withdraw
@endsection
@section('mainContent')
<style type="text/css">
    option{
        color: #000;
    }
</style>
    <div class="box-body">
        <div class="row">


            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading"> Earnings Balance</div>
                    <div class="panel-body" style="min-height: 110px;">

                        <div>  {{$user->earning_balance}} Taka</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <a href="{{url('/')}}/editmobile" class="btn btn-success pull-right"
                       style="margin-top: 3px;">edit</a>
                    <div class="panel-heading">My Mobile Account</div>
                    <div class="panel-body" style="min-height: 110px;">

                        <div>AC Name:<?php if (isset($mobile_row->ac_name)) {
                                echo $mobile_row->ac_name;
                            } ?></div>
                        <div>AC Number: <?php if (isset($mobile_row->ac_number)) {
                                echo $mobile_row->ac_number;
                            } ?></div>

                        <div>Service Name: <?php if (isset($mobile_row->service_name)) {
                                echo $mobile_row->service_name;
                            } ?></div>


                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <a href="{{url('/')}}/editmobile" class="btn btn-info pull-right" style="margin-top: 3px;">edit</a>
                    <div class="panel-heading">My Bank Account</div>
                    <div class="panel-body" style="min-height: 110px;">

                        <div>AC Name: <?php if (isset($bank->ac_name)) {
                                echo $bank->ac_name;
                            } ?></div>
                        <div>AC No: <?php if (isset($bank->ac_number)) {
                                echo $bank->ac_number;
                            } ?></div>
                        <div>Branch Name: <?php if (isset($bank->ac_branch)) {
                                echo $bank->ac_branch;
                            } ?></div>
                        <div>Bank Name: <?php if (isset($bank->bank_name)) {
                                echo $bank->bank_name;
                            } ?></div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading" style="font-weight: bold;">Withdraw Money</div>
                    <div class="panel-body">
                        <h4 style="text-align: center">Earnings Balance</h4>
                        <h3 style="text-align: center">{{$user->earning_balance}} Taka</h3>
                        @if(Session::has('w_error'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('w_error')}}
                            </div>
                        @endif

                        @if(Session::has('w_success'))

                            <div class="alert alert-success" role="alert">
                                {{Session::get('w_success')}}
                            </div>

                        @endif
                        <hr>
                        <div class="form-group text-center">
                            <form method="POST" action="{{url('/money_transfer')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Withdraw Account:</label>
                                    <select class="form-control" data-style="btn-blue" required="" name="payment_to">
                                        <option value="">Select Your Account</option>
                                        <option value="1">To Mobile Account</option>
                                        <option value="2">To Bank Account</option>
                                        <option value="3">To Wallet</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="number" name="amount" required="" value="" class="form-control"
                                           id="name" placeholder="Amount">
                                </div>
                                <div class="form-group text-center">
                                    <input class="btn btn-primary" type="submit" value="Withdraw">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="orderhistory">
                <h3>Transaction History</h3>
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Trx ID.</th>
                            <th>Order Id</th>
                            <th>Date</th>

                            <th>Transfer To</th>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Amount</th>

                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('admin.affilate.withdraw_pagination')

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
<script type="text/javascript">
    
</script>

@endsection

