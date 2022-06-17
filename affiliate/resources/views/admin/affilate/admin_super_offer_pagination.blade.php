@if(isset($offers))
    <?php $i=$offers->perPage() * ($offers->currentPage()-1);?>
    @foreach ($offers as $offer)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $offer->name }}</td>
             <td>{{ $offer->phone }}</td>
            <td>{{ $offer->acount_type }}</td>
            <td>{{ $offer->sender_number }}</td>
            <td>{{ $offer->transaction_id }}</td>
            <td>{{ $offer->amount }}</td>
            <td><?php echo  $offer->status==1? 'Active':"Pendding"; ?></td>
            <td>{{ $offer->created_at }}</td>
            <td>

                <?php
                if( $offer->status==1) {
                ?>
                <a href="{{url('/admin/super/offer/inactive/'.$offer->super_offer_id)}}" >
                    <button type="button" class="btn btn-info">Inactive</button>
                </a>
                    <?php }  else { ?>
                    <a href="{{url('/admin/super/offer/active/'.$offer->super_offer_id)}}" >
                        <button type="button" class="btn btn-success">Active</button>
                    </a>

                    <?php } ?>
                <a href="{{url('/admin/super/offer/delete/'.$offer->super_offer_id)}}" onclick="return confirm('Are you want to delete')" >
                    <button type="button" class="btn btn-danger">Delete</button>
                </a>
            </td>




            </td> 
        </tr>


    @endforeach

    <tr>
        <td colspan="13" align="center">
            {!! $offers->links() !!}
        </td>
    </tr>
@endif


