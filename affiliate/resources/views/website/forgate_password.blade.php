@extends('website.master')
@section('mainContent')

<style>
    .input-container {
      display: -ms-flexbox; /* IE10 */
      display: flex;
      width: 100%;
      margin-bottom: 15px;
    }

    .icon {
        padding: 15px;
        background: dodgerblue;
        color: white;
        min-width: 40px;
        text-align: center;
        height: 50px;
}
    }

    .input-field {
      width: 100%;
      padding: 10px;
      outline: none;
    }

    .input-field:focus {
      border: 2px solid dodgerblue;
    }
    .panel{
        background-color: #c2ceff00;
    }
    .panel-success .panel-heading {
        color: #3c763d00;
        background-color: #dff0d800;
        border-color: #d6e9c600;
    }
    .panel-success {
        border-color: #d6e9c600;
    }

    form {border: 3px solid #f1f1f1;
        width: 468px;
        margin-left: 16%;
        border-radius: 18px;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .button_class {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

     

    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container_login {
        padding: 16px;
        background-color: #ffffff80
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 600px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
        form {
            border: 3px solid #f1f1f1;
            width: 100%;
            margin-left: 0px !important;
        }
    }
</style>
<section style="min-height: 600px;background-repeat: no-repeat;background-attachment: fixed; background-size: cover; background-image: url('images/loginCover.jpg">
    
    <div class="container">
        
        <div class="row" style="margin-top: 100px">
            
            <div class="col-md-2"></div>
                        <div class="col-md-8">
                            
                              <div class="panel panel-success">
        <div class="panel-heading">
            <h2 style="text-align: center; color: #000;">Password Assistance</h2>
            <strong style="color: #000;text-align:center">Enter the email address associated   with your  Jacwan Affiliates account</strong>
        </div>
  <div class="panel-body">

<form action="{{url('/')}}/forgotPassword" method="post" >
@csrf
    <div class="container_login">
        <h3 style="color:green">{{Session::get('success')}}</h3>
        <h3 style="color:red">{{Session::get('error')}}</h3>
        <label style="float: left; color: #000;" for="uname"><b>User Email</b></label>
        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input style="width: 100%" class="input-field" type="email" placeholder="User Email" name="email" required>
        </div>
        <button class="button_class" type="submit" style="font-weight: 600; border-radius: 5px;width: 30%;">Continue</button>
    </div>

    <div class="container_login">

        
    </div>
</form>
</div>

</br>
</div>
                        </div>

            
                        <div class="col-md-2"></div>

        </div>
    </div>
    




 </section>

@endsection
