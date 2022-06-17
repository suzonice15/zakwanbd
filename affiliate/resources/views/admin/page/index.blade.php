@extends('layouts.master')
@section('pageTitle')
    All pages List
@endsection
@section('mainContent')

<div class="box-body">
    <div class="table-responsive" >
        <table   class="table table-bordered table-striped table-responsive ">
            <thead>
            <tr>
                <th  width="2%">Sl</th>
                <th width="10%">Page Name </th>
                <th  width="10%">Page Link </th>
                <th  width="30%">Page Description </th>
                <th  width="10%"> Created date </th>
                <th  width="10%">Action </th>
            </tr>
            </thead>
            <tbody>

                @if(isset($pages))
<?php $i=0;?>
            @foreach ($pages as $page)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{$page->page_name}} </td>
                <td>{{$page->page_link}} </td>
                <td><?php echo strip_tags($page->page_content); ?> </td>
                <td>{{date('d-m-Y',strtotime($page->created_time))}}</td>

                <td>
                    <a title="edit" href="{{ url('/admin/page/') }}/{{ $page->page_id }}">
                        <span class="glyphicon glyphicon-edit btn btn-success"></span>
                    </a>


                    <a title="delete" href="{{ url('/admin/page/delete') }}/{{ $page->page_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
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

