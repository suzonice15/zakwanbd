@if(isset($orders))
    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
    @foreach ($orders as $order)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->customer_name }}</td>
            <td><span class="label label-info">{{ $order->customer_phone }}<span class="label label-success"></span></td>
            <td><span class="label label-success">@if($order->order_area=='inside')
                        Inside Dhaka @else Outside Dhaka @endif
                </span></td>
            <td>{{ $order->customer_address }}</td>
            <td>{{$order->created_by}}</td>
            <td> @money($order->order_total)
            </td>
            <td> @money($order->shipping_charge)</td>
            <td><span class="label label-success">{{ $order->order_status }}</span></td>
            <td>{{date('d-F-Y H:i:s a',strtotime($order->created_time))}}</td>

            <td>
                <a title="edit" href="{{ url('admin/order') }}/{{ $order->order_id }}">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>

                {{--<a title="delete" href="{{ url('admin/product/delete') }}/{{ $order->product_id }}" onclick="return confirm('Are you want to delete this Product')">--}}
                {{--<span class="glyphicon glyphicon-trash btn btn-danger"></span>--}}
                {{--</a>--}}
            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $orders->links() !!}
        </td>
    </tr>
@endif


