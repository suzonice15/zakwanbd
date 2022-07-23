@extends('layouts.master')
@section('pageTitle')
    User Registration Form
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

        <div class="col-sm-offset-0 col-md-12">
            <form action="{{ url('admin/user/store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                                <label for="zone_id">Zone</label>
                                <select onchange="getShopData(this.value)" required class="form-control select2 " name="zone_id"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option value="" >Select Option</option>
                                    @foreach($zones as $zone)
                                        <option  value="{{$zone->id}}">{{$zone->zone_name}}</option>
                                    @endforeach
                                </select>
                     </div>

                     <div class="form-group">
                                <label for="zone_id">Shop</label>
                                <select required class="form-control select2 " name="shop_id" id="shop_id"  >
                                    <option value="" >Select Option</option>
                                    
                                </select>
                     </div>



                        <div class="form-group "><label for="media_title">Name<span class="required">*</span></label>
                            <input type="text" required="" class="form-control" name="user_name" value="">


                        </div>

                    <div class="form-group "><label for="media_title">Email<span class="required">*</span></label>
                        <input type="text" id="customer_email" required="" class="form-control" name="user_email"
                               value="">

                        <p id="customer_email_error" style="color:red"></p>

                    </div>

                        <div class="form-group "><label for="media_title">Phone<span class="required">*</span></label>
                            <input type="text" id="customer_phone" required="" class="form-control" name="user_phone"
                                   value="">


                        </div>
 
                        <div class="form-group "><label for="media_title">User Status<span
                                    class="required">*</span></label>
                            <select name="user_type" class="form-control">
                                <option value="office-staff" style="background-color: red;">Office Stuf</option>
                                <option value="super-admin">Super admin</option>
                                <option value="admin"> Admin</option>
                            </select>
                        </div>

                        <div class="form-group "><label for="media_title">Password</label>
                            <input type="password" class="form-control" name="user_pass">


                        </div>

                        <div class="form-group featured-image">
                            <label>Picture</label>
                            <input type="file" class="form-control" name="user_picture">

                        </div>


                    <div class="box-footer">
                        <input type="submit" class="btn btn-success pull-right" value="Save">

                    </div>



            </form>
        </div>
    </div>

    <script>

function getShopData(zone_id){
            $.ajax({
                url:"{{url('admin/getShopData')}}/"+zone_id,
                success:function(data){
                    $("#shop_id").html(data);
                    
                }
            })


        }

        $('#customer_phone').on('blur', function () {

            var customer_phone = $('#customer_phone').val();
            if (!/^01\d{9}$/.test(customer_phone)) {
                $('#phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
            } else {
                $('#phone_error').text("");


            }
        });


        $('#customer_email').blur(function () {
            var error_email = '';
            var email = $('#customer_email').val();
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email)) {
                $('#customer_email_error').html('<label class="text-danger">email address format is not correct</label>');


            } else {
                $('#customer_email_error').html('');

            }
        });

    </script>



@endsection


