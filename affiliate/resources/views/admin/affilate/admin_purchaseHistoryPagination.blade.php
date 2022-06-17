@if(isset($purchases))
    <?php $i=$purchases->perPage() * ($purchases->currentPage()-1);?>
    @foreach ($purchases as $purchase)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $purchase->name }}</td>
            <td>{{ $purchase->email }}</td>
            <td>{{ $purchase->phone }}</td>

            <td>{{ $purchase->order_total }}</td>
            <td>{{ $purchase->order_id }}</td>

            </td>
            <td>{{date('d-m-Y H:i a',strtotime($purchase->created_time))}}</td>
        </tr>
    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $purchases->links() !!}
        </td>
    </tr>
@endif


