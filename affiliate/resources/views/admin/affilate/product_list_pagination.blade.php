@if(isset($products))
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    @foreach ($products as $product)
        <tr>

            <td> {{ ++$i }} </td>
            <td>{{ $product->sku }}</td>
            <td>
                <img src="{{ env('APP_ECOMMERCE') }}/public/uploads/{{ $product->folder }}/thumb/{{ $product->feasured_image }}">
                <a href="{{ url('/') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

            </td>
            <td>{{ $product->purchase_price }}</td>
            <td>{{ $product->product_price }}</td>
            <td>{{ $product->discount_price }}</td>
            <td>{{ $product->product_profite }}</td>

            <td><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
            <td>{{date('d-m-Y H:m s',strtotime($product->created_time))}}</td>
            <td>
                <a title="edit" href="{{ url('admin/affilite/editProduct') }}/{{ $product->product_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $products->links() !!}
        </td>
    </tr>
@endif