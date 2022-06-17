@extends('layouts.master')
@section('pageTitle')
    Wallet History
@endsection
@section('mainContent')


    <section class="invoice">

        <div class="row invoice-info">

            <table class="table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Transaction</th>
                    <th scope="col">Sender Number</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>



                </tr>
                </thead>
                <tbody>
                <?php if($wallets) { foreach ($wallets as $key=>$wallet) { ?>
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{  $wallet->name }}  </td>
                    <td><?php echo $wallet->email ?></td>
                    <td><?php echo $wallet->phone ?></td>
                    <td><?php echo $wallet->transaction_id ?></td>
                    <td><?php echo $wallet->sender_number ?></td>
                    <td><?php echo $wallet->amount ?></td>
                    <td>{{date("d M Y",strtotime($wallet->created_at))}}</td>
                    <td>@if($wallet->status==0) <span class="label label-info">Pending</span>  @elseif($wallet->status==2) <span class="label label-danger">Rejected</span> @else <span class="label label-success">Paid</span> @endif</td>
                </tr>
                <?php } }?>
                </tbody>
            </table>

        </div>




    </section>

@endsection

