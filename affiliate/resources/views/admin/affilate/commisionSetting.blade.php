@extends('layouts.master')
@section('pageTitle')
Commision Setting
@endsection
@section('mainContent')
<div class="box-body">

<form action="{{url('admin/commisionSetting')}}" method="post" >
    @csrf

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Income Type</th>
                <th>Person</th>
                <th>Income</th>
                <th>Income Limit</th>
            </tr>
        </thead>
        <tbody>
            

        @php
    $incomeTypes = [
        'Direct Income' => 'direct',
        '1st Label Income' => '1st',
        '2nd Label Income' => '2nd',
        '3rd Label Income' => '3rd',
        '4th Label Income' => '4th',
        '5th Label Income' => '5th',
        '6th Label Income' => '6th',
        '7th Label Income' => '7th',
        // '8th Label Income' => '8th' 
    ];
    $savedData = collect($savedIncomeData ?? [])->keyBy('type');

@endphp

@foreach($incomeTypes as $label => $type)
@php
    $data = $savedData->get($type, ['referar' => '', 'pay_per_order' => '', 'pay_limit' => '']);
@endphp
<tr>
    <th>{{ $label }}</th>
    <th>
        <input type="hidden" name="type[]" value="{{ $type }}" />
        <input type="text" name="referar[]"  value="{{ $data['referar'] }}" class="form-control" />
    </th>
    <th><input type="text" name="pay_per_order[]" value="{{ $data['pay_per_order'] }}" class="form-control" /></th>
    <th><input type="text" name="pay_limit[]"  value="{{ $data['pay_limit'] }}"  class="form-control" /></th>
</tr>
@endforeach 

        </tbody>
    </table>

    <button type="submit" class="form-control btn btn-info">Update</button>

</form>

</div>


@endsection