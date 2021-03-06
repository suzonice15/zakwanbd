@extends('layouts.master')
@section('pageTitle')
   My Referrals  List({{$totals}})
@endsection


<style>

    tr {
        border: 1px solid #1D96B2;
    }

   .table thead th {
        border: 1px solid #1D96B2;
        border: 1px solid #fff;
       text-align: center;
    }

    .table tbody td {
        border: 1px solid #1D96B2 !important;
        height: 50px;
        font-size: 17px;
        color: #000;
        text-align: left;
    }

    thead {
        background-color: #1d96b2;
        color: #fff
    }
</style>
@section('mainContent')
<div class="box-body">
    <div class="row">
        <div class="col-md-5  pull-right">
            <input type="text" id="serach" name="search" placeholder="Search Referral" class="form-control" >
        </div>
    </div>
    <br/>
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Created Date</th>
                <th>Personal Sales</th>
                <th>Team Sales</th>
            </tr>
            </thead>
            <tbody>

               @include('admin.affilate.myreferrel_pagination')
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
                url:"{{url('admin/affilite/myreferrel/pagination')}}?page="+page+"&query="+query,
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

