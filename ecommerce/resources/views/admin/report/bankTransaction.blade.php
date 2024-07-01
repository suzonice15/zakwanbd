@extends('layouts.master')
@section('pageTitle')
Bank Transaction Information
@endsection
@section('mainContent')
<div class="box-body">
     
    <div class="table-responsive">

    <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th> 
                <th>Zone </th> 
                <th>Shop</th> 
                <th>Bank Name</th> 
                <th>Voucer No</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Picture</th>
               
                <th>date</th> 
                <th>Created date</th> 
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($banks as   $key=>$amount)

                <?php
                $zone_name=DB::table('zones')->where('id',$amount->zone_id)->value('zone_name');
                $shop_name=DB::table('shops')->where('id',$amount->shop_id)->value('shop_name');

                ?>

                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$zone_name}}</td>
                    <td>{{$shop_name}}</td>
                    <td>{{$amount->bank_name}}</td>
                    
                    <td>{{$amount->voucer_no}}</td>
                    <td>{{$amount->amount}}</td>
                    <td>{{$amount->note}}</td>
                    <td><a download target="_blank" href="{{url('/')}}/public/voucer/{{$amount->picture}}" >Picture</a></td>
                    
                    <td>{{$amount->date}}</td>
                    <td>{{$amount->created_at}}</td>
                    <td>@if($amount->status==1)<span class="label label-success"> Approved </span> @else <span class="label label-danger">Pending </span> @endif</td>
                    <td>
                    @if($amount->status==0)
                <a title="edit" href="{{ url('admin/report/bankReceive') }}/{{ $amount->id }}">
                    <span class="glyphicon glyphicon-check btn btn-success"></span>
                </a>
                @endif


                </td>
                </tr>
    @endforeach

             
            </tbody>

        </table>

    </div>

 
</div> 
@endsection

