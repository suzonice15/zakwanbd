@php
 $categories = explode(",", get_option('home_cat_section'));
foreach ($categories as  $category_id) {
$category_info = get_category_info($category_id);
if($category_info){
$products= getHomeProductByCategoryId($category_id);
@endphp
<div class="row px-2">
    <div class="col-md-12 mt-3 col-12 col-lg-12 col-sm-12 col-xl-12 px-3 mb-2" style="border-bottom: 2px solid #2f832e;">
        <h4 style="display: inline;"><a  class="home-page-category-title" href="{{url('/')}}/category/{{$category_info->category_name}}">{{$category_info->category_title}}</a></h4>
        <a  class="home-page-category-right-more" href="{{url('/')}}/category/{{$category_info->category_name}}">View All</a>
    </div>
   @if($products)
       @foreach($products as $product)
        <?php     if ($product->discount_price) {
            $sell_price = $product->discount_price;
            } else {
            $sell_price = $product->product_price;
            } ?>
    <div class="col-md-4 col-lg-2 col-xl-2 col-xxl-2 col-sm-6 col-6 p-1">
        <div class="card">
            @if ($product->discount_price)
                <div class="freepeoduct"> <strong>-</strong> {{$product->product_price- $product->discount_price}} Tk</div>
            @endif
            <div class="box">
                <a  class="text-decoration-none" href="{{url('/')}}/{{$product->product_name}}">
                    <img  style="width:100%" class="img-fluid p-2"
                     src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}" alt="  {{ $product->product_title }}">
            </a>
            </div>
            <div class="card-body">
                <p class="product-title">  <a  class="text-decoration-none" href="{{url('/')}}/{{$product->product_name}}"> {{ $product->product_title }}</a></p>
                <p class="product-title">  {{ $product->product_subtitle }}</p>
                <div class="price">
                    <?php
                    if($product->discount_price){
                    ?>
                    <p class="text-danger text-decoration-line-through"> @money($product->product_price) </p>
                        <?php } ?>

                    <p>@money($sell_price)</p>
                </div>
                <span class="star-rating text-center "><span style="position: relative;top: 5px;">({{totalProductRiviewCount($product->product_id)}})</span></span>

            </div>
        </div>
    </div>
       @endforeach
       @endif

</div>

@php } }  @endphp
