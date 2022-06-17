@extends('layouts.master')
@section('pageTitle')
    All Admin Users List
@endsection
@section('mainContent')

<div class="box-body">
    <div class="table-responsive" >
        <table id="example1" class="table table-bordered table-striped table-responsive ">
            <thead>
            <tr>
                <th>Sl</th>
                <th >Picture</th>
                <th >Name </th>
                <th >Phone </th>
                <th >Email </th>
                {{--<th >Status </th>--}}
                <th >Degination </th>
                <th >date </th>
                <th >Action </th>
            </tr>
            </thead>
            <tbody>

                @if(isset($users))
<?php $i=0;?>
            @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                  @if(isset($user->picture))
                    <img src="{{URL::to('/public')}}/uploads/users/{{$user->picture}}" width="50" height="50"/>

                   @else
                    <img src="{{URL::to('/public')}}/uploads/user/user.png" width="50" height="50"/>
                    @endif
                </td>
                <td>{{$user->name}} </td>
                <td>{{$user->user_phone}} </td>
                <td>{{$user->email}} </td>

                <td>{{$user->status}}</td>
                <td>{{date('d-m-Y',strtotime($user->registered_date))}}</td>
                <td>
                    <a title="edit" href="{{ url('/admin/user/') }}/{{ $user->admin_id }}">
                        <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>


                    <a title="delete" href="{{ url('/admin/user/delete') }}/{{ $user->admin_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
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

