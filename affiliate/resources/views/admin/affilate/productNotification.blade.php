@extends('layouts.master')
@section('pageTitle')
   Product Notification lists
@endsection
@section('mainContent')
    <div class="box-body">

        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Product Photo</th>
                    <th>Product Name</th>
                    <th>Previous Price</th>
                    <th>Current Price</th>
                    <th>Price Variation</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>

                @include('admin.affilate.pagination_productNotification')
                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>


    <script>
        $(document).ready(function(){

            function productSeen($notification_id) {
                alert($notification_id)

            }



        });
    </script>

    <script>
        $(document).ready(function(){


            $(document).on('click', '.notification', function(){
               let notification_id=this.id;
                if(notification_id){
                    $.ajax({
                        type:"GET",
                        url:"{{url('user/affilite/notification/seen')}}/"+notification_id,
                        success:function(data)
                        {
                            $('tbody').html('');
                            $('tbody').html(data);
                        }
                    })
                }
            });

            function fetch_data(page)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('user/product/notification/pagination')}}?page="+page,
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }



            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);

                fetch_data(page);
            });

        });
    </script>


@endsection

