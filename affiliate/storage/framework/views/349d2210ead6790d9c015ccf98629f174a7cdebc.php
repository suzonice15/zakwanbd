<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Zakwan Affiliate </title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #021C88;
      /* Background color */
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: white;
      overflow: hidden;
      /* Prevents page scroll due to animation */
    }

    header {
      background-color: #001869;
      /* Dark header background */
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .site-name {
      font-size: 1rem;
      font-weight: bold;
      color: white;
    }

    .login-text {
      font-size: 1rem;
      cursor: pointer;
      color: white;
      text-decoration: none;
    }

    /* Container that wraps the center message */
    .center-wrapper {
      flex: 1;
      display: grid;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 80px);
     
      overflow: hidden;
    
    }

    /* Text message with animation */
    .center-message {
      font-size: 1.5rem;
      font-weight: 600;
      padding: 20px;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeSlideIn 1.2s ease-out forwards;
      animation-delay: 0.5s;
      text-align: center;
    }

    /* Keyframes for slide and fade effect */
    @keyframes  fadeSlideIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @media (max-width: 600px) {
      .site-name {
        font-size: 1rem;
      }

      .center-message {
        font-size: 1.3rem;
      }
    }

    a {
      color: white;
      text-decoration: none;

    }
    .text-center{text-align: center;}
  </style>
</head>

<body>
  <header>
    <div class="site-name">Zakwan</div>
    <div class="login-text"><a href="<?php echo e(url('/')); ?>/loginSignUp">Login</a></div>
  </header>

  <!-- Wrapper for center message -->
   <div class="text-center">
         <img src="<?php echo e(url('/public/images/logo_icon.png')); ?>"   style="height:300px" /> 
   </div>
  <div class="center-wrapperx"> 
    <div class="center-message"> 
       <h4>Welcome to Zakwan Affiliate</h4> 
       <br/>
       <h4> জাকওয়ান অ্যাফিলিয়েট   আপনার সাফল্যের নতুন দিগন্ত !</h4>
    </div>  
  </div>
</body>

</html><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/website/new_home.blade.php ENDPATH**/ ?>