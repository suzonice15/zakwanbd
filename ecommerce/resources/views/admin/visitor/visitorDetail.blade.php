@extends('layouts.master')
@section('pageTitle')
Visitor   Details
@endsection
@section('mainContent')
<div class="box-body">
    
    <br/>
    <h4 style="color:red;font-weight:bold">Records: {{count($visitors)}}</h4>
    <div class="table-responsive">


        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr class="text-center" >
                <th class="text-center">Time</th> 
                <th class="text-center">Device</th> 
                <th class="text-left">From Link</th> 
                <th class="text-left">Visited</th>  
            </tr>
            </thead>
            <tbody> 
                @foreach($visitors as $key=>$visitor)
                <tr>
                <td class="text-center"> <span class="label label-success">{{date("h:i a",strtotime($visitor->created_at))}}</span> </td>
               <td class="text-center">{{$visitor->agent}}</td>
                    <td class="text-left"><a href="{{$visitor->referer}}" target="_blank">{{$visitor->referer}}</a></td>
                    <td class="text-left"><a href="{{$visitor->website}}" target="_blank">{{$visitor->website}}</a></td>
                 </tr> 
                @endforeach
            </tbody>

        </table>

    </div> 
</div>

<script>
    
</script>


@endsection

