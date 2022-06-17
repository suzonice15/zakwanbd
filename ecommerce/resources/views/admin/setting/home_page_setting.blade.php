@extends('layouts.master')
@section('pageTitle')
    Update Home Page Website Information
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <form action="{{ url('admin/homepage/setting') }}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="box" style="border: 2px solid #ddd;">
                <div class="box-header with-border" style="background-color: green;color:white;">
                    <h3 class="box-title">Website Home Page   Information</h3>
                </div>
                <div class="box-body" style="padding: 22px;">
                    <div class="form-group">
                        <label for="home_cat_section">Home Category Section</label>
                        <input type="text" class="form-control" name="home_cat_section" id="home_cat_section" value="<?=get_option('home_cat_section')?>">
                    </div>

                    <div class="form-group">
                        <label for="home_share_image">Home Page Share Image</label>
                        <input type="text" class="form-control" name="home_share_image" id="home_share_image" value="<?=get_option('home_share_image')?>">
                    </div>




                            <div class="form-group">
                                <label for="home_seo_title">Seo Title</label>
                                <input type="text" class="form-control" name="home_seo_title" id="home_seo_title" value="<?=get_option('home_seo_title')?>">
                            </div>


                            <div class="form-group">
                                <label for="home_seo_content">Meta Descripiton</label>
                                <textarea class="form-control" rows="5" name="home_seo_content"><?=get_option('home_seo_content')?></textarea>
                            </div>

                            <div class="form-group ">
                                <label for="home_seo_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" name="home_seo_keywords" id="home_seo_keywords" value="<?=get_option('home_seo_keywords')?>">
                            </div>




                        </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Update</button>
                </div>

            </div>







        </form>

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


