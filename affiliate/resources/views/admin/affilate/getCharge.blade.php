@extends('layouts.master')
@section('pageTitle')
   Service Charge List
@endsection
@section('mainContent')
    <div class="box-body">

    <div class='row'>
        <div class="col-md-6">
            <h3>Total :{{$charge->amount}}</h3>
        </div>
        <div class="col-md-6">
            <a  href="{{url('/')}}/admin/getServiceChargeFromAffiliate"  class="btn btn-success">Get Charge</a>  
        </div>
    </div>



        <div class="table-responsive">
            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>                   
                    <th>Name</th>
                    <th>ID</th>
                    <th>Phone</th>
                    <th>Amount</th>
                    <th>Date</th>                           
                </tr>
                </thead>
                <tbody>
                    @foreach($charges as $key=>$charge)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$charge->name}}</td>
                        <td>{{$charge->id}}</td>
                        <td>{{$charge->phone}}</td>
                        <td>{{$charge->amount}}</td>
                        <td>{{date("d/m/Y",strtotime($charge->created_date))}}</td>

                    </tr>
                    @endforeach
               
                </tbody>
            </table>
        </div> 
    </div>

 


@endsection

