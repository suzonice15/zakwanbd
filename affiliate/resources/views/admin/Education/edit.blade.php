@extends('layouts.master')
@section('pageTitle')
   Update Education Details
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        <div class="col-sm-offset-0 col-md-12">
            <form action="{{ url('admin/education/update') }}/{{ $education->id }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Page  Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                                
                            <div class="col-md-11 col-sm-12" style="margin-left: 10px">
                            	<div class="form-group ">
	                                <label for="category_name">Education Type*</label>
					                <select class="form-control" required="" name="education_type">
					                  <option <?php if($education->education_type == 'Text') {echo "selected";} ?> value="Text">Text</option>
					                  <option <?php if($education->education_type == 'Youtube') {echo "selected";} ?> value="Youtube">Youtube Vedio</option>
					                  <option <?php if($education->education_type == 'Facebook') {echo "selected";} ?> value="Facebook">Facebook Vedio</option>
					                </select>
	                            </div>
                                <div class="form-group ">
                                    <label for="category_name">Education Details or Vedio Link*</label>

                                    <textarea   class="form-control ckeditor" rows="10" name="education_details"
                                                id="page_content">{{$education->education_details}}</textarea>
                                </div>

                                <div class="box-footer">
                                    <input type="submit" class="btn btn-success pull-right" value="Update">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection