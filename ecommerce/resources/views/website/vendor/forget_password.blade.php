@extends('website.master')
@section('mainContent')

<div class="container">
    <div id="loginbox"  style="margin-top:80px;background: white;
padding: 58px 5px;" class="mainbox col-12 d-flex justify-content-center ">
         <div class="form-group mb-3">
            @if(Session::has('success'))
                <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
        </div>


        <div class="card card-info" >

            <div class="card-heading">
                <div class="card-title" style="text-align: center;padding: 9px;background: #ddd;color: black;">Forgot Password</div>
            </div>

            <div style="padding-top:30px" class="card-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                @if(Session::has('error'))
                    <div class="alert alert-danger">

                        {{ Session::get('error') }}
                        @php
                        Session::forget('error');
                        @endphp
                    </div>
                @endif
                <form  action="{{url('/')}}/vendor/forgot-password" method="post"  >

                    <h5 id="fadeout" style="color:red;text-aling:center"><?php


                    if(isset($error)) { echo  $error;} ?></h5>

                    @csrf
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="vendor_email" value="" placeholder="Enter Your Email">
                    </div>

                    <div style="margin-top:10px" class="form-group">


                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn  btn-success" value="Submit">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>

@endsection

