<?php

if($affilates){
foreach($affilates as $row ){


?>

<tr>

    <td>{{$row->marketing_id}}</td>
    <td>{{$row->name}}</td>

    <td>{{$row->email}}</td>

    <td>{{$row->phone}}</td>
    <td>{{$row->status==0 ? 'Pending' : "Active"}}</td>

    <td>{{ $row->created}}</td>


    <td>
    <td>

        <a data-id="{{$row->marketing_id}}" data-toggle="modal" class="btn btn-info marketingMetarialClass" data-target="#modal-suspend" href="#">View</a>
    </td>

    </td>

</tr>

<?php
}


} ?>

<tr>
    <td colspan="9" align="center">
        {!! $affilates->links() !!}
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


