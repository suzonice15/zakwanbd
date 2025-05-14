<div class="message-wrapper">
    <ul class="messages">
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="message clearfix">
                
                <div class="<?php echo e(($message->message_by =='admin') ? 'received' : 'sent'); ?>">
                    <p><?php echo e($message->message); ?></p>
                    <p class="date"><?php echo e(date('d M y, h:i a', strtotime($message->created_at))); ?></p>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div><?php /**PATH D:\xampp7\htdocs\zakwanbd\affiliate\resources\views/admin/affilate/affilite_chat_message.blade.php ENDPATH**/ ?>