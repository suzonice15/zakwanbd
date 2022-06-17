@extends('layouts.master')
@section('pageTitle')
     Withdraw  Status Change
@endsection
@section('mainContent')
<div class="box-body">
<br/>
	<div class="row  justify-content-center">
		<div class="col-md-3">
			</div>
	    <div class="col-md-5">
			<form method="post" action="{{url('/admin/updateWithdrawStatus')}}">
			@csrf
				<input type="hidden" name="id" value="{{$id}}">
			    <div class="form-group">
			      <select class="form-control" id="" name="status">
			        <option value="0">Request</option>
			        <option value="1">Paid</option>
			        <option value="2">Rejected</option>
			      </select>
			    </div>
				@if($withdraw_data->status==1)
					<button type="button" class="btn btn-info btn-lg">You already Paid</button>

				@else
			    <button type="submit" class="btn btn-info btn-lg">update</button>
					@endif
			</form>
		</div>
	</div>
</div>

@endsection