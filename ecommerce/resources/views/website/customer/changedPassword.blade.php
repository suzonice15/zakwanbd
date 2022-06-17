@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-6">

            <form method="post" action="{{url('/customer/changed_password')}}" enctype="multipart/form-data">

                @csrf
                <div class="form-group">

                    <p style="color:red">{{Session::get('error')}}</p>
                    <p style="color:green">{{Session::get('success')}}</p>
                </div>
                <div class="form-group">
                    <label for="user_name">Old Password</label>
                    <input type="password" name="old_password"  id="old_password"  value="{{ old('old_password') }}"  class="form-control"  placeholder="Enter Your Old Password">
                </div>


                <div class="form-group"><label for="user_phone">Password</label>
                    <input type="password" name="password"   id="password"
                           class="form-control" placeholder="Password" value="">
                </div>

                <div class="form-group"><label for="user_phone">Confirm Password</label>
                    <input type="password" name="cpassword"  placeholder="Confirm Password"  id="password"
                           class="form-control" value="">
                </div>


                <br>


                <button type="submit" class="btn btn-success">Changed Password</button>

            </form>

        </div>

        <div class="col-md-6">


        </div>

    </div>

@endsection