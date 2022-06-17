@extends('layouts.master')
@section('pageTitle')
    All Sliders List
@endsection
@section('mainContent')

<div class="box-body">
    <div class="table-responsive" >
        <table id="example1" class="table table-bordered table-striped table-responsive ">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Name </th>
                <th>Picture</th>
                <th> Slider link</th>
                <th>Published status </th>
                <th> Created date </th>
                <th> Modified date </th>
                <th >Action </th>
            </tr>
            </thead>
            <tbody>

                @if(isset($sliders))
<?php $i=0;?>
            @foreach ($sliders as $slider)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{$slider->homeslider_title}} </td>
                <td>
                  @if(isset($slider->homeslider_picture))
                    <img src="{{URL::to('/public')}}/uploads/sliders/{{$slider->homeslider_picture}}" width="50" height="50"/>

                   @else
                    <img src="{{URL::to('/public')}}/uploads/user/user.png" width="50" height="50"/>
                    @endif
                </td>

                <td>{{$slider->target_url}}</td>
                <td><?php if($slider->status==1){ echo 'Publised'; } else { echo "Unpublised";} ?></td>
                <td>{{date('d-m-Y',strtotime($slider->created_time))}}</td>
                <td>{{date('d-m-Y',strtotime($slider->modified_time))}}</td>
                <td>
                    <a title="edit" href="{{ url('/admin/slider/') }}/{{ $slider->homeslider_id }}">
                        <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>


                    <a title="delete" href="{{ url('/admin/slider/delete') }}/{{ $slider->homeslider_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
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

