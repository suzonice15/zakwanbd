@extends('layouts.master')
@section('pageTitle')
    Vendor Published Product List
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row">
            <div class="col-md-2">
                <a href="{{url('/admin/product/create')}}" class="form-control btn btn-success">
                    Add New Product

                </a>      </div>

            <div class="col-md-5  pull-right">
                <input type="text" id="serach" name="search" placeholder="Search Product By Product Code Or Product Name" class="form-control" >
            </div>
        </div>
        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>

                    <th>Product Code</th>
                    <th>Product</th>
                    <th>Purchase Price</th>
                    <th>Sell Price</th>
                    <th>Discount Price</th>
                    <th>Sohojbuy Commision </th>
                    <th>Reject Note </th>
                    <th>Published Status</th>
                    <th>Registration date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @include('admin.vendor.published_pagination')
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
                    url:"{{url('admin/vendor/published/products/pagination')}}?page="+page+"&query="+query,
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

