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
      background: #9f29ff;
      color: white;
      min-width: 40px;
      text-align: center;
      height: 47px;
      margin-top: 9px;
}
    }

    .input-field {
      width: 100%;
      padding: 10px;
      outline: none;
    }

    .input-field:focus {
      border: 2px solid #9f29ff;
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
        background-color:#9f29ff;
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

        form {
            border: 3px solid #f1f1f1;
            width: 100%;
            margin-left: 0px !important;
        }
        .login-title{
            text-align: center;
  color: white;
  position: relative;
  margin-right: -72px;
        }
    }
    .login-title{
        text-align: right;color: white;position: relative;margin-right: 50px;
    }
    .icon-hide{
        position: relative;float: right;top: -51px;margin-right: 8px;color: #a29b9b;font-weight: bold;
        cursor: pointer;
    }
</style>
<section style="min-height: 950px;
background-position: center;
overflow:hidden;
background-repeat: no-repeat;
background-attachment: fixed;
background-size: cover;
background-image: url('images/loginCover.jpg')
" >

    <div class="container-fluid">
        <div class="row" style="margin-top: 100px">
            <marquee scrollamount="6" style="color: white;font-weight: bold;font-size: 20px"><?=get_option('notice')?></marquee>

            <div style="display: flex;justify-content: end;" class="col-md-11">


            <div class="panel panel-success">
        <div class="panel-heading"><h2 class="login-title" >Login/ <a href="{{url('/')}}/registration" style="color:white"  >Sign up</a></h2>
</div>
  <div class="panel-body">
<form onsubmit="return validateForm()" action="{{url('/')}}/affilite_login_check" method="post" >
@csrf
@if(count($errors) > 0)
    <div>
        <ul>
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
    <div class="container_login">
        <h3 style="color:green">{{Session::get('success')}}</h3>
        <h3 style="color:red">{{Session::get('error')}}</h3>
        <label for="uname"><b>User Email</b></label>
        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input style="width: 100%; margin-top: 8px" class="input-field" type="text" placeholder="Email or  phone number" name="email" >
        </div>
        <label for="psw"><b>Password</b></label>
        <div class="input-container">
            <i class="fa fa-key icon"></i>
            <input type="password" placeholder="Enter Password" id="password" name="password" required class="input-field" required>

        </div>
        <i class="fa fa-eye icon-hide"></i>
        <button class="button_class" type="submit" style="font-weight: 600; float:right;border-radius: 5px;width: 30%;bottom: 21px;position: relative;" >Login</button>
        <div style="margin-top: 5px; font-size: 15px; font-weight: 600; display: inline-flex;;">

            <span><a style="color: black" href="{{URL::to('/forgot-password')}}">Forgot Your Password?</a></span>
        </div>

    </div>


</form>
</div>

</br>
</div>
</div>
        </div>
    </div>





 </section>
 <script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["email"].value;
    var b = document.forms["Form"]["password"].value;
    if (a == null || a == "", b == null || b == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
     $(".icon-hide").click(function(){
         if($('#password').attr('type')=='text'){
             $('#password').get(0).type = 'password';
         }else{
             $('#password').get(0).type = 'text';
         }
     })
</script>
@endsection
