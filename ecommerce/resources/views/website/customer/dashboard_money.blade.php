@extends('website.customer.dashboard')
@section('profile_master')

    <style>
        .warllet-money{
            margin-top: 7px;
            background: red;
            position: absolute;
            border: none;
        }
        .bonas{
            padding: 56px 8px;
        }

        .names{    background: #ddd;
            text-align: center;
            font-size: 45px;
            text-transform: capitalize;
            font-weight: bold;}
        .winner{    background: green;
            text-align: center;
            font-size: 45px;
            color:white;
            font-weight: bold;}
        .winner {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }


            @media (max-width: 776px) {
                .bonas{
                    padding: 0px 0px;

                }
                .warllet-money {
                    margin-top: -39px;
                    margin-left: 80px;
                }
                .bonas h3{
                    font-size: 16px;
                    text-align: center;
                    padding-top: 11px;
                }
                .bonas h4{
                    font-size: 16px;
                    text-align: center;
                    padding-top: 11px;
                }
            .winner{
                background: green;
                text-align: center;
                font-size: 20px;
                color: white;
                font-weight: bold;
                padding: 6px;
            }
            }
    </style>



    <div class="row">


        <div class="col-12 col-lg-4 text-center  ">
            <div class="bonas bg-success  text-white" >
                <h3>Cashback Balance</h3>
                <h4>Tk. {{number_format($user->cashback_blance,2)}}</h4>

            </div>
        </div>

        <div class="col-12 col-lg-4  text-center  ">
            <div class="bonas bg-success  text-white" >
                <h3>Main Wallet </h3>
                <h4>Tk. {{number_format($user->wallet_blance,2)}}</h4>

                <div class="other">
                    <button type="button"    class="btn btn-success warllet-money btn-sm" data-bs-toggle="modal" data-bs-target="#add-money">

                        Add Fund
                    </button>
                </div>

            </div>
        </div>


        <div class="col-12 col-lg-4  text-center">
            <div class="bonas bg-success text-white">
                <h3>Coin Wallet </h3>
                <h4>Tk. {{number_format($user->bonus_blance,2)}}</h4>
            </div>
        </div>
    </div>



    <?php
            /* promosion offer result published */
    $promosion_offer_active=get_option('promosion_offer_active');
    if($promosion_offer_active==1){
    ?>

    <div class="row" style="margin-top: 50px;">
        <div class="col-12">
            <div class="names hide"></div>
            <div class="winner hide"></div>
        </div>
    </div>


    <?php
    }
    /* end promosion offer result published */
    ?>

    @if(isset($product->feasured_image))
    <div class="row" style="margin: 1px;margin-top: 11px;box-shadow: 2px 5px 13px 6px rgba(0,0,0,.68);
-webkit-box-shadow: 2px 5px 13px 6px rgba(0,0,0,.68);
-moz-box-shadow: 2px 5px 13px 6px rgba(0,0,0,.68);">

        <h4 style="margin-bottom: -30px;margin-top: 13px;font-weight: bold">{{$product->product_title }}</h4>
        <div class="col-12 col-md-4 text-center  ">

            <div class="bonas   text-white" >
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->feasured_image }}"
                     class="img-fluid" style="border: 2px solid #ddd;"
                    alt="{{ $product->product_title }}">


            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="bonas tab-content" >
                <?php echo $product->product_description ?>
            </div>
        </div>


        </div>
    <div class="row" style="margin: 1px;margin-top: 11px;box-shadow: 2px 5px 13px 6px rgba(0,0,0,.68);
-webkit-box-shadow: 2px 5px 13px 6px rgba(0,0,0,.68);
-moz-box-shadow: 2px 5px 13px 6px rgba(0,0,0,.68);">

    <div class="col-12 col-md-8">
        @if($order_count==0)
        
         <form  id="example" action="{{url('/')}}/customer/promosion/order" method="post">
             @csrf
             <div class="mb-3">
                 <h2 style="color:green;font-weight: bold" id="product_order_success"> {{Session::get('success')}}</h2>
                 <h2 style="color:red;font-weight: bold" id="product_order_error"> {{Session::get('error')}}</h2>

            </div>

             <div class="mb-3">
                 <?php   $product_id=$product->product_id;     ?>
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" required class="form-control" id="customer_name" name="customer_name"  value="{{Session::get('name')}}"  placeholder="Customer Name">
                <input type="hidden" id="amount" class="form-control"  name="amount" value="{{$product->discount_price}}">
                 <input type="hidden" name="products[items][{{$product_id}}][name]" value="<?php echo $product->product_title;?>">
                 <input type="hidden" name="products[items][<?=$product_id?>][featured_image]" value="{{url('/')}}/public/uploads/<?php echo $product->folder;?>/small/<?php echo $product->feasured_image;?>">
                 <input type="hidden" id="product_quantity" name="products[items][<?=$product_id?>][qty]" value="1">
                 <input type="hidden" id="product_price" name="products[items][<?=$product_id?>][price]" value="<?php echo $product->discount_price;?>">
                 <input type="hidden" name="products[items][<?=$product_id?>][subtotal]" value="{{$product->discount_price}}">


             </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Customer Phone</label>
                <input type="text" class="form-control" id="customer_phone" value="{{Session::get('phone')}}" name="customer_phone" placeholder="Customer Phone">
            </div>
            <div class="mb-3">
                <label for="addreess" class="form-label">Customer Address</label>
                <textarea name="customer_address" required id="customer_address" class="form-control" placeholder="Customer Address"></textarea>
            </div>
             <p><input required type="checkbox" value="1" > <a href="" data-bs-toggle="modal" data-bs-target="#terms-condition">আমি Terms and Condition  পড়েছি এবং এতে রাজি আছি</a></p>

            <button type="submit"     style="cursor:pointer;margin-bottom: 25px" id="submit" class="btn btn-primary">Submit</button>

        </form>
        @else
           <h5 style="color:green;font-weight: bold;padding:5px" id="product_order_error"> ধন্যবাদ, আপনি এই ফোনটি অর্ডার করেছেন।
        </h5>
        @endif
        
        
    </div>

    </div>


    @endif

    <div class="col-md-12">
        <div class="modal  fade" id="add-money" style="z-index: 10000">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                       @if(Session::get('error'))
                       
                       <h5 class="modal-title" style="color:red;font-weight:bold" id="exampleModalLabel">আপনার  একাউন্টে পর্যাপ্ত টাকা নেই। দয়া করে রিচার্জ করুন </h5>
                       @else
                       <h5 class="modal-title" id="exampleModalLabel">Add Money</h5>
                       
                       @endif
                        
                        
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <form method="post" action="{{url('/')}}">

                                    <div class="form-group" style="
    display: flex;
    flex-direction: row;
    justify-content: center;
">
                                        <img src="https://www.sohojaffiliates.com/images/Jp-Bkash.jpg" style="
    height: 560px;
    width: 453px;
"  class="img-fluid"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Transaction Id</label>
                                        <input type="text"  required  name="transaction_id"  id="transaction_id" class="form-control" id="exampleInputPassword1" placeholder="Transaction Id">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Sender Number</label>
                                        <input type="number" required name="sender_number" id="sender_number" class="form-control" id="exampleInputPassword1" placeholder="Sender Number">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Amount </label>
                                        <input type="number" required name="amount" id="amount_of_promotion" class="form-control" id="exampleInputPassword1" placeholder="Amount">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Note</label>
                                        <textarea  name="note" class="form-control"  id="note" placeholder="Note" rows="3"></textarea>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="submit_transaction" class="btn btn-primary">Submit</button>

                                        <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal" aria-label="Close">Close</button>

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
        <div class="modal  fade" id="terms-condition" style="z-index: 10000">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <form method="post" action="{{url('/')}}">
                                    <div class="tab-content" >
                                    {!! $page_content !!}
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-right" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>


    @if(Session::get('error'))
<script>
 
    $(window).on('load', function() {
        $('#add-money').modal('show');
    });

</script>

    @endif


<?php
    $promosion_offer_active=get_option('promosion_offer_active');
    if($promosion_offer_active==1){
?>

    <script>

        $(document).ready(function(){
            $("#checked_tearm_conditon").change(function() {
                if($('#checked_tearm_conditon').prop('checked')) {
                   
                    $('#submit').removeAttr('disabled');
                } else {

                    $('#submit').attr('disabled','disabled');
                }
            });

        });

        window.onload = rollClick;
      //  window.onload = amitumi;
        const ENTRANTS =<?= get_option('address') ?>


        const namesEl = document.querySelector(".names");
        const winnerEl = document.querySelector(".winner");

        function randomName() {
            const rand = Math.floor(Math.random() * ENTRANTS.length);
            const name = ENTRANTS[rand];
            namesEl.innerText = name;
        }

        function rollClick() {

            winnerEl.classList.add("hide");
            namesEl.classList.remove("hide");
            setDeceleratingTimeout(randomName, 1, 100);
            setTimeout(()=>{
                namesEl.classList.add("hide");
            winnerEl.classList.remove("hide");
            const winner = namesEl.innerText;
           // winnerEl.innerText = winner;
            winder();

        }, 30000);
        }

         function winder(){

             $.ajax({
                 url:"{{url('/')}}/customer/lotarySuccess",
                 success:function(data){
                     console.log(data)
                     const winnerEl = document.querySelector(".winner");
                     winnerEl.innerText = data;
                 }
             })

         }

        function setDeceleratingTimeout(callback, factor, times) {
            const internalCallback = ((t, counter) => {
                return () => {
                if (--t > 0) {
                    setTimeout(internalCallback, ++counter * factor);
                    callback();
                }
            };
        })(times, 0);

            setTimeout(internalCallback, factor);
        }

    </script>
    <?php  }  ?>


    <script>
            $(document).ready(function(){
        $("#submit_transaction").click(function () {
            if($("#transaction_id").val().length !=10){
                alert("Transaction Id does not matched");
                return false;
            }
            if($("#sender_number").val().length !=11){
                alert("Enter Your 11 digit Sender Number");
                return false;
            }

            if($("#amount_of_promotion").val().length ==0){
                alert("Please Enter Amount");
                return false;
            }

            $("#submit_transaction").attr("disabled","disabled")
            $.ajax({
                url:"{{url('/')}}/add-wallet/balance",
                method:"post",
                data:{
                    transaction_id:$("#transaction_id").val(),
                    sender_number:$("#sender_number").val(),
                    amount:$("#amount_of_promotion").val(),
                    note:$("#note").val(),
                    "_token":"{{csrf_token()}}"

                },
                success:function(data){
                    if(data.success==true){
                        $("#add-mony-sucess").text("Successfully added to your wallet please wait for admin approval")

                        setInterval(()=>{
                            $("#add-money").modal('hide');

                    },3000)
                    } else {

                    }
                }
            })


        })
            })



    </script>


@endsection