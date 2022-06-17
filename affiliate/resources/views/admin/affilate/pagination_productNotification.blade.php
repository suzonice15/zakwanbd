@if(isset($notifications))
    <?php $i=$notifications->perPage() * ($notifications->currentPage()-1);?>
    @foreach ($notifications as $product)

        <tr class="notification" id="{{ $product->product_affiliate_notification_id }}" >

            <td><?php echo ++$i;?></td>
            <td>  <img   src="https://www.sohojbuy.com/public/uploads/{{$product->folder}}/small/{{$product->feasured_image}}" class="img-circle" alt="User Image">
            </td>
            <td>{{ $product->product_title }}</td>
            <td>{{ $product->previous_price }}</td>
            <td>{{ $product->present_price }}</td>
            <td>{{ $product->present_price - $product->previous_price }}</td>
            <td>
               @if($product->status==0)
                    <span class="label label-danger">Unseen</span>
                    @else
                <span class="label label-success">Seen</span>
                @endif

            </td>

        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $notifications->links() !!}
        </td>
    </tr>
@endif




