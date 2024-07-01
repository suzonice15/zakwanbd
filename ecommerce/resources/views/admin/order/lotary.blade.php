@extends('layouts.master')
@section('pageTitle')
    Lotary Result Published
@endsection
@section('mainContent')
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
            <form name="category" action="{{url('/')}}/admin/lotary/success" class="form-horizontal" method="post" enctype="multipart/form-data">

                @csrf

                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title"> Lotary Result Published</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 28px;">


                        <div class="form-group ">
                            <label for="default_product_terms">Promosion Order Result Published</label>
                            <select class="form-control" name="promosion_offer_published">
                                <option>Select</option>
                                <option value="1" >Published</option>

                            </select>
                        </div>

                    </div>
                </div>




                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update">

                </div>
            </form>



        </div>
    </div>
@endsection

