@if(isset($messageInfo))
    <?php $i=$messageInfo->perPage() * ($messageInfo->currentPage()-1);?>
    @foreach ($messageInfo as $message)
        <tr  onclick="messageSeen({{$message->id}})" id="{{$message->id}}">
            <td>{{$message->phone}}</td>
            <td>{{$message->message}}</td>
            <td>
                @if($message->status==1)

                    <button type="button" class="btn btn-block btn-success btn-xs">Seen</button>
                    @else

                    <button type="button" class="btn btn-block btn-danger btn-xs">Unseen</button>


                @endif


            </td>
            <td>
                <button type="button" id="{{$message->id}}" class="btn btn-danger dltVideo">Delete</button>
            </td>
        </tr>
    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $messageInfo->links() !!}
        </td>
    </tr>
@endif


<script>

    function  messageSeen(id){
        $.ajax({
            type:"GET",
            url:"{{url('admin/generel/message/show')}}/"+id,
            success:function(data)
            {

            }
        })
    }

</script>
