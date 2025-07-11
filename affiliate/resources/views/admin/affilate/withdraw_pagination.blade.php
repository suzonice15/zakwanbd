@if(isset($withdraws))
    <?php $i = $withdraws->perPage() * ($withdraws->currentPage() - 1);?>
    @foreach ($withdraws as $withdraw)
        <tr> 

            <td class="text-center">{{$withdraw->id}}</td>
            <td class="text-center">{{$withdraw->order_id}}</td>
            <td>{{$withdraw->date}}</td> 
            <td>{{$withdraw->to_user_ac}}</td>
            <td>{{$withdraw->account}}</td>
            <td>{{$withdraw->account_number}}</td>
            <td>{{$withdraw->amount}}</td> 
            <td>
               @if($withdraw->status==1)  
                <button class="btn btn-success">
                    Paid
                    </button>
             @elseif($withdraw->status==0)  

                <button class="btn btn-info">
                  Request
                </button>
                   @elseif($withdraw->status==3)  

                <button class="btn btn-info">
                  Charge
                </button>
                @else  

                <button class="btn btn-danger">
                 Rejected
                </button>
               @endif
            </td>


        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $withdraws->links() !!}
        </td>
    </tr>
@endif


