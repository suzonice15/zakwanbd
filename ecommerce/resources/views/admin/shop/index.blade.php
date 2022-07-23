@extends('layouts.master')
@section('pageTitle')
    All Shop  List
@endsection
@section('mainContent')
<div class="box-body">
    <div class="row">
        <div class="col-md-1">
            <a href="{{url('/')}}/admin/shop/create" class="form-control btn btn-success">
                Add New 

            </a>
        </div>
        <div class="col-md-4 pull-right ">
            <input type="text" id="serach" name="search" placeholder="Search here" class="form-control" >
        </div>

    </div>
    <br/>
    <br/>
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th>
                <th> Zone</th>
                <th>Shop Name</th>
                <th>Shop Manager</th>
                <th>Shop Phone </th>
                <th>Shop Mobile </th>
                <th>Address</th>
                <th>Continue</th>
                 <th>Status </th>
                 <th>Agency Profit</th>
                 <th>Agency Amount</th>
                 <th> Created date </th>
                <th >Action </th>
            </tr>
            </thead>
            <tbody>

               @include('admin.shop.pagination')
            </tbody>

        </table>

    </div>

    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

</div>

<script>
    
</script>


@endsection

