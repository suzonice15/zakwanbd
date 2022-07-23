@extends('layouts.master')
@section('pageTitle')
    Add New Shop
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        @if (count($errors) > 0)
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    @foreach ($errors->all() as $error)

                        <li style="list-style: none">{{ $error }}</li>

                    @endforeach

                </ul>
            </div>
        @endif


        <form action="{{ url('admin/shop') }}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="box" style="border: 2px solid #ddd;">
                <div class="box-header with-border" style="background-color: green;color:white;">
                    <h3 class="box-title">Shop Information</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12" style="margin-left: 10px">
                        
                       
                        <div class="form-group">
                                <label for="zone_id">Zone</label>
                                <select required class="form-control select2 " name="zone_id"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option value="" >Select Option</option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->zone_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                            <div class="form-group">
                                <label for="shop_name">Shop Name<span class="required">*</span></label>
                                <input required type="text" id="shop_name" class="form-control"
                                       name="shop_name" value="">
                                       <input   type="hidden" id="profit_amount" class="form-control"
                                       name="profit_amount" value="0">
                                       
                            </div>
                            
                            <div class="form-group">
                                <label for="shop_name">Address <span class="required">*</span></label>                               
                                <textarea name="address" class="form-control" id="address" rows="2"></textarea>
                            </div>


                            <!-- /.form-group -->
                            <div class="form-group ">
                                <label for="phone">Mobile<span class="required">*</span></label>
                                <input required type="text" class="form-control" id="mobile"
                                       name="mobile"
                                       value="">
                               
                            </div>
                            <div class="form-group ">
                                <label for="phone">Phone<span class="required">*</span></label>
                                <input required type="text" class="form-control" id="phone"
                                       name="phone"
                                       value="">
                               
                            </div>

                            <div class="form-group">
                                <label for="admin_id">Manager</label>
                                <select required class="form-control select2 " name="admin_id"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option value="" >Select Option</option>
                                    @foreach($admins as $admin)
                                        <option value="{{$admin->admin_id}}">{{$admin->name}}({{$admin->user_phone}})</option>
                                    @endforeach
                                </select>
                            </div>
                           
                             

                            <div class="form-group">
                                <label for="billing_name">Shop Continue<span class="text-danger">*</span></label>
                                <select name="shop_status" id="shop_status" class="form-control">
                                    <option value="1" style="background-color: red;">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="billing_name">Shop Status<span class="text-danger">*</span></label>
                                <select name="agency_status" id="agency_status" class="form-control">
                                    <option value="0">Company</option>
                                    <option value="1" >Agency</option>                                   
                                </select>
                            </div>

                            <div class="form-group ">
                                <label for="phone">Agency profit Percent</label>
                                <input   type="text" class="form-control" id="profit_percent"
                                       name="profit_percent"
                                       value="">
                               
                            </div>

                            



                            <!-- /.form-group -->
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->

            </div>        

            <div class="box-footer">
                <input type="submit" class="btn btn-success pull-left" value="Save">

            </div>

        </form>

    </div>


    <script>
        $(document).ready(function () {
            $("#category_title").on('input click', function () {
                var text = $("#category_title").val();
                var _token = $("input[name='_token']").val();

                var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $("#category_name").val(word);
                $.ajax({
                    data: {url: word, _token: _token},
                    type: "POST",
                    url: "{{url('category-urlcheck')}}",
                    success: function (result) {

                        // $('#categoryError').html(result);
                        var str2 = "es";
                        var word = $("#category_name").val(word);
                        if (result) {
                            var text = $("#category_title").val();
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            var word = word.concat(str2);
                            $("#category_name").val(word);

                        } else {
                            var text = $("#category_title").val();
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            $("#category_name").val(word);
                        }
                    }
                });
            });


        });
    </script>



@endsection


