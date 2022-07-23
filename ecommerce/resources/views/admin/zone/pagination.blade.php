
 
@if(isset($zones)) 
    @foreach ($zones as $key=>$zone) 
        <tr>
            <td class='text-center'>{{$zone->id}}</td>  
            <td class='text-center'>{{$zone->zone_name }}</td>  
            <td class='text-center'>{{date('d-m-Y',strtotime($zone->created_at))}}</td>      
           <td class='text-center'>
                <a title="edit" href="{{ url('admin/zone') }}/{{ $zone->id }}/edit">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
           </td>     
        </tr> 
    @endforeach 
@endif


