@extends('layouts.master')
@section('pageTitle')
    My Customer Referrals  List ( {{$customers->total()}})
@endsection
<style>

    tr {
        border: 1px solid #1D96B2;
    }

    .table thead th {
        border: 1px solid #1D96B2;
        border: 1px solid #fff;
        text-align: center;
    }

    .table tbody td {
        border: 1px solid #1D96B2 !important;
        height: 50px;
        font-size: 17px;
        color: #000;
        text-align: left;
    }

    thead {
        background-color: #1d96b2;
        color: #fff
    }
</style>
@section('mainContent')
    <div class="box-body">
        <div class="table-responsive">
            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: left">Name</th>
                    <th>Address</th>
                    <th> Total Order</th>
                    <th>Total Buy Amount</th>
                    <th>Total Profit</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @if($customers)
                   @php $i=$customers->perPage() * ($customers->currentPage()-1); @endphp
                    @foreach($customers as $customer)
                        <?php
                             $order_total=DB::table('order_data')
                                     ->where('customer_id','=',$customer->id)
                                     ->sum('order_total');
                        $order_order_count=DB::table('order_data')->where('customer_id','=',$customer->id)->count();

                                ?>
                <tr>
                    <td style="text-align: center">{{++$i}}</td>

                    <td style="text-align: center">{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->address}}</td>
                    <td style="text-align: center">{{$order_order_count}}</td>
                    <td style="text-align: center">{{$order_total}}</td>
                 
                    <td style="text-align: center">{{$customer->affiliate_commision_from_customer}}</td>
                    <td style="text-align: center">{{date("d-m-Y",strtotime($customer->created_date))}}</td>
                </tr>
                    @endforeach
                @endif



                </tbody>

            </table>
            {!! $customers->links()!!}

        </div>


    </div>



@endsection

