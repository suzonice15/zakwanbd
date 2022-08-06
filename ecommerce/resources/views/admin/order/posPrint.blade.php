

<style type="text/css"> 
 
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  font-size:10px; 
}

</style>
 
    <!-- title row -->
    <div  style="float:center;width:288px;margin-top:-10px"> 
                <p style="text-align:center;font-size:25px;font-weight: bold;margin-top: 0px;margin-bottom: -13px;">Zakwan</p> 
                <p style="text-align:center;font-size:14px;">Zakwan Pharma & Supershop  </p> 
                <p style="margin-top: -12px;text-align:center;font-size: 16px;
                font-weight: bold;">www.zakwanbd.com</p> 

    </div> 

                <div  style="margin-top:-25px;float:left;width:288px;display: flex;flex-direction: row;
                justify-content:space-around"> 
                                <p style="font-size: 13px;
    border: 1px solid black;
    padding: 5px;
    font-weight: bold;
    width: 98px;
    text-align: center">V.No:1222</p> 
                                <p style="font-size: 13px;
    border: 1px solid black;
    padding: 5px;
    font-weight: bold;
    width: 99px;
    text-align: center;
                        ">Date:   <span style="float:right;font-size:9px">{{date("d/m/Y")}} <br/> {{date("h:i a")}} <span></p> 
                </div> 

   

    <div  style="margin-top:-10px; ">  
    <table style="width:100%">
                <tbody>
                <tr style="border:none">
                    <th width="20%"  style="text-align:left;left;border:1px solid white !important"  >Name</th><td  style="text-align:center;border:1px solid white !important" >:</td><td style="border:1px solid white !important">{{$order->customer_name}}</td> 
                </tr>
                <tr style="border:none">
                    <th width="20%"   style="text-align:left;border:1px solid white !important" >Affiliate ID</th><td style="text-align:center;border:1px solid white !important">:</td> <td style="border:1px solid white !important">{{$order->user_id}}</td> 
                </tr>
                
                </tbody>
                <table>

    </div> 

    <div class="product" style="margin-top:5px; " >

    <table class="table table-striped">
                <thead>
                <tr>
                    <th width="1%">Sl</th>
                    <th  width="50%" >Description</th> 
                    <th  width="20%" style="text-align: center">Price</th>
                    <th  width="20%" style="text-align: center">Amount</th>
                </tr>
                </thead>
                <tbody>

                <?php

                 
                $order_items = DB::table('order_details')->where('order_id',$order->order_id)->get();     


                $html = null;
                $subtotal=0;
                $count=0;
              
                    foreach ($order_items as $product_id => $item) {  
                          
                        $product = single_product_information($item->product_id);
                        $name = $product->product_title;
                        $subtotal +=$item->qnt*$item->price;
                ?>
                <tr>
                    <td><?=++$count?></td>
                    <td><span  >{{$name}}</span></td> 
                   
                    <td style="text-align: center">{{$item->price}} ×  {{$item->qnt}}  </td>
                    <td style="text-align: center">{{$item->qnt * $item->price}}  </td> 
                </tr>

                <?php   } ?>
                <tr>
                <td rowspan="3" colspan="2" style="text-align:center">Full Paid</td>  
                    <td colspan="1" style="text-align:right">Total Amount</td>                      
                    <td style="text-align: center">{{$subtotal}} </td> 
                </tr>
                <tr>
                    <td colspan="1" style="text-align:right">Discount</td>                      
                    <td style="text-align: center">{{$order->discount_price}} </td> 
                </tr>
                <tr>
                    <td colspan="1" style="text-align:right">Paid Amount</td>                      
                    <td style="text-align: center">{{$order->advabced_price}} </td> 
                </tr>

                </tbody>
            </table>
</div>

<div class="product" style="margin-top:-10px;">
   <p style="text-align:center;margin-left:150px">
   <u> Sujon</u>
</p> 
<p style="text-align:right;font-size:12px;margin-top:-15px;"> 
   Zakwan Pharma & Supershop
</p> 
  </div>

  <script >
 
    window.print();
 

</script>


     