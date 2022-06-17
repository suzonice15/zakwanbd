@extends('layouts.master')
@section('pageTitle')
    Wallets History

@endsection
@section('mainContent')

    <div class="box-body">

        <div class="row">
            <div class="col-md-6 col-xs-12">


        <div class="box box-primary" style="border: 2px solid #ddd;">
            <div class="box-header with-border">
                <h3 class="box-title">Pay money to customer wallet</h3>
            </div>

            <form role="form" action="{{url('/')}}/admin/addWalletBalance" method="post">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Customer Mobile </label>
                        <input type="text" autocomplete="off"  required  name="customer_phone"  id="customer_phone" class="form-control"  placeholder="Enter Customer Mobile">
                       <p id="mobile_error"></p>
                    </div>

                    <div class="form-group " id="hide_class">
                        <label for="exampleInputPassword1">Customer Id </label>
                        <input type="text" readonly  required  name="id"  id="id" class="form-control" >

                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Sender Number</label>
                        <input type="text" required name="sender_number" id="sender_number" class="form-control"  value="cash money " placeholder="Sender Number">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Amount </label>
                        <input type="number" required name="amount" id="amount_of_promotion" class="form-control" id="exampleInputPassword1" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Note</label>
                        <textarea  name="note" class="form-control"  id="note" placeholder="Note" rows="3"></textarea>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>


            </div>
        </div>



        <div class="table-responsive" >
            <table id="example1" class="table table-bordered table-striped table-responsive ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>  Name</th>
                    <th>  Phone</th>
                    <th>User Status</th>
                    <th>Trx ID.</th>
                    <th>Amount</th>
                    <th>Sender Number</th>
                    <th>Status</th>
                    <th> Note</th>
                    <th> Date</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>

                @if(isset($withdraws))
                    <?php $i=$withdraws->perPage() * ($withdraws->currentPage()-1);?>
                    @foreach ($withdraws as $withdraw)
                     @php
                     if($withdraw->customer_id > 0){
                     $user=DB::table('users')->select('name','phone')->where('id','=',$withdraw->customer_id)->first();
                     $userName=$user->name;
                     $userPhone=$user->phone;
                     } else {
                     $user=DB::table('users_public')->select('name','phone')->where('id','=',$withdraw->affiliate_id)->first();
                     $userName=$user->name;
                     $userPhone=$user->phone;
                     }
                     @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $userName }}</td>
                            <td>{{ $userPhone }}</td>

                            <td><?php
                                if($withdraw->customer_id > 0){
                                ?>

                                <button class="btn btn-success">
                                    Customer
                                </button>
                                <?php }   else { ?>

                                <button class="btn btn-info">
                                    Affiliate
                                </button>
                                <?php } ?>
                            </td>
                            <td>{{ $withdraw->transaction_id }}</td>
                            <td>{{ $withdraw->amount }}</td>
                            <td>{{ $withdraw->sender_number }}</td>

                            <td>
                                <?php
                                if($withdraw->status==1){
                                ?>

                                <button class="btn btn-success">
                                    Paid
                                </button>
                                <?php } elseif($withdraw->status==0) { ?>

                                <button class="btn btn-info">
                                    Request
                                </button>
                                <?php } else { ?>

                                <button class="btn btn-danger">
                                    Rejected
                                </button>
                                <?php } ?>
                            </td>
                       </td>
                            <td>{{ $withdraw->note}}</td>
                            <td>{{date('d-F-Y H:i:s a',strtotime($withdraw->created_at))}}</td>

                            <td>
                                <?php
                                if($withdraw->status !=1){
                                    ?>
                            <a href="{{url('/')}}/admin/wallet/{{$withdraw->wallet_history_id}}" class="btn btn-success"> <i class="fa fa-eye"> </i> </a>
                           <?php } ?>
                            </td>

                        </tr>


                    @endforeach

                    <tr>
                        <td colspan="13" align="center">
                            {!! $withdraws->links() !!}
                        </td>
                    </tr>
                @endif

                </tbody>

            </table>

        </div>



    </div>

    <script>
        $("#hide_class").hide();
        $(document).on('blur','#customer_phone',function () {
           var customer_phone=$(this).val();
            if(customer_phone.length <10){
                $("#mobile_error").html("<strong style='color:red'>Please Enter  Mobile / Email of customer</strong>")
                $("#hide_class").hide();
                $("#id").val('');
                return false;

            } else{
                $("#mobile_error").text('');
                $.ajax({
                    url:"{{url('/')}}/search/customerByPhone/"+customer_phone,
                    success:function (data){
                        if(data > 0){
                            $("#id").val(data);
                            $("#mobile_error").html("<strong style='color:green'>User found</strong>")
                            $("#hide_class").show();

                        } else{
                            $("#mobile_error").html("<strong style='color:red'>No user found</strong>")
                            $("#hide_class").hide();
                            $("#id").val('');
                        }

                    }
                })
            }
            

            

        })
    </script>


@endsection

