<li>
    <a href=" {{ url('user/chat/') }}"><i class="fa fa-envelope" style="font-size: 20px"></i>  Contact Support
               <span class="pull-right-container">
               <small class="label pull-right bg-red"   id="user_chat_count">0</small>
             </span>

    </a>

</li>




<li>
    <a href=" {{ url('user/affilite/orderForCustomer') }}"><i class="fa fa-shopping-cart" style="font-size: 20px"></i>&nbsp Order For Customer </a>
</li>



<li class="treeview">
    <a href="#">
        <i class="fa fa-product-hunt fs-large "></i>
        <span>Products</span>
                    <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" {{ url('user/product/link-generator') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>All Products</a>
        </li>
        <li><a href=" {{ url('user/product/hot-deals') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Top Deals </a>
        </li>
        <li><a href=" {{ url('user/tending/products') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Tending Products</a>
        </li>
    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class=" fa fa-user-md fs-large "></i>
        <span>Top Members</span>  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" {{ url('admin/affilite/top_referrers') }}">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                </i>Top Referrers </a>
        </li>
        <li><a href=" {{ url('admin/affilite/top_earner') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>
               Top Earner  </a>
        </li>
        <li>
            <a href=" {{ url('user/affilite/top/affiliates') }}">
                <i class="fs-small fa fa-arrow-circle-right"></i>
            Top Affiliates</a>
        </li>
        <li>
            <a href=" {{ url('user/teamSummary') }}">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Team Summary </a>
        </li>

    </ul>
</li>

<li class="treeview">
    <a href="#">
        <i class="fa fa-list fs-large "></i>
        <span> History </span>
                    <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" {{ url('admin/affilite/earnings') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Earning History</a>
        </li>

        <li><a href=" {{ url('admin/affilite/orderhistory') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Purchase History</a>
        </li>
        <li><a href=" {{ url('wallet') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Wallet History</a>
        </li>
        <li><a href=" {{ url('admin/affilite/campaign') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i> Campaign Statistics</a>
        </li>
        <li><a href=" {{ url('admin/affilite/referrals') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i> My Referrals History</a>
        </li>
        <li><a href=" {{ url('user/customers') }}">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i> My Customer </a>
        </li>


    </ul>
</li>



<li>
    <a href=" {{ url('withdraw') }}"><i class="fa fa-won" style="font-size: 20px"></i>  Withdraw </a>
</li>

<li>
    <a href="{{ url('/affiliate/complain') }}"><i class="fa fa-calendar-plus-o" style="font-size: 20px"></i>  Complain </a>
</li>
<li>
    <a href=" {{ url('/profile') }}"><i  style="font-size: 20px" class="fa fa-fw fa-user"></i>&nbsp Profile  </a>
</li>
<li>
    <a href=" {{ url('/channedPassword') }}"><i  style="font-size: 20px" class="fa fa-key fa-key"></i>Changed Password  </a>
</li>

