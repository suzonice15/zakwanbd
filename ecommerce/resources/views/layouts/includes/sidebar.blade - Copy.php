<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('public/uploads/users')}}/{{ Session::get('picture') }}" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Session::get('name')}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php
        $status= Session::get('status');
        ?>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{ url('/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <?php
            if($status=='super-admin'   or $status=='admin' ) {
            ?>
            <?php } ?>
            <?php
            if($status=='super-admin' or $status=='office-staff' or $status=='admin' ) {
            ?>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/order/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Order</a></li>
                    <li><a href=" {{ url('admin/orders')}}"><i class="fa fa-arrow-circle-right"></i>All Orders</a></li>
                    <li><a href=" {{ url('admin/onlineOrders')}}"><i class="fa fa-arrow-circle-right"></i>Online Orders</a></li>
                    <li><a href=" {{ url('admin/courier/view/report')}}"><i class="fa fa-arrow-circle-right"></i>Courier Report</a></li>
                    <li><a href=" {{ url('admin/order/report')}}"><i class="fa fa-arrow-circle-right"></i>Order  Report</a></li>
                </ul>
            </li>
             <li>
                <a href="{{ url('/admin/generel/message') }}">
                    <i class="fa fa-envelope"></i> <span>User Message</span>
                   <span class="pull-right-container">
              <small class="label pull-right bg-red" id="website_message_count" onmousemove="website_message_count()">0</small>
            </span>
                </a>
            </li>
            <li>
                <a href="{{ url('/admin/questions') }}">
                    <i class="fa fa-envelope"></i> <span>Questions</span>
                   <span class="pull-right-container">

              <small class="label pull-right bg-red" id="questions_count" onmousemove="website_message_count()">0</small>
            </span>
                </a>
            </li>
        <?php } ?>
            <?php
            if($status=='editor' or $status=='admin') {
            ?>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Orders </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/order/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Order</a></li>
                    <li><a href=" {{ url('admin/orders') }}"><i class="fa fa-arrow-circle-right"></i>All Orders</a></li>


                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/product/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Product </a>
                    </li>
                    <li><a href=" {{ url('admin/products') }}"><i class="fa fa-arrow-circle-right"></i>All Products List</a></li>
                </ul>
            </li>
            <?php }

            if($status=='super-admin') {
            ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/product/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Product </a>
                    </li>
                    <li><a href=" {{ url('admin/products') }}"><i class="fa fa-arrow-circle-right"></i>All Products List</a></li>
                    <li><a href=" {{ url('admin/productBarCodeGenerate') }}"><i class="fa fa-arrow-circle-right"></i>  Products BarCode</a></li>
                    <li><a href=" {{ url('admin/unpublishedProduct') }}"><i class="fa fa-arrow-circle-right"></i>All Unpublished Product</a></li>
                    <li><a href=" {{ url('admin/staff-products') }}"><i class="fa fa-arrow-circle-right"></i>Staff Products List</a></li>
                    <li><a href=" {{ url('admin/top-deal-products') }}"><i class="fa fa-arrow-circle-right"></i>Top Deal Products</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Categories</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/category/create') }}"><i class="fa fa-arrow-circle-right"></i>Create category</a>
                    </li>
                    <li><a href=" {{ url('admin/categories') }}"><i class="fa fa-arrow-circle-right"></i>All Categories</a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/user/create') }}"><i class="fa fa-arrow-circle-right"></i>Create User</a></li>
                    <li><a href=" {{ url('admin/users') }}"><i class="fa fa-arrow-circle-right"></i>Admin Users</a></li>
                    <li><a href=" {{ url('admin/generel/users') }}"><i class="fa fa-arrow-circle-right"></i>Generel Users</a></li>


                </ul>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Sliders</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/slider/create') }}"><i class="fa fa-arrow-circle-right"></i>Add Slider </a></li>
                    <li><a href=" {{ url('admin/sliders') }}"><i class="fa fa-arrow-circle-right"></i>All Sliders</a></li>


                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Reports</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/report/order_report') }}"><i class="fa fa-arrow-circle-right"></i>Order Reports</a>
                    </li>
                    <li><a href=" {{ url('admin/report/stockReport') }}"><i class="fa fa-arrow-circle-right"></i>Stock Reports</a>
                    </li>
                    <li><a href=" {{ url('admin/report/userProductDemand') }}"><i class="fa fa-arrow-circle-right"></i>Product Demand</a>
                    </li>
                   
                   
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Zone Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">                    
                    <li><a href=" {{ url('admin/zoneStock') }}"><i class="fa fa-arrow-circle-right"></i>Zone Stock</a>
                    </li>
                   
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Courier</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/courier/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Courier </a>
                    </li>
                    <li><a href=" {{ url('admin/couriers') }}"><i class="fa fa-arrow-circle-right"></i>All Couriers List</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Suppliyer</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/supply/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New  </a>
                    </li>
                    <li><a href=" {{ url('admin/supply') }}"><i class="fa fa-arrow-circle-right"></i>Suppliyer List</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Media</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/media/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Media Image
                        </a></li>
                    <li><a href=" {{ url('admin/media') }}"><i class="fa fa-arrow-circle-right"></i>All Product Images List</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span>Zone & Shop </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/zone') }}"><i class="fa fa-arrow-circle-right"></i> Zone  </a></li>
                    <li><a href=" {{ url('admin/shop') }}"><i class="fa fa-arrow-circle-right"></i>Shop</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/page/create') }}"><i class="fa fa-arrow-circle-right"></i>Add New Page </a>
                    </li>
                    <li><a href=" {{ url('admin/pages') }}"><i class="fa fa-arrow-circle-right"></i>All Pages </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Setting</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href=" {{ url('admin/default/setting') }}"><i class="fa fa-arrow-circle-right"></i>Default Setting</a>
                    </li>
                    <li><a href=" {{ url('admin/homepage/setting') }}"><i class="fa fa-arrow-circle-right"></i>Home Page Setting</a></li>

                    <li><a href=" {{ url('admin/social/setting') }}"><i class="fa fa-arrow-circle-right"></i>Social Media Setting</a></li>
                    <li><a href=" {{ url('/clear-cache') }}"><i class="fa fa-arrow-circle-right"></i>clear-cache</a></li>
                    <li><a href=" {{ url('/admin/default/mailSetting') }}"><i class="fa fa-arrow-circle-right"></i>Mail Setting</a></li>
                </ul>
            </li>

        <?php } ?>

             <li>
                <a href="{{ url('/admin/menuPermission') }}">
                    <i class="fa fa-dashboard"></i> <span>Manu Permission</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>

            <?php     
          $value=  DB::table('roles')->where('id',1)->value('html');
            ?>

            {!! $value !!}


        </ul>
    </section>
  
</aside>
<script >
    function website_message_count() {
        $.ajax({
            url:"{{url('/')}}/admin/generel/message/notificationCount",
            success:function (data) {
                $('#website_message_count').text(data.message)
                $('#questions_count').text(data.product)
            }
        })
    }
    window.onload = function(e){
        website_message_count()
    }
</script>
