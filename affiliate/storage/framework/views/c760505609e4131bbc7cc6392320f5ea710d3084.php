<div class="container">

    <div class="row">

        <div class="col-md-6">

            <h4 class="text-center mb-5">Basic Information</h4>


            <table class="table table-bordered">


                <tr>

                    <td>Name:</td>
                    <td><?php echo e($affilate->name); ?></td>

                </tr>
                <tr>

                    <td>Phone:</td>
                    <td><?php echo e($affilate->phone); ?></td>

                </tr>
                <tr>

                    <td>Email:</td>
                    <td><?php echo e($affilate->email); ?></td>

                </tr>    
                <tr>

                    <td>Address:</td>
                    <td><?php echo e($affilate->address); ?></td>

                </tr>
                <tr>

                    <td>Total Earn:</td>
                    <td><?php echo number_format($user->life_time_earning, 2); ?></td>

                </tr>
                <tr>

                    <td>Total Withdraw:</td>
                    <td><?php echo e($total_withdraw); ?></td>

                </tr>

                <tr>

                    <td>Earning Balance:</td>
                    <td><?php echo number_format($user->earning_balance, 2); ?></td>

                </tr>

                <tr>

                    <td>Wallet Balance:</td>
                    <td><?php echo number_format($user->ewallet_balance, 2); ?></td>

                </tr>

                <tr>

                    <td>Shopping Points:</td>
                    <td><?php echo number_format($user->shopping_point, 2); ?></td>

                </tr>
                <tr>

                    <td>Total Referral:</td>
                    <td><?php echo e($total_referral); ?></td>

                </tr>
                <tr>

                    <td>Referrer Name:</td>
                    <td>
                        <?php
                            if ($referrerName) {
                                echo $referrerName->name;
                            }
                        ?>
                    </td>

                </tr>
                <tr>

                    <td>Lavel :</td>
                    <td>
                       <?php
                        if($lavel){
                           echo $lavel->lavel;
                        }else{
                            echo "1";
                        }
                       ?> 
                    </td>

                </tr>
                <tr>
                    <td>Passoword</td>
                    <td>
                        <input type="password" class='form-control' name="password" id="password" > 
                    </td>
                    <td>
                        <button type="button" class='btn btn-info btn-sm' onclick='PasswordChanged(<?php echo e($user->id); ?>)'>Update</button>   
                    </td>
                </tr>
                <tr>

                    <td>Login to Affiliate Panel</td>
                    <td>

                         <a  target="_blank" href="<?php echo e(url('/')); ?>/adminLoginToAffiliate/<?php echo e($user->id); ?>" class="btn btn-success">Login To Affiliate</a>

                    </td>

                </tr>
            </table>







        </div>


    </div>


    </div>

<script>

    function PasswordChanged(id){
        
   var password= $("#password").val();
  var confirm_message= confirm("Are You want to change password");
  if(confirm_message){
    $.ajax({
        url:"<?php echo e(url('/')); ?>/changedPasswordOfAffiliate",
        data:{
            user_id:id,
            password:password
        },
        success:function (data){
            alert(data.success)

        },
        error:function (data){
            alert(data)

        }
    })
  }else{

    alert("Password does not changed")
  }
    
}
    </script><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/single_affilite_view.blade.php ENDPATH**/ ?>