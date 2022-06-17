@if($order->customer_order_note !='' || $order->affiliate_order_note !='' )
<table class="table table-bordered">
      <tr>
        <th>Customer Order Note</th>
        <th>Affiliate Order Note</th>

    </tr>

    <tr>

        <td>{{$order->customer_order_note}}</td>
        <td>{{$order->affiliate_order_note}}</td>

    </tr>


</table>
@endif


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
        <td>{{$order->user_name}}</td>
        <td>{{$order->status}}</td>
        <td>{{$order->order_note}}</td>

        <td>{{date('d-m-Y',strtotime($order->updated_date))}}</td>
        <td>{{date('h:i a',strtotime($order->updated_date))}}</td>
    </tr>

    <?php } } ?>
</table>