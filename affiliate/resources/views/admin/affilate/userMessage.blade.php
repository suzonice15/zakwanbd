@extends('layouts.master')
@section('pageTitle')
    Message
@endsection
@section('mainContent')


    <section class="invoice">

        <div class="row invoice-info">

            <table class="table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>



                </tr>
                </thead>
                <tbody>
                <?php if($messages) { foreach ($messages as $key=>$message) { ?>
                <tr class="notification" id="{{ $message->id }}">
                    <td>{{++$key}}</td>
                    <td><?php echo $message->message ?></td>
                    <td>{{date("d M Y",strtotime($message->created_at))}}</td>
                    <td>@if($message->status==0) <span class="label label-danger">Unseen</span>  @else <span class="label label-success">Seen</span> @endif</td>
                </tr>
                <?php } }?>
                </tbody>
            </table>

        </div>




    </section>
    <script>
        $(document).on('click', '.notification', function(){
            let notification_id=this.id;
            if(notification_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('user/message/seen')}}/"+notification_id,
                    success:function(data)
                    {

                    }
                })
            }
        });
    </script>

@endsection

