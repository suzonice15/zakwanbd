@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="text-center">

                        <th scope="col">SL</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Sender Number</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Note</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Date</th>


                    </tr>
                    </thead>
                    <tbody>

                    @if($wallets)
                        
                            @foreach ($wallets as $key=>$wallet)

                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>



                                    <td>{{ $wallet->transaction_id }}</td>
                                    <td>{{ $wallet->sender_number }}</td>
                                    <td>{{ $wallet->amount }}</td>

                                    <td>{{ $wallet->note}}</td>
                                    <td>
                                        <?php
                                        if($wallet->status==1){
                                        ?>

                                        <button class="btn btn-success btn-sm">
                                            Paid
                                        </button>
                                        <?php } elseif($wallet->status==0) { ?>

                                        <button class="btn btn-info btn-sm">
                                            Pending
                                        </button>
                                        <?php } else { ?>

                                        <button class="btn btn-danger btn-sm">
                                            Rejected
                                        </button>
                                        <?php } ?>
                                    </td>


                                    <td>{{date('d-m-Y H:i:s a',strtotime($wallet->created_at))}}</td>


                                </tr>


                            @endforeach

                      
                    @endif

                    </tbody>
                </table>
            </div>


        </div>

    </div>

@endsection