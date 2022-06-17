@extends('layouts.master')
@section('pageTitle')
    Income History
@endsection
@section('mainContent')
    <div class="box-body">

        <br/>

        <div class="container">

            <div class="row">

                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" id="serach" placeholder="Enter  Name or Email or Phone">

                </div>
            </div>

        </div>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Purchase Amount</th>
                    <th>Order Id</th>
                    <th>Date</th>


                </tr>
                </thead>
                <tbody>

                @include('admin.affilate.admin_purchaseHistoryPagination')
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
                    url:"{{url('/admin/purchase/history/pagination')}}?page="+page+"&query="+query,
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
    </script>


@endsection

