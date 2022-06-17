

@extends('layouts.master')
@section('pageTitle')
    Change Shop Name
@endsection
@section('mainContent')
    <div class="box-body">


        <div class="row">

            <div class="col-md-6">
                <div class="well well-sm">
                    <div class="panel panel-success">

                        <div class="panel-heading" style="font-weight: bold;">Change Shop Name Request </div>

                        <div class="panel-body">
                            <form method="POST" action="{{URL::to('/vendor/change-shop-name-update')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="ac_name">Change Shop Name Link:</label>
                                    <input type="text" name="request_shop_link" value="<?php if(isset($vandorInfo->request_shop_link)){ echo $vandorInfo->request_shop_link;} ?>" class="form-control" placeholder="Shop Name Link">
                                </div>
                                <div class="form-group">
                                    <label for="ac_number">Change Shop Name:</label>
                                    <input type="text" name="request_shop_name" value="<?php if(isset($vandorInfo->request_shop_name)){ echo $vandorInfo->request_shop_name;} ?>" class="form-control" placeholder="Shop Name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="service_name">Change Status:</label>
                                    <p>
                                    <?php 
                                    if($vandorInfo->request_status=='1'){
                                        echo "Pending";
                                    }else if($vandorInfo->request_status=='2'){
                                        echo "Accepted";
                                    }else{
                                        echo "No Change Request";
                                    }
                                    ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>


@endsection






