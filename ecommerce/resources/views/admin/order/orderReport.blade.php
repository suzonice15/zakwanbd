@extends('layouts.master')
@section('pageTitle')
    Order Report
@endsection
@section('mainContent')
    <div class="row">

        <div class="col-md-5">
            <div class="box">

                <div class="box-body">
                    <!-- Date -->
                    <div class="form-group">
                        <label>Month</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" id="month" class="form-control datepicker pull-right" >
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>

        <div class="col-md-5">
            <div class="box">

                <div class="box-body">
                    <!-- Date -->
                    <div class="form-group">
                        <label>Day</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text"  id="day"  class="form-control datepicker pull-right" >
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <div class="col-md-2">
            <div class="box">

                <div class="box-body">
                    <!-- Date -->
                    <div class="form-group">
                        <label></label>

                        <div class="input-group date">

                            <button type="button" id="submit" class="form-control btn btn-success" >Submit</button>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <!-- /.col (right) -->
    </div>




    <?php

    if(session::get('status')=='super-admin' || session::get('status')=='admin'){
    ?>
    <span class="order-report">

    @include('admin.order.orderReportView')

</span>
    <?php } ?>



    <script>
        $(document).ready(function(){


            function fetch_data(month,day)
            {
                $.ajax({
                    method:"post",
                    url:"{{url('admin/order/report')}}",
                    data:{
                        month:month,
                        day:day,
                        "_token":"{{csrf_token()}}"
                    },
                    success:function(data)
                    {
                        console.log(data)
                         $('.order-report').html(data);
                    }
                })
            }




            $(document).on('click', '#submit', function(event){
              var month= $("#month").val();
              var day= $("#day").val();

                fetch_data(month,day);
            });
        });
    </script>



@endsection

