@extends('layouts.master')
@section('pageTitle')
    All Education Post List
@endsection
@section('mainContent')

<div class="box-body">
    <div class="table-responsive" >
        <table   class="table table-bordered table-striped table-responsive ">
            <thead>
            <tr>
                <th  width="2%">Sl</th>
                <th width="10%">Education Type</th>
                <th  width="40%">Details / Link </th>
                <th  width="10%"> Created Date </th>
                <th  width="10%"> Status </th>
                <th  width="10%">Action </th>
            </tr>
            </thead>
            <tbody>

                @if(isset($educations))
<?php $i=0;?>
            @foreach ($educations as $education)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{$education->education_type}} </td>
                <td><?php echo "{$education->education_details}"; ?></td>
                <td>{{date('d-m-Y',strtotime($education->created_time))}}</td>
                <td>
                	@if($education->status == 1)
	                    <a type="button" class="btn btn-info btn-sm" href="{{url('/admin/education/active/'.$education->id)}}">Active</a>
                    @else
	                    <a type="button" class="btn btn-danger btn-sm" href="{{url('/admin/education/inactive/'.$education->id)}}">Inactive</a>
                    @endif
                </td>
                <td>
                    <a title="edit" href="{{ url('/admin/education-edit/') }}/{{ $education->id }}">
                        <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>


                    <a title="delete" href="{{ url('/admin/education/delete') }}/{{ $education->id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                        <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                    </a></td>
            </tr>

            @endforeach
                @endif
            </tbody>

        </table>
    </div>
</div>
@endsection

