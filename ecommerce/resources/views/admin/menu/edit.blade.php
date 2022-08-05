@extends('layouts.master')
@section('pageTitle')
   Menu Permission
@endsection
@section('mainContent')

<style>
 

</style>
    <div class="box-body">

    <form action="{{ url('admin/menu/update/1') }}" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf  
                <div id="accordion">
                <h3>Orders</h3>
                        <div> 
                             <li>
                                        <span>Orders</span>   
                                        <input   type="checkbox" name="parent[1]" value="Orders,fa fa-dashboard"  style="margin-left:460px"/>
                                                <table>
                                                    <tr>
                                                        <td>Add New Order</td>
                                                        <td><input   type="checkbox" name="menu[1][1]" value="Add New Order,admin/order/create"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                    <tr>
                                                        <td>Orders </td>
                                                        <td><input   type="checkbox" name="menu[1][2]" value="Orders,admin/orders"  style="margin-left:440px"/></td>
                                                    </tr> 
                                                </table>
                               </li>
                        </div>
                    <h3>Products</h3>
                             <div> 
                                    <li>
                                            <span>Products</span>   
                                            <input   type="checkbox" name="parent[2]" value="Products,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Product</td>
                                                            <td><input   type="checkbox" name="menu[2][10]" value="Add New ,admin/product/create"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Product List</td>
                                                            <td><input   type="checkbox" name="menu[2][11]" value="Product List,admin/products"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                    </table>
                                    </li>
                        </div>
                        <h3>Menu Permisssion</h3>
                        <div>
                     
                             <li>
                                        <span>Menu Permisssion</span>   
                                        <input   type="checkbox" name="parent[500]" value="Menu Permisssion,admin/menuPermission , fa fa-facebook"  style="margin-left:460px"/>
                                                
                             </li>
                        </div>
                        <h3>Sliders</h3>
                             <div> 
                                    <li>
                                            <span>Sliders</span>   
                                            <input   type="checkbox" name="parent[3]" value="Sliders,fa fa-dashboard"  style="margin-left:460px"/>
                                                    <table>
                                                        <tr>
                                                            <td>Add New Slider</td>
                                                            <td><input   type="checkbox" name="menu[3][20]" value="Add New,admin/slider/create"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                        <tr>
                                                            <td>Slider List</td>
                                                            <td><input   type="checkbox" name="menu[3][21]" value="Product List,admin/sliders"  style="margin-left:440px"/></td>
                                                        </tr> 
                                                    </table>
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


