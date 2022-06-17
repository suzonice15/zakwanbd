


<table class="table table-bordered">
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Status</th>
        <th>Status</th>
        <th>Date</th>
        <th>Time</th>
    </tr>
    <?php
    if($orders) {
    $count=0;

    foreach ($orders as $order ){
    ?>
    <tr>
        <td><?=++$count?></td>
        @if($order->user_name=='Rakibul islam')
        <td></td>
        @else
            <td>{{$order->user_name}}</td>
        @endif

        <td>{{$order->status}}</td>
        <td>{{$order->order_note}}</td>

        <td>{{date('d-m-Y',strtotime($order->updated_date))}}</td>
        <td>{{date('h:i a',strtotime($order->updated_date))}}</td>
    </tr>

    <?php } } ?>
</table>