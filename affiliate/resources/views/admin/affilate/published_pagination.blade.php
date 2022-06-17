@if(isset($products))
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    @foreach ($products as $product)
        <tr>

            <td> {{ ++$i }} </td>
            <td>{{ $product->sku }}</td>
            <td>
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                <a href="{{ url('product') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

            </td>
            <td>{{ $product->purchase_price }}</td>
            <td>{{ $product->product_price }}</td>
            <td>{{ $product->discount_price }}</td>
            <td>{{ $product->vendor_percent }} %</td>
            <td><?php echo   $product->product_summary ?></td>
            <td><?php if($product->status==1) { ?>

                <span class="label label-success">Publised</span>
                <?php } else { ?>
                <span class="label label-danger">Pending</span>
                <?php } ?>

            </td>



            <td>{{date('d-m-Y H:m s a',strtotime($product->created_time))}}</td>
            <td>
                <?php if($product->status==0) { ?>
                <a target="_blank" title="edit" class="btn btn-info" href="{{ url('admin/vendor/product/published') }}/{{ $product->product_id }}">
                   Published
                </a>
                    <?php } else { ?>
                <a  target="_blank" title="edit" class="btn btn-bitbucket" href="{{ url('admin/vendor/product/unpublished') }}/{{ $product->product_id }}">
                Unpublished
                </a>
                    <?php } ?>
                <a  target="_blank" title="edit" href="{{ url('admin/product') }}/{{ $product->product_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>

                <a title="delete" href="{{ url('admin/product/delete') }}/{{ $product->product_id }}" onclick="return confirm('Are you want to delete this Product')">
                    <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                </a></td>
        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $products->links() !!}
        </td>
    </tr>
@endif


