@extends('layouts.master')
@section('pageTitle')
    Role List
@endsection
@section('mainContent')
<div class="box-body">
    
    <br/>
    <br/>
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Role Name</th> 
                <th> Created date </th>
                <th >Action </th>
            </tr>
            </thead>
            <tbody>
                @foreach($roles as $key=>$role)
                <tr>
                <td>{{++$key}}</td>
            <td>{{$role->role_name }}</td>  
            <td>{{date("d-m-Y",strtotime($role->created_at))}} </td>
            <td>
                    <a title="edit" target="_blank" href="{{url('/')}}/admin/role/{{$role->id}}/edit">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
                  </td>
            <td>
@endforeach

              
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

