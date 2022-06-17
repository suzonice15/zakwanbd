@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="text-center">

                        <th scope="col">Order ID</th>
                        <th scope="col">Amount</th>
                         <th scope="col">Date</th>
                        <th scope="col">Payment Status</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if($history)
                        @foreach($history as $row)
                            <tr class="text-center">
                                <td>{{$row->order_id}}</td>
                                <td>{{$row->amount}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->status}}</td>



                            </tr>

                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>


        </div>

    </div>

@endsection