<style>
    .fs-large{
        font-size: 20px;
        font-weight: bold;
    }
    .fs-small{
        font-size: 18px;
        font-weight: bold;
    }
</style>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="background-color: #9f29ff">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php
               $image= Session::get('picture');
                    if($image){
                ?>
                <img src="{{url('public/uploads/')}}/{{ Session::get('picture') }}" class="img-circle"
                     alt="User Image">

                <?php } else { ?>

                    <img  src="{{ env('APP_ECOMMERCE') }}public/uploads/user.png" class="img-circle"
                         alt="User Image">

                <?php } ?>
            </div>
            <div class="pull-left info">
                <p style="color:white;font-weight: bold">{{ Session::get('name')}}</p>
                <?php
                $status= Session::get('status');

                ?>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                @if($status=='user')
                <br>
                <a href="{{url('/profile')}}">
                @if(Session::get('accountVarificationStatus')==1)
                    <span style="color:green">Verified</span>
                    @elseif(Session::get('accountVarificationStatus')==2)
                    <span style="color:green">National Id Verified</span>
                @elseif(Session::get('accountVarificationStatus')==3)
                    <span style="color:green">Address  Verified</span>
                @elseif(Session::get('accountVarificationStatus')==4)
                    <span style="color:red">Pending</span>
                    @else
                        <span style="color:red">Verify your account</span>
                    @endif
                </a>
                    @endif
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li>
                <a href="{{ url('/dashboard') }}">
                    <i class=" fs-large fa fa-dashboard"></i> <span>&nbsp Dashboard</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
             <?php
                 if($status =='user'){
                ?>
           @include('layouts.includes.affiliate_sidebar')
            <?php
                }
            if($status =="super-admin"){
            ?>
            @include('layouts.includes.admin_sidebar')

        <?php }

            if($status =='office-staff' || $status =='editor' ){

                ?>

            <li>
                <a href=" {{ url('admin/chat/') }}"><i class="fa fa-user" style="font-size: 20px"></i>&nbsp &nbsp Chat </a>
            </li>
            <li>
                <a href=" {{ url('/admin/marketing/metarial') }}"><i class="fa fa-circle-o" style="font-size: 20px"></i>   Member Marketing Material  </a>
            </li>
            <li>
                <a href=" {{ url('admin/affilator_list') }}"><i class="fa fa-circle-o" style="font-size: 20px"></i>  Affilator list</a>
            </li>


            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


<script >

    function withdraw_count() {

        $.ajax({
            url:"{{url('/')}}/withdraw/notification/count",
            success:function (data) {
                $('#withdraw_count').text(data)
            }
        })
    }
    function user_chat_count() {

        $.ajax({
            url:"{{url('/')}}/user_chat_count",
            success:function (data) {
                if(data>0){
                    $('#user_chat_count').text(data)

                } else {

                    $('#user_chat_count').hide()
                }

            }
        })
    }


    window.onload = function(e){
        withdraw_count()
        user_chat_count()
    }

</script>
