
 
@if(isset($supliyers)) 
    @foreach ($supliyers as $key=>$supliyer) 
        <tr>
            <td class='text-center'>{{++$key}}</td>  
            <td class='text-center'>{{$supliyer->name }}</td>  
            <td class='text-center'>{{$supliyer->mobile }}</td>  
            <td class='text-center'>{{$supliyer->address }}</td>  
            <td class='text-center'>{{date('d-m-Y',strtotime($supliyer->created_at))}}</td>      
           <td class='text-center'>
                <a title="edit" href="{{ url('admin/supply') }}/{{ $supliyer->id }}/edit">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
           </td>     
        </tr> 
    @endforeach 
@endif


