@extends('layouts.master')
@section('pageTitle')
   Online Users ( <span id="total_affilate">{{$affilates_total}}</span>)

@endsection
@section('mainContent')
    <div class="box-body">

        <br/>


        <div class="table-responsive">




            <table  id="main_table" class="table table-bordered table-striped   ">
                <thead>
                <tr>


                    <th>User Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Login Time</th>

                </tr>
                </thead>
                <tbody>




@include('admin.affilate.online_user_ajax')



                </tbody>

            </table>

        </div>



    </div>


    <script>
        $(document).ready(function(){

            function fetch_data()
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/online/ajax')}}",
                    success:function(data)
                    {
                        console.log(data);
                        $('tbody').html('');
                        $('tbody').html(data);
                    },
                    error:function (data) {
                        console.log(data)

                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/online/ajax_total')}}",
                    success:function(data)
                    {
                       $('#total_affilate').text(data);
                    },
                    error:function (data) {


                    }
                });


            }

            setInterval(fetch_data, 160000);


        });
    </script>


@endsection

