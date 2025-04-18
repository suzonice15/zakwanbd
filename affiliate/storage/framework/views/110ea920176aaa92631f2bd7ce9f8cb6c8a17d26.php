<?php

if($affilates){
foreach($affilates as $row ){


?>

<tr>

    <td><?php echo e($row->marketing_id); ?></td>
    <td><?php echo e($row->name); ?></td>

    <td><?php echo e($row->email); ?></td>

    <td><?php echo e($row->phone); ?></td>
    <td><?php echo e($row->status==0 ? 'Pending' : "Active"); ?></td>

    <td><?php echo e($row->created); ?></td>


    <td>
    <td>

        <a data-id="<?php echo e($row->marketing_id); ?>" data-toggle="modal" class="btn btn-info marketingMetarialClass" data-target="#modal-suspend" href="#">View</a>
    </td>

    </td>

</tr>

<?php
}


} ?>

<tr>
    <td colspan="9" align="center">
        <?php echo $affilates->links(); ?>

    </td>
</tr>





<div class="modal fade" id="modal-suspend">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Affiliate Metarial</h4>
            </div>
            <div class="modal-body" >

                <span class="affilite_details_id"></span>


            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/marketingMetarialPagination.blade.php ENDPATH**/ ?>