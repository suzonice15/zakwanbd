@extends('layouts.master')
@section('pageTitle')
    Update Mail Setting
@endsection
@section('mainContent')

<div class="box-body">
        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/social/smtpAdd') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Smtp Mail Information</h3>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Smtp Driver</label>
                            <input type="text" class="form-control" name="driver" id="" value="{{$mailInfo->driver}}">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Smtp Host</label>
                            <input type="text" class="form-control" name="host" id="" value="{{$mailInfo->host}}">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Smtp Port</label>
                            <input type="text" class="form-control" name="port" id="" value="{{$mailInfo->port}}">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Smtp UserName</label>
                            <input type="text" class="form-control" name="username" id="" value="{{$mailInfo->username}}">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Smtp Password</label>
                            <input type="text" class="form-control" name="password" id="" value="{{$mailInfo->password}}">
                        </div>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Smtp Encryption</label>
                            <input type="text" class="form-control" name="encryption" id="" value="{{$mailInfo->encryption}}">
                            <input type="hidden" name="id" value="{{$mailInfo->id}}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>
                </div>

            </form>
        </div>
</div>

@endsection