@extends('layouts.master')
@section('pageTitle')
   Update Sponsor Information
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">
            <form  name="category" action="{{ url('admin/sponsor')}}" class="form-horizontal"
                   method="post"
                   enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title"> Update Sponsor Information </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="padding: 28px;">



                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 1  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_1">{{$sponsor->sponsor_1}}</textarea>
                        </div>



                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 2  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_2">{{$sponsor->sponsor_2}}</textarea>
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 3  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_3">{{$sponsor->sponsor_3}}</textarea>
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 4  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_4">{{$sponsor->sponsor_4}}</textarea>
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 5  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_5">{{$sponsor->sponsor_5}}</textarea>
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 6  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_6">{{$sponsor->sponsor_6}}</textarea>
                        </div>


                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor 7  </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_7">{{$sponsor->sponsor_7}}</textarea>
                        </div>

                        <div class="form-group ">
                            <label for="default_product_terms">Sponsor Advertisement </label>
                            <textarea class="form-control ckeditor" rows="2"
                                      name="sponsor_add">{{$sponsor->sponsor_add}}</textarea>
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


