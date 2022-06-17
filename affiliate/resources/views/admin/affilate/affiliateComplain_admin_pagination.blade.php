
<?php $i=$affilates->perPage() * ($affilates->currentPage()-1);?>

<?php


if (!empty($affilates))
{
$sum = 0;
$amount = 0;

foreach ($affilates as $complain)
{
$affiliate=DB::table('users_public')->select('phone','name','id')->where('id','=',$complain->affiliate_id)->first();


?>
<tr>

    <td><?=$complain->complain_id?></td>
    @if($affiliate)
        <td><?= $affiliate->id?></td>
        <td><?= $affiliate->name?></td>
        <td><?= $affiliate->phone?></td>


    @endif

    <td><?= $complain->affiliate_complain?></td>

    <td><?= $complain->affiliate_answer?> </td>
    <td><?= $complain->status?> </td>


    <td><?= date('d-m-Y  h:i a',strtotime($complain->created_at))?></td>


    <td>
        <a title="view" href="{{ url('admin/affilite/complainEdit') }}/{{ $complain->complain_id }}">
            <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
        </a>
    </td>
</tr>

<?php }

?>
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