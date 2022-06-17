

<?php
if ($products) {
$i = 0;
    $html='';
foreach ($products as $product) {
$product_link = 'product/' . $product->product_name;
// product price
$product_price = $product->product_price;
$product_title = $product->product_title;
$product_discount = $product->discount_price;
$sku = $product->sku;
if ($product_discount >0) {
$sell_price = $product_discount;
} else {
$sell_price = $product_price;
}
//$image = get_product_thumb($product->product_id);

if ($i <= 7) {
    ?>



    <li>
        <a
                href="{{ url('/') }}/{{$product->product_name}}">
        <img style="padding-top: 13px;" src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"
             width="50"/> <span class="search-product_title">{{$product->product_title}}</span>

        <p class="search-price"><span> @money($sell_price)</span>
           @if ($product_discount >0)
            <span class="text-danger text-decoration-line-through"> @money($product->product_price)</span>
               @endif

        </p>
        </a>
    </li>


<?php
}

$i++;
}
if($i >= 7){
$total_product = DB::table('product')->where('status','=',1)->where(function ($query) use ($search_query){
        return $query->where('sku','LIKE','%'.$search_query.'%')
        ->orWhere('product_title','LIKE','%'.$search_query.'%');
    })->count();
$more_product=$total_product-$i;
 ?>

<li ><a style="background: #679767;text-align: center;padding: 16px 9px;color:white !important;"
        href="{{ url('search') }}?search={{$search_query}}">{{$more_product}} more
        results</a></li>
<?php } ?>

<?php
}

?>
