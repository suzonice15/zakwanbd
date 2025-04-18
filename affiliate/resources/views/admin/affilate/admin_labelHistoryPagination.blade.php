@if(isset($incomes))
    <?php $i=$incomes->perPage() * ($incomes->currentPage()-1);?>
    @foreach ($incomes as $income)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ @$income->incomeFor->name }}({{@$income->incomeFor->id}})</td>
            <!-- <td>{{ @$income->incomeFor->email }}</td> -->
            <!-- <td>{{ @$income->incomeFor->phone }}</td> -->
            <td>{{ @$income->incomeFrom->name }}({{@$income->incomeFrom->id}})</td>
          
            <td class="text-center">{{ $income->previous_income > 0  ? $income->previous_income : 0 }} Tk.</td>
            <td class="text-center">{{ $income->amount }} Tk.</td>
            <td class="text-center">{{ $income->after_income }} Tk.</td>
            <td class="text-center">{{ $income->order_id }}</td> 
            <td class="text-center">{{ $configs[$income->layer] ?? '' }}</td> 
            </td>
            <td>{{date('d-m-Y h:ia',strtotime($income->created_at))}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="13" align="center">
            {!! $incomes->links() !!}
        </td>
    </tr>
@endif


