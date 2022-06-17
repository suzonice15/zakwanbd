@extends('layouts.master')
@section('pageTitle')
    Update Mission
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        <form action="{{ url('admin/coin/setting/') }}/{{$coin->id}}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="box" style="border: 2px solid #ddd;">
                <div class="box-header with-border" style="background-color: green;color:white;">
                    <h3 class="box-title">Mission Information</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12" style="margin-left: 10px">
                            <div class="form-group">
                                <label for="coin_title">Mission Name<span class="required">*</span></label>
                                <input required type="text" id="coin_title" class="form-control  "
                                       name="coin_title" value="{{$coin->coin_title}}">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group ">
                                <label for="coin_description">Description<span class="required">*</span></label>
                                <input required type="text" class="form-control the_name" id="coin_description"
                                       name="coin_description"
                                       value="{{$coin->coin_description}}">

                            </div>
                            <div class="form-group ">
                                <label for="coin_link">Link<span class="required">*</span></label>
                                <input required type="text" class="form-control" id="coin_link"   name="coin_link"     value="{{$coin->coin_link}}">
                            </div>

                            <div class="form-group ">
                                <label for="coin_link">Picture<span class="required">*</span></label>
                                <input   type="file" class="form-control" id="coin_icon"   name="coin_icon"  >

                                <img width="150" src="{{url('/')}}/public/uploads/category/{{$coin->coin_icon}}" class="image-responsive">
                            </div>


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




@endsection


