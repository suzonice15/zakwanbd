@extends('layouts.master')
@section('pageTitle')
   Live Support
@endsection
@section('mainContent')
    <style xmlns="http://www.w3.org/1999/html">
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
            background: white;
        }


        .messages .message {
            margin-bottom: 15px;
        }
        .messages .message:last-child {
            margin-bottom: 0;
        }
        .received, .sent {
            width: 70%;
            height: auto;
            padding: 3px 10px;
            border-radius: 10px;
        }
        .received {
            background: #e4e6eb;
            color: black;
            font-size: 17px;
        }
        .sent {
            background: #0084ff;
            float: right;
            color:white;
            text-align: right;
            font-size: 17px;
        }
        .message p {
            margin: 5px 0;
        }
        .sent  .date {
            color: white;
            font-size: 12px;
        }
        .received  .date {
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
        .chat-send-button{
            width: 96px;position: relative;left: -29px;height: 44px;top: -4px;
        }

        @media  (max-width: 776px) {
            .message-wrapper {
                padding: 10px;
                height: 300px;
                background: white;
            }
            .chat-send-button {
                width: 100%;
                position: relative;
                left: -1px;
                height: 44px;
                top: -19px;
            }

        }


    </style>


    <div class="container">
        <div class="row" style="margin-bottom: 50px;margin-top: 10px">
            <div class="col-md-11 col-sm-12" id="messages">
                <span class="messagebox">
                      @include('admin.affilate.affilite_chat_message')
                </span>
            </div>
            <div class="col-md-10 col-sm-12" id="messages">
                <input type="text" name="message"  placeholder="Type your message ....." id="message" class="submit">
             </div>
            <div class="col-md-1 col-sm-1 mt-2"    id="messages">
                <br>

                <button type="button" name="message" id="submit_chat" class="form-control btn btn-success chat-send-button"><i class="fa fa-fw fa-send-o"></i> Send</button>
            </div>
            <br>
            <br>
        </div>


    </div>

        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            var user_id = "{{ Session::get('id') }}";
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
                    // alert(JSON.stringify(data));
                    if (user_id == data.from) {
                        scrollToBottomFunc();
                        getChat(user_id);
                    } else if (user_id == data.to) {
                        scrollToBottomFunc();
                        getChat(user_id);
                    }

                })
                });




                $(document).on('click', '#submit_chat', function (e) {

                    var message = $("#message").val();
                    console.log(message)
                    // check if enter key is pressed and message is not null also receiver is selected
                    if ( message != '' ) {
                        $("#message").val(''); // while pressed enter text box will be empty

                        $.ajax({
                            type: "post",
                            url: "{{url('/')}}/chatStoreFromAffiliate", // need to create this post
                            data: {
                                message:message,
                                "_token": "{{ csrf_token() }}",
                            },
                            cache: false,
                            success: function (data) {
                            },
                            error: function (jqXHR, status, err) {
                            },
                            complete: function (data) {

                                scrollToBottomFunc();
                            }
                        })
                    }

            });
            // make a function to scroll down auto
            function scrollToBottomFunc() {
                $('.message-wrapper').animate({
                    scrollTop: $('.message-wrapper').get(0).scrollHeight
                }, 50);
            }
            function getChat() {
                $.ajax({
                    type:"GET",
                    url:"{{url('getchat/fromAffilite')}}",
                    success:function(data)
                    {

                        $('.messagebox').html(data);

                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }

        </script>







@endsection

