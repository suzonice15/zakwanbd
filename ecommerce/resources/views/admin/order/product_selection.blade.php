<?php
if (count($products) > 0) {

?>


<?php

$admin_user= Session::get('status');
if($admin_user=='super-admin'){
    $affilite_commision_show="";


} else {
    $affilite_commision_show="readonly";
}

?>
<table class="table table-striped table-bordered">
    <tr>
        <th class="name" width="30%">Product</th>
        <th class="name" width="5%">Code</th>
        <th class="image text-center" width="5%">Image</th>
        <th class="quantity text-center" width="10%">Qty</th>
        <th class="quantity text-center" width="10%">Commision</th>
        <th class="price text-center" width="10%">Price</th>
        <th class="total text-right" width="10%">Sub-Total</th>
    </tr>
    <?php
    $subtotall=0;
    $totalamout=0;
    $totalCommision=0;
    foreach ($products as $prod) {
    $sell_price = floatval($prod->product_price);
    if ($prod->discount_price) {
        $sell_price = floatval($prod->discount_price);
        $sell_price = $sell_price;
    } else {
        $sell_price = floatval($prod->product_price);
        $sell_price = $sell_price;
    }
    $subtotal = ($sell_price * $qty);
    //$totalamout += $subtotal;
    $subtotall += $subtotal;
    $featured_image = '';//get_product_thumb($prod->product_id, 'thumb');
    $featured_image = url('/public') . '/uploads/' . $prod->folder . '/small/' . $prod->feasured_image;;//get_product_thumb($prod->product_id, 'thumb');
    //commition calculation of affilator
    $commision_price=0;

    if($order->user_id>0){
        $affilate_id=$order->user_id;
    } else {
        $affilate_id=0;
    }
    if($affilate_id>0){
        //  order count
        $hotdeal_commision=DB::table('user_commission')->select('commission')
                ->where('user_id',$affilate_id)
                ->where('product_id',$prod->product_id)
                ->where('order_id',$order->order_id)->first();
        if($hotdeal_commision){
            $commision_price=$hotdeal_commision->commission*$qty;
            $totalCommision +=$commision_price;

        } else {
            /* vendor product commistion distribution */
            $vendorProductCheck=DB::table('product')
                    ->select('top_deal','vendor_id')
                    ->where('product_id', $prod->product_id)
                    ->first();
            if($vendorProductCheck){
                $commision_price= $vendorProductCheck->top_deal*$qty;
                $totalCommision +=$commision_price;
            }
        }
    }
    ?>
    <tr>
        <td><?=$prod->product_title ?></td>
        <td><?=$prod->sku?></td>
        <td class="image text-center">
            <img src="<?=$featured_image?>" height="30" width="30">
        </td>


        <td class="text-center">
            <input  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="number" name="products[items][<?=$prod->product_id ?>][qty]" class="form-control item_qty"
                   value="<?=$qty ?>" data-item-id="<?=$prod->product_id ?>" style="width:60px;">
        </td>
        <td><input type="number" readonly  name="commision[]" value="{{$commision_price}}" class="form-control">

            <input type="hidden" name="commion_product_id[]" value="{{$prod->product_id}}" class="form-control">


        </td>

        <td class="text-center">৳ <?=$sell_price ?>.00</td>
        <td class="text-right">৳ <?=$subtotal ?>.00</td>
    </tr>


        <input type="hidden" name="products[items][<?=$prod->product_id?>][featured_image]" value="<?=$featured_image?>">
        <input type="hidden" name="products[items][<?=$prod->product_id?>][price]" value="<?=$sell_price?>">
        <input type="hidden" name="products[items][<?=$prod->product_id?>][name]" value="<?= $prod->product_title?>">
        <input type="hidden" name="products[items][<?=$prod->product_id?>][subtotal]" value="<?=$subtotal?>">
    <?php


    }
    ?>
</table>
 <a class="btn btn-primary pull-right update_items">Change</a><br><br><br>

<?php
//$order_total = $totalamout;
$order_total = $subtotall;

$order_total = $order_total + $shipping_charge;
?>
<table class="table table-striped table-bordered">
    <tbody>
    <tr> <td> Sub Total </td> <td
                class="text-right"> ৳ <span
                    id="subtotal_price_sujon"><?php echo $subtotall-$order->affiliate_discount . '.00' ?></span> </td> </tr>
    <tr> <td> <span
                    class="extra bold">Delivery Cost</span> </td> <td class="text-right"> <input
                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                    type="text" name="shipping_charge" class="form-control" id="shipping_charge"
                    value="<?= $shipping_charge;?>"> </td> </tr>

    <tr> <td> <span
                    class="extra bold">Discount Price</span> </td> <td class="text-right"> <input
                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                    type="text" name="discount_price" class="form-control" id="discount_price"
                    value="{{$order->discount_price}}"> </td> </tr>
    <tr> <td> <span
                    class="extra bold">Advance Price</span> </td> <td class="text-right"> <input
                    onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                    type="text" name="advabced_price" class="form-control" id="advabced_price"
                    value="{{$order->advabced_price}}"> </td> </tr>
    <tr>
        <td><span class="extra bold totalamout">Affiliate Commision</span></td>
        <td>
            @if($order->changed_affilite_commision)
                <input  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" type="text" {{$affilite_commision_show}} name="totalCommision"  class="form-control"  value="<?php echo $order->changed_affilite_commision?>">


            @else

                <input  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  type="text" {{$affilite_commision_show}} name="totalCommision"  class="form-control"  value="<?php echo ($totalCommision-$order->affiliate_discount) ?>">

            @endif
        </td>


    </tr>
    <tr> <td> <span
                    class="extra bold totalamout">Total</span> </td> <td
                class="text-right"> <span class="bold totalamout"><p> ৳ <span
                            id="total_cost"><?php echo $order->order_total-$order->cashback_balance-$order->bonus_balance; ?></span></p></span> <input
                    type="hidden"
                    name="order_total"
                    id="order_total"
                    value="<?php echo $order->order_total-$order->cashback_balance-$order->bonus_balance; ?>">

    </tr>
    </tbody>
</table>

<?php
}

?>
