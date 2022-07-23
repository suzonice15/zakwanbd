@extends('layouts.master')
@section('pageTitle')
    All Zone  List
@endsection
@section('mainContent')
<div class="box-body">
    <div class="row">
        <div class="col-md-1">
            <a href="{{url('/')}}/admin/zone/create" class="form-control btn btn-success">
                Add New  

            </a>
        </div>
        <div class="col-md-4 pull-right ">
            <input type="text" id="myInput" name="search" placeholder="Search here.." class="form-control" >
        </div>
    </div>
    <br/>
    <br/>
    <div class="table-responsive">

        <table id="myTable"  class="table table-bordered table-striped   ">
            <thead>
            <tr  >
                <th class='text-center'>Sl</th>               
                <th class='text-center'>Zone Name</th>  
                 <th class='text-center'> Created date </th>
                <th class='text-center' >Action </th>
            </tr>
            </thead>
            <tbody>
               @include('admin.zone.pagination')
            </tbody>

        </table>

    </div>

    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

</div>

<script> 

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>


@endsection

