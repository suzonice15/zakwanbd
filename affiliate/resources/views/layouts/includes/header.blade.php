<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=get_option('site_title')?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <script src="{{asset('assets/')}}/ckeditor/ckeditor.js"></script>

    <!-- jQuery 3 -->
    <script src="{{ asset('assets/adminfile')}}/bower_components/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/adminfile')}}/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
        @media(max-width: 767px){
           .box-primary {
                border-top-color: #3c8dbc;
                margin-top: 50px;
            }
        }
        .pagination {
            display: inline-block;
            padding-left: 40px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
 <body class="fixed layout-boxed sidebar-mini sidebar-mini-expand-feature active menu-open skin-green-light" style="height: auto; min-height: 100%;"  >

<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/')  }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>A<b>T</b></span>
            <!-- logo for regular state and mobile devices -->
             <?php

                        $status=Session::get('status');
                        if($status=='user'){

                        ?>
            <span class="logo-lg"><b>zakwanbd.com</b></span>
            
            <?php } else { ?>
            
                        <span class="logo-lg"><b>Admin</b>Panel</span>
<?php } ?>
        </a>


        <?php

        $user_id=Session::get('id');

              $total_unsen_notification=  DB::table('product_update_affiliate_notification')->where('affiliate_id',$user_id)->where('status',0)->count();
              $notifications=  DB::table('product_update_affiliate_notification')
                      ->select('product_update_affiliate_notification.status','product_affiliate_notification_id','folder','feasured_image','product_title','previous_price','present_price','product_affiliate_notification_id')
                      ->join('product_update_notification','product_update_notification.product_id','=','product_update_affiliate_notification.product_id')
                      ->join('product','product_update_notification.product_id','=','product.product_id')
                      ->where('affiliate_id',$user_id)
                      ->where('product_update_affiliate_notification.status',0)
                      ->orderBy('product_update_notification.created_at','desc')
                      ->paginate(10);

        $total_messages=  DB::table('message_to_affilates')
                ->where('affiliate_id',$user_id)
                ->where('status',0)
                ->count();


        $messages=  DB::table('message_to_affilates')
                ->select('message')
                   ->where('affiliate_id',$user_id)
                ->where('status',0)
                ->orderBy('id','desc')
                ->paginate(10);



        $items = \Cart::getContent();
        $total = 0;
        $quantity = 0;
        foreach ($items as $row) {
            $total = \Cart::getTotal();
            $quantity = Cart::getContent()->count();
        }
        ?>


        <!-- Header Navbar: style can be found in header.less -->
        <style>
            .blink_me {
                animation: blinker 1s linear infinite;
            }

            @keyframes blinker {
                60% {
                    opacity: 0;
                }
            }
            .notification_active_class{
                font-weight: bold;color:black !important;
            }
            .notification_inactive_class{
              color:black
            }
            .padding_class_a{
                    padding: 10px 8.5px !important;
            }
        </style>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                @if($status=='super-admin' || session::get('email')=='suzonice15@gmail.com')
                    <li class="dropdown messages-menu">
                        <a   id="show_admin_note" style="color: white;font-weight: bold;" target="_blank"   >
                            <i class="fa fa-plus"></i>
                        </a>

                    </li>
                    @endif
                    
                     <li class="dropdown messages-menu">
                        <a  style="color: yellow;font-weight: bold;" target="_blank" class="padding_class_a blink_me" href="https://zakwanbd.com/customer/login/affiliate/{{Session::get('id')}}" >
                               Login to zakwanbd.com
                        </a>

                    </li>
                    
                    <li class="dropdown messages-menu">
                        <a  class="padding_class_a" href="{{url('/cart')}}" >
                            <i class="fa fa-shopping-cart"  ></i>
                            <span class="label label-danger">{{$quantity}}</span>
                        </a>

                    </li>

                    <li class="dropdown messages-menu">
                        <a class="padding_class_a"  href="{{url('/')}}/wishlist" >
                            <i class="fa fa-heart-o"  ></i>
                            @if(Session::get('total_wishlist_count')>0)
                                <span  class="label label-danger" id="wishlist_count">{{Session::get('total_wishlist_count')}}</span>
                            @endif

                        </a>

                    </li>
                    <li class="dropdown messages-menu">
                        <a  class="padding_class_a" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">{{$total_messages}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{$total_messages}} messages</li>
                            <li>
                                <ul class="menu">
                                   @if($messages)
                                       @foreach($messages as $message)
                                    <li>
                                        <a href="{{url('/')}}/user/message">
                                            <p>{{$message->message}}</p>
                                        </a>
                                    </li>
                                       @endforeach
                                       @endif
                                    </ul>
                            </li>
                            <li class="footer"><a href="{{url('/')}}/user/message">See All Messages</a></li>
                        </ul>
                    </li>

                    <li class="dropdown messages-menu">
                        <a  class="padding_class_a" href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span style=" font-size: 15px;" class="label label-danger">{{$total_unsen_notification}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{$total_unsen_notification}} notifications</li>
                            <li>
                                 <ul class="menu">
                                   @if($notifications)
                                       @foreach($notifications as $notification)
                                    <li>
                                        <div class="pull-left">
                                            <img   src="https://www.sohojbuy.com/public/uploads/{{$notification->folder}}/small/{{$notification->feasured_image}}" class="img-circle" alt="User Image">
                                        </div>
                                        <a href="#" >
                                            <p class="{{ $notification->status==0 ? 'notification_active_class':'notification_inactive_class' }}" >{{$notification->product_title}}</p>
                                            <p class="{{ $notification->status==0 ? 'notification_active_class':'notification_inactive_class' }}" >Old Price :{{$notification->previous_price}} Taka       New Price: {{$notification->present_price}} Taka</p>
                                        </a>
                                    </li>
                                        @endforeach
                                       @endif


                                </ul>
                            </li>
                            <li class="footer"><a href="{{url('/')}}/user/product/notification">See All notifications</a></li>
                        </ul>
                    </li>



                    <li class="dropdown user user-menu">
                        <a  class="padding_class_a"  href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $image= Session::get('picture');
                            if($image){
                            ?>
                            <img style="height: 20px; width: 25px;" src="{{url('public/uploads/')}}/{{ Session::get('picture') }}" class="img-circle"
                                 alt="User Image">

                            <?php } else { ?>

                            <img style="height: 20px; width: 25px;" src="{{ env('APP_ECOMMERCE') }}public/uploads/user.png" class="img-circle"
                                 alt="User Image">

                            <?php } ?>

                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <?php
                                $image= Session::get('picture');

                                if($image){
                                ?>
                                <img src="{{url('public/uploads/')}}/{{ Session::get('picture') }}" class="img-circle"
                                     alt="User Image">

                                <?php } else { ?>

                                <img src="{{ env('APP_ECOMMERCE') }}public/uploads/user.png" class="img-circle"
                                     alt="User Image">

                                <?php } ?>

                                <p>
                                    {{ Session::get('name')}}
                                    <small>{{ Session::get('created')}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                            @if($status !='super-admin')
                                <div class="pull-left">
                                    <a href="{{ url('/profile') }}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                @endif
                                <div class="pull-right">
                                    <a href="{{ url('/affilite/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    
                    <!--<li>-->
                    <!--    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
                    <!--</li>-->
                </ul>
            </div>





        </nav>
    </header>

    <div class="modal fade" id="admin_note" style="z-index:999999999;">
        <div class="modal-dialog m model-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Admin Note </h4>
                </div>
                <div class="modal-body" id="show_html">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script type="text/javascript">
        $("#show_admin_note").on('click', function() {
            $('#admin_note').modal('show');
            $.ajax({
                url:"{{url('/')}}/admin/note",
                success:function(data){

                    $("#show_html").html(data)
                }
            })
        });
    </script>



