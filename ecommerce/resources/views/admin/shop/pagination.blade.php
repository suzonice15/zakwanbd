
 
@if(isset($shops))

    @foreach ($shops as $key=>$shop) 

        <tr>
            <td>{{ $shop->id}}</td> 
            <td>{{optional($shop->Zone)->zone_name }}</td> 
            <td>{{$shop->shop_name }}</td> 
            <td>{{optional($shop->User)->name }}</td> 
            <td>{{$shop->phone}} </td> 
            <td>{{$shop->mobile}} </td> 
             
            <td>{{$shop->address}} </td>             
           
            <td>
                @if($shop->shop_status==1)
                 <span class="label label-success">Active</span>
                 @else
                <span class="label label-danger">Inactive</span>
                @endif
            </td>

            <td>
            @if($shop->agency_status==1)
                 <span class="label label-success" style="background-color:yellow !important;color:black !important;">Agency</span>
                 @else
                <span class="label label-success">Company</span>
                @endif 
        
        </td>
            <td>@if($shop->profit_percent  > 0)  {{ $shop->profit_percent}} % @endif </td>             
            <td>{{$shop->profit_amount}} </td>      
            <td>{{date('d-m-Y',strtotime($shop->created_at))}}</td>
            <td>
                <a title="edit" href="{{ url('admin/shop') }}/{{ $shop->id }}/edit">
                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                </a>
            </td>
        </tr>

    @endforeach
 
@endif


