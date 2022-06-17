<section class="content">

    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$new_count}}</h3>
                        <h4>@money($new_sum)</h4>

                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$phone_pending_count}}</h3>
                        <h4>@money($phone_pending_sum)</h4>

                        <p>Phone Pending Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$pending_payment_count}}</h3>
                        <h4>@money($pending_payment_sum)</h4>

                        <p>Pending Payment Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$processing_count}}</h3>
                        <h4>@money($processing_sum)</h4>

                        <p>Processing Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$on_courier_count}}</h3>
                        <h4>@money($on_courier_sum)</h4>

                        <p>Courier Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$delivered_count}}</h3>
                        <h4>@money($delivered_sum)</h4>

                        <p>Delivered Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$refund_count}}</h3>
                        <h4>@money($refund_sum)</h4>

                        <p>Refund Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$completed_count}}</h3>
                        <h4>@money($completed_sum)</h4>

                        <p>Completed Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <a href="http://localhost/suhojbuy.com/admin/orders" style="text-decoration: none">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$cancled_count}}</h3>
                        <h4>@money($cancled_sum)</h4>

                        <p>Cancled Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </a>
        </div>


    </div>

    <div class="row">

        <div class="col-md-12 table-responsive ">

            <?php


            $days=cal_days_in_month(CAL_GREGORIAN,$month,$years);

            ?>

            <style>
                table ,th ,tr,td{
                    text-align: center;
                }
            </style>

            <table class="table table-striped table-dark">
                <caption style="text-align: center;background-color: red;color: white;/* width: 98%; *//* padding: 9px; */font-size: 19px;font-weight: bold;" >Monthly Sales Report 1-<?=$month?>-<?=$years?> to <?=$days?>-<?=$month?>-<?=$years?></caption>
                <thead>
                <tr style="background-color:green;color:white">
                    <th scope="col">SL</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total Order</th>
                    <th scope="col">Total Amount</th>
                </tr>
                </thead>
                <tbody>

                <?php

                $final_total_order_count=0;
                $final_total_order_sum=0;
                for ($day=1;  $day<=$days;$day++) {

                $date=$years.'-'.$month.'-'.$day;
                $view_date=$day .'-'.$month.'-'.$years;
                $row='amnei disi';

                $total_order_count =DB::table('order_data')
                        ->where('order_date',$date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed')
                                    ->orWhere('order_status','=','on_courier')
                                    ->orWhere('order_status','=','delivered');
                        })->count();
                $total_order_sum   =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed')
                                    ->orWhere('order_status','=','on_courier')
                                    ->orWhere('order_status','=','delivered');
                        })
                        ->sum('order_total');

                $total_order_advaned_sum   =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed')
                                    ->orWhere('order_status','=','on_courier')
                                    ->orWhere('order_status','=','delivered');
                        })
                        ->sum('advabced_price');

                $total_order_discount_price_sum=DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed')
                                    ->orWhere('order_status','=','on_courier')
                                    ->orWhere('order_status','=','delivered');
                        })
                        ->sum('discount_price');

                if($view_date==date("d-m-Y")){
                    $bacground_color="red";
                    $color="white";
                } else {
                    $bacground_color="white";
                    $color="black";
                }
                $final_total_order_count +=$total_order_count;
                $final_total_order_sum +=$total_order_sum+$total_order_advaned_sum;

                ?>


                <tr style="background: <?=$bacground_color?>;font-size: 16px;color:<?=$color?>">
                    <th ><?=$day?></th>
                    <th ><?=$view_date?></th>
                    <td ><?=$total_order_count?></td>
                    <td><?=number_format($total_order_sum,2)?> Tk</td>
                </tr>



                <?php } ?>
                </tbody>

                <tr style="background: green;color:white;font-size: 16px">
                    <th ><?=$day?></th>
                    <th ><?=$view_date?></th>
                    <td ><?=$final_total_order_count?></td>
                    <td><?=number_format($final_total_order_sum,2)?> Tk</td>
                </tr>
            </table>








        </div>
    </div>
</section>
