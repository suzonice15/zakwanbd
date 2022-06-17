
<?php $i=$affilates->perPage() * ($affilates->currentPage()-1);?>

<?php


if (!empty($affilates))
{ 
foreach ($affilates as $affilate)
{


?>
<tr>
    <td><?= ++$i?></td>

    <td><?= $affilate->name?></td>
    <td><?= $affilate->id?> </td>
    <td><?= $affilate->email?> </td>
    <td><?= $affilate->order_id?> </td>



    <td><?= $affilate->amount?> Taka</td>
    <td><?= date('d-m-Y  h:i a',strtotime($affilate->created_at))?></td>
     
   
</tr>

<?php }

?>
{{--<tr>--}}
{{--<td colspan="5"><b class="pull-right">Total: </b></td><td><b><?php echo $sum;?> Points</b></td><td><b><?php echo $amount;?> Tk</b></td>--}}
{{--</tr>--}}

<tr>
    <td colspan="9" align="center">
        {!! $affilates->links() !!}
    </td>
</tr>
<?php
} else
{
?> <tr><td colspan="6" class="bg-danger">No History Found</td></tr>
<?php  }  ?>