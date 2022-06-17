@if(isset($products))
    <?php $i=$products->perPage() * ($products->currentPage()-1);?>
    @foreach ($products as $product)
        <tr>


            <?php
            $profite=0;
            if($product->discount_price){

                $sell_price=$product->discount_price;
                $profite=$sell_price-$product->product_profite;
            } else {
                $sell_price=$product->product_price;
                $profite=$sell_price-$product->product_profite;
            }

            ?>

            <td> {{ ++$i }} </td>
            <td>{{ $product->sku }}</td>
            <td>
                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                <br/>
                <a href="{{ url('') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

            </td>

            <td>{{ $product->product_price }}</td>
            <td>{{ $product->discount_price }}</td>
            <td>{{ $profite }}</td>

            <td><?=$product->product_summary?></td>
            <td><?php if($product->status==1) { ?>
               <span class="label label-success">Publised</span>

                <?php } else { ?>

                <span class="label label-danger">Pending</span>


                <?php } ?> </td>
            <td>{{date('d-m-Y H:m s',strtotime($product->created_time))}}</td>
            <td>
                <?php
                    $click = DB::table('product_hit_count')->where('product_id', $product->product_id)->count();
                    if ($click) {
                        echo $click;
                    }else{
                        echo "0";
                    }
                ?>
            </td>
            <td>
                <a title="edit" href="{{ url('vendor/product') }}/{{ $product->product_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>

                <a title="delete" href="{{ url('vendor/product/delete') }}/{{ $product->product_id }}" onclick="return confirm('Are you want to delete this Product')">
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


