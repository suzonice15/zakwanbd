
    <div class="container">
        <h3>Wishlist</h3>

        <table class="table table-striped table-bordered">


            <thead>
            <tr>
                <th class="name">Product</th>
                <th class="quantity">Availability</th>
                <th class="price">Price</th>
                <th class="total text-center">Action</th>
            </tr>
            </thead>

            <tbody>

            @if($products)
                @foreach($products as $product)

                    <?php
                    $product_stock=$product->product_stock;
                    if ($product->discount_price) {
                        $sell_price = $product->discount_price;
                    } else {
                        $sell_price = $product->product_price;
                    }
                    ?>
                    <tr>
                        <td class="name">
                            <a href="{{ url('/') }}/{{ $product->product_title }}">
                                <img
                                    src="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image }}"
                                    alt="Menz full sleev polo-shirt-4327" width="30"> {{ $product->product_title }} </a></td>
                        <td class="quantity">
                            <div class="availability">@if($product_stock >0) In Stock @else Out of Stock @endif</div>
                        </td>
                        <td class="price">@money($sell_price)</td>
                        <td class="total text-center" width="8%">
                            <a href="javascript:void(0)" data-product_id="{{ $product->product_id}}" data-picture="{{ url('/public/uploads') }}/{{ $product->folder }}/thumb/{{ $product->feasured_image}}" class="btn btn-primary add_to_cart icon"
                            > <i
                                    class="fa fa-shopping-cart"></i> </a> <a href="javascript:void(0)" class="remove_wish_list"
                                                                             date-product_id="{{ $product->product_id}}"> <span class="glyphicon glyphicon-trash btn btn-danger"></span> </a></td>
                    </tr>
                @endforeach

            @else
                <tr>

                    <td class="quantity">
                        There are no product to your whislised
                    </td>


                </tr>
            @endif

            </tbody>
        </table>
    </div>
