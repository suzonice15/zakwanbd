@extends('layouts.master')
@section('pageTitle')
    All Message
    @endsection
@section('mainContent')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




<table   class="table table-striped table-bordered" style="width:100%">
    <input type="search" id="serach" style="width:400px;margin-top: 10px;margin-right: 5px" placeholder="Phone Number" class="form-control pull-right">
    <thead>
        <tr>
            <th>Phone Number</th>
            <th>Message</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    	@include('admin.user.message_pagination')
    </tbody>
   
</table>
<input type="hidden" name="hidden_page" id="hidden_page" value="1" />

<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script type="">
    
    $(".dltVideo").click(function(){

                 var element=$(this);
                 var id = element.attr("id");
                 var APP_URL = $('meta[name="_base_url"]').attr('content');
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                 swal({
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this  file!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {

                        
                         jQuery.ajax({
                            url: APP_URL+'/admin/generel/messageDelete',
                            method: 'post',
                            data:{id:id},
                            success: function(result){


                                location.reload(true);
                            },
                              error: function() {
                                alert('Error occurs!');
                             }
                        });



                    swal("Poof! Your  file has been deleted!", {
                      icon: "success",
                    });
                  } else {
                    swal("Your  file is safe!");
                  }
                });
            })
</script>
<script>
    $(document).ready(function(){

        function fetch_data(page, query)
        {
            $.ajax({
                type:"GET",
                url:"{{url('admin/generel/message/pagination')}}?page="+page+"&query="+query,
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



    });
</script>
@endsection