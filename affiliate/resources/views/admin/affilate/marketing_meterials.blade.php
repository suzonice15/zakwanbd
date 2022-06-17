@extends('layouts.master')
@section('pageTitle')
    Marketing Meterials

@endsection
@section('mainContent')

    <section class="content">
        <div class="row">

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-success" style="border: 1px solid green;">
                    <div class="box-header with-border" style="background: green;color: white;">
                        <h3 class="box-title">Coupon Code </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{url('/')}}/couponStore">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                @if(Session::get('success_c'))
                                <p style="color:green">{{Session::get('success_c')}}</p>
                                    @endif
                                    @if(Session::get('error_c'))
                                        <p style="color:red">{{Session::get('error_c')}}</p>
                                    @endif

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Name</label>
                                <input  required type="text" class="form-control" id="coupon_name" name="coupon_name" placeholder="Coupon Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Code</label>
                                <input required type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code">

                             <p style="color:red;font-size: 13px" id="coupon_code_error"></p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Coupon Expire Day </label>
                                <input required type="number" class="form-control" id="expire_date" name="expire_date" placeholder="Coupon Expire day">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <select required name="product_id" id="product_id" class="form-control select2">
                                    <option>Search Product here...</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->product_id}}">{{$product->product_title}}-{{$product->sku}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div id="hiddenSection">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Affiliate Commision</label>
                                    <input  type="number" readonly class="form-control" id="affilite_commisionShow" name="affilite_commisionShow"  >

                                    <input  type="hidden" readonly class="form-control" id="affilite_commision" name="affilite_commision"  >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon Discount</label>
                                    <input  required type="text"   class="form-control" id="affilite_discount" name="discount"  >
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button id="couponsubmit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success" style="border: 1px solid green;">
                    <div class="box-header with-border" style="background: green;color: white;">
                        <h3 class="box-title">Marketing Meterial </h3>
                    </div>
                    <form method="POST" action="{{url('user/my/marketing/meterials')}}" enctype="multipart/form-data">
                     @csrf

                    <div class="box-body">

                        <div class="form-group">
                            <?php $succes = Session::get('success');
                            if($succes){
                            ?>
                            <div class="alert alert-success updateMessage">
                                <?=$succes?>
                            </div>
                            <?php }  else {
                            if (isset($user->status)) {
                            if($user->status==0){

                            ?>   <div class="alert alert-success">

                                <p>Your Information is pending .</p>
                            </div>
                            <?php    } else   { ?>

                            <div class="alert alert-success">
                                <p>Your Information is approved  successfully.</p>
                            </div>
                            <?php   } } }?>
                        </div>
                        <div class="form-group">
                            <?php $message= Session::get('success'); if($message) { ?>
                            <h2 style="color:green">{{$message}}</h2>
                            <?php } ?>
                            <label for="username">Marketing Meterial Name</label>
                            <select name="metarial_name" class="form-control">
                                <option value="Facebook Page">Facebook Page</option>
                                <option value="Facebook Group">Facebook Group</option>
                                <option value="Facebook Market">Facebook Marketplace Profile</option>
                                <option value="Youtube">Youtube </option>
                                <option value="Website">Website </option>
                                <option value="Twitter">Twitter </option>
                                <option value="instagram">Instagram </option>
                                <option value="linkedin">Linkedin </option>
                                <option value="Likee">Likee </option>
                                <option value="Tiktok">Tiktok </option>
                                <option value="Jibonpata Page">Jibonpata Page </option>
                                <option value="Jibonpata Group">Jibonpata Group </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="username">Marketing Meterial Link</label>
                            <input required type="url" name="metarial_value" class="form-control"
                                   value="<?php if (isset($user->metarial_value)) {
                                       echo $user->metarial_value;
                                   } ?>" placeholder="Marketing Meterial Value">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary pull-right"
                                   value="Submit">
                        </div>


                    </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    <div class="box-body">


            <div class="" style="background-color: green;color:white;text-align: center;height: 35px; font-weight: 600; line-height: 35px;">Coupon Code
            </div>
            <div class="box-body" style="border: 1px solid green;">

                <div class="table-responsive">
                    <table class="table table-bordered    ">
                        <thead>
                        <tr style="text-align: center">

                            <th style="text-align: center" >Name</th>
                            <th style="text-align: center">Code</th>
                            <th style="text-align: center">Product Name</th>
                            <th style="text-align: center">Coupon Price</th>
                            <th style="text-align: center">Expire Date</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $key=>$coupon)

                            @php

                            $product=DB::table("product")->where('product_id','=',$coupon->product_id)->first();

                            @endphp
                            <tr style="text-align: center">

                                <td>{{$coupon->coupon_name}}</td>
                                <td>{{$coupon->coupon_code}}</td>
                                @if($product)
                                <td> <a target="_blank" href="{{ env('APP_ECOMMERCE') }}{{$product->product_name}}"> {{$product->product_title}}</a></td>
@endif
                                <td>{{$coupon->discount}}</td>
                                <td>{{date("d-m-Y",strtotime($coupon->expire_date))}}</td>

                                <td><a href="{{url("/")}}/couponDelete/{{$coupon->id}}" class="btn btn-danger btn-sm" onclick="return confirm('are you want to delete')">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </div>

    <div class="box-body">

        @if($metarials)
        <div class="" style="background-color: green;color:white;text-align: center;height: 35px; font-weight: 600; line-height: 35px;">My Marketing Matarial
        </div>
            <div class="box-body"  style="border: 1px solid green;">
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered    ">
                        <thead>
                        <tr>
                            <th style="text-align: center">Sl</th>
                            <th style="text-align: center">Marketing Matarial Name</th>
                            <th style="text-align: center">Marketing Matarial Value</th>
                            <th style="text-align: center">Reject Note</th>
                            <th style="text-align: center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($metarials as $key=>$metarial)
                            <tr style="text-align: center">
                                <td>{{++$key}}</td>
                                <td>{{$metarial->metarial_name}}</td>
                                <td>{{$metarial->metarial_value}}</td>
                                <td>{{$metarial->reject_note}}</td>
                                <td>@if($metarial->status==0) Pending @elseif($metarial->status==2) Rejected @else Approved @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
    </div>
    <script>
        $('.updateMessage').fadeOut(4000);
        $('#hiddenSection').hide();


        $("#coupon_code").on("input",function () {
            let coupon_code=$(this).val();
            $.ajax({
                url:"{{url('/')}}/CouponCodeCheck/"+coupon_code,
                success:function (data) {
                  if(data==1){
                      $("#couponsubmit").attr('disabled','disabled');
                      $("#coupon_code_error").text('This coupon code created by other affiliate please try with other');
                  } else {
                      $("#couponsubmit").removeAttr('disabled');
                      $("#coupon_code_error").text('');
                  }
                }
            })
        })
        $("#product_id").change(function () {
            $('#hiddenSection').show();
            let product_id=$(this).val();
            $.ajax({
                url:"{{url('/')}}/getCouponCodeProductPrice/"+product_id,
                success:function (data) {
$("#affilite_commision").val(data)
$("#affilite_commisionShow").val(data)
                }
            })
        })
        $("#affilite_discount").on("input",function(){
            let affilite_discount=Number($(this).val());
            console.log(typeof affilite_discount)
            let affilite_commision=Number($("#affilite_commision").val());

            if(affilite_discount >= affilite_commision){
                alert("Maximum discount is   "+(affilite_commision-1)+" Taka" )
                $("#couponsubmit").attr('disabled','disabled');
            } else {

                $("#couponsubmit").removeAttr('disabled');
            }
            $("#affilite_commisionShow").val(affilite_commision-affilite_discount);

        })
        $('#affilite_discount').bind('keyup paste', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endsection
