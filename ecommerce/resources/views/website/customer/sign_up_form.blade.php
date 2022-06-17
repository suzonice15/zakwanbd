
@extends('website.master')
@section('mainContent')

    <div class="container d-flex justify-content-center" style="background: white;padding: 50px 50px">
        @if (count($errors) > 0)
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    @foreach ($errors->all() as $error)

                        <li style="list-style: none">{{ $error }}</li>

                    @endforeach

                </ul>
            </div>
        @endif
            <form class="well form-horizontal" action="{{url('/')}}/customer/form" method="post"  id="contact_form">
        @csrf
            <div style="border: 1px solid #ddd;">

                <!-- Form Name -->
                 <h2 style="font-size: 22px;background: #ddd;text-align: center;padding: 5px 11px;" >Customer Registration Form</h2>

                <!-- Text input-->


<div style="padding: 10px;" >

    <div class="form-group">
        <div class="col-12 ">
            @if(Session::has('success'))

                <div class="alert alert-success">

                    {{ Session::get('success') }}

                    @php

                    Session::forget('success');

                    @endphp

                </div>

            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-12 ">
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    @php
                    Session::forget('error');
                    @endphp
                </div>
            @endif
        </div>
    </div>

    <div class="before">
    <div class="form-group">
        <label class="col-12 control-label">Full Name</label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input style="width:320px" name="name" id="name" placeholder="Enter Name" class="form-control"  type="text">
            </div>

        </div>
        <p style="color:red" id="name_error"></p>


    </div>

    <div class="form-group">
        <label class="col-12 control-label">Contact No.</label>
        <div class="col-12 ">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                <input name="phone" id="phone"  placeholder="01738000000" class="form-control" type="number">
            </div>
        </div>
        <p style="color:red" id="phone_error"></p>

    </div>


        <div class="form-group">
            <div class="row">
                <label class="col-3 control-label">Gender</label>
                <div class="col-3">
                    <div class="input-group">
                        <select class="form-control" id="gender" name="gender">

                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="male">Other</option>

                        </select>
                    </div>
                </div>


            </div>

        </div>

        <div class="form-group" style="margin-top:5px">
            <div class="row">
            <label class="col-3 control-label">Birthday</label>
            <div class="col-3 ">
                <div class="input-group">
                    <select class="form-control" id="month" name="month">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
            <div class="col-3 ">
                <div class="input-group">
                    <select class="form-control" id="day" name="day">
                       @for($day=1;$day<=31;$day++)
                        <option value="{{$day}}">{{$day}}</option>
                           @endfor
                    </select>
                </div>
            </div>
                <div class="col-3 ">
                    <div class="input-group">
                        <select class="form-control" id="year" name="year">
                            @for($year=date("Y")-12;$year >=1950;$year--)
                                <option value="{{$year}}">{{$year}}</option>
                            @endfor

                        </select>
                    </div>
                </div>



                </div>

        </div>






        <div class="form-group">
            <label class="col-12 control-label"></label>
            <div class="col-12"><br>
                <button type="button"  id="requestForOtp" class="btn btn-info form-control" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNext<span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                <a href="{{url('/customer/login')}}" class="btn btn-success mt-3 form-control">Already member? Login here.</a>
            </div>
        </div>

        </div>


     {{--after given otp --}}

    <div class="after">

        <div class="form-group">
            <label class="col-12 control-label" >Otp</label>
            <div class="col-12 ">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input style="width:320px" required name="otp" id="otp" placeholder="Enter Your Otp" class="form-control"  type="text">
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

        <div class="form-group">
            <label class="col-12 control-label" >Referrer  Id</label>
            <div class="col-12 ">
                <div class="input-group">

                    <input value="{{$affiliate_id}}" name="affiliate_id" id="affiliate_id" placeholder="referrer id" class="form-control"  type="text">
                </div>
            </div>

            <p id="cpassword_error" style="color:red"></p>

        </div>





        <div class="form-group">
            <label class="col-12 control-label"></label>
            <div class="col-12"><br>
                <button type="button" id="formSubmit" class="btn btn-info" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Confirm <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>

            </div>
        </div>


        </div>






</div>


            </div>



        </form>
    </div>
    </div><!-- /.container -->


    <script>
      //  loan_amt.value.replace(/[^0-9]/g, '')

        $(document).ready(function () {
            $(".after").hide();






            $("#requestForOtp").click(function () {
               let name= $("#name").val();
               let phone= $("#phone").val();
                if(name==''){
                    $("#name_error").html("Enter Your Name")

                } else {
                    $("#name_error").html("")
                }



                if (!/^01\d{9}$/.test(phone)) {
                    $('#phone_error').text('Invalid phone number');
                } else {

                    $(this).prop("disabled",true);

                    $('#phone_error').text('');

                    $.ajax({
                        url:"{{url('/')}}/otp/request/"+phone,
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





        });
    </script>


@endsection

