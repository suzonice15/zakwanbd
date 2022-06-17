
@extends('website.master')
@section('mainContent')

<div class="container">
    <div id="loginbox" style="margin-top:50px;background: white;
padding: 58px 5px;" class="mainbox d-flex justify-content-center col-md-12 col-lg-12 col-xl-12 col-xxl-12  col-sm-12 ">
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

        <div class="form-group mb-3">
            @if(Session::has('error'))
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    {{ Session::get('error') }}
                    @php
                        Session::forget('error');
                    @endphp
                </div>
            @endif
        </div>
        <div class="card panel-info" >

            <div class="card-heading">
                <div class="panel-title" style="text-align: center;padding: 9px;background: #ddd;color: black;" >Vendor Login</div>
{{--                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>--}}
            </div>

            <div style="padding-top:30px" class="card-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form  action="{{url('/')}}/vendor/login" method="post"  >

                    <h5 id="fadeout" style="color:red;text-aling:center"><?php


                    if(isset($error)) { echo  $error;} ?></h5>

                    {{ csrf_field() }}
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="vendor_email" value="" placeholder="Email">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="vendor_password" placeholder="password">
                    </div>

                    <div style="margin-top:10px" class="form-group">


                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn  btn-success" value="Login">

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style=" padding-top:15px; font-size:95%" >
                                 <a href="{{url('/')}}/vendor/forgot-password" class="btn btn-danger text-white">
                                    Forget Password
                                </a>
                                <a href="{{url('/')}}/vendor/form" class="btn btn-info text-white" >
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
   </div>

@endsection

