@extends('layouts.master')
@section('pageTitle')
    Update Courier
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        

        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/courier/update') }}/{{ $courier->courier_id }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Courier Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-12" style="margin-left: 10px">
                                <div class="form-group">
                                    <label for="category_title">Category Name<span class="required">*</span></label>
                                    <input required="" type="text" id="courier_name" class="form-control the_title"
                                           name="courier_name" value="{{$courier->courier_name}}">
                                </div>

                            </div>

                            <!-- /.col -->
                            <div class="col-md-3 col-sm-12" style="margin-left: 20px">

                                <div class="form-group">
                                    <label for="billing_name">Location<span class="text-danger">*</span></label>
                                    <select name="courier_status" id="courier_status" class="form-control">
                                        <option value="1" >Inside Dhaka</option>
                                        <option value="2" >Outside Dhaka</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-12" style="margin-left: 20px">

                                <div class="form-group">
                                    <label for="billing_name">Location<span class="text-danger">*</span></label>
                                    <select name="active" id="active" class="form-control">
                                        <option value="1" >Active</option>
                                        <option value="0" >In Active </option>

                                    </select>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->

                </div>


              <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update">

                </div>
            </form>



        </div>
    </div>

    <script>

        document.forms['category'].elements['courier_status'].value = "{{ $courier->courier_status }}";
        document.forms['category'].elements['active'].value = "{{ $courier->active }}";


    </script>




@endsection


