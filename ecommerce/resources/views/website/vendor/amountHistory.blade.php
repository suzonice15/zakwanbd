@extends('layouts.master')
@section('pageTitle')
     Product Amount
@endsection
@section('mainContent')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <div class="box-body">
        <div class="row">
        	<div class="table-responsive">

	            <table id="example" class="table table-striped table-bordered" style="width:100%">
			        <thead>
			            <tr>
			                <th>Shop Name</th>
			                <th>Vendor Name</th>
			                <th>Product Title</th>
			                <th>Amount</th>
			                <th>Date</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach ($historyInfo as $history)
			            <tr>
			                <td>{{$history->vendor_shop}}</td>
			                <td>{{$history->vendor_f_name}}</td>
			                <td>{{$history->product_title}}</td>
			                <td>{{$history->vendor_amount}}</td>
			                <td>{{$history->date}}</td>
			                
			            </tr>
			            @endforeach
			        </tbody>
			            
			    </table>

	        </div>
        </div>
    </div>
<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>
@endsection