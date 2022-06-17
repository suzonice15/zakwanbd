@extends('layouts.master')
@section('pageTitle')
    Edit Profile
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

    <div class="col-sm-offset-0 col-md-7">
        <form action="{{ url('vendor/profileUpdate') }}/{{ $user->vendor_id }}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf


                <div class="form-group "><label for="media_title">First Name<span class="required">*</span></label>
                    <input type="text" required="" class="form-control" name="vendor_f_name" value="{{$user->vendor_f_name}}">

                </div>

                <div class="form-group "><label for="media_title">Last Name<span class="required">*</span></label>
                    <input type="text" required="" class="form-control" name="vendor_l_name" value="{{$user->vendor_l_name}}">

                </div>

                <div class="form-group "><label for="media_title">Email<span class="required">*</span></label>
                    <input type="text" id="" required="" class="form-control" name="vendor_email"
                           value="{{ $user->vendor_email }}">

                </div>

                <div class="form-group "><label for="media_title">Phone<span class="required">*</span></label>
                <input type="text" id="vendor_phone" required="" class="form-control" name="vendor_phone"
                value="{{ $user->vendor_phone }}">

                </div>

                <div class="form-group">
                    <label class="" >Address </label>
                    <div class=" inputGroupContainer">
                        <div class="input-group">
                            <textarea name="vendor_address"  placeholder="addrees" class="form-control" rows="4" cols="420" required="">{{$user->vendor_address}}</textarea>

                        </div>
                    </div>
                </div>

                <div class="form-group "><label for="media_title">Password</label>
                    <input type="vendor_password" class="form-control" name="vendor_password">
                </div>

				@if($user->vendor_image)
				  <div class="form-group featured-image">

					<img style="height: 200px; width: 200px;" src="{{URL::to('/public')}}/uploads/users/{{ $user->vendor_image }}">

                </div>
				@endif

                <div class="form-group featured-image">
                    <label>Picture</label>
                    <input type="file" class="form-control" name="vendor_image">

                </div>

                @if($user->nid_image)
                  <div class="form-group featured-image">

                    <img style="height: 200px; width: 200px;" src="{{URL::to('/public')}}/uploads/users/{{ $user->nid_image }}">

                </div>
                @endif

                <div class="form-group featured-image">
                    <label>Nid Image</label>
                    <input type="file" class="form-control" name="nid_image">

                </div>

                @if($user->bank_image)
                  <div class="form-group featured-image">

                    <img style="height: 200px; width: 200px;" src="{{URL::to('/public')}}/uploads/users/{{ $user->bank_image }}">

                </div>
                @endif

                <div class="form-group featured-image">
                    <label>Bank Checkbook Image</label>
                    <input type="file" class="form-control" name="bank_image">

                </div>

            <div class="form-group featured-image">
                <label>Shop Picture</label>
                <input type="file" class="form-control" name="vendor_shop_image">

            </div>

            @if($user->vendor_shop_image)
                <div class="form-group featured-image">

                    <img style="height: 200px; width: 200px;" src="{{URL::to('/public')}}/uploads/users/{{ $user->vendor_shop_image }}">

                </div>
            @endif




                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-right" value="Update">

                </div>

        </form>
    </div>
    <div class="col-md-5">
        <div class="panel panel-primary">
            <div class="panel-body">
                <legend>
                    <img style="height: 150px; width: 150px;" src="{{URL::to('/public')}}/uploads/users/{{ $user->vendor_image }}">

                    My Profile</legend>
                <h4>First Name: {{$user->vendor_f_name}}</h4>
                <h4>Last Name: {{$user->vendor_l_name}}</h4>
                <h4>Email: {{$user->vendor_email}}</h4>
                <h4>Phone : {{$user->vendor_phone}}</h4>
                <h4>Address : {{$user->vendor_address}}</h4>
            </div>
        </div>
    </div>
</div>

@endsection