<section class="content">

    

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
            <caption style="text-align: center;background-color: red;color: white;/* width: 98%; *//* padding: 9px; */font-size: 19px;font-weight: bold;" >Monthly Sales Report 1-<?=date('m')?>-<?=date('Y')?> to <?=$days?>-<?=date('m')?>-<?=date('Y')?></caption>
                <thead>
                <tr id="table_report_heading" style="background-color:green;color:white">
                    <th scope="col">SL</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total Order</th>
                    <th scope="col">Total Sell Amount</th>
                    <th scope="col">Total Discount Amount</th>
                    <th scope="col">Total Profit</th>
                    <th scope="col">Affiliate Profit</th>
                    <th scope="col">Company Profit</th>
                </tr>
                </thead>
                <tbody>

                <?php

                
            $final_total_order_count=0;
            $final_total_order_sum=0;
            $final_total_profit_sum=0;
            $final_total_commision_paid_to_affiliate=0;
            $final_total_company_profit=0;
            $final_total_discount_price=0;
            for ($day=1;  $day<=$days;$day++) {

                $date=$years.'-'.$month.'-'.$day;
                $view_date=$day .'-'.$month.'-'.$years;
                $row='amnei disi';

                $total_order_count =DB::table('order_data')
                        ->where('order_date',$date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed');
                        })->count();

                        $total_sell_amount=0;              
                        $total_net_profite_sum=0;              
                        $company_profit=0;              
                       
                        $total_order_sum   =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed');
                        })
                        ->sum('advabced_price'); 
                        $total_return_amount   =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed');
                        })
                        ->sum('order_total'); 

                        $total_sell_amount=$total_order_sum+$total_return_amount; 

                        $total_discount_price  =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed');
                        })
                        ->sum('discount_price'); 
                        
                  $total_profit_sum   =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed');
                        })
                        ->sum('total_profit_for_company'); 

                        $total_net_profite_sum=$total_profit_sum-$total_discount_price;

                        $total_commision_paid_to_affiliate   =DB::table('order_data')->where('order_date', $date)
                        ->where(function ($query) use ($row) {
                            return $query->orWhere('order_status','=','completed');
                        })
                        ->sum('total_commision_paid_to_affiliate');
                        $final_total_commision_paid_to_affiliate +=$total_commision_paid_to_affiliate;

                  

                       

                       
                        $final_total_discount_price +=$total_discount_price;

                        $company_profit=$total_profit_sum-($total_discount_price+$total_commision_paid_to_affiliate);
                        $final_total_company_profit +=$company_profit;
                       
                        $final_total_profit_sum +=$total_net_profite_sum;

                    if($view_date==date("d-m-Y")){
                        $bacground_color="red";
                        $color="white";
                    } else {
                        $bacground_color="white";
                        $color="black";
                    }
            $final_total_order_count +=$total_order_count;
            $final_total_order_sum +=$total_sell_amount;

            ?>


                <tr style="background: <?=$bacground_color?>;font-size: 16px;color:<?=$color?>">
                    <th ><?=$day?></th>
                    <th ><?=$view_date?></th>
                    <td ><?=$total_order_count?></td>
                    <td><?=number_format($total_sell_amount,2)?> Tk</td>
                    <td><?=number_format($total_discount_price,2)?> Tk</td>
                    <td><?=number_format($total_net_profite_sum,2)?> Tk</td>
                    <td><?=number_format($total_commision_paid_to_affiliate,2)?> Tk</td>
                    <td><?=number_format($company_profit,2)?> Tk</td>
                </tr>



        <?php } ?>
                </tbody>

                <tr style="background: green;color:white;font-size: 16px">
                    <th ></th>
                    <th ><?=$view_date?></th>
                    <td ><?=$final_total_order_count?></td>
                    <td><?=number_format($final_total_order_sum,2)?> Tk</td>
                    <td><?=number_format($final_total_discount_price,2)?> Tk</td>
                    <td><?=number_format($final_total_profit_sum,2)?> Tk</td>
                    <td><?=number_format($final_total_commision_paid_to_affiliate,2)?> Tk</td>
                    <td><?=number_format($final_total_company_profit,2)?> Tk</td>
                </tr>
            </table>








        </div>
    </div>
</section>


<script>
        
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
          if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
            $("#table_report_heading").css({"position": "fixed", "top": "50px","width":"85%","display":"inline-table","left":"257px"});
          } else {
            $("#table_report_heading").css({"position": "relative","top": "0px","width":"100%","display":"revert","left":"0px"});
          }
        }
         
        </script>
