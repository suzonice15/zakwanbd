<li>
    <a href=" <?php echo e(url('admin/message/')); ?>"><i class="fa fa-envelope" style="font-size: 20px"></i>&nbsp &nbsp Message </a>
</li>
<li>
    <a href=" <?php echo e(url('admin/chat/')); ?>"><i class="fa fa-user" style="font-size: 20px"></i>&nbsp &nbsp Chat </a>
</li>


<li>
    <a href=" <?php echo e(url('/admin/marketing/metarial')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i>   Member Marketing Material  </a>
</li>







<li class="treeview">
    <a href="#">
        <i class="fa fa-table fs-large "></i>
        <span>History</span>
                    <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">

        <li><a href=" <?php echo e(url('admin/withdraw')); ?>">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                Withdraw History   <small class="label pull-right bg-red"  onMouseOver="withdraw_count()" id="withdraw_count">0</small></a>
        </li>
        <li><a href=" <?php echo e(url('admin/income/history')); ?>">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                 Income History</a>
        </li>
        <li><a href=" <?php echo e(url('admin/purchase/history')); ?>">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Purchase History</a>
        </li>
        <li><a href=" <?php echo e(url('admin/wallet')); ?>">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Wallet History </a>
        </li>




    </ul>
</li>






<li class="treeview">
    <a href="#">
        <i class="fa fa-user fs-large "></i>
        <span>Affiliate</span>
                    <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" <?php echo e(url('admin/affilator_list')); ?>">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Affilator list</a>
        </li>
        <li><a href=" <?php echo e(url('admin/affiliate_varification_list')); ?>">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Affiliates Varification list</a>
        </li>
        <li><a href=" <?php echo e(url('admin/inactive/affiliate')); ?>">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Inactive Affiliate</a>
        </li>




    </ul>
</li>
 
 <li> 
 <a href=" <?php echo e(url('admin/getCharge')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i> Service Charge </a> 
 </li> 
<li>
    <a href=" <?php echo e(url('admin/online/user')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i> Online Users</a>
</li>
<li>
    <a href=" <?php echo e(url('admin/campain/report')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i> Campaign Report</a>
</li>
 
<!-- <li>
    <a href=" <?php echo e(url('admin/royalty/history')); ?>"><i class="fa fa-history" style="font-size: 20px"></i>&nbsp Royalty Fund Management</a>
</li>
<li>
    <a href=" <?php echo e(url('admin/contest/history')); ?>"><i class="fa fa-history" style="font-size: 20px"></i>&nbsp Contest Fund Management</a>
</li> -->

<li><a href=" <?php echo e(url('admin/product/notification/delete')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i>Affiliate Product Notification</a>

<li class="treeview">
    <a href="#">
        <i class=" fs-large fa fa-product-hunt"></i>
        <span>Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" <?php echo e(url('admin/page/create')); ?>"><i class="fs-small fa fa-arrow-circle-right"></i>Add New Page </a>
        </li>
        <li><a href=" <?php echo e(url('admin/pages')); ?>"><i class="fs-small fa fa-arrow-circle-right"></i>All Pages </a></li>


    </ul>
</li>
<!-- 
<li class="treeview">
    <a href="#">
        <i class="fs-large fa fa-book"></i>
        <span>Education</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" <?php echo e(url('admin/education/create')); ?>"> <i class="fs-small fa fa-arrow-circle-right"></i>Add Education </a>
        </li>
        <li><a href=" <?php echo e(url('admin/education-list')); ?>"> <i class="fs-small fa fa-arrow-circle-right"></i>Education List </a></li>


    </ul>
</li> -->

<li>
    <a href=" <?php echo e(url('admin/achievements')); ?>"><i class="fa fa-circle-o" style="font-size: 20px"></i>  Achievements </a>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-cog fs-large "></i>
        <span>Setting</span>
                    <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        <li><a href=" <?php echo e(url('admin/default/setting')); ?>">

                <i class="fs-small fa fa-arrow-circle-right"></i>

                </i>Default Setting</a>
        </li>
        <li><a href=" <?php echo e(url('clear-cache')); ?>">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Clear Cache</a>
        </li>
        <!-- <li><a href=" <?php echo e(url('admin/default/register-offer')); ?>">
                <i class="fs-small fa fa-arrow-circle-right"></i>
                Register Offer</a>
        </li> -->
        <!-- <li><a href=" <?php echo e(url('admin/default/bonus-offer')); ?>"> <i class="fs-small fa fa-arrow-circle-right"></i>Bonus Offer</a>
        </li> -->
        <!-- <li><a href=" <?php echo e(url('admin/default/cashback-offer')); ?>"> <i class="fs-small fa fa-arrow-circle-right"></i>Cash Back Offer</a>
        </li> -->
        <!-- <li><a href=" <?php echo e(url('admin/sponsor')); ?>"> <i class="fs-small fa fa-arrow-circle-right"></i>Sponsor Setting</a>
        </li> -->


    </ul>
</li>




<li><a href=" <?php echo e(url('admin/affiliate/complain')); ?>">

        <i class="far fa-comment-alt"></i>
        <i class="fa fa-circle-o" style="font-size: 20px"></i>

        Affiliate Complain</a><?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/layouts/includes/admin_sidebar.blade.php ENDPATH**/ ?>