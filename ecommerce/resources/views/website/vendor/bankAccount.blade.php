

@extends('layouts.master')
@section('pageTitle')
    Add Bank Account
@endsection
@section('mainContent')
    <div class="box-body">


        <div class="row">

            <div class="col-md-6">
                <div class="well well-sm">
                    <div class="panel panel-success">

                        <div class="panel-heading" style="font-weight: bold;">Mobile Account Details </div>

                        <div class="panel-body">
                            <form method="POST" action="{{URL::to('/vendor/mobile_update')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="ac_name">Ac Name:</label>
                                    <input type="text" name="m_name" value="<?php if(isset($bankInfo->m_name)){ echo $bankInfo->m_name;} ?>" class="form-control" placeholder="Account Name">
                                </div>
                                <div class="form-group">
                                    <label for="ac_number">Ac Number:</label>
                                    <input type="text" name="m_number" value="<?php if(isset($bankInfo->m_number)){ echo $bankInfo->m_number;} ?>" class="form-control" placeholder="Bkash/Rocket/Nagad Number">
                                </div>
                                <div class="form-group">
                                    <label for="ac_type">Ac Type:</label>
                                    <input type="text" name="m_type" class="form-control" value="<?php if(isset($bankInfo->m_type)){ echo $bankInfo->m_type;} ?>" placeholder="eg. personal / agent">


                                </div>
                                <div class="form-group">
                                    <label for="service_name">Service Name:</label>
                                    <input type="text" name="m_service" value="<?php if(isset($bankInfo->m_service)){ echo $bankInfo->m_service;} ?>" class="form-control" id="address" placeholder="Bkash/Rocket/Nagad etc.">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="well well-sm">
                    <div class="panel panel-success">

                        <div class="panel-heading" style="font-weight: bold;">Bank Account Details </div>

                        <div class="panel-body">
                            <div class="panel-body">

                                <form method="POST" action="{{URL::to('/vendor/bank_update')}}">
                                    @csrf


                                    <div class="form-group">
                                        <label for="ac_name">Ac Name:</label>
                                        <input type="text" name="b_name" required="" value="<?php if(isset($bankInfo->b_name)){ echo $bankInfo->b_name;} ?>" class="form-control" id="name" placeholder="Your Account Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="ac_number">Ac Number:</label>
                                        <input type="text" name="b_number" required="" value="<?php if(isset($bankInfo->b_number)){ echo $bankInfo->b_number;} ?>" class="form-control" id="email" placeholder="Your Account Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="ac_branch">Branch Name:</label>
                                        <input type="text" name="b_branch" required="" value="<?php if(isset($bankInfo->b_branch)){ echo $bankInfo->b_branch;} ?>" class="form-control"   placeholder="Bank Branch Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank_name">Bank Name:</label>
                                        <input type="text" name="b_bank" required="" value="<?php if(isset($bankInfo->b_bank)){ echo $bankInfo->b_bank;} ?>" class="form-control" id="address" placeholder="Bank Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="save" class="btn btn-primary pull-right" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>


@endsection






