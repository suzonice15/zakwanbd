@extends('layouts.master')
@section('pageTitle')
    Vendor Commision list
@endsection
@section('mainContent')

    <div class="box-body">
        <div class="table-responsive" >
            <table id="example1" class="table table-bordered table-striped table-responsive ">
                <thead>
                <tr style="background-color:black;color:white">
                    <th>Order Id</th>
                    <th>Product</th>
                    <th>Product Price</th>
                    <th>Admin price</th>
                    <th>Vendor Amount</th>
                    <th>Status</th>

                    <th>Date</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>

                <?php if(isset($commisions)){

                        $count=0;
                $totalPrice=0;
                        $adminTotalPrice=0;
                        $vendorTotalPrice=0;
                     foreach ($commisions as $user){
                $adminTotalPrice += $user->amount;
                $vendorTotalPrice += $user->vendor_amount;


$count++;
                  $product = DB::table('product')
                          ->select('product_title')
                               ->where('product_id', $user->product_id)->first();


                        $order=DB::table('order_data')
                                ->select('products')
                                ->where('order_id',  $user->order_id)->first();
                                if($order){
                        $order_items = unserialize($order->products);



                        if(is_array($order_items['items'])) {
                        foreach ($order_items['items'] as $product_id => $item) {

                            if($product_id== $user->product_id){

                            $totall = intval(preg_replace('/[^\d.]/', '', isset($item['subtotal']) ? $item['subtotal'] : null));

                      $totalPrice +=$totall;
                        }}

                                }
                        }else {
                                    $totall=0;
                                }



                        ?>

                        <?php  if($user->status==1) { ?>
                        <tr style="background-color:#00a65a;color:white">

                            <?php } else { ?>
                        <tr style="background-color:#ddd;color:black">

                        <?php } ?>


                            <td>{{$user->order_id}} </td>



                            <td>{{$product->product_title}} </td>
                            <td>{{$totall}} </td>
                            <td>{{$user->amount}} </td>
                            <td>{{$user->vendor_amount}} </td>
                            <td>
                                <?php  echo $status=$user->status==1 ?
                               'Paid':'UnPaid'

                                    ?>

                            </td>
                            <td>{{$user->date}} </td>
                            <td>
                                <?php  if($user->status==0) { ?>
                                <a href="{{url('/')}}/vendor/product/price/pay/{{$user->id}}" class="btn btn-success">Paid</a>
                                    <?php } else { ?>
                                {{--<a href="{{url('/')}}/vendor/product/price/unpay/{{$user->id}}" class="btn btn-danger">Unpaid</a>--}}

                           <?php }?>
                            </td>


                        </tr>


                  <?php

                  }
                          }


            ?>


                <tr style="background-color:#8f3f71;color:white">

                    <td>{{$count}} </td>



                    <td>{{$count}} </td>
                    <td>{{$totalPrice}} </td>
                    <td>{{$adminTotalPrice}} </td>
                    <td>{{$vendorTotalPrice}} </td>
                    

                    <td colspan="4">
                    </td>


                </tr>
                </tbody>

            </table>
            <?php
          echo   $commisions->links();
            ?>

        </div>



    </div>


@endsection
