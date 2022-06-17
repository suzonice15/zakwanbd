@extends('layouts.master')
@section('pageTitle')
    Vendor Withdraw Amount
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
			                <th>Email</th>
			                <th>Phonr</th>
			                <th>Amount</th>
			                <th>Date</th>
			                <th>Status</th>
			                <th>Action</th>
			            </tr>
			        </thead>
			        <tbody>
			        	@foreach ($withdrowInfo as $withdrow)
			            <tr>
			                <td>{{$withdrow->vendor_shop}}</td>
			                <td>{{$withdrow->vendor_f_name . $withdrow->vendor_l_name}}</td>
			                <td>{{$withdrow->vendor_email}}</td>
			                <td>{{$withdrow->vendor_phone}}</td>
			                <td>{{$withdrow->withdrawAmount}}</td>
			                <td>{{$withdrow->date}}</td>
			                <td>
			                	<?php
			                		if ($withdrow->status=='0') {
			                			echo "Unpaid";
			                		}else if($withdrow->status=='1'){
			                			echo "Paid";
			                		}else if($withdrow->status=='2'){
			                			echo "Cancle";
			                		}else{
			                			echo "Refund";
			                		}
			                	?>
			                </td>
			                <?php
			                	if ($withdrow->status!='3') {
			                ?>
			                <td>
			                	<a href="#" data-toggle="modal" data-target="#myModal{{$withdrow->id}}">
						          <span class="glyphicon glyphicon-tag"></span>
						        </a>
			                </td>

			                <?php		

			                	}else{
			                ?>
			                <td>
			                	Unable to edit
			                </td>
			                <?php
			                	}
			                ?>
			            </tr>

			            <!-- The Modal -->
						  <div class="modal" id="myModal{{$withdrow->id}}">
						    <div class="modal-dialog">
						      <div class="modal-content">
						      
						        <!-- Modal Header -->
						        <div class="modal-header">
						          <h4 class="modal-title">Withdraw Status Change</h4>
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						        </div>
						        <form method="post" action="{{ url('admin/vendor/published/WithdrowStatusChange') }}">
						        @csrf
							        <!-- Modal body -->
							        <div class="modal-body">
							            <div class="form-group">
										  <label for="sel1">Select Status :</label>
										  <select class="form-control" id="sel1" name="status">
										    <option value="0" <?php if($withdrow->status=='0'){echo "selected";} ?> >Unpaid</option>
										    <option value="1" <?php if($withdrow->status=='1'){echo "selected";} ?> >Paid</option>
										    <option value="2" <?php if($withdrow->status=='2'){echo "selected";} ?> >Cancle</option>
										    <option value="3" <?php if($withdrow->status=='3'){echo "selected";} ?> >Refund</option>
										  </select>
										  <input type="hidden" name="vendorId" value="{{$withdrow->vendorId}}">
										  <input type="hidden" name="id" value="{{$withdrow->id}}">
										  <input type="hidden" name="withdrawAmount" value="{{$withdrow->withdrawAmount}}">
										</div>
										<div class="form-group">
											<input type="submit" name="update">
										</div>
							        </div>
						        </form>
						        <!-- Modal footer -->
						        <div class="modal-footer">
						          <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
						        </div>
						      </div>
						    </div>
						  </div>
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