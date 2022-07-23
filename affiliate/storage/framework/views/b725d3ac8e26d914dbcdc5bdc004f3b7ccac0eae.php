
<?php $__env->startSection('pageTitle'); ?>
    Live Support
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 7px;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #a7a7a7;
        }
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #929292;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
        }
        .user-wrapper, .message-wrapper {
            border: 1px solid #dddddd;
            overflow-y: auto;
        }
        .user-wrapper {
            height: 600px;
        }
        .user {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover {
            background: #eeeeee;
        }
        .user:last-child {
            margin-bottom: 0;
        }
        .pending {
            position: absolute;
            left: 13px;
            top: 9px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;
        }
        .media-left {
            margin: 0 10px;
        }
        .media-left img {
            width: 64px;
            border-radius: 64px;
        }
        .media-body p {
            margin: 6px 0;
        }
        .message-wrapper {
            padding: 10px;
            height: 536px;
            background: #eeeeee;
        }
        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 70%;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #9eab9e;
            color: black;
        }
        .sent {
            background: green;
            float: right;
            text-align: right;
            color: white;
            font-size: 21px;
        }
        .message p {
            margin: 5px 0;
        }
        .sent .date {
            color: white;
            font-size: 12px;
        }
        .received .date {
            color: black;
            font-size: 12px;
        }
        .active {
            background: #eeeeee;
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid #cccccc;
        }
        input[type=text]:focus {
            border: 1px solid #aaaaaa;
        }
    </style>


    <section class="invoice">

        <div class="row">
            <div class="col-md-4">
                <div class="message_status" style="margin-bottom: 12px;display: flex;flex-direction: row;justify-content: space-evenly;background: #ddd;padding: 7px;">
                    <button class="btn btn-success btn-sm" onclick="affiliate_by_message_status(0)">New</button>
                    <button class="btn btn-primary btn-sm" onclick="affiliate_by_message_status(1)">Pending</button>
                    <button class="btn btn-info btn-sm" onclick="affiliate_by_message_status(2)">Done</button>


                </div>
                <div class="user-wrapper">
                    <?php echo $__env->make('.admin.affilate.getChatUser', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>

            <div class="col-md-8" >

                <button class="btn btn-success btn-sm" onclick="messageConvert(0)">New</button>
                <button class="btn btn-primary btn-sm" onclick="messageConvert(1)">Pending</button>
                <button class="btn btn-info btn-sm" onclick="messageConvert(2)">Done</button>


                <span id="messages"></span>


            </div>
            <input type="hidden" value="" id="affilite_id">
        </div>
         <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


        <script>

            $("#messsage_status").hide();
            function messageConvert(status) {
             let affilite_id= $("#affilite_id").val();
                if(affilite_id >0) {
                    $.ajax({
                        type: "get",
                        url: "<?php echo e(url('/')); ?>/admin/message/messageConvert/" + affilite_id + "/" + status,
                        success: function (data) {

                        }
                    });
                } else{
                    alert("Please Select Affiliate ")
                }


            }

            function affiliate_by_message_status(status){
                    $.ajax({
                    type: "get",
                    url: "<?php echo e(url('/')); ?>/admin/message/message_status/" + status, // need to create this route
                    success: function (data) {
                    $('.user-wrapper').html(data);
                    console.log(data)
                    }
                    });

                    }

            var receiver_id = '';
            var my_id = "<?php echo e(Session::get('id')); ?>";

            $(document).ready(function () {
                // ajax setup form csrf token
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;
                var pusher = new Pusher('0f6b31a39c1a3676af1b', {
                    cluster: 'ap2',
                    forceTLS: true
                });
                var channel = pusher.subscribe('my-channel');
                channel.bind('my-event', function (data) {
                   // getChatUser();
                    // alert(JSON.stringify(data));
                    if (my_id == data.from) {

                        $('#' + data.to).click();
                    } else if (my_id == data.to) {
                        if (receiver_id == data.from) {
                            // if receiver is selected, reload the selected user ...
                            $('#' + data.from).click();
                        } else {
                            // if receiver is not seleted, add notification for that user
                            var pending = parseInt($('#' + data.from).find('.pending').html());
                            if (pending) {
                                $('#' + data.from).find('.pending').html(pending + 1);
                            } else {
                                $('#' + data.from).append('<span class="pending">1</span>');
                            }
                        }
                    }
                });



                $(document).on('click','.user',function () {
                    $("#messsage_status").show();
                    $('.user').removeClass('active');
                    $(this).addClass('active');
                    $(this).find('.pending').remove();
                    receiver_id = $(this).attr('id');
                      $("#affilite_id").val(receiver_id);
                    $.ajax({
                        type: "get",
                        url: "<?php echo e(url('/')); ?>/admin/chat/" + receiver_id, // need to create this route
                        success: function (data) {
                            $('#messages').html(data);
                            scrollToBottomFunc();
                        }
                    });
                });
                $(document).on('keyup', '.input-text input', function (e) {
                    var message = $(this).val();
                    // check if enter key is pressed and message is not null also receiver is selected
                    if (e.keyCode == 13 && message != '' && receiver_id != '') {
                        $(this).val(''); // while pressed enter text box will be empty
                        var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                        $.ajax({
                            type: "post",
                            url: "<?php echo e(url('/')); ?>/chatStoreFromAdmin", // need to create this post
                            data: {
                                receiver_id: receiver_id,
                                message:message,
                                "_token": "<?php echo e(csrf_token()); ?>",
                            },
                            cache: false,
                            success: function (data) {
                            },
                            error: function (jqXHR, status, err) {
                            },
                            complete: function (data) {
                                console.log(data)
                                scrollToBottomFunc();
                            }
                        })
                    }
                });
            });
            // make a function to scroll down auto
            function scrollToBottomFunc() {
                $('.message-wrapper').animate({
                    scrollTop: $('.message-wrapper').get(0).scrollHeight
                }, 50);
            }

            function getChatUser() {
                $.ajax({
                    type: "get",
                    url: "<?php echo e(url('/')); ?>/getChatUser", // need to create this post

                    cache: false,
                    success: function (data) {

                        $(".user-wrapper").html(data)

                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function (data) {


                    }
                })
            }
        </script>





    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/admin/affilate/admin_chat.blade.php ENDPATH**/ ?>