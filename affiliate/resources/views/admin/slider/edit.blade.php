@extends('layouts.master')
@section('pageTitle')
   Update Slider
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
            <form action="{{ url('admin/slider/update') }}/{{ $slider->homeslider_id }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Slider Information</h3>
                    </div>
                <div class="row">
                    <div class="col-md-7 col-sm-12" style="margin-left: 25px">
                        <div class="form-group">
                            <label for="category_title">Slider Name<span class="required">*</span></label>
                            <input required type="text" id="homeslider_title" class="form-control the_title"
                                   name="homeslider_title" value="{{$slider->homeslider_title}}">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group ">
                            <label for="category_name">Slider Parmalink<span class="required">*</span></label>
                            <input required type="text" class="form-control the_name" id="target_url"
                                   name="target_url"
                                   value="{{$slider->target_url}}">

                        </div>



                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-4 col-sm-12" style="margin-left: 10px">


                        <div class="form-group">
                            <label for="billing_name">Published Status<span class="text-danger">*</span></label>
                            <select name="status" id="payment_type" class="form-control">
                                <option value="1" <?php if($slider->status==1){ echo 'selected';}?> >Published</option>
                                <option value="0"  <?php if($slider->status==0){ echo 'selected';}?> >Unpublished</option>
                            </select>
                        </div>

                        <div class="form-group featured-image">
                            <label>Slider Picture(1300*400)</label>
                            <input type="file" class="form-control" name="slider_picture">

                        </div>
                        <!-- /.form-group -->
                    </div>

                    <img style="margin-left:20px" src="{{URL::to('/public')}}/uploads/sliders/{{$slider->homeslider_picture}}" width="200" height="50"/>
<input type="hidden" name="old_picture" value="{{$slider->homeslider_picture}}">

                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-right" value="Update">

                </div>
                </div>




            </form>
        </div>
    </div>





@endsection


