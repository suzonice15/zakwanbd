@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-6">

            <form method="post" action="{{url('/customer/profile/update')}}" enctype="multipart/form-data">

@csrf
                <div class="form-group">
                    <p style="color:green">{{Session::get('success')}}</p>

                    <label for="user_name">Name</label> <input type="text"
                                                               name="name"
                                                               id="user_name"
                                                               class="form-control"
                                                               value="{{$user->name}}">
                </div>
                <div class="form-group"><label for="user_phone">Phone</label> <input readonly type="text"
                                                                                     name="phone"
                                                                                     id="user_phone"
                                                                                     class="form-control"
                                                                                     value="{{$user->phone}}">
                </div>
                <div class="form-group"> <label for="user_email">Email</label>
                    <input type="text"    name="email"
                                                                                     id="user_email"
                                                                                     class="form-control"
                                                                                     value="{{$user->email}}" />


                                </div>

                <div class="form-group">
                    <label for="user_address">Address</label>


                    <textarea name="address" id="user_address" class="form-control">{{$user->address}}</textarea>
                </div>

                <div class="form-group">
                    <label for="user_address">Picture</label>
                    <br/>


                    <input name="user_picture" type="file" class="form-control">
                </div>



 <br>


                <button type="submit" class="btn btn-success">Update Profile</button>

            </form>

        </div>

        <div class="col-md-6">



        </div>

    </div>

@endsection