<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Zakwan Affiliate</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #0f172a;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
    }

    .login-container {
      background-color: #1f2937; /* Dark background for the form */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      text-align: center;
    }

    .login-title {
      font-size: 1.5rem;
      font-weight: bold;
      color: white;
      margin-bottom: 15px;
    }

    .login-title a {
      color: #4CAF50; /* Green for Sign-up link */
      text-decoration: none;
    }

    .input-container {
      position: relative;
      margin: 4px 0;
    }

    .input-field {
    margin-top: 4px;
    width: 100%;
    padding: 8px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #2d3748;
    color: white;
    outline: none;
    }

    .input-field:focus {
      border-color: #4CAF50; /* Green focus border */
    }

    .icon {
      position: absolute;
      top: 10px;
      left: 10px;
      color: #ccc;
    }

    .icon-hide {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      color: #ccc;
      cursor: pointer;
    }

    .button_class {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 1rem;
      border-radius: 5px;
      width: 100%;
      cursor: pointer;
      margin-top: 10px;
    } 

    .forgot-password {
      font-size: 0.9rem;
      color: white;
      margin-top: 10px;
      display: inline-block;
    }

    .forgot-password a {
      color: white;
      text-decoration: none;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    /* Success and error messages */
    .success-msg, .error-msg {
      font-size: 1rem;
      margin-bottom: 10px;
    }

    .success-msg {
      color: green;
    }

    .error-msg {
      color: red;
    }

    @media (max-width: 600px) {
      .login-container {
        width: 90%;
        padding: 20px;
      }

      .login-title {
        font-size: 1.5rem;
      }

      .input-field {
        font-size: 0.9rem;
      }

      .button_class {
        font-size: 0.9rem;
      }
    }
    label{float:left}
    a:hover{
        text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-title">Registration Form
    </div>
    <form action="{{url('/')}}/affilite_login_check" method="post" onsubmit="return validateForm()">
      @csrf

      @if(count($errors) > 0)
        <div class="error-msg">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="success-msg" style="color:green">{{Session::get('success')}}</div>
      <div class="error-msg" style="color:red">{{Session::get('error')}}</div>

      <div class="input-container">
        <label for="parent_id"><b>Referral ID</b></label>
        <input type="text" placeholder="" id="parent_id"  name="parent_id" value="<?php echo  Cookie::get('referrer_user')?>" autocomplete="off" class="input-field">
      </div>

      <div class="input-container">
        <label for="nation_id_number"><b>NID</b></label>
        <input type="text"  placeholder="NID" id="nation_id_number" name="nation_id_number" autocomplete="off" class="input-field">
      </div>

 

      <div class="input-container">
        <label for="phone"><b>Phone</b></label>
        <input type="text"  placeholder="Phone" id="customer_phone" name="phone" autocomplete="off" class="input-field" >
      </div>

      <div class="input-container">
        <label for="uname"><b>Email</b></label>
        <input type="text"placeholder="Email" id="email" name="email" autocomplete="off" class="input-field">
      </div>
 
      <div class="input-container">
        <label for="psw"><b>Password</b></label>
        <input type="password" id="password" name="password" placeholder="" class="input-field" required>
        <i class="fa fa-eye icon-hide"></i>
      </div>
      <div class="input-container">
      <input  required type="checkbox" name="checkbox" value="1" />
            <span style="color:#fff">  I have read and agree with the </span><a style="color:#fff" href="{{url('/')}}/terms-condition" target="_blank">Terms & Conditions</a>
 
      </div>

     

      <button class="button_class" type="submit">Submit</button>

      <div class="forgot-password">
        <span><a href="{{URL::to('/login')}}" >Already have an account ? Login</a></span>
      </div>
    </form>
  </div>

  <script>
    // Add password visibility toggle for the "eye" icon
    document.querySelector('.icon-hide').addEventListener('click', function() {
      const passwordField = document.getElementById('password');
      const icon = this;
      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.add("fa-eye-slash");
        icon.classList.remove("fa-eye");
      } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    });

    function validateForm() {
      // Add your custom form validation here if needed
      return true;
    }
  </script>

</body>
</html>
