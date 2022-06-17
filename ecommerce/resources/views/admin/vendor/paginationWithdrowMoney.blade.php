@if(isset($vendors))
    <?php $i=$vendors->perPage() * ($vendors->currentPage()-1);?>
    @foreach ($vendors as $vendor)
        <tr>

            <td> {{ ++$i }} </td>
            <td>{{ $vendor->vendor_f_name. ' '.$vendor->vendor_l_name }}</td>
            <td>{{ $vendor->vendor_email }}</td>
            <td>{{ $vendor->vendor_phone }}</td>
            <td>{{ $vendor->vendor_shop }}</td>

            <td>{{ $vendor->life_time_earning }}</td>
            <td>{{ $vendor->amount }}</td>


            <td>

                <a title="delete" href="{{ url('admin/vendor/money/pay') }}/{{ $vendor->vendor_id }}">
                    <span class="glyphicon glyphicon-minus btn btn-info"></span>
                </a>
            </td>
        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $vendors->links() !!}
        </td>
    </tr>
@endif


