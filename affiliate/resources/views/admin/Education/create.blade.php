@extends('layouts.master')
@section('pageTitle')
    Add New Education Details
    @endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">

            <form action="{{ url('admin/education/store') }}" class="form-horizontal" method="post"
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
					                  <option selected="" value="Text">Text</option>
					                  <option value="Youtube">Youtube Vedio</option>
					                  <option value="Facebook">Facebook Vedio</option>
					                </select>
	                            </div>
	                            <div class="form-group ">
	                                <label for="category_name">Education Details or Vedio Link*</label>

	                                <textarea class="form-control ckeditor" rows="10" name="education_details" required="" id="page_content"></textarea>
	                            </div>

                                <div class="box-footer">
                                    <input type="submit" class="btn btn-success pull-right" value="Save">

                                </div>
                            </div>




                    </div>
                    </div>

                    <!-- /.box-body -->

                </div>





            </form>

        </div>
    </div>

@endsection


