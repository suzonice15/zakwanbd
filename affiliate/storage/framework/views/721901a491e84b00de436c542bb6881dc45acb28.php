<div class="main_content"> <form>
    <textarea class="form-control" id="note_value" rows="5"></textarea>

      <div class="wrapper-main-note" style="display: flex;justify-content: space-between;">


          <h4 style="margin-top:24px">Total : <?php echo e(count($notes)); ?> </h4>
          <a class="btn btn-success btn-sm" type="button" id="save" style="float: right;margin: 15px;z-index: 2000">Add Note</a>
      </div>

</form>

<table class="table table-bordered">
    <thead>
    <tr>

        <th  width="5%">Sl</th>
        <th width="90%">Note</th>
        <th width="5%">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $count=count($notes);
    ?>
    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <tr>
        <th  ><?php echo e($count--); ?></th>
        <td
        onblur="noteUpdate(<?php echo e($note->id); ?>)" 
                <?php if($note->status==0): ?>
                style="color: red;text-decoration: line-through;"
                <?php endif; ?>
                contenteditable='true'
                id="content_<?php echo e($note->id); ?>"

        ><?php echo e($note->note); ?></td>
        <td>
            <a onclick="noteDelete(<?php echo e($note->id); ?>)"  type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
            <?php if($note->status==1): ?>
            <a onclick="noteDone(<?php echo e($note->id); ?>)"  type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> </a>
                <?php endif; ?>
        </td>
    </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</div>


<script type="text/javascript">
    $("#save").click('click', function() {
        $.ajax({
            url:"<?php echo e(url('/')); ?>/admin/note_save?note="+$("#note_value").val(),
            success:function(data){
                $("#note_value").val('')
                getNote();
            }
        })
    });

    function noteUpdate(id){
  var content= $("#content_"+id).text();  
        $.ajax({
            url:"<?php echo e(url('/')); ?>/admin/noteUpdated/",
            data:{id:id,data:content},
            success:function(data){
                console.log(data)
               
            },
            error:function(data){
                console.log(data)
               
            }
        })
    }
    function noteDelete(id){
        $.ajax({
            url:"<?php echo e(url('/')); ?>/admin/noteDelete/"+id,
            success:function(data){
                getNote();
            }
        })
    }

    function noteDone(id){
        $.ajax({
            url:"<?php echo e(url('/')); ?>/admin/noteDone/"+id,
            success:function(data){
                getNote();
            }
        })
    }


    function getNote(){

        $.ajax({
            url:"<?php echo e(url('/')); ?>/admin/note",
            success:function(data){

                $(".main_content").html(data)
            }
        })

    }
</script>
<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/note/index.blade.php ENDPATH**/ ?>