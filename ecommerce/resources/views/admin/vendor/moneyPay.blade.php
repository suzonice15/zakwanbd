@extends('layouts.master')
@section('pageTitle')
    Add New Product
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">





            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="box box-primary" style="border: 2px solid #ddd;">
                            <div class="box-header" style="background-color: #bdbdbf;">
                                <h3 class="box-title">Vendor Basic   Information</h3>
                            </div>

                            <div class="box-body" style="padding: 22px;">
                                <div class="form-group">
                                    <h4>Name:    {{$vendor->vendor_f_name.' '.$vendor->vendor_l_name}}</h4>
                                    <h4>Email:    {{$vendor->vendor_email}}</h4>
                                    <h4>Phone:    {{$vendor->vendor_phone}}</h4>
                                     <h4>Shop:    {{$vendor->request_shop_name}}</h4>
                                    <h4>Address:    {{$vendor->vendor_address}}</h4>
                                    <h4>LifeTime Money:    {{$vendor->life_time_earning}}</h4>
                                    <h4>Current Blance:    {{$vendor->amount}}</h4>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="box box-primary" style="border: 2px solid #ddd;">
                            <div class="box-header" style="background-color: #bdbdbf;">
                                <h3 class="box-title">Vendor  Widthrow Information</h3>
                            </div>

                            <div class="box-body" style="padding: 22px;">

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <h4>Acount  Name:{{$vendor->m_name}}</h4>
                                        <h4>Mobile:{{$vendor->m_service}}</h4>
                                        <h4>Acount Number:{{$vendor->m_number}}</h4>
                                        <h4>Acount Type:{{$vendor->m_type}}</h4>
                                     </div>
                                    <hr style="border:1px solid #ddd;width: 100%">

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <h4>Acount Name:{{$vendor->b_name}}</h4>
                                        <h4>Branch Number:{{$vendor->b_branch}}</h4>
                                        <h4>Acount Number:{{$vendor->b_number}}</h4>
                                        <h4>Bank  Type:{{$vendor->b_bank}}</h4>
                                    </div>
                                    <hr style="border:1px solid #ddd;width: 100%">
                                </div>

                                <form method="POST" action="{{url('admin/vendor/insert/withdrow/amount')}}/{{$vendor->vendor_id}}">
                                    @csrf
                                <div class="col-md-6" >
                                    <div class="form-group" style="padding-right: 15px;" >
                                        <label for="name">Withdraw Account:</label>
                                        <select class="form-control"   required  name="accountStatus">
                                            <option value="">Select Your Account</option>
                                            <option value="1">In Mobile Account</option>
                                            <option value="2">In Bank Account</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="amount">Amount:</label>
                                        <input type="number" name="withdrawAmount" required value="" class="form-control"
                                               placeholder="Amount">
                                    </div>
                                 </div>
                                    <div class="form-group text-center">
                                            <input class="btn btn-primary" type="submit" value="Withdraw">
                                        </div>

                                        @if(Session::has('successs'))
                                            <div class="callout callout-success">


                                                <h4>
                                                    {{ Session::get('successs')}}

                                                </h4>
                                            </div>
                                        @elseif(Session::has('errorr'))
                                            <div class="callout callout-danger">


                                                <h4>
                                                    {{ Session::get('errorr')}}

                                                </h4>
                                            </div>
                                        @else

                                            @endif



                                    </form>

                            </div>


                        </div>
                    </div>



                </div>





    </div>





@endsection


