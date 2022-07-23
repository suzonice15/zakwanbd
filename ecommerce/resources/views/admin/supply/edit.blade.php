@extends('layouts.master')
@section('pageTitle')
    Update Suppliyer  Information
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

        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/supply') }}/{{ $supply->id }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                  @method('PUT')
                @csrf
                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Suppliyer Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-md-5 col-sm-12" style="margin-left: 10px">
                           
                           <div class="form-group">
                                  <label for="zone_name">Name<span class="required">*</span></label>
                                  <input required type="text" id="name" class="form-control  "
                                         name="name" value="{{$supply->name}}">
                              </div> 
                              <div class="form-group">
                                  <label for="zone_name">Phone<span class="required">*</span></label>
                                  <input required type="text" id="mobile" class="form-control  "
                                         name="mobile" value="{{$supply->mobile}}">
                              </div>
                              <div class="form-group">
                                  <label for="zone_name">Address <span class="required">*</span></label>
                                  <input required type="text" id="address" class="form-control"
                                         name="address" value="{{$supply->address}}">
                              </div>
                               
                          </div>        
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->

                </div> 

                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update">

                </div>
            </form>


            </form>
        </div>
    </div> 

@endsection


