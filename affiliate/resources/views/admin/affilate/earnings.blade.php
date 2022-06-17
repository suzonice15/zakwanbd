@extends('layouts.master')
@section('pageTitle')
    My   Earning History  
@endsection
@section('mainContent')
    <div class="box-body">


        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Order Id </th>
                    <th>Source User</th>
                    <th>My Commision </th>
                    <th>Date</th>
                    <th>Product View</th>                  
                </tr>
                </thead>
                <tbody>

                @include('admin.affilate.earnings_pagination')
                </tbody>

            </table>

        </div>



        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>


    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Product View</h4>
                </div>
                <div class="modal-body" id="orderView">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script>
        $(document).ready(function(){


            $(document).on('click','.permission_id',function () {

             var order_id=$(this).data('order_id');
            if(order_id){
                $.ajax({
                    url:"{{url('/')}}/order/product/show?order_id="+order_id,
                    method:"GET",
                    success:function (data) {

                        $('#orderView').html('');
                        $('#orderView').html(data);

                    }
                })
            }
            });
            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/affilite/earning/pagination')}}?page="+page+"&query="+query,
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

