@if(isset($incomes))
    <?php $i=$incomes->perPage() * ($incomes->currentPage()-1);?>
    @foreach ($incomes as $income)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $income->name }}</td>
            <td>{{ $income->email }}</td>
            <td>{{ $income->phone }}</td>
            <td>{{ $income->commision }}</td>
            <td>{{ $income->order_id }}</td>

            </td>
            <td>{{date('d-F-Y H:i:s a',strtotime($income->date))}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="13" align="center">
            {!! $incomes->links() !!}
        </td>
    </tr>
@endif


