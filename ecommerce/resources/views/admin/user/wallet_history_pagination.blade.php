@if(isset($withdraws))
    <?php $i=$withdraws->perPage() * ($withdraws->currentPage()-1);?>
    @foreach ($withdraws as $withdraw)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $withdraw->from_user_id }}</td>
            <td>{{ $withdraw->id }}</td>
            <td>{{ $withdraw->to_user_ac }}</td>
            <td>{{ $withdraw->amount }}</td>

            <td>{{ $withdraw->from_user_ac }}</td>

            <td><?php

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
            <td>{{date('d-F-Y H:i:s a',strtotime($withdraw->date))}}</td>

            <td>
                <a href="{{url('/admin/editWithdrawStatus/'.$withdraw->id)}}" >
                    <button type="button" class="btn btn-info btn-lg">Edit</button>
                </a>
            </td>


        </tr>


    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $withdraws->links() !!}
        </td>
    </tr>
@endif


