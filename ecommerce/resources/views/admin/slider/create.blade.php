@extends('layouts.master')
@section('pageTitle')
    Add New Slider
    @endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">

            <form action="{{ url('admin/slider/store') }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Slider Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-7 col-sm-12" style="margin-left: 10px">
                                <div class="form-group">
                                    <label for="category_title">Slider Name<span class="required">*</span></label>
                                    <input required type="text" id="homeslider_title" class="form-control the_title"
                                           name="homeslider_title" value="">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group ">
                                    <label for="category_name">Slider Parmalink<span class="required">*</span></label>
                                    <input required type="text" class="form-control the_name" id="target_url"
                                           name="target_url"
                                           value="">

                                </div>



                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-4 col-sm-12" style="margin-left: 10px">


                                <div class="form-group">
                                    <label for="billing_name">Published Status<span class="text-danger">*</span></label>
                                    <select name="status" id="payment_type" class="form-control">
                                        <option value="1" style="background-color: red;">Published</option>
                                        <option value="0">Unpublished</option>
                                    </select>
                                </div>

                                <div class="form-group featured-image">
                                    <label>Slider Picture(1300 * 400)</label>
                                    <input type="file" class="form-control" name="slider_picture">

                                </div>
                                <!-- /.form-group -->
                            </div>

                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success pull-right" value="Save">

                        </div>

                    </div>

                    <!-- /.box-body -->

                </div>





            </form>

        </div>
    </div>

@endsection


