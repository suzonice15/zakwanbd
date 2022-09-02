@extends('layouts.master')
@section('pageTitle')
    All Orders  List
@endsection
@section('mainContent')
    <style>
        @media (min-width: 1200px){
            .order_status { width: 155px !important; }
        }
        .order_status {
            width: 14%;
            background: #6A00A8;
            font-weight: bold;
            border: none;
            margin: 4px;
        }

        .btn .badge {
            position: relative;
            top: 2px;
            text-align: center;
            float: right;
            color: red;
        }

        @media (max-width: 776px) {
            .order_status {
                width: 48%;
                margin-bottom: 8px;
                background: #6a00a8;
                font-weight: bold;
                border: none;
                margin: 2px;
            }

            .btn .badge {
                position: relative;
                top: 2px;
                text-align: center;
                float: right;
                color: red;
            }
        } </style>


<div class="box-body">
    <div class="row">

         <span id="order_status_view">

<div class="row" style="cursor: pointer;">


    <div class="col-12 col-lg-12 col-xl-12">
        <button onclick="orderStatus('new')" type="button" class="btn btn-primary order_status  "> New <span class="badge badge-light">{{getOrderCount('new')}}</span>
        </button>
 
        <button onclick="orderStatus('processing')" type="button" class="btn btn-primary order_status " style="background: #f9be0c;color:black">  Processing  <span class="badge badge-light" style="color:black">     {{getOrderCount('processing')}}</span>
        </button>
        <button onclick="orderStatus('on_courier')" type="button" class="btn btn-primary order_status " style="background: #f9be0c;color:black;">  Courier  <span class="badge badge-light" style="color:black">     {{getOrderCount('on_courier')}}</span>
        </button>
         
        <button onclick="orderStatus('completed')" type="button" class="btn btn-primary order_status " style="background: green;">  Completed  <span class="badge badge-light">     {{getOrderCount('completed')}}</span>
        </button>
        <button onclick="orderStatus('cancled')" type="button" class="btn btn-primary order_status " style="background: red;">  Cancled  <span class="badge badge-light">     {{getOrderCount('cancled')}}</span>
        </button>
        
        <button onclick="orderStatus('refund')" type="button" class="btn btn-primary order_status " style="background: red;">  Refund  <span class="badge badge-light">     {{getOrderCount('refund')}}</span>
        </button>
        <button onclick="orderStatus('1')" type="button" class="btn btn-primary order_status " style="background: blue;">  All  <span class="badge badge-light">     {{getOrderCount('1')}}</span>
        </button>
        <?php
        $admin_user_status=Session::get('status');
        if($admin_user_status !="office-staff" || $admin_user_status !="editor") {
            ?>

        <!-- <button   type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-exchange" >  <i class="fa fa-exchange"></i>   </button> -->

        <?php } ?>




    </div>


</div></span>


        <div class="col-md-3  col-sm-12">
            <br>
            <input type="text" id="affiliate_id"   name="affiliate_id" placeholder="Search Affiliate Id" class="form-control" >
            <br>
        </div>
        <div class="col-md-3  col-sm-12">
            <br>
            <input type="text" id="product_code"   name="product_code" placeholder="Search Product Code" class="form-control" >
            <br>
        </div>
        <div class="col-md-3  col-sm-12">
            <br>
            <input type="text" id="pagination_search_by_phone"   name="pagination_search_by_phone" placeholder="Search Phone Number" class="form-control" >
            <br>
        </div>

        <div class="col-md-3  col-sm-12">
            <br>
            <input type="text" id="serach"   name="search" placeholder="Search Order Number" class="form-control" >
            <br>
        </div>
    </div>
    <div class="table-responsive">

        <table  class="table table-bordered  ">
            <thead>
            <tr style="background-color: #5f046c;color: white;text-align: center">

                <th width="10%">Order Id  </th>
                <th width="15%">Customer</th>
                <th width="15%">Product</th>
                <th width="20%">Affiliate</th>
                <th width="18%">History</th>
                <th width="10%">Amount</th>
                <th width="5%">Status</th>
                <th width="5%">Actions</th>
            </tr>
            </thead>
            <tbody>
               @include('admin.order.pagination')
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Invoice Print</h4>
                </div>
                <div class="modal-body"   id="orderModalPrint">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
    <div class="modal fade" id="modal-exchange">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Order Exchange To Other Stuff </h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{url('/')}}/order/exchange">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="staff_id">Stuff  Name</label>
                                <select name="staff_id"  id="staff_id" required class="form-control">
                                    <option value="">Select Option</option>
                                    @foreach($stuffInfo as $stuff)
                                    <option value="{{$stuff->admin_id}}">{{$stuff->name}}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" id="exchange_now" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                 </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="status" id="status" value="{{$order_status}}" />
</div>
<script>
    $("#exchange_now").click(function () {
      var staff_id=  $("#staff_id").val()
        var order_id = new Array();
        $('.checkAll').each(function () {
            if ($(this).is(":checked")) {
                order_id.push(this.value);
            }
        });
        if (order_id.length > 0 && staff_id !='') {
            $.ajax({
                url: '{{url('/')}}/admin/orderExchange',
                data: {
                    order_id: order_id,
                    staff_id: $("#staff_id").val(),
                    "_token": "{{ csrf_token() }}"
                },
                type: 'post',
                success: function (data) {
                    console.log(data)
                  alert("Successfully Done")
                }
            });
        } else {
            alert("Please select Order Id / Stuff")
        }
    });

    $(document).on("change", "#checkAll", function (event) {
        if ($(this).is(":checked")) {
            $('.checkAll').prop('checked', true);

        } else if ($(this).is(":not(:checked)")) {
            $('.checkAll').prop('checked', false);
        }

    });
    function orderStatus(status) {
        $('#status').val(status);
        let page = 1;
        fetch_data(page, status);
    }
    function fetch_data(page,status)
    {
        $.ajax({
            type:"GET",
            url:"{{url('order/pagination')}}?page="+page+"&status="+status,
            success:function(data)
            {
                $('tbody').html('');
                $('tbody').html(data);
            }
        })
    }
    $(document).ready(function(){


        function fetch_data_search(page,query)
        {
            $.ajax({
                type:"GET",
                url:"{{url('order/pagination_by_search')}}?page="+page+"&query="+query,
                success:function(data)
                {
                    $('tbody').html('');
                    $('tbody').html(data);
                }
            })
        }

        function pagination_search_by_affiliate_id(page,query)
        {
            $.ajax({
                type:"GET",
                url:"{{url('order/pagination_search_by_affiliate_id')}}?page="+page+"&query="+query,
                success:function(data)
                {
                    $('tbody').html('');
                    $('tbody').html(data);
                }
            })
        }
        function pagination_search_by_phone(page,query)
        {
            $.ajax({
                type:"GET",
                url:"{{url('order/pagination_search_by_phone')}}?page="+page+"&query="+query,
                success:function(data)
                {
                    $('tbody').html('');
                    $('tbody').html(data);
                }
            })
        }
        function pagination_search_by_product_code(page,query)
        {
            $.ajax({
                type:"GET",
                url:"{{url('order/pagination_search_by_product_code')}}?page="+page+"&query="+query,

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
            var status = $('#status').val();
            if(query.length >0) {
                fetch_data_search(page,query);
            } else {
                fetch_data_search(1, '');
            }
        });
        $(document).on('keyup input', '#affiliate_id', function(){
            var query = $('#affiliate_id').val();
            var page = $('#hidden_page').val();
            var status = $('#status').val();
            if(query.length >0) {
                pagination_search_by_affiliate_id(page,query);
            } else {
                fetch_data_search(1, '');
            }
        });
        $(document).on('keyup input', '#product_code', function(){
            var query = $('#product_code').val();
            var page = $('#hidden_page').val();
            var status = $('#status').val();
            if(query.length >3) {
                pagination_search_by_product_code(page,query);
            } else {
                pagination_search_by_product_code(1, '');
            }
        });
        $(document).on('keyup input', '#pagination_search_by_phone', function(){
            var query = $('#pagination_search_by_phone').val();
            var page = $('#hidden_page').val();
            var status = $('#status').val();
            if(query.length >7) {
                pagination_search_by_phone(page,query);
            } else {
                pagination_search_by_phone(1, '');
            }
        });
        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
         var status=$('#status').val();
            fetch_data(page,status);
                });




    });
</script>


@endsection

