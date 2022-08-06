@extends('layouts.master')
@section('pageTitle')
   Update User Registration Form
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
            <form action="{{ url('admin/user/update') }}/{{ $user->admin_id }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf

                     <div class="form-group">
                                <label for="zone_id">Zone</label>
                                <select onchange="getShopData(this.value)" required class="form-control select2 " name="zone_id"
                                        tabindex="-1"
                                        aria-hidden="true">
                                    <option value="" >Select Option</option>
                                    @foreach($zones as $zone)
                                        <option @if($zone->id==$user->zone_id) selected @endif value="{{$zone->id}}">{{$zone->zone_name}}</option>
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
                        <input type="text" required="" class="form-control" name="name" value="{{$user->name}}">


                    </div>

                    <div class="form-group "><label for="media_title">Email<span class="required">*</span></label>
                        <input type="text" id="customer_email" required="" class="form-control" name="email"
                               value="{{ $user->email }}">

                        <p id="customer_email_error" style="color:red"></p>

                    </div>

                    <div class="form-group "><label for="media_title">Phone<span class="required">*</span></label>
                    <input type="text" id="customer_phone" required="" class="form-control" name="user_phone"
                    value="{{ $user->user_phone }}">

                    </div>


                
                    <div class="form-group "><label for="media_title">User Status<span
                                class="required">*</span></label>
                        <select required name="status" id="status" class="form-control">
                        <option   value="">Select Option</option>
                            @foreach($roles as $role)
                            <option @if($role->id==$user->status) selected @endif  value="{{ $role->id}}">{{ $role->role_name}}</option>
                            @endforeach
                          
                        </select>
                    </div>

                <div class="form-group "><label for="media_title">User Active Status<span
                                class="required">*</span></label>
                    <select name="active_status" id="active_status" class="form-control">
                        <option <?php if($user->active_status==1) { echo "selected";}  ?> value="1" >Active</option>
                        <option <?php if($user->active_status==0) { echo "selected";}  ?> value="0" >In Active</option>

                    </select>
                </div>
               

                    <div class="form-group "><label for="media_title">Password</label>
                        <input type="password" class="form-control" name="user_pass">


                    </div>
					@if($user->picture)
					  <div class="form-group featured-image">

						<img src="{{URL::to('/public')}}/uploads/users/{{ $user->picture }}">
                        <input type="hidden" class="form-control" name="old_picture" value="{{$user->picture}}">

                    </div>
					@endif

                    <div class="form-group featured-image">
                        <label>Picture</label>
                        <input type="file" class="form-control" name="user_picture">

                    </div>


                    <div class="box-footer">
                        <input type="submit" class="btn btn-success pull-right" value="Update">

                    </div>
                </form>


            </form>
        </div>
    </div>

    <script>

getShopData({{$user->zone_id}});

        function getShopData(zone_id){
            $.ajax({
                url:"{{url('admin/getShopData')}}/"+zone_id,
                success:function(data){
                    $("#shop_id").html(data);
                    $("#shop_id").val({{$user->shop_id}});
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


