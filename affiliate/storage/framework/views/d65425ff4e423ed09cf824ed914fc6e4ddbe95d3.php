
<?php $i=$earning_history->perPage() * ($earning_history->currentPage()-1);?>

<?php


if (!empty($earning_history))
{
$sum = 0;
$amount = 0;

foreach ($earning_history as $erh)
{

$sum+=$erh->points;
$amount +=$erh->amount;

?>
<tr>
    <td><?= ++$i?></td>
    <td><?= $erh->order_id?> </td>
    <td><?= $erh->earner_name?></td>


    <td><?= $erh->commision?> Taka</td>
    <td><?= date('d-m-Y  h:i a',strtotime($erh->date))?></td>
    <td> 

       <?php if($erh->permission==1): ?>
        <button type="button" data-order_id="<?php echo e($erh->order_id); ?>" class="btn btn-success permission_id" data-toggle="modal" data-target="#modal-default">
       1st level Comm.
        </button>
      <?php elseif($erh->permission==2): ?>
            <button type="button"   class="btn btn-danger "  >
            2nd level Comm.
            </button>
      <?php elseif($erh->permission==3): ?> 
            <button type="button"   class="btn btn-danger "  >
           3rd level Comm.
            </button>
      <?php elseif($erh->permission==4): ?> 
            <button type="button"   class="btn btn-danger "  >
           4th level Comm.
            </button>

      <?php elseif($erh->permission==5): ?> 
            <button type="button"   class="btn btn-danger "  >
            2nd Referer
            </button> 
      <?php elseif($erh->permission==6): ?> 
            <button type="button"   class="btn btn-danger "  >
            Royalty Bonus
            </button>
            <?php elseif($erh->permission==7): ?> 

            <button type="button"   class="btn btn-blue " style="background-color: blue;color:white"  >
            Contest Bonus
            </button>
       <?php else: ?> 
            <button type="button"   class="btn btn-blue " style="background-color: blue;color:white"  >
            2nd level Comm.
            </button>
    <?php endif; ?>



    </td>
   
</tr>

<?php }

?>


<tr>
    <td colspan="9" align="center">
        <?php echo $earning_history->links(); ?>

    </td>
</tr>
<?php
} else
{
?> <tr><td colspan="6" class="bg-danger">No History Found</td></tr>
<?php  }  ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/earnings_pagination.blade.php ENDPATH**/ ?>