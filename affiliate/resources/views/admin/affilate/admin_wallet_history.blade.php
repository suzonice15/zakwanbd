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
                    <th scope="col">Note</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>



                </tr>
                </thead>
                <tbody>
               @include('admin.affilate.admin_wallet_history_pagination')
                </tbody>
            </table>

        </div>
        <script>
            $(document).on('click', '#affilite_id', function(){
                var wallet_id=  $(this).attr("data-id") // will return the string "123"

                if(affilite_id) {


                    $.ajax({
                        type: "GET",
                        url: "{{url('/admin/wallet/show/')}}/" + wallet_id,
                        success: function (data) {

                            $('.affilite_details_id').empty();
                            $('.affilite_details_id').html(data);
                        }
                    })
                }

            });

        </script>






    </section>

@endsection

