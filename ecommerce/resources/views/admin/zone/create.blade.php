@extends('layouts.master')
@section('pageTitle')
    Add New Category
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        @if (count($errors) > 0)
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    @foreach ($errors->all() as $error)

                        <li style="list-style: none">{{ $error }}</li>

                    @endforeach

                </ul>
            </div>
        @endif


        <form action="{{ url('admin/zone') }}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="box" style="border: 2px solid #ddd;">
                <div class="box-header with-border" style="background-color: green;color:white;">
                    <h3 class="box-title">Zone Information</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5 col-sm-12" style="margin-left: 10px">
                            <div class="form-group">
                                <label for="zone_name">Zone Name<span class="required">*</span></label>
                                <input required type="text" id="zone_name" class="form-control  "
                                       name="zone_name" value="">
                            </div>
                            
                            <!-- /.form-group -->
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


