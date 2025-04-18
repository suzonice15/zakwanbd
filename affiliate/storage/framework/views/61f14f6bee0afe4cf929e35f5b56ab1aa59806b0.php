
<?php $__env->startSection('pageTitle'); ?>
    Message
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>


    <section class="invoice">

        <div class="row invoice-info">

            <table class="table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">Sl</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>



                </tr>
                </thead>
                <tbody>
                <?php if($messages) { foreach ($messages as $key=>$message) { ?>
                <tr class="notification" id="<?php echo e($message->id); ?>">
                    <td><?php echo e(++$key); ?></td>
                    <td><?php echo $message->message ?></td>
                    <td><?php echo e(date("d M Y",strtotime($message->created_at))); ?></td>
                    <td><?php if($message->status==0): ?> <span class="label label-danger">Unseen</span>  <?php else: ?> <span class="label label-success">Seen</span> <?php endif; ?></td>
                </tr>
                <?php } }?>
                </tbody>
            </table>

        </div>




    </section>
    <script>
        $(document).on('click', '.notification', function(){
            let notification_id=this.id;
            if(notification_id){
                $.ajax({
                    type:"GET",
                    url:"<?php echo e(url('user/message/seen')); ?>/"+notification_id,
                    success:function(data)
                    {

                    }
                })
            }
        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/userMessage.blade.php ENDPATH**/ ?>