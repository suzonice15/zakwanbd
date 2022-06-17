@extends('layouts.master')
@section('pageTitle')
    Update Cash Back Offer
@endsection
@section('mainContent')


<div class="box-body">
    <div class="col-sm-offset-0 col-md-12">
        <form action="{{ url('admin/default/cashback-offer-submit')  }}" class="form-horizontal"
              method="post">
            @csrf
            <div class="box" style="border: 2px solid #ddd;">
                <div class="box-header with-border" style="background-color: green;color:white;">
                    <h3 class="box-title">Cash Back Offer Setting</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="padding: 28px;">
                	<div class="form-group ">
                        <label for="site_title">Cashback Amount Percent</label>
                        <input type="text" class="form-control" name="offer" id="site_title" value="{{$bonusInfo->offer}}">
                    </div>
                   
                    <div class="form-group ">
                        <label for="site_title">Status</label>
                        <select class="form-control" name="status">
                        	<option value="1" <?php if($bonusInfo->status=='1'){echo "selected";} ?> >Active</option>
                        	<option value="2" <?php if($bonusInfo->status=='2'){echo "selected";} ?> >De-Active</option>
                        </select>
                    </div>
                    <div class="box-footer">
	                    <input type="submit" class="btn btn-success pull-left" value="Update">
	                </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection