@foreach($affiliates as $affiliate)
<tr>
    <td>{{$affiliate->user_id}}</td>
    <td>{{$affiliate->name}}</td>
    <td>{{$affiliate->phone}}</td>
    <td>{{$affiliate->address}}</td>
    <td>
        @if($affiliate->achivement_id==1)
            T shart
      @elseif($affiliate->achivement_id==2)
            Smart Watch
            @endif
    </td>
    <td>@if($affiliate->status==0)
    Pending
            @else
        Paid
            @endif
    </td>
    <td>{{date("d-m-Y H:i:s a",strtotime($affiliate->create_time))}}</td>
    <td>
        @if($affiliate->status==0)
        <a  onclick="return confirm('Are you want to paid ?')" href="{{url('/')}}/admin/achivementComplete/{{$affiliate->id}}" class="btn btn-success">Paid</a>
            @endif
    </td>

</tr>
    @endforeach

<tr><td colspan="9">{!! $affiliates->links() !!}</td></tr>