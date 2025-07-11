@if(isset($withdraws))
    <?php $i=$withdraws->perPage() * ($withdraws->currentPage()-1);?>
    @foreach ($withdraws as $withdraw)

        <?php

       $amount= $withdraw->amount;
       $payableAmount=($amount- ($withdraw->amount * $deduction)/100);

        


      $name=  DB::table('users_public')->where('id',$withdraw->from_user_id)->value('name');

        ?>
        <tr style="@if($withdraw->status==1) background-color: green;color:white @endif">
            <td>{{ ++$i }}</td> 
            <td>{{ $name }} ({{ $withdraw->from_user_id }})</td>
            <td>{{ $withdraw->id }}</td>
            <td>{{ $withdraw->to_user_ac }}</td>
            <td>{{ $withdraw->account }}</td>
             <td >
                @if($withdraw->account_number)
                <input type="text"   @if($withdraw->status == 1)  style="color:#000" @endif id="{{ $withdraw->id }}" value="{{ $withdraw->account_number }}">
                @if($withdraw->status == 0)
                <button class="btn btn-success btn-sm" onclick="return AccountNumberCopy({{ $withdraw->id }})">Copy</button>
                <br/>
                <span  style="color:green;font-weight:bold" id="result_{{ $withdraw->id }}"></span>
                @endif
                    @endif
            </td>
            <td>
                @if($withdraw->status != 3)
                {{ $withdraw->amount }}
                @endif
            
            </td>
            <td>
              @if($withdraw->status != 3)
              {{ $payableAmount }}
              @else 
               {{ $withdraw->amount }}
              @endif
            </td>
            {{--<td>{{ $withdraw->from_user_ac }}</td>--}}
           <td>
    @if($withdraw->status == 1)
        <span class="btn btn-success btn-sm">Paid</span>
    @elseif($withdraw->status == 0)
        <span class="btn btn-info btn-sm">Request</span>
    @elseif($withdraw->status == 3)
        <span class="btn btn-warning btn-sm">Charge</span>
    @else
        <span class="btn btn-danger btn-sm">Rejected</span>
    @endif
</td>

            </td>
            <td>{{date('d-F-Y H:i:s a',strtotime($withdraw->date))}}</td>
            <td>
                 @if(in_array($withdraw->status,[0,2]))
                <a href="{{url('/admin/editWithdrawStatus/'.$withdraw->id)}}" >
                    <button type="button" class="btn btn-info btn-sm">Edit</button>
                </a>
                @endif
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


