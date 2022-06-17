@extends('layouts.master')
@section('pageTitle')
    Add New Mission
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        <form action="{{ url('admin/coin/setting/create') }}" class="form-horizontal" method="post"
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
                                       name="coin_title" value="">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group ">
                                <label for="coin_description">Description<span class="required">*</span></label>
                                <input required type="text" class="form-control the_name" id="coin_description"
                                       name="coin_description"
                                       value="">

                            </div>
                            <div class="form-group ">
                                <label for="coin_link">Link<span class="required">*</span></label>
                                <input required type="text" class="form-control" id="coin_link"   name="coin_link"     value="">
                            </div>

                            <div class="form-group ">
                                <label for="coin_link">Picture<span class="required">*</span></label>
                                <input required type="file" class="form-control" id="coin_icon"   name="coin_icon"  >
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


