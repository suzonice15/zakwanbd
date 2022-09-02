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


            <form name="product" onsubmit="return submitPrevent()"  action="{{ url('admin/order/store') }}" class="form-horizontal"
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
                                            <input  required  class="form-control" type="text" name="affiliate_mobile" id="affiliate_mobile"
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
                                            <input  required readonly type="text" name="user_id" class="form-control"  id="user_id"    value=""/>
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
                                        <select name="product_ids" id="product_ids" class="form-control select2 product_ids"  >
                                                    <?php foreach($products as $product) :
                                                    $product_title=$product->product_title;
                                                    ?>
                                                    <option value="{{$product->barcode}}"
                                                    >{{$product_title}} - {{$product->sku}} <span style="color:red"> ({{$product->stock}}) </span></option>
                                                    <?php endforeach; ?>
                                                </select>
                                    </div> 
                                    <div class="form-group" style="padding: 11px;margin-top: -21px;">
                                        <label>Pos Product </label> 
                                        <input type="text" name="pos-pinter" class="form-control product_ids" id="pos_product_id">
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
                                   <th class="quantity text-center" width="5%">Commision</th>
                                   <th class="price text-center" width="10%">Price</th>
                                   <th class="total text-center" width="10%">Sub-Total</th>
                                   <th class="total text-center" width="3%">Delete</th>
                               </tr>

                               <tr>
                                <tbody id="product_show">

                                <tr> 
                                    <td class="text-right" colspan='6'>  Total Amount</td> 
                                    <td class="text-center"><span id="total_subtotal_price"></span></td> 
                                    <td>
                                </tr>

                                <tr style="display:none"> 
                                    <td class="text-right" colspan='6'> Delivery Cost </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="shipping_charge" class="form-control" id="shipping_charge" value="0"> 
                                    </td> 
                                    <td>
                                </tr> 
                                <tr> 
                                    <td class="text-right" colspan='6'>Discount Price </td> 
                                    <td class="text-center"><input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="discount_price" class="form-control remove_zero" id="discount_price" value="0"> 
                                    </td> 
                                    <td>
                                </tr> 
                                
                                <tr> 
                                    <td class="text-right" colspan='6'>Paid Amount </td> 
                                    <td class="text-center"><input required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="text" name="advabced_price" class="form-control " id="advabced_price" value=""> 
                                    </td> 
                                    <td>
                                </tr>  

                                <tr> 
                                    <td class="text-right" colspan='6'>Return Amount </td> 
                                    <td class="text-center">
                                    <span id="total_amount"></span>
                                        <input onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" 
                                      type="hidden"   name="order_total" class="form-control" id="order_total" value=""> 
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
                $("#advabced_price").click(function(){
                    $("#advabced_price").val("")
                })
                $("#discount_price").click(function(){
                    $("#discount_price").val("")
                })

                function submitPrevent(){
                    var sum = 0;
                   let pos_product_id= $("#pos_product_id").val();
                   if(pos_product_id==''){ 
                    return true
                   }
                }

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
                        console.log("here...")              
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
                    affiliate_mobile = affiliate_mobile.trim();
                    $.ajax({
                        url:"{{url('/')}}/order/affiliateCheckByMobile/"+affiliate_mobile,
                        success:function(data){
                            if(data.success=='ok'){
                                $("#customer_name").val(data.name)                          
                                $("#customer_phone").val(data.phone)                          
                                $("#user_id").val(data.id)  
                            }else{
                                $("#customer_name").val('')                          
                                $("#customer_phone").val(affiliate_mobile)   
                                $("#user_id").val(2)   
                            } 
                        }

                    })                    
                })               
 
            </script> 
            <script>
                $(document).on('onbarcodescaned change', '.product_ids', function () {                    
                    let product_id=$(this).val(); 
                     
         //200 works fine for me but you can adjust it   
                                
                    $.ajax({
                        type: "get",
                        data: {product_id:product_id},
                        url: "{{  route('getOrderProduct')}}",
                        success: function (result) { 
                            $("#pos_product_id").val("");
                            
                            $("#pos_product_id").focus();
                            let check_value='no';

                            $('#product_show .barcode').each(function(){ 
                              var existingProduct=$(this).val();
                              if(existingProduct==product_id){
                                console.log("same")
                                check_value='yes';
                             } 
                            });
                          if(check_value=='no'){
                            $('#product_show').prepend(result);   
                          }else{
                           
                           var quantity= parseInt($("#product_quntity_"+product_id).val());
                           console.log(quantity)
                           quantity +=1;
                            $("#product_quntity_"+product_id).val(quantity).trigger("change");
                            
                          }
                                          
                                subTotalGenerate();  
                                return false;                                                  
                        },
                        errors: function (result) {                          
                            console.log(result)
                        }
                    }); 


                });

            </script>

@endsection


