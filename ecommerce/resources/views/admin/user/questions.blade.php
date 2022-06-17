@extends('layouts.master')
@section('pageTitle')
    All Message
@endsection
@section('mainContent')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




    <table   class="table table-striped table-bordered" style="width:100%">
        {{--<input type="search" id="serach" style="width:400px;margin-top: 10px;margin-right: 5px" placeholder="Phone Number" class="form-control pull-right">--}}
        <thead>
        <tr>
            <th>Sl</th>
            <th>Product</th>
            <th>Customer Questions</th>
            <th>Admin Questions</th>
            <th>Status </th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @include('admin.user.questions_pagination')
        </tbody>

    </table>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />


    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/generel/message/pagination')}}?page="+page+"&query="+query,
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



        });
    </script>
@endsection