<?php if($wallets) { foreach ($wallets as $key=>$wallet) { ?>
<tr>
    <td>{{++$key}}</td>
    <td>{{  $wallet->name }}  </td>
    <td><?php echo $wallet->email ?></td>
    <td><?php echo $wallet->phone ?></td>
    <td><?php echo $wallet->transaction_id ?></td>
    <td><?php echo $wallet->sender_number ?></td>

    <td><?php echo $wallet->amount ?></td>
    <td><?php echo $wallet->note ?></td>
    <td>{{date("d M Y",strtotime($wallet->created_at))}}</td>
    <td>@if($wallet->status==0) <span class="label label-info">Pending</span>  @elseif($wallet->status==2) <span class="label label-danger">Rejected</span> @else <span class="label label-success">Paid</span> @endif</td>

    <td>

        <a id="affilite_id" data-id="{{$wallet->wallet_history_id}}" data-toggle="modal" data-target="#modal-default" href="#">
            <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
        </a>


    </td>



</tr>
<?php } }?>
<tr>
    <td colspan="9" align="center">
        {!! $wallets->links() !!}
    </td>
</tr>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Wallet Details</h4>
            </div>
            <div class="modal-body" >
                <span class="affilite_details_id"></span>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


