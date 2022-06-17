@extends('layouts.master')
@section('pageTitle')
    Changed Password
@endsection
@section('mainContent')

    <div class="box-body">

        <div class="row">
            <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form onsubmit ="return verifyPassword()" method="POST" action="{{url('channedPassword')}}" enctype="multipart/form-data">
                                @csrf
@if(isset($success))
                                <div class="alert alert-success" role="alert">
 {{$success}}
</div>
@endif
                                <div class="form-group">
                                    <label for="username">Old Password:</label>
                                    <input type="password" name="old_password" value="" class="form-control"
                                           id="old_password" placeholder="Old Password">
                                </div>

                                <div class="form-group">
                                    <label for="username">New Password:</label>
                                    <input type="password" name="new_password" value="" class="form-control"
                                           id="new_password" placeholder="New  Password">
                                </div>
                                <div class="form-group">
                                    <label for="username">Confirm Password:</label>
                                    <input type="password" name="confirm_password" value="" class="form-control"
                                           id="confirm_password" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-success">Update </button>
                                </div>
                                <div>
                                    <p id="message" style="color:red"></p>
                                </div>
                            </form>
                        </div>
                    </div>

            </div>

        </div>


    </div>

    <script>
        function verifyPassword() {

            var pw = document.getElementById("new_password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            //check empty password field
            if(pw == "") {
                document.getElementById("message").innerHTML = "**Fill the password please!";
                return false;
            }
            if(pw != confirm_password) {
                document.getElementById("message").innerHTML = "** New Password    and Confirm Password does not matched";
                return false;
            } 
            return true;
 
        }
    </script>


@endsection
