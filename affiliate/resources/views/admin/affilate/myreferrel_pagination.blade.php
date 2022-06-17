@if(isset($users))
    <?php 
    
    $i=$users->perPage() * ($users->currentPage()-1);
//   // echo $i;total
//     echo   $ii=$users->total();
    
    ?>
    <?php
    $counter=0;
    ?>
    @foreach ($users as $product) 
    <tr> 
        <?php
        $personal_sells=  DB::table('order_data')->where('user_id',$product->id)->where('order_status','=','completed')->sum('order_data.order_total');
        $team_sales=  DB::table('order_data')->join('users_public','users_public.id','=','order_data.user_id')->where('users_public.parent_id','=',$product->id)->where('user_id',$product->id)->where('order_status','=','completed')->sum('order_data.order_total')
        ?>
        <td><?php echo $counter=$counter+1;?></td>
        <td>{{ $product->name }}</td> 
        <td>{{ $product->phone }}</td>
        <td>{{ $product->email }}</td>
        <td><?php echo date('d-m-Y h:i:s' ,strtotime($product->created ))?></td>
        <td>{{$personal_sells }} Tk</td>
        <td>{{$team_sales }} Tk</td>
    </tr>
    @endforeach

    <tr>
        <td colspan="9" align="center">
            {!! $users->links() !!}
        </td>
    </tr>
@endif


