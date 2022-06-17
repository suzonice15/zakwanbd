
<?php

if($comments) {
        foreach($comments as $comment){
?>
<div class="question-class" style="background-color:white;padding:5px 5px; margin-top:5px">
    <h4><i class="fa fa-question-circle"></i> {{$comment->comment_from_customer}}</h4>

    <?php if($comment->comment_from_admin) { ?>
    <h5 style="color:#ddd">
        <span style="color:white;background-color: #ddd;border-radius: 50%;width: 4%;display: inline-block;height: 8%;padding: 1px 3px;font-size: 20px;">A</span> {{$comment->comment_from_admin}}</h5>

    <?php } else { ?>
    <h5 style="color:#ddd">
         No answer yet</h5>
<?php } ?>

</div>

<?php } } ?>
