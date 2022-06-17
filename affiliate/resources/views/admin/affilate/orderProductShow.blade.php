
<table class="table table-bordered">
    <thead>
    <tr>
        <th width="5%">Sl</th>
        <th width="85%">Product</th>
        <th scope="10%">Commision</th>
     </tr>
    </thead>
    <tbody>
    <?php
    if($product_permission_report){

            $count=0;
    $total=0;
    foreach ($product_permission_report as $product){

            $total +=$product->comission;
    ?>
    <tr>
        <td>{{++$count}}</td>
        <td><img width="" src="{{ env('APP_ECOMMERCE') }}public/uploads/{{ $product->folder }}/small/{{ $product->feasured_image }}">{{$product->product_title}}</td>
        <td>{{$product->comission}}</td>

    </tr>
    <?php } }?>

    <?php

    $order=DB::table('order_data')->select('affiliate_discount')->where('order_id',$order_id)->first();
   $affiliate_discount= $order->affiliate_discount;
            if($affiliate_discount > 0){

    ?>

    <tr>
        <td colspan="2" class="text-right">Affiliate Discount</td>
        <td >-{{$affiliate_discount}}</td>

    </tr>
    <?php } ?>


    <tr>
        <td colspan="2" class="text-right">Total</td>
        <td >{{$total-$affiliate_discount}}</td>

    </tr>
    </tbody>
</table>