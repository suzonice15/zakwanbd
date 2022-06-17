@extends('layouts.master')
@section('pageTitle')
    Affiliate Material


@endsection
@section('mainContent')
    <div class="box-body">

        <br/>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="serach" placeholder="Enter Affiliate Name Or Mail Or Phone">

                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table  id="main_table" class="table table-bordered table-striped">
                <thead>
                <tr> <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @include('admin.affilate.marketingMetarialPagination')
                </tbody>
            </table>
        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>




    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/marketing/metarial/pagination')}}?page="+page+"&query="+query,
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serach', function(){
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                if(query.length >0) {
                    fetch_data(page, query);
                } else {
                    fetch_data(1, '');
                }
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                fetch_data(page, query);
            });

        });




        $(document).on('click', '.marketingMetarialClass', function(){
            var affilite_id=  $(this).attr("data-id");
             if(affilite_id) {


                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/affilite/metarial/show')}}?affilite_id=" + affilite_id,
                    success: function (data) {

                        $('.affilite_details_id').empty();
                        $('.affilite_details_id').html(data);
                    }
                })
            }

        });

        </script>


@endsection

