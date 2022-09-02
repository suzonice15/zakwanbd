@extends('layouts.master')
@section('pageTitle')
    Profile View
@endsection
@section('mainContent')

    <div class="box-body">

        <div class="row">
            <div class="col-md-7">
                <div class="well well-sm">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="POST" action="{{url('profile')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Name:</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control"
                                           id="name" placeholder="Name">
                                    <input type="hidden" name="id" value="{{$user->id}}" class="form-control" id="name"
                                           placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="username">Phone:</label>
                                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control"
                                           id="phone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <label for="username">Email:</label>
                                    <input type="text" name="email" value="{{$user->email}}" class="form-control"
                                           id="phone" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="username">National ID:</label>
                                    <input type="text" name="nation_id_number" value="{{$user->nation_id_number}}"
                                           class="form-control" id="nation_id_number" placeholder="national id">
                                </div>
                                <div class="form-group">
                                    <label for="username">Country:</label>
                                    <input type="text" name="country" value="Bangladesh" class="form-control"
                                           id="country" placeholder="country">
                                </div>

                                <div class="form-group">
                                    <label for="username">City:</label>
                                    <input type="text" name="city" value="{{$user->city}}" class="form-control"
                                           id="city" placeholder="city">
                                </div>
                                <div class="form-group">
                                    <label for="username">Post Code:</label>
                                    <input type="text" name="post_code" value="{{$user->post_code}}"
                                           class="form-control" id="post_code" placeholder="Post Code">
                                </div>
                                <div class="form-group">
                                    <label for="username">Address:</label>
                                    <textarea class="form-control" name="address"
                                              placeholder="address">{{$user->address}}</textarea>
                                </div>

                                <div style="text-align: center;background: #ddd;padding: 7px;margin-top: -13px;width: 100%;margin-top: 5px;font-weight:bold">Nominee Information:</div>
                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">


                                    <div class="form-group">
                                        <label for="username">Nominee Name:</label>
                                        <input type="text" name="nominee_name" value="{{$user->nominee_name}}" class="form-control" id="nominee_name"
                                               placeholder="Nominee Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Nominee Mobile:</label>
                                        <input type="text" name="nominee_phone" value="{{$user->nominee_phone}}" class="form-control" id="nominee_phone"
                                               placeholder="Nominee Mobile">
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Nominee Relation:</label>
                                        <input type="text" name="nominee_relation" class="form-control"
                                               id="nominee_relation" value="{{$user->nominee_relation}}"  placeholder="Nominee Relation">
                                    </div>
                                    <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                        <label for="username">Nominee Picture:</label>
                                        <input type="file" name="nominee_national_id" class="form-control">
                                        @if($user->nominee_national_id)
                                            <img class="img-responsive"
                                                 src="{{url('/')}}/public/uploads/{{$user->nominee_national_id}}">
                                        @endif
                                    </div>

                                </div>


                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    @if($user->reject_note)
                                        <p style="font-weight: bold">Rejected Note</p>
                                        <p style="color:red">{{$user->reject_note}}</p>
                                    @endif

                                </div>
                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <label for="username">Picture:</label>
                                    <input type="file" name="picture" class="form-control">
                                    @if($user->picture)
                                        <img class="img-responsive"
                                             src="{{url('/')}}/public/uploads/{{$user->picture}}">
                                    @endif
                                </div>

                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <label for="username">National Id Card:</label>
                                    <input type="file" name="nationalIdPicture" class="form-control">
                                    @if($user->nationalIdPicture)
                                        <img class="img-responsive"
                                             src="{{url('/')}}/public/uploads/{{$user->nationalIdPicture}}">
                                    @endif
                                </div>

                                <div class="form-group" style="border: 1px solid #ddd;padding: 13px;">
                                    <label for="username">Bank Statement/Electric bill/Gas/ Wasa bill Picture:</label>
                                    <input type="file" name="addressVarifiedPicture" class="form-control">
                                    @if($user->addressVarifiedPicture)
                                        <img class="img-responsive"
                                             src="{{url('/')}}/public/uploads/{{$user->addressVarifiedPicture}}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right"
                                           value="Update Profile">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <legend>
                            <img src="{{url('/')}}/public/uploads/{{$user->picture}}">

                            My Profile
                        </legend>
                        <h4>Wallet Balance: {{$user->ewallet_balance}} TK</h4>
                        <h4>Earning Balance: {{$user->earning_balance}} TK</h4>
                        {{--<h4>Shopping Point : {{$user->shopping_point}} SP</h4>--}}
                        <h4>Skill Points : {{$skil_point}} SP</h4>
                        <h4>Bonus: {{$user->bonus_balance}} TK</h4>

                        <div>Name: {{$user->name}}</div>
                        <div>My Account: {{$user->email}}</div>
                        <div>My Referral ID: {{$user->id}}</div>
                        <div>Address: {{$user->address}}</div>
                        <div>Email: {{$user->email}}</div>

                        <?php
                        $referrer_name = DB::table('users_public')
                                ->where('id', '=', $user->parent_id)
                                ->first();
                        ?>
                        <div>Referrer: <?php if ($referrer_name) {
                                echo $referrer_name->name;
                            } else {
                                echo "No Referrer";
                            } ?></div>

                        <div>Created: {{$user->created}}</div>

                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection
