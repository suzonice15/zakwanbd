@extends('layouts.master')
@section('pageTitle')
 Affiliate Complain
@endsection
@section('mainContent')
    <div class="box-body">



        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th> Phone</th>
                    <th>Complain Name</th>
                    <th>Complain Answer</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @include('admin.affilate.affiliateComplain_admin_pagination')
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
                    url:"{{url('admin/affilite/complain/pagination')}}?page="+page+"&query="+query,
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

