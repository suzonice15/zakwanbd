@extends('layouts.master')
@section('pageTitle')
Visitor   List
@endsection
@section('mainContent')
<div class="box-body">
    <form action="{{url('/')}}/admin/shopVisitorList">
    <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-3  ">
        <input type="date" id="serach" name="start_date" value="{{$start_date}}"  class="form-control" >
        </div>
         <div class="col-md-3  ">
            <input type="date" id="serach" name="end_date" value="{{$end_date}}"    class="form-control" >
         </div>
         <div class="col-md-1">
            <button type="submit" class="form-control btn btn-info">Search</button>
         </div> 
    </div>
    </form>
    <br/>
    <br/>
    <h4 style="color:red;font-weight:bold">Records: {{count($visitors)}}</h4>
    <div class="table-responsive"> 
        <table  class="table table-bordered table-striped">
            <thead>
            <tr class="text-center" >
                <th class="text-center">Sl</th>
                <th class="text-center">IP</th>
                <th class="text-center">Device</th>
                <th class="text-center" >Location</th> 
                <th class="text-left" >From Link</th> 
                <th class="text-center">Created At</th> 
                <th class="text-center" >Action </th>
            </tr>
            </thead>
            <tbody> 
                @foreach($visitors as $key=>$visitor)
                <tr>
                    <td class="text-center">{{++$key}}</td>
                    <td class="text-center">{{$visitor->ip}}</td>
                    <td class="text-center">{{$visitor->agent}}</td> 
                    <td class="text-center">{{$visitor->location}}</td>
                    <td class="text-left"><a href="{{$visitor->referer}}" target="_blank">{{$visitor->referer}}</a></td>
                    <td class="text-center"><span class="label label-info">{{date("d/m/Y",strtotime($visitor->created_at))}} </span> <span class="label label-success">{{date("h:i a",strtotime($visitor->created_at))}}</span> </td>
                    <td class="text-center"> <a href="{{url('/')}}/admin/visitorDetail/{{$visitor->ip}}/{{date("Y-m-d",strtotime($visitor->created_at))}}" target="_blank" class="btn btn-primary">View</a></td>
                </tr> 
                @endforeach
            </tbody>

        </table>

    </div> 
</div>

<script>
    
</script>


@endsection

