@extends('layouts.master')
@section('pageTitle')
    Withdraw amount
@endsection
@section('mainContent')

        <div class="box-body">
                <div class="row">


                    <div class="col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-heading"> Total LifeTime Balance</div>
                            <div class="panel-body" style="min-height: 110px;">

                                <div>  {{$vandorInfo->life_time_earning}} Taka</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-success">
                            <a href="{{url('vendor/bank-account')}}" class="btn btn-success pull-right"
                               style="margin-top: 3px;">edit</a>
                            <div class="panel-heading">My Mobile Account</div>
                            <div class="panel-body" style="min-height: 110px;">

                                <div>AC Name:<?php if (isset($vandorInfo->m_name)) {
                                        echo $vandorInfo->m_name;
                                    } ?></div>
                                <div>AC Number: <?php if (isset($vandorInfo->m_number)) {
                                        echo $vandorInfo->m_number;
                                    } ?></div>
                                <div>AC Type: <?php if (isset($vandorInfo->m_type)) {
                                        echo $vandorInfo->m_type;
                                    } ?></div>
                                <div>Service Name: <?php if (isset($vandorInfo->m_service)) {
                                        echo $vandorInfo->m_service;
                                    } ?></div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-info">
                            <a href="{{url('vendor/bank-account')}}" class="btn btn-info pull-right" style="margin-top: 3px;">edit</a>
                            <div class="panel-heading">My Bank Account</div>
                            <div class="panel-body" style="min-height: 110px;">

                                <div>AC Name: <?php if (isset($vandorInfo->b_name)) {
                                        echo $vandorInfo->b_name;
                                    } ?></div>
                                <div>AC No: <?php if (isset($vandorInfo->b_number)) {
                                        echo $vandorInfo->b_number;
                                    } ?></div>
                                <div>Branch Name: <?php if (isset($vandorInfo->b_branch)) {
                                        echo $vandorInfo->b_branch;
                                    } ?></div>
                                <div>Bank Name: <?php if (isset($vandorInfo->b_bank)) {
                                        echo $vandorInfo->b_bank;
                                    } ?></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading" style="font-weight: bold;">Withdraw Money</div>
                            <div class="panel-body">
                                <h4 style="text-align: center">Total Balance</h4>
                                <h3 style="text-align: center"><?php if (isset($vandorInfo->amount)) {
                                        echo $vandorInfo->amount;
                                    } ?> Taka</h3>
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

                                <?php if($withdrawDay =='Sundayx') { ?>
                                <div class="form-group text-center">
                                    <form method="POST" action="{{url('vendor/insert-withdrow-amount')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Withdraw Account:</label>
                                            <select class="form-control" data-style="btn-blue" required="" name="accountStatus">
                                                <option value="">Select Your Account</option>
                                                <option value="1">In Mobile Account</option>
                                                <option value="2">In Bank Account</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount:</label>
                                            <input type="number" name="withdrawAmount" required="" value="" class="form-control"
                                                   id="name" placeholder="Amount">
                                        </div>
                                        <div class="form-group text-center">
                                            <input class="btn btn-primary" type="submit" value="Withdraw">
                                        </div>
                                    </form>
                                </div>
                                <?php }?>


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
                                    <th>Sl</th>

                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1;?>
                                    @foreach ($withdrawInfo as $withdraw)
                                        <tr>
                                            <td> <?php echo $count++;?>  </td>

                                            <td>{{date('d-m-Y',strtotime($withdraw->date))}}</td>
                                            <td>{{$withdraw->withdrawAmount}}</td>
                                            <td>
                                                <?php
                                                if ($withdraw->status=='0') {
                                                   echo "Not Paid";
                                                }else{
                                                    echo "Paid";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

@endsection