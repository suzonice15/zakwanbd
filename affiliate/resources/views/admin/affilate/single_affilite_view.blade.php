<div class="container">

    <div class="row">

        <div class="col-md-6">

            <h4 class="text-center mb-5">Basic Information</h4>


            <table class="table table-bordered">


                <tr>

                    <td>Name:</td>
                    <td>{{$affilate->name}}</td>

                </tr>
                <tr>

                    <td>Phone:</td>
                    <td>{{$affilate->phone}}</td>

                </tr>
                <tr>

                    <td>Email:</td>
                    <td>{{$affilate->email}}</td>

                </tr>    
                <tr>

                    <td>Address:</td>
                    <td>{{$affilate->address}}</td>

                </tr>
                <tr>

                    <td>Total Earn:</td>
                    <td><?php echo number_format($user->life_time_earning, 2); ?></td>

                </tr>
                <tr>

                    <td>Total Withdraw:</td>
                    <td>{{$total_withdraw}}</td>

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
                    <td>{{$total_referral}}</td>

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

                    <td>Login to Affiliate Panel</td>
                    <td>

                         <a  target="_blank" href="{{url('/')}}/adminLoginToAffiliate/{{$user->id}}" class="btn btn-success">Login To Affiliate</a>

                    </td>

                </tr>
            </table>







        </div>


    </div>


    </div>


