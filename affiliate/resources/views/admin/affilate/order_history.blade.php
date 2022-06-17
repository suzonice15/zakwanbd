@extends('layouts.master')
@section('pageTitle')
    Purchase History
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row">


        <div class="col-md-12 col-lg-12 col-sm-12 text-center justify-content-center">

            <style>
                .status_check{
                    text-transform: capitalize;
                    margin-bottom: 5px;
                }
               .order_count{
                    margin-left: 10px !important;
                    top: 3px !important;
                }
            </style>

            <button type="button" class="btn btn-success status_check" id="new" >new   <small class="label pull-right bg-red order_count">{{$new}}</small></button>
             <button type="button" class="btn btn-success status_check" id="phone_pending"  style="background-color: rgb(60, 141, 188);background: #e6e64f;border: none;color: black;" >Phone Pending   <small class="label pull-right bg-red order_count">{{$phone_pending}}</small></button>
             <button type="button" class="btn btn-primary status_check" id="processing" >processing   <small class="label pull-right bg-red order_count">{{$processing}}</small></button>
             <button type="button" class="btn btn-info status_check" id="courier" >courier   <small class="label pull-right bg-red order_count">{{$courier}}</small></button>
             <button type="button" class="btn btn-success status_check" id="delivered" >delivered   <small class="label pull-right bg-red order_count">{{$delivered}}</small></button>
             <button type="button" class="btn btn-danger status_check" id="refund"  >refund   <small class="label pull-right bg-red order_count">{{$refund}}</small></button>
             <button type="button" class="btn btn-success status_check" id="completed" >completed   <small class="label pull-right bg-red order_count">{{$completed}}</small></button>
             <button type="button" class="btn btn-danger status_check" id="cancled" >cancled   <small class="label pull-right bg-red order_count">{{$cancled}}</small></button>
             <button type="button" class="btn btn-danger status_check" id="failed" >failed    <small class="label pull-right bg-red order_count">{{$failed}}</small></button>

        </div>
    </div>
        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Last Product</th>
                    <th>Quantity</th>
                    <th style="width: 10%">Amount</th>
                    <th>Order Note</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @include('admin.affilate.order_history_pagination')
                </tbody>

            </table>

        </div>

        <div class="modal fade" id="orderEditModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Order Edit History </h4>
                    </div>
                    <div class="modal-body ordereditshow" >

                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />


    </div>

    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/affilite/orderhistoryPagination')}}?page="+page+"&query="+query,
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            function fetch_data_by_status(status)
            {
                $.ajax({
                    type:"GET",
                    {{--url:"{{url('order/pagination')}}?page="+page+"&query="+query+"&status="+status,--}}
                    url:"{{url('order/paginationByOrderStatus')}}?status="+status,
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

            $(document).on('click', '.status_check', function() { // code


                var status=$(this).attr("id")

//                $(".status_check").css("background-color", "green");
//                $("#"+status).css("background-color", "#3c8dbc");
                if(status=='courier'){
                    status='on_courier';
                }
                //alert(status)
             //   $('#status').val(status);
               // var status=$('#status').val();
//                 if(status=='new'){
//                    $('#new').addClass('btn btn-danger');
//                    $('#pending_payment').rClass('btn btn-success');
//                    $('#phone_pending').addClass('btn btn-success');
//                    $('#processing').addClass('btn btn-success');
//                    $('#on_courier').addClass('btn btn-success');
//                    $('#delivered').addClass('btn btn-success');
//                    $('#completed').addClass('btn btn-success');
//                    $('#cancled').addClass('btn btn-success');
//
//
//                } else if(status=='phone_pending'){
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-success');
//                     $('#phone_pending').addClass('btn btn-danger');
//                     $('#processing').addClass('btn btn-success');
//                     $('#on_courier').addClass('btn btn-success');
//                     $('#delivered').addClass('btn btn-success');
//                     $('#completed').addClass('btn btn-success');
//                     $('#cancled').addClass('btn btn-success');
//                }
//
//                 else if(status=='pending_payment'){
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-danger');
//                     $('#phone_pending').addClass('btn btn-success');
//                     $('#processing').addClass('btn btn-success');
//                     $('#on_courier').addClass('btn btn-success');
//                     $('#delivered').addClass('btn btn-success');
//                     $('#completed').addClass('btn btn-success');
//                     $('#cancled').addClass('btn btn-success');
//                 }
//                 else if(status=='processing'){
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-success');
//                     $('#phone_pending').addClass('btn btn-success');
//                     $('#processing').addClass('btn btn-danger');
//                     $('#on_courier').addClass('btn btn-success');
//                     $('#delivered').addClass('btn btn-success');
//                     $('#completed').addClass('btn btn-success');
//                     $('#cancled').addClass('btn btn-success');
//                 }
//                 else if(status=='on_courier'){
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-success');
//                     $('#phone_pending').addClass('btn btn-success');
//                     $('#processing').addClass('btn btn-success');
//                     $('#on_courier').addClass('btn btn-danger');
//                     $('#delivered').addClass('btn btn-success');
//                     $('#completed').addClass('btn btn-success');
//                     $('#cancled').addClass('btn btn-success');
//                 }
//                 else if(status=='delivered'){
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-success');
//                     $('#phone_pending').addClass('btn btn-success');
//                     $('#processing').addClass('btn btn-success');
//                     $('#on_courier').addClass('btn btn-success');
//                     $('#delivered').addClass('btn btn-danger');
//                     $('#completed').addClass('btn btn-success');
//                     $('#cancled').addClass('btn btn-success');
//                 }
//                 else if(status=='completed'){
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-success');
//                     $('#phone_pending').addClass('btn btn-success');
//                     $('#processing').addClass('btn btn-success');
//                     $('#on_courier').addClass('btn btn-success');
//                     $('#delivered').addClass('btn btn-success');
//                     $('#completed').addClass('btn btn-danger');
//                     $('#cancled').addClass('btn btn-success');
//                 }
//
//                 else  {
//
//                     $('#new').addClass('btn btn-success');
//                     $('#pending_payment').addClass('btn btn-success');
//                     $('#phone_pending').addClass('btn btn-success');
//                     $('#processing').addClass('btn btn-success');
//                     $('#on_courier').addClass('btn btn-success');
//                     $('#delivered').addClass('btn btn-success');
//                     $('#completed').addClass('btn btn-success');
//                     $('#cancled').addClass('btn btn-danger');
//                 }
//
//





                fetch_data_by_status(status);


            })





        });
    </script>

@endsection

