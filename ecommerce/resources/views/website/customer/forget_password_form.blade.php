@extends('website.master')
@section('mainContent')

<div class="container mt-5">
    <div id="loginbox" style="margin-top:50px;" class="mainbox d-flex justify-content-center col-12 mt-5">

        <div class="card panel-info mt-5" style="margin:100px 0px" >

            <div class="panel-heading">
                <div class="card-title" style="background: #ddd;text-align: center;padding: 7px;">Forgot Password</div>
            </div>

            <div style="padding-top:30px" class="card-body" >

                <div class="form-group mb-3">
                    @if(Session::has('success'))
                        <div class="alert alert-success">

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

                            {{ Session::get('error') }}
                            @php
                            Session::forget('error');
                            @endphp
                        </div>
                    @endif
                </div>

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form  action="{{url('/')}}/customer/forgotPasswordUpdateByPhone" method="post"  id="contact_form" >

                    <h5 id="fadeout" style="color:red;text-aling:center">{{
                    Session::get('error')}}</h5>

                    @csrf
                    <div class="before">

                    <div style="margin-bottom: 25px;width: 100%" class="input-group">
                        <input style="width:360px" id="phone" type="number" class="form-control" name="phone" value="" placeholder="Enter Your Phone Number">
                    </div>

                  <p id="phone_error" style="color:red"></p>


                        <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="button" id="requestForOtp" class="btn  btn-success form-control"   value="Submit">

                        </div>
                    </div>

                    </div>

                    <div class="after">

                        <div class="form-group">
                            <label class="col-12 control-label" >Otp</label>
                            <div class="col-12 ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input style="width:360px" required name="otp" id="otp" placeholder="Enter Your Otp" class="form-control"  type="text">
                                </div>
                            </div>

                            <p id="otp_error" style="color:red"></p>


                        </div>


                        <div class="form-group">
                            <label class="col-12 control-label" >Password</label>
                            <div class="col-12 ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input required name="password" id="password"  placeholder="Password" class="form-control"  type="password">

                                </div>
                            </div>

                            <p id="password_error" style="color:red"></p>

                            <input type="hidden" id="server_otp" value="">


                        </div>


                        <div class="form-group">
                            <label class="col-12 control-label" >Confirm Password</label>
                            <div class="col-12 ">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input required name="cpassword" id="cpassword" placeholder="Confirm Password" class="form-control"  type="password">
                                </div>
                            </div>

                            <p id="cpassword_error" style="color:red"></p>

                        </div>







                        <div style="margin-top:20px" class="form-group">
                            <div class="col-sm-12 controls">
                                <input type="button"  id="formSubmit" class="btn  btn-success form-control"   value="Confirm">

                            </div>
                        </div>

                    </div>




                </form>
            </div>
        </div>
    </div>
   </div>

    <script>
        $(".after").hide();

        $("#requestForOtp").click(function () {

            let phone= $("#phone").val();
            if (!/^01\d{9}$/.test(phone)) {
                $('#phone_error').text('Invalid phone number');

            } else {


                $(this).prop("disabled",true);
                $('#phone_error').text('');


                $.ajax({
                    url:"{{url('/')}}/otp/passwordResetRequest/"+phone,
                    success:function (data) {

                        if(data.success){

                            $(".after").show();
                            $(".before").hide();
                            $("#server_otp").val(data.otp)
                        } else {
                            $("#requestForOtp").prop("disabled",false);
                            $('#phone_error').text(data.message);
                        }

                        console.log(data)


                    }
                })

            }

        })


        $("#formSubmit").click(function () {
            var submit="ok"
            let cpassword= $("#cpassword").val();
            let password= $("#password").val();
            let otp= $("#otp").val();
            let server_otp= $("#server_otp").val();
            if(server_otp != otp){
                $("#otp_error").html("<strong>Your Otp does not matched</strong>")
                submit="no"

            } else {
                $("#otp_error").html("")
                submit="ok"



            }



            if(password==''){
                $("#password_error").html("<strong>Enter Your Password</strong>")
                submit="no"
            } else {
                $("#password_error").html("")

                if(password !=cpassword){
                    $("#cpassword_error").html("<strong>Password and Confirm Password does not matched</strong>")

                    submit="no"
                } else {
                    $("#cpassword_error").html("")
                    submit="ok"
                }
            }



            if(submit=="ok"){
                $("#contact_form").submit()
            }
        })



        //        $(".before").hide();


    </script>

@endsection

