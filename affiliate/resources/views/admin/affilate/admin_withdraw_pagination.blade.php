@if(isset($withdraws))
    <?php $i=$withdraws->perPage() * ($withdraws->currentPage()-1);?>
    @foreach ($withdraws as $withdraw)

        <?php


      $name=  DB::table('users_public')->where('id',$withdraw->from_user_id)->value('name');

        ?>
        <tr style="@if($withdraw->status==1) background-color: green;color:white @endif">
            <td>{{ ++$i }}</td>
            <td>{{ $withdraw->from_user_id }}</td>
            <td>{{ $name }}</td>
            <td>{{ $withdraw->id }}</td>
            <td>{{ $withdraw->to_user_ac }}</td>
            <td>{{ $withdraw->account }}</td>
             <td >
                @if($withdraw->account_number)
                <input type="text" id="{{ $withdraw->id }}" value="{{ $withdraw->account_number }}">
                <button class="btn btn-success btn-sm" onclick="return AccountNumberCopy({{ $withdraw->id }})">Copy</button>
                <br/>
                <span  style="color:green;font-weight:bold" id="result_{{ $withdraw->id }}"></span>
                    @endif
            </td>
            <td>{{ $withdraw->amount }}</td>
            {{--<td>{{ $withdraw->from_user_ac }}</td>--}}
            <td><?php
                if($withdraw->status==1){
                ?>
                <button class="btn btn-success btn-sm">Paid  </button>
                <?php } elseif($withdraw->status==0) { ?>
                <button class="btn btn-info btn-sm">
                    Request
                </button>
                <?php } else { ?>
                <button class="btn btn-danger btn-sm">
                    Rejected
                </button>
                <?php } ?>
            </td>
            </td>
            <td>{{date('d-F-Y H:i:s a',strtotime($withdraw->date))}}</td>
            <td>
                <a href="{{url('/admin/editWithdrawStatus/'.$withdraw->id)}}" >
                    <button type="button" class="btn btn-info btn-sm">Edit</button>
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
<script>
    function AccountNumberCopy(account_id) {
        /* Get the text field */
        var copyText = document.getElementById(account_id);
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        document.getElementById("result_"+account_id).innerText="Copied";
        $("#result_"+account_id).fadeOut(5000);


    }
</script>


