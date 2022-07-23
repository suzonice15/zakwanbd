@extends('layouts.master')
@section('pageTitle')
Add New Order

@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12">


            <form name="product" action="{{ url('admin/order/store') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color: #ddd;">
                                    <h3 class="box-title">Customer Information</h3>

                                </div>
                                <div class="box-body">

                                    <div class="order_data" id="customer_info_change"
                                         style="padding: 18px;">

                                         <div class="form-group ">
                                            <label for="billing_name">Affiliate Mobile</label>
                                            <input   class="form-control" type="text" name="affiliate_mobile" id="affiliate_mobile"
                                                   value=" " />
                                        </div> 


                                        <div class="form-group ">
                                            <label for="billing_name">Name </label>
                                            <input required class="form-control" type="text" name="customer_name" id="customer_name" 
                                                   value=" "/>
                                        </div> 

                                        <div class="form-group ">
                                            <label for="billing_email">Customer Phone</label>
                                            <input required type="text" name="customer_phone"  id="customer_phone" class="form-control"
                                                   value=""/>
                                        </div> 

                                        <div class="form-group ">
                                            <label for="billing_email">Affiliate ID </label>
                                            <input disabled type="text" name="user_id" class="form-control"  id="user_id"    value=""/>
                                        </div> 

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="box box-danger" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color:#ddd">
                                    <h3 class="box-title">Actions</h3>
                                </div>
                                <div class="box-body">

                                    


                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label>Shipping Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>

                                            <input type="text" name="shipment_time"
                                                   class="form-control pull-right withoutFixedDate"
                                                   value="{{date("Y/m/d")}}">
                                        </div>
                                    </div>


                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label>Order Status</label> 
                                        <select name="order_status" id="order_status" class="form-control">  
                                            <option value="completed">Completed</option> 
                                        </select>
                                    </div> 

                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label>Product List </label> 
                                        <select name="product_ids" id="product_ids" class="form-control select2"  >
                                                    <?php foreach($products as $product) :
                                                    $product_title=$product->product_title;
                                                    ?>
                                                    <option value="{{$product->product_id}}"
                                                    >{{$product_title}} - {{$product->sku}}</option>
                                                    <?php endforeach; ?>
                                                </select>
                                    </div> 

                                  
                            </div>
                        </div>

                    </div>


                    </div>

                    <div class="row">



                            <div class="col-md-12">
                                <div class="box box-primary" style="border:2px solid #ddd">
                                    <div class="box-header" style="background-color:#ddd">
                                        <h3 class="box-title">Product Information</h3>
                                    </div>
                                    <div class="box-body">
                         
                           <table class="table   table-bordered">
                               <tr>
                                   <th class="name" width="30%">Product</th>
                                   <th class="text-center" width="5%">Code</th>
                                   <th class="image text-center" width="5%">Image</th>
                                   <th class="quantity text-center" width="5%">Qty</th>
                                   <th class="price text-center" width="10%">Price</th>
                                   <th class="total text-center" width="10%">Sub-Total</th>
                                   <th class="total text-center" width="3%">Delete</th>
                               </tr>

                               <tr>
                                <tbody id="product_show">

                                <tr> 
                                    <td class="text-right" colspan='5'>Sub Total</td> 
                                    <td class="text-center"><span id="total_subtotal_price"></span></td> 
                                    <td>
                                </tr>

                                <tr> 
                                    <td class="text-right" colspan='5'> Delivery Cost </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="shipping_charge" class="form-control" id="shipping_charge" value="0"> 
                                    </td> 
                                    <td>
                                </tr> 
                                <tr> 
                                    <td class="text-right" colspan='5'>Discount Price </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="discount_price" class="form-control" id="discount_price" value="0"> 
                                    </td> 
                                    <td>
                                </tr> 
                                
                                <tr> 
                                    <td class="text-right" colspan='5'>Paid Amount </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="advabced_price" class="form-control" id="advabced_price" value="0"> 
                                    </td> 
                                    <td>
                                </tr>  

                                <tr> 
                                    <td class="text-right" colspan='5'>Total </td> 
                                    <td class="text-center">
                                    <span id="total_amount"></span>
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="hidden" name="order_total" class="form-control" id="order_total" value=""> 

                                    </td> 
                                    <td>
                                </tr>  
                                
                               </tbody>
                               
                           </table> 

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                    </div>
                </div>
             </form>

            <script>

                function deleteRow(btn) {
                   let confirm_message= confirm("Are you sure you want to delete ?")
                   if(confirm_message){
                    var row = btn.parentNode.parentNode;
                        row.parentNode.removeChild(row);
                        subTotalGenerate();
                   }              
                }

                function quantityChange(quantity,product_id){
                    if(quantity >=1 ){                   
                   let price=parseInt($("#price_"+product_id).text());
                   let total_sub_total=price*quantity;
                   $("#subtotal_"+product_id).text(total_sub_total)
                   subTotalGenerate();
                }else{
                    alert("minimum 1 quantity need")
                }                   
                }

                function subTotalGenerate(){                  
                  var price = 0;
                    $('.subtotal_price').each(function(){
                        price += parseFloat($(this).text());  
                    }); 
                  $("#total_subtotal_price").text(price);  
                  totalGenerate();
                }
                function totalGenerate(){

                   let subtotal= parseInt($("#total_subtotal_price").text());   
                   let shipping_charge= parseInt($("#shipping_charge").val());   
                   let discount_price= parseInt($("#discount_price").val()); 
                   let advabced_price= parseInt($("#advabced_price").val()); 
                   
                   let summation=subtotal+shipping_charge;
                   let subtract=advabced_price+discount_price;

                   let total=summation-subtract;

                    $("#total_amount").text(total);
                    $("#order_total").val(total);
                    
                }

                $('#shipping_charge , #discount_price  , #advabced_price').on("input",function(e){
                    
                    totalGenerate();
                })

                $("#affiliate_mobile").blur(function(){
                    let affiliate_mobile=$("#affiliate_mobile").val();

                    $.ajax({
                        url:"{{url('/')}}/order/affiliateCheckByMobile/"+affiliate_mobile,
                        success:function(data){
                            if(data.success=='ok'){
                                $("#customer_name").val(data.name)                          
                                $("#customer_phone").val(data.phone)                          
                                $("#user_id").val(data.id)  
                            }else{
                                $("#customer_name").val('')                          
                                $("#customer_phone").val('')   
                                $("#user_id").val(2)   
                            } 
                        }

                    })
                    
                })

               
 
            </script> 
            <script>
                $(document).on('change', '#product_ids', function () {                    
                    let product_id=$(this).val();   
                    $.ajax({
                        type: "get",
                        data: {product_id:product_id},
                        url: "{{  route('getOrderProduct')}}",
                        success: function (result) { 
                            $('#product_show').prepend(result);
                            
                                subTotalGenerate();
                                                    
                        },
                        errors: function (result) {                          
                            console.log(result)
                        }
                    });

                });

            </script>





@endsection


