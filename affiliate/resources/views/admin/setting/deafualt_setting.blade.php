@extends('layouts.master')
@section('pageTitle')
    Update Default Website Information
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/default/setting')  }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">Default Website  Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 28px;">
                        <div class="form-group ">
                            <label for="site_title">Site Title</label>
                            <input type="text" class="form-control" name="site_title" id="site_title"
                                   value="<?= get_option('site_title') ?>">
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Master Password</label>
                                       <input type="password" class="form-control" name="master_password" id="master_password"
                                   value="<?= get_option('master_password') ?>">
                        </div>





                        <div class="form-group ">
                            <label for="notice">Login Page Notice </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="notice"><?=get_option('notice')?></textarea>
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Affiliate Dashboard Notice</label>
                            <textarea class="form-control ckeditor" rows="10"
                                      name="dashboard_notice"><?=get_option('dashboard_notice')?></textarea>
                        </div>

                    </div>
                </div>




                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update">

                </div>
            </form>


            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("#category_title").on('input click', function () {
                var text = $("#category_title").val();
                var _token = $("input[name='_token']").val();

                var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $("#category_name").val(word);
                $.ajax({
                    data: {url: word, _token: _token},
                    type: "POST",
                    url: "{{url('category-urlcheck')}}",
                    success: function (result) {

                        // $('#categoryError').html(result);
                        var str2 = "es";
                        var word = $("#category_name").val(word);
                        if (result) {
                            var text = $("#category_title").val();
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            var word = word.concat(str2);
                            $("#category_name").val(word);

                        } else {
                            var text = $("#category_title").val();
                            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                            $("#category_name").val(word);
                        }
                    }
                });
            });


        });
    </script>




@endsection


