@extends('layouts.master')
@section('pageTitle')
    Update Social Media Information
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/social/setting') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Social Media  Information</h3>
                    </div>
                    <div class="box-body" style="padding: 29px;">
                        <div class="form-group ">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" name="facebook" id="facebook" value="<?=get_option('facebook')?>">
                        </div>
                        <div class="form-group ">
                            <label for="youtube">YouTube</label>
                            <input type="text" class="form-control" name="youtube" id="youtube" value="<?=get_option('youtube')?>">
                        </div>


                        <div class="form-group ">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" name="twitter" id="twitter" value="<?=get_option('twitter')?>">
                        </div>


                        <div class="form-group">
                            <label for="instagram">Linkind</label>
                            <input type="text" class="form-control" name="linked" id="instagram" value="<?=get_option('linked')?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-right">Update</button>
                    </div>

                </div>


            </form>



        </div>
    </div>




@endsection


