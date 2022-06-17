@extends('layouts.master')
@section('pageTitle')
    Super Offer

@endsection
@section('mainContent')

    <div class="row">
        <br>
        <br>

        <div class="col-md-1 ">

        </div>

        <div class="col-md-10 ">
            <p>
                <?=get_option('super_offer')?>

            </p>

            <?php
            if($account){
                if($account->status==1){

            ?>

            <button   class="btn btn-success text-center">Your registration has been completed</button>
            <?php } else { ?>
            <button  style="justify-content: center"  class="btn btn-info  text-center">Your registration not approved with for admin approved</button>

            <?php }  } else {  ?>

            <button id="info" class="btn btn-info">Registration Now</button>
            <?php }?>



        </div>
        </div>

    <div id="form_section" style="display: none" class="row">

        <div class="col-md-1 ">

        </div>
        <div class="col-md-8 ">


                <br>
                <br>
                <br>

                <form class="form-horizontal" action="{{url('/')}}/user/superOffer" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Acount Type</label>
                            <div class="col-sm-9">

<select required  class="form-control" name="acount_type" id="acount_type">
    <option>Select   Your Option</option>
    <option value="bkash">bkash</option>
    <option value="rocket">Rocket</option>
    <option value="nogod">Nogod</option>

</select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Sender Number</label>
                            <div class="col-sm-9">
                                <input type="number"  required class="form-control"  name="sender_number" id="sender_number" placeholder="Sender Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Transaction Id</label>
                            <div class="col-sm-9">
                                <input type="text"  required class="form-control"  name="transaction_id" id="transaction_id" placeholder="Transaction Id ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>
                            <div class="col-sm-9">
                                <input type="number"  required class="form-control"  name="amount" id="amount" placeholder="Amount">
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                        <button type="submit" class="btn btn-info pull-right">Submit Now</button>
                    </div>
                    <!-- /.box-footer -->
                </form>

        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>  <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <script>
        $('#info').click(function () {
            $(this).hide();
            $('#form_section').show();
        })
    </script>




@endsection

