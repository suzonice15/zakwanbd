<?php $__env->startSection('mainContent'); ?>

<style>
    .input-container {
      display: -ms-flexbox; /* IE10 */
      display: flex;
      width: 100%;
      margin-bottom: -3px;
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

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }
    .container_login {
        padding: 16px;
        background-color: #ffffff80
    }
    /* Change styles for span and cancel button on extra small screens */
    @media  screen and (max-width: 600px) {
        span.psw {
            display: block;
            float: none;
        }
        .main-login-div{
            display: block !important;

        }
        .reg-title {
            text-align: center !important;
            padding-right: 5px !important;
        }

        form {
            border: 3px solid #f1f1f1;
            width: 100%;
            margin-left: 0px !important;
        }


        #email_varify_show{
            right: -57px !important;
        }
    }
    .reg-title{
        text-align: right;
        color: white;
        padding-right: 36px;
    }
    #email_varify_show{
        display:block;color:black;font-weight: bolder;position: relative;right: -82px;font-weight: bold;
    }
    .main-login-div{
        display: flex;justify-content: end;
    }
</style>
<section style="min-height: 950px;background-position: center;overflow:hidden;background-repeat: no-repeat;background-attachment: fixed; background-size: cover; background-image: url('images/loginCover.jpg')" >
    
    <div class="container-fluid">
        
        <div class="row" style="margin-top: 100px">

            <div   class="col-md-11 col-sm-12 main-login-div">
                            
                              <div class="panel panel-success main-div-content">
        <div class="panel-heading"><h2 class="reg-title" >Registration Form</h2>
</div>
  <div class="panel-body">

<form action="<?php echo e(url('registration')); ?>"  method="post" >

<?php echo csrf_field(); ?>
<?php $success=Session::get('success');

        if($success){

        ?>
        <h3 style="color: green;
border: 2px solid green;
padding: 12px;
font-size: 23px;">
            <p>আপনার ইমেইলে একটি ভেরিফিকেশন লিংক পাঠানো হয়েছে। লিংকে ক্লিক করে ভেরিফিকেশন সম্পন্ন করুন। Inbox এ মেইল না পেলে Spam বা Junk ফোল্ডার চেক করুন।</p>

        </h3>

        <?php } ?>



       <?php  if(empty($success)){ ?>
    <div class="container_login">
        <h3 style="color:green"><?php echo e(Session::get('success')); ?></h3>
        <h3 style="color:red"><?php echo e(Session::get('error')); ?></h3>
        <div class="input-container fieldHiden" style="margin-top: -28px;">
            <i class="fa fa-user icon"></i>
            <input class="input-field" required="" type="text" placeholder="Full Name" name="name" autocomplete="off">
        </div>

        <div class="input-container">
            <i class="fa fa-envelope icon"></i>
            <input style="width: 80%" required=""  class="input-field" type="text" placeholder="Email" id="email" name="email" autocomplete="off">
            <input style="height: 48px;margin-top: 8px;width: 25%;background-color: #9f29ff;border: none" type="button" id="varify" class="btn btn-success" value="Verify">

        </div>

        <div class="input-container">
            <span id="email_varify_show"> Click verify button to verify your email </span>
        </div>

        <div class="input-container varificationClassSectionHide">
            <span id="success" style="display:none;color:green">আপনার ইমেইলে একটি ভেরিফিকেশন কোড গেছে এই কোডটি নিচের বক্সে বসান
                            ইনবক্সে না পেলে   স্পাম ফোল্ডার চেক করেন</span>
            <p class="email_error" class="text-danger"> </p>
            <input type="hidden" id="varificationServerCode">
        </div>
        <div class="input-container varificationClassSectionHide">
            <input class="input-field" type="text" placeholder="Enter Your Varification Code" name="varify_code" id="varify_code" autocomplete="off">
            <i id="checked" class="fa fa-check-square" style="color:green;font-size: 25px"></i>
            <input style="width: 80%" type="hidden" id="varification_code_check"  name="varification_code_check" value="<?php echo e(Session::get('code')); ?>">
            <button type="button"  style="display:none;width: 25%;height: 47px; margin-top: 9px;" id="varifyCodeCheck" class="btn btn-info"> Submit</button>
        </div>
        <div class="input-container fieldHiden">
            <i class="fa fa-user icon"></i>
            <input class="input-field" required="" type="text" placeholder="NID" id="nation_id_number" name="nation_id_number" autocomplete="off">
            <span id="nid"></span>
        </div>
       

        <div class="input-container fieldHiden">
            <i class="fa fa-phone icon"></i>
            <input class="input-field" required="" type="text" placeholder="Phone" id="customer_phone" name="phone" autocomplete="off">
            <span id="customer_phone_error"></span>
        </div>

        <div class="input-container">
            <span id="customer_phone_error"></span>
        </div>
        <div class="input-container fieldHiden">
            <i class="fa fa-key icon"></i>
            <input required class="input-field" type="password" placeholder="Password" id="password" name="password" autocomplete="off">
        </div>
         

        <div class="input-container fieldHiden">
            <i class="fa fa-user icon"></i>
            <input class="input-field" type="text" placeholder="Referral (Optional)" name="parent_id" value="<?php echo  Cookie::get('referrer_user')?>" autocomplete="off">
        </div>

        <div class="input-container fieldHiden">
            <i class="fa fa-user icon"></i>
          <select name="gender" id="gender" style="height: 49px;margin-top: 8px;"  class="input-field">
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
          </select>
        </div>
        <div class="fieldHiden" style="margin-top: 10px;">
            <input  required type="checkbox" name="checkbox" value="1" /><span style="color:black">  I have read and agree with the </span><a style="color:black" href="<?php echo e(url('/')); ?>/terms-condition" target="_blank">Terms & Conditions</a>

        </div>

        <button class="button_class fieldHiden" id="form_submit" type="submit" style="font-weight: 600;border-radius: 5px;width: 30%;float: right;">Submit</button>
        <br>
        <div style="margin-top: 5px; font-size: 15px; font-weight: 600; display: inline-flex;">
            <span class="fieldHiden" style="color: black"> Already have an account ? <a style="color: green" class="fieldHiden" href="<?php echo e(URL::to('login')); ?>">Sign in</a></span>
        </div>
    </div>
 
    <?php } ?>
</form>
</div>

</br>
</div>
                  
</div>

        </div>
    </div>

 </section>
     <script>


jQuery('#gender').on('change', function () {
   var gender= $("#gender").val();
           if(gender =='Female'){
$("#form_submit").hide();
           }else{
            $("#form_submit").show();
           }
        });


        jQuery('form#checkout #customer_phone').on('blur', function () {
            var customer_phone= jQuery('#customer_phone').val();
            if (!/^01\d{9}$/.test(customer_phone)) {
                return false;
                jQuery('#customer_phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
            } else {
                jQuery('#customer_phone_error').text(" ");
                return true;
            }
        });


    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.fieldHiden').hide();
            $('#varifyCodeCheck').click(function(){
                var customerCode=$("#varify_code").val();
                var serverCode=$("#varificationServerCode").val();
                if(serverCode===customerCode){
                    $('.fieldHiden').show();
                    $('.varificationClassSectionHide').hide();
                } else {

                    alert("Your Varification Code does not matched")
                }
            });
            $('#checked').hide();
            $('#success').hide();
            $(document).on('input','#varify_code', function () {
               let varify_code= $('#varify_code').val();
               let varification_code_check= $('#varification_code_check').val();
                if(varification_code_check==varify_code){
                    $('#checked').show();
                } else {

                    $('#checked').hide();

                }


            });

            $('#varify_code').hide();
            $(':input[type="submit"]').prop('disabled', true);
            $('#varify').click(function(){

                var email = $('#email').val();
                if(email== ''){
                    $('.email_error').html('<span style="color:red">Please Enter Your Email</span>');
                    $('#email_varify_show').hide();
                }
                if(IsEmail(email)==false){
                    $('.email_error').html('<span style="color:red">Please Enter Your Valid  Email</span>');
                    $('#email_varify_show').hide();

                } else {

                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('affilite/email_check')); ?>?email="+email,
                    success:function(data)
                    {

                             console.log(data)

                        if(data=='no'){
                            $('.email_error').html('<span style="color:red">This   Email exits in our database try another </span>');
                            $('#email_varify_show').hide();
                        } else {

                            $('#email').css("width","100%");
                            $('#success').show();
                            $('#varifyCodeCheck').show();
                            $('#varify_code').show();
                            $('.email_error').html('');
                             $('#varify').hide();
                            $('#email_varify_show').hide();
                            $(':input[type="submit"]').prop('disabled', false);
                            $('#varificationServerCode').val(data);


                        }
                    }
                });

            }
        });
        });
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
                return false;
            }else{
                return true;
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/website/sign_up.blade.php ENDPATH**/ ?>