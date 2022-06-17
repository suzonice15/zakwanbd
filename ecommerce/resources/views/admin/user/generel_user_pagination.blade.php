@if(isset($users))
    <?php $i=$users->perPage() * ($users->currentPage()-1);?>
    @foreach ($users as $user)
        <tr>

            <td> {{ ++$i }} </td>
            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ date('d,M,Y',strtotime($user->created_date)) }}</td>

        </tr>

    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $users->links() !!}
        </td>
    </tr>
@endif


