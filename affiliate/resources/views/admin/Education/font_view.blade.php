@extends('layouts.master')
@section('pageTitle')
    Education Page
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row" style="margin-top:50px">
            <div class="col-md-12">    
	        	@foreach($educations as $education)
	        	<div class="box box-primary text-center">
	        		<br>
					<?php echo "{$education->education_details}"; ?>
				    <br>
				</div>
				<br>
				@endforeach
            </div>
        </div>
    </div>
    
@endsection
