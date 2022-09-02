@extends('layouts.master')
@section('pageTitle')
   Menu Permission
@endsection
@section('mainContent')

<style>
 

</style>
    <div class="box-body">

    <form action="{{ url('admin/menu/update/') }}/{{$role->id}}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf  
                <div id="accordion">
                <h3>Orders</h3>
                        <div> 
                             <li>
                                        <span>Orders</span>   
                                        <input   type="checkbox" name="parent[1]" @if(in_array('1',$role_menu)) checked @endif  value="Orders,fa fa-dashboard"  style="margin-left:460px"/>
                                                <table>
                                                    <tr>
                                                        <td>Add New Order</td>
                                                        <td><input   type="checkbox"   name="menu[1][201]" @if(in_array('201',$role_menu)) checked @endif value="Add New Order,admin/order/create"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>All Orders </td>
                                                        <td><input   type="checkbox" name="menu[1][202]" @if(in_array('202',$role_menu)) checked @endif value="All Orders,admin/orders"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Online Orders </td>
                                                        <td><input   type="checkbox" name="menu[1][203]" @if(in_array('203',$role_menu)) checked @endif value="Online Orders,admin/onlineOrders"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Sell Transfer </td>
                                                        <td><input   type="checkbox" name="menu[1][206]" @if(in_array('206',$role_menu)) checked @endif value="Sell Transfer ,admin/sellTransfer"  style="margin-left:440px"/></td>
                                                    </tr> 

                                                    <tr>
                                                        <td>Courier Report </td>
                                                        <td><input   type="checkbox" name="menu[1][204]" @if(in_array('204',$role_menu)) checked @endif value="Courier Report,admin/courier/view/report"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Order  Report</td>
                                                        <td><input   type="checkbox" name="menu[1][205]" @if(in_array('205',$role_menu)) checked @endif value="Order  Report,admin/order/report"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                   
                                                     
                                                </table>
                               </li>
                        </div>
                    <h3>Products</h3>
                             <div> 
                                    <li>
                                            <span>Products</span>   
                                            <input   type="checkbox" name="parent[2]"  @if(in_array('2',$role_menu)) checked @endif value="Products,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Product</td>
                                                            <td><input   type="checkbox" name="menu[2][210]" @if(in_array('210',$role_menu)) checked @endif value="Add New ,admin/product/create"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Product List</td>
                                                            <td><input   type="checkbox" name="menu[2][211]" @if(in_array('211',$role_menu)) checked @endif value="Product List,admin/products"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Product BarCode Generate</td>
                                                            <td><input   type="checkbox" name="menu[2][212]" @if(in_array('212',$role_menu)) checked @endif  value="Product BarCode Generate,admin/productBarCodeGenerate"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>All Unpublished Product</td>
                                                            <td><input   type="checkbox" name="menu[2][213]" @if(in_array('213',$role_menu)) checked @endif value="All Unpublished Product,admin/unpublishedProduct"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        
                                                        <tr>
                                                            <td>Staff Products List</td>
                                                            <td><input   type="checkbox" name="menu[2][214]" @if(in_array('214',$role_menu)) checked @endif value="Staff Products List,admin/staff-products"  style="margin-left:440px"/></td>
                                                        </tr> 

                                                    

                  
                                                    </table>
                                    </li>
                        </div>


                        <h3>Categories</h3>
                             <div> 
                                    <li>
                                            <span>Categories</span>   
                                            <input   type="checkbox" name="parent[3]"  @if(in_array('3',$role_menu)) checked @endif  value="Categories,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Category</td>
                                                            <td><input   type="checkbox" name="menu[3][20]"  @if(in_array('20',$role_menu)) checked @endif value="Add New Category,admin/category/create"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Product Categories</td>
                                                            <td><input   type="checkbox" name="menu[3][21]" @if(in_array('21',$role_menu)) checked @endif value="All Categories,admin/categories"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        
                                                    </table>
                                    </li>
                        </div>

                        <h3>Users</h3>
                             <div> 
                                    <li>
                                            <span>Users</span>   
                                            <input   type="checkbox" name="parent[4]"  @if(in_array('4',$role_menu)) checked @endif value="Users,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New User</td>
                                                            <td><input   type="checkbox" name="menu[4][22]"  @if(in_array('22',$role_menu)) checked @endif value="Add New User,admin/user/create"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Admin Users</td>
                                                            <td><input   type="checkbox" name="menu[4][23]" @if(in_array('23',$role_menu)) checked @endif value="Admin Users,admin/users"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Generel Users</td>
                                                            <td><input   type="checkbox" name="menu[4][250]" @if(in_array('250',$role_menu)) checked @endif value="Generel Users,generel/users"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Sliders</h3>
                             <div> 
                                    <li>
                                            <span>Sliders</span>   
                                            <input   type="checkbox" name="parent[5]"  @if(in_array('5',$role_menu)) checked @endif value="Sliders,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Slider</td>
                                                            <td><input   type="checkbox" name="menu[5][24]" @if(in_array('24',$role_menu)) checked @endif value="Add New Slider,admin/slider/create"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Admin Sliders</td>
                                                            <td><input   type="checkbox" name="menu[5][25]" @if(in_array('25',$role_menu)) checked @endif  value="Admin Sliders,admin/sliders"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                      
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Reports</h3>
                             <div> 
                                    <li>
                                            <span>Reports</span>   
                                            <input   type="checkbox" name="parent[6]" @if(in_array('6',$role_menu)) checked @endif  value="Reports,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                    <tr>
                                                            <td> Top Sell Product</td>
                                                            <td><input   type="checkbox" name="menu[6][29]" @if(in_array('29',$role_menu)) checked @endif  value="Top Sell Product,admin/report/heightSellProduct"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Order Reports</td>
                                                            <td><input   type="checkbox" name="menu[6][26]" @if(in_array('26',$role_menu)) checked @endif  value="Order Reports,admin/report/order_report"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Stock Reports</td>
                                                            <td><input   type="checkbox" name="menu[6][27]" @if(in_array('27',$role_menu)) checked @endif  value="Stock Reports,admin/report/stockReport"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Product Demand</td>
                                                            <td><input   type="checkbox" name="menu[6][28]" @if(in_array('28',$role_menu)) checked @endif value="Product Demand,admin/report/userProductDemand"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                        <td>Product Sell  Report</td>
                                                        <td><input   type="checkbox" name="menu[6][30]" @if(in_array('30',$role_menu)) checked @endif value="Product Sell  Report,admin/ProductSellReport"  style="margin-left:440px"/></td>
                                                       </tr> 
                                                       <tr>
                                                            <td>Stock Check</td>
                                                            <td><input   type="checkbox" name="menu[6][31]" @if(in_array('31',$role_menu)) checked @endif value="Stock Check,admin/productStockCheck"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                    </table>
                                    </li>
                           </div>

                           <h3>Zone Management</h3>
                             <div> 
                                    <li>
                                            <span>Zone Management</span>   
                                            <input   type="checkbox" name="parent[7]" @if(in_array('7',$role_menu)) checked @endif value="Zone Management,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Zone Stock</td>
                                                            <td><input   type="checkbox" name="menu[7][35]" @if(in_array('35',$role_menu)) checked @endif  value="Zone Stock,admin/zoneStock"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Courier</h3>
                             <div> 
                                    <li>
                                            <span>Courier</span>   
                                            <input   type="checkbox" name="parent[8]"  @if(in_array('8',$role_menu)) checked @endif value="Courier,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Courier</td>
                                                            <td><input   type="checkbox" name="menu[8][45]" @if(in_array('45',$role_menu)) checked @endif value="Add New Courier,admin/courier/create"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>All Couriers List</td>
                                                            <td><input   type="checkbox" name="menu[8][46]" @if(in_array('46',$role_menu)) checked @endif value="All Couriers List,admin/couriers"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Suppliyer</h3>
                             <div> 
                                    <li>
                                            <span>Suppliyer</span>   
                                            <input   type="checkbox" name="parent[9]" @if(in_array('9',$role_menu)) checked @endif value="Suppliyer,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Suppliyer</td>
                                                            <td><input   type="checkbox" name="menu[9][47]" @if(in_array('47',$role_menu)) checked @endif  value="Add New Suppliyer,admin/supply/create"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>All Suppliyer List</td>
                                                            <td><input   type="checkbox" name="menu[9][48]" @if(in_array('48',$role_menu)) checked @endif value="All Suppliyer List,admin/supply"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Media</h3>
                             <div> 
                                    <li>
                                            <span>Media</span>   
                                            <input   type="checkbox" name="parent[10]"  @if(in_array('10',$role_menu)) checked @endif value="Media,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Media Image</td>
                                                            <td><input   type="checkbox" name="menu[10][49]" @if(in_array('49',$role_menu)) checked @endif value="Add New Media Image,admin/media/create"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>All Product Images List</td>
                                                            <td><input   type="checkbox" name="menu[10][50]"  @if(in_array('50',$role_menu)) checked @endif value="All Product Images List,admin/media"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Zone & Shop</h3>
                             <div> 
                                    <li>
                                            <span>Zone & Shop</span>   
                                            <input   type="checkbox" name="parent[11]" @if(in_array('11',$role_menu)) checked @endif value="Zone & Shop,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Zone</td>
                                                            <td><input   type="checkbox" name="menu[11][51]" @if(in_array('51',$role_menu)) checked @endif value="Zone,admin/zone"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>Shop</td>
                                                            <td><input   type="checkbox" name="menu[11][52]" @if(in_array('52',$role_menu)) checked @endif value="Shop,admin/shop"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div>

                           <h3>Pages</h3>
                             <div> 
                                    <li>
                                            <span>Pages</span>   
                                            <input   type="checkbox" name="parent[12]" @if(in_array('12',$role_menu)) checked @endif  value="Pages,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Page</td>
                                                            <td><input   type="checkbox" name="menu[12][60]" @if(in_array('60',$role_menu)) checked @endif value="Add New Page,admin/page/create"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>All Pages</td>
                                                            <td><input   type="checkbox" name="menu[12][61]" @if(in_array('61',$role_menu)) checked @endif value="All Pages,admin/pages"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div> 

                           <h3>Setting</h3>
                             <div> 
                                    <li>
                                            <span>Setting</span>   
                                            <input   type="checkbox" name="parent[13]" @if(in_array('13',$role_menu)) checked @endif value="Setting,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Default Setting</td>
                                                            <td><input   type="checkbox" name="menu[13][63]" @if(in_array('63',$role_menu)) checked @endif value="Default Setting,admin/default/setting"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>Home Page Setting</td>
                                                            <td><input   type="checkbox" name="menu[13][64]" @if(in_array('64',$role_menu)) checked @endif value="Home Page Setting,admin/homepage/setting"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>Social Media Setting</td>
                                                            <td><input   type="checkbox" name="menu[13][65]" @if(in_array('65',$role_menu)) checked @endif value="Social Media Setting,admin/social/setting"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>Mail Setting</td>
                                                            <td><input   type="checkbox" name="menu[13][66]" @if(in_array('66',$role_menu)) checked @endif value="Mail Setting,admin/default/mailSetting"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        <tr>
                                                            <td>Clear Cache</td>
                                                            <td><input   type="checkbox" name="menu[13][67]" @if(in_array('67',$role_menu)) checked @endif value="Clear Cache,clear-cache"  style="margin-left:440px"/></td>
                                                        </tr>   
                                                        
                                                    </table>
                                    </li>
                           </div>  

                        <h3>Menu Permisssion</h3>
                        <div>
                     
                             <li>
                                        <span>Menu Permisssion</span>   
                                        <input   type="checkbox" name="parent[500]" @if(in_array('500',$role_menu)) checked @endif value="Menu Permisssion,admin/menuPermission , fa fa-book"  style="margin-left:460px"/>
                                                
                             </li>
                        </div>
                        
     
 
</div>
      
<button type="submit" class="btn btn-success">Update</button>

</form>
         
    </div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>

@endsection


