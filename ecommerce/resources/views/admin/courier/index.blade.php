@extends('layouts.master')
@section('pageTitle')
    All Categoreis Users List
@endsection
@section('mainContent')
<div class="box-body">

    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th>
                <th> Name</th>
                <th> Address</th>

                <th>Action </th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0;?>

            @if($couriers)
                @foreach($couriers as $row)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$row->courier_name}}</td>
                    <td><?php  echo $status= $row->courier_status==1 ? 'Inside Dhaka':'Outside Dhaka';?></td>
                    <td>
                        <a title="edit" href="{{ url('admin/courier') }}/{{ $row->courier_id }}">
                            <span class="glyphicon glyphicon-edit btn btn-success"></span>
                        </a>


                        <a title="delete" href="{{ url('admin/courier/delete') }}/{{ $row->courier_id }}" onclick="return confirm('Are you want to delete this information ')">
                            <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                        </a></td>

                </tr>

                @endforeach
                @endif

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
                url:"{{url('category/pagination/fetch_data')}}?page="+page+"&query="+query,
                success:function(data)
                {
                    $('tbody').html('');
                    $('tbody').html(data);
                }
            })
        }

        $(document).on('keyup', '#serach', function(){
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

