<?php
if (count($products) > 0) {

?>
<table class="table table-striped table-bordered">
    <tr>
        <th class="name" width="30%">Product</th>
        <th class="name" width="5%">Code</th>
        <th class="image text-center" width="5%">Image</th>
        <th class="quantity text-center" width="10%">Qty</th>
         <th class="price text-center" width="10%">Price</th>
        <th class="total text-right" width="10%">Sub-Total</th>
    </tr>
    <?php
    $totalamout=0;
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
    $totalamout += $subtotal;
    $featured_image = '';//get_product_thumb($prod->product_id, 'thumb');
    $featured_image = url('/public') . '/uploads/' . $prod->folder . '/small/' . $prod->feasured_image;;//get_product_thumb($prod->product_id, 'thumb');








    ?>
    <tr>
        <td><?=$prod->product_title ?></td>
        <td><?=$prod->sku?></td>
        <td class="image text-center">
            <img src="<?=$featured_image?>" height="30" width="30">
        </td>


        <td class="text-center">
            <input type="number" name="products[items][<?=$prod->product_id ?>][qty]" class="form-control item_qty"
                   value="<?=$qty ?>" data-item-id="<?=$prod->product_id ?>" style="width:60px;">
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
$order_total = $totalamout;
$order_total = $order_total + $shipping_charge;
?>
<table class="table table-striped table-bordered">
    <tbody>
    <tr> <td> Sub Total </td> <td
                class="text-right"> ৳ <span
                    id="subtotal_price_sujon"><?php echo $totalamout . '.00' ?></span> </td> </tr>
    <tr> <td> <span
                    class="extra bold">Delivery Cost</span> </td> <td class="text-right"> <input
                    type="text" name="shipping_charge" class="form-control" id="shipping_charge"
                    value="<?= $shipping_charge;?>"> </td> </tr>

    <tr> <td> <span
                    class="extra bold">Discount Price</span> </td> <td class="text-right"> <input
                    type="text" name="discount_price" class="form-control" id="discount_price"
                    value="0"> </td> </tr>
    <tr> <td> <span
                    class="extra bold">Advance Price</span> </td> <td class="text-right"> <input
                    type="text" name="advabced_price" class="form-control" id="advabced_price"
                    value="0"> </td> </tr>
    <tr> <td> <span
                    class="extra bold totalamout">Total</span> </td> <td
                class="text-right"> <span class="bold totalamout"><p> ৳ <span
                            id="total_cost"><?php echo $order_total; ?></span></p></span> <input
                    type="hidden"
                    name="order_total"
                    id="order_total"
                    value="<?php echo $order_total; ?>">
    </tr>
    </tbody>
</table>

<?php
}

?>
