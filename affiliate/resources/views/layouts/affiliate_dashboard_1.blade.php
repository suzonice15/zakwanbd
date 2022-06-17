@extends('layouts.master')
@section('pageTitle')
    Affiliate  Dashboard
@endsection
@section('mainContent')
<?php
function RemainingOrder($total_order,$status){
    return $status-$total_order;
}
?>
<style>
    .you-need{
        text-align: justify;font-size: 23px;margin-top: 5px;
    }
    @media (max-width: 776px){
        .you-need{
            font-size: 15px;
        }
    }
</style>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 col-xs-12"><br>
                @if(get_option('dashboard_notice'))
                 <div style="
    padding: 5px 20px;
    background: yellow;
    margin: 8px 16px;
    margin-top: -11px;
    margin-bottom: 18px;
    font-size: 15px;
    line-height: 22px;
    color: red;
    /* text-shadow: 4px 4px 0px yellow; */
    text-align: justify;
" ><?=get_option('dashboard_notice')?></div>
            </div>
            @endif
        </div>
        @include('layouts.affiliate_dashboard_top')
        @if($user->status !=1)
         <div class="row" style="background-color: red;color:white;margin-left: 12px;margin-right: 14px;">
            <div class="col-md-12 col-sm-12 col-xs-12"  >
                <h3 class="you-need">Your account is limited you will not get 2nd level commision ,you need 1 sell to remove limitation. </h3>
            </div>
        </div>
         @endif

        <div class="container-fluid mt-3">
        <div class="row">
            <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tbody>
                   <tr>
                       <th style="text-align: center;font-weight: bold">
                           Your Refferar Code: <?php echo $user->id; ?>
                       </th>
                       <td>
                           Your referer link:     <input id="link_id" style="font-size: 18px;" type="text"
                                                                                value="{{url('/')}}/reffer/<?php echo $user->id; ?>"
                                                                                class="form-control">
                       </td>
                       <td>
                           <input type="button" value="Copy" onclick="myFunction()" class="btn btn-success">
                           <span id="reffer_link_id" style="color:green;font-weight:bold;margin-left:3px"></span>
                       </td>
                   </tr>
                </tbody>
                <tbody>
                <tr>
                    <th  style="text-align: center;font-weight: bold">
                        Shop  Page referer link:
                    </th>
                    <td>
                        <input id="link_id_1" style="font-size: 18px;" type="text"
                               value="https://zakwanbd.com/<?php echo $user->id; ?>"
                               class="form-control">
                    </td>
                    <td>
                        <input type="button" value="Copy" onclick="myFunction1()" class="btn btn-info">
                        <span id="show_link_id" style="color:green;font-weight:bold;margin-left:3px"></span>
                    </td>
                </tr>
                </tbody>

            </table>
            </div>
        </div>
        </div>
        @include('layouts.affiliate_dashboard_hot_product_social_media')
        @include('layouts.affiliate_dashboard_price')
    <script>
        function myFunction() {
            $("#reffer_link_id").show();

            var copyText = document.getElementById("link_id");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            $("#reffer_link_id").text("Coppied").fadeOut(5000)

        }

        function myFunction1() {
            $("#show_link_id").show();
            var copyText = document.getElementById("link_id_1");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            $("#show_link_id").text("Coppied").fadeOut(5000)

        }
    </script>


    <div class="row">
        <div class="col-md-12">
            <div class="modal" id="modal-productShare" style="z-index: 10000">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Product Link Generator</h4>
                        </div>
                        <div class="modal-body" id="view_page">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>

            </div>

        </div>

        <div class="col-md-12">
            <div class="modal" id="add-money" style="z-index: 10000">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center">Add Money</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                <form method="post" action="{{url('/')}}">

                                    <div class="form-group">

                                      <img src="{{url('/')}}/images/Jp-Bkash.jpg" class="img-responsive"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Transaction Id</label>
                                        <input type="text"  required  name="transaction_id"  id="transaction_id" class="form-control" id="exampleInputPassword1" placeholder="Transaction Id">
                                    </div>
                                    <div class="form-check">
                                        <label for="exampleInputPassword1">Sender Number</label>
                                        <input type="number" required name="sender_number" id="sender_number" class="form-control" id="exampleInputPassword1" placeholder="Sender Number">

                                    </div>
                                    <div class="form-check">
                                        <label for="exampleInputPassword1">Amount</label>
                                        <input type="number" required name="amount" id="amount" class="form-control" id="exampleInputPassword1" placeholder="Amount">

                                    </div>
                                    <div class="form-check">
                                        <label for="exampleInputPassword1">Note</label>
                                        <textarea  name="note" class="form-control"  id="note" placeholder="Note" rows="3"></textarea>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="submit_transaction" class="btn btn-primary">Submit</button>

                                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                                    </div>
                                    <span style="color:green;font-weight:bold;font-size: 19px" id="add-mony-sucess"></span>
                                </form>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
            </div>
        </div>
    </div>


    <?php if($marketingMetarialCheck==0) { ?>

    <div class="modal fade" id="myModal" style="z-index:999999999;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Notice Board</h4>
                </div>
                <div class="modal-body">
                    <?=get_option('marketing_metarial_notice')?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <script type="text/javascript">
        $(window).on('load', function() {
            $('#myModal').modal('show');
        });
    </script>


    <?php } ?>

    <script>
        $("#submit_transaction").click(function () {
            if($("#transaction_id").val().length !=10){
                 alert("Transaction Id does not matched");
                return false;
            }
            if($("#sender_number").val().length !=11){
                alert("Enter Your 11 digit Sender Number");
                return false;
            }

            if($("#amount").val().length ==0){
                alert("Please Enter Amount");
                return false;
            }

            $.ajax({
                url:"{{url('/')}}/add-wallet/balance",
                method:"post",
                data:{
                    transaction_id:$("#transaction_id").val(),
                    sender_number:$("#sender_number").val(),
                    amount:$("#amount").val(),
                    note:$("#note").val(),
                    "_token":"{{csrf_token()}}"

                },
                success:function(data){
                   if(data.success==true){
                       $("#add-mony-sucess").text("Successfully added to your wallet please wait for admin approved")

                       setInterval(()=>{
                           $("#add-money").modal('hide');

                       },5000)
                   } else {

                   }
                }
            })


        })
    </script>
@endsection

