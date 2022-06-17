@extends('layouts.master')
@section('pageTitle')
    All Media Users List
@endsection
@section('mainContent')
<div class="box-body">
    <div class="row">
        <div class="col-md-4  pull-right">
            <input type="text" id="serach" name="search" placeholder="Search category" class="form-control" >
        </div>
    </div>
    <div class="table-responsive">

        <table  class="table table-bordered table-striped ">
            <thead>
            <tr>
                <th width="2%">Sl</th>
                <th width="15%">Media Name</th>
                <th width="3%">Product Code</th>
                <th width="3%">Image</th>
                <th width="20%">Image Path</th>
                <th width="10%">Created date </th>
                <th width="3%">Action </th>
            </tr>
            </thead>
            <tbody>
               @include('admin.media.pagination')
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
                url:"{{url('media/pagination/fetch_data')}}?page="+page+"&query="+query,
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


<script>
    $(document).ready(function(){



            $(document).on("click", ".copy_class", function(event){
                var  id= this.id;
                var  picture_id= document.getElementById("url_"+id);

                     picture_id.select();
                    document.execCommand('copy');
                  document.execCommand("copy");

        });




    });
</script>





@endsection

