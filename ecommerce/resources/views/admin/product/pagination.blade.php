@if(isset($products))
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    @foreach ($products as $product)
        <tr>

            <td> {{ ++$i }} </td>
            <td>{{ $product->sku }}</td>
            <td>
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                <a target="_blank" href="{{ url('/') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

            </td>
            <?php
            $status= Session::get('status');
            if ($status != 'editor') {
            ?>
            <td>{{ $product->purchase_price }}</td>
            <?php
                }
            ?>
            <td>{{ $product->product_price }}</td>
            <td>{{ $product->discount_price }}</td>
            <?php

            if ($status != 'editor') {
            ?>
            <td>{{ $product->product_profite }}</td>
            <td>
                {{ $product->commision_percent }}
                </td>
            <td>{{ $product->top_deal  }}  </td>
            <?php
            }
            ?>

            <td><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
            <td>{{ $product->product_stock }}</td>
            <td>{{ $product->product_order_count }}</td>
            <td>{{date('d-m-Y H:m s',strtotime($product->created_time))}}</td>
            <td>
                <a title="edit" href="{{ url('admin/productEdit') }}/{{ $product->product_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
                <?php
                $admin_user=Session::get('status');
                if($admin_user !='editor' && $admin_user !='office-staff') {
                ?>


                    <a title="delete" href="{{ url('admin/product/delete') }}/{{ $product->product_id }}" onclick="return confirm('Are you want to delete this Product')">
                        <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                    </a>

                <?php } ?>






            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $products->links() !!}
        </td>
    </tr>
@endif


