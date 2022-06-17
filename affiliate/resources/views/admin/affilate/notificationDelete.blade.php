@extends('layouts.master')
@section('pageTitle')
   Product Notification Delete list
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <!-- general form elements -->
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Product Notification Delete Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{url('/')}}/admin/product/notification/delete" method="post">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                             <h3 style="color:red"> {{ Session::get('success') }}</h3>

                             </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" class="form-control" id="exampleInputEmail1" name="date" placeholder="Enter your date" required>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

        </div>


    </div>


@endsection

