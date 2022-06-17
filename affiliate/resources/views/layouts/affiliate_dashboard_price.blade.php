<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <!-- 3% -->
            <div class="info-box bg-aqua">
                    <span class="info-box-icon"  style="background: white;">
                        <img  style="border: 1px solid #ddd;margin-top: -9px;" src="{{url('/')}}/public/images/tshart.jpg">
                    </span>
                <?php
                // $order_count=53;
                if($order_count <10){
                    $count=$order_count;
                } else if($order_count >=10){
                    $count=9;
                }
                ?>
                <div class="info-box-content">
                    <span class="info-box-text">Target  1    </span>
                    <span class="info-box-number"> Need 10 sales </span>
                    <div class="progress">
                        <?php if($order_count >-1 ){
                        ?>
                        <div class="progress-bar" style="width: <?=$order_count*10?>%"></div>
                        <?php }  else { ?>
                        <div class="progress-bar" style="width: 0%"></div>
                        <?php }?>

                    </div>
              <span class="progress-description">
                   @if(RemainingOrder($order_count,10) <=0 )
                      achieved T-shart
                  @else
                      {{RemainingOrder($order_count,10)}}     sales to  T-shart
                  @endif

                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>


        </div>



        <div class="col-md-4">
            <!-- 4% -->
            <div class="info-box bg-blue">
                    <span class="info-box-icon" style="background: white;">
                         <img  style="border: 1px solid #ddd;margin-top: -9px;" src="{{url('/')}}/public/images/smart_watch.jpg">


                    </span>

                <?php
                if($order_count <10){
                    $count=0;
                } else if($order_count >=10 && $order_count <=19){
                    $count=$order_count;
                } else{
                    $count=19;
                }


                ?>

                <div class="info-box-content">
                    <span class="info-box-text">Target 2</span>
                    <span class="info-box-number">  Need 100 sales</span>

                    <div class="progress">
                        <?php

                        if($order_count >9 ){
                        $order_countt= $order_count-10;
                        ?>
                        <div class="progress-bar" style="width: <?=$order_countt*10?>%"></div>
                        <?php }  else { ?>
                        <div class="progress-bar" style="width: 0%"></div>
                        <?php }?>

                    </div>
              <span class="progress-description">
                   @if(RemainingOrder($order_count,100) <=0 )
                      achieved  Smart Watch
                  @else
                      {{RemainingOrder($order_count,100)}} sales to Smart Watch

                  @endif




                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>


        </div>


        <div class="col-md-4">
            <!-- 5% -->
            <div class="info-box bg-green">
                    <span class="info-box-icon" style="background: white;">
                                                <img  style="border: 1px solid #ddd;margin-top: -9px;" src="{{url('/')}}/public/images/phone.png">

                    </span>
                <?php
                if($order_count <19){
                    $count=0;
                } else if($order_count >19 && $order_count <29){
                    $count=$order_count;
                } else {
                    $count=29;
                }
                //                    else if($order_count >19 && $order_count <29){
                //                        $count=$order_count;
                //                    }


                ?>

                <div class="info-box-content">
                    <span class="info-box-text">Target  3</span>
                    <span class="info-box-number"> Need 1000 sales </span>

                    <div class="progress">
                        <?php

                        if($order_count >19 ){
                        $order_countt= $order_count-19;
                        ?>
                        <div class="progress-bar" style="width: <?=$order_countt*10?>%"></div>
                        <?php }  else { ?>
                        <div class="progress-bar" style="width: 0%"></div>
                        <?php }?>

                    </div>
              <span class="progress-description">

                      @if(RemainingOrder($order_count,1000) <=0 )
                      achieved  Smart Phone
                  @else
                      {{RemainingOrder($order_count,1000)}} sales to Smart Phone

                  @endif

                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>


        </div>

        <div class="col-md-4">
            <!-- 6% -->
            <div class="info-box bg-yellow">
                    <span class="info-box-icon" style="background: white;">
                                                <img style="border: 1px solid #ddd;margin-top: -9px;"  src="{{url('/')}}/public/images/laptop.jpg">

                    </span>
                <?php
                if($order_count <29){
                    $count=0;
                } else if($order_count >29 && $order_count <39){
                    $count=$order_count;
                } else {
                    $count=39;
                }
                //                    else if($order_count >19 && $order_count <29){
                //                        $count=0;
                //                    }
                //                    else if($order_count >29 && $order_count <39){
                //                        $count=$order_count;
                //                    }


                ?>

                <div class="info-box-content">
                    <span class="info-box-text">Target  4</span>
                    <span class="info-box-number"> Need 5000 sales </span>

                    <div class="progress">
                        <?php

                        if($order_count >29 ){
                        $order_countt= $order_count-29;
                        ?>
                        <div class="progress-bar" style="width: <?=$order_countt*10?>%"></div>
                        <?php }  else { ?>
                        <div class="progress-bar" style="width: 0%"></div>
                        <?php }?>

                    </div>
              <span class="progress-description">
                    @if(RemainingOrder($order_count,5000) <=0 )
                      achieved  Laptop
                  @else
                      {{RemainingOrder($order_count,5000)}} sales to Laptop

                  @endif

                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>


        </div>


        <div class="col-md-4">
            <!-- 6% -->
            <div class="info-box bg-red">
                    <span class="info-box-icon" style="background: white;">
                                                <img  style="border: 1px solid #ddd;margin-top: -9px;" src="{{url('/')}}/public/images/umrah.webp">

                    </span>
                <?php
                if($order_count <39){
                    $count=0;
                } else if($order_count >40 && $order_count <49){
                    $count=$order_count;
                }
                else  {
                    $count=49;
                }
                //                    else if($order_count >29 && $order_count <39){
                //                        $count=0;
                //                    }
                //                    else if($order_count >39 && $order_count <49){
                //                        $count=$order_count;
                //                    }


                ?>

                <div class="info-box-content">
                    <span class="info-box-text">Target  5</span>
                    <span class="info-box-number">  Need 15000 sales</span>

                    <div class="progress">
                        <?php

                        if($order_count >40 ){
                        $order_countt= $order_count-39;
                        ?>
                        <div class="progress-bar" style="width: <?=$order_countt*10?>%"></div>
                        <?php }  else { ?>
                        <div class="progress-bar" style="width: 0%"></div>
                        <?php }?>

                    </div>
              <span class="progress-description">

                    @if(RemainingOrder($order_count,15000) <=0 )
                      achieved  Umrah
                  @else
                      {{RemainingOrder($order_count,15000)}} sales to Umrah

                  @endif



                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>


        </div>


        <div class="col-md-4">
            <!-- 6% -->
            <div style="
    background-color: #da0811;
    color: white;
" class="info-box bg-darkcyan">
                    <span class="info-box-icon" style="background: white;">
                                                <img  style="border: 1px solid #ddd;margin-top: -9px;" src="{{url('/')}}/public/images/car.webp">

                    </span>

                <?php
                if($order_count <49){
                    $count=0;
                } else if($order_count >50 && $order_count <60){
                    $count=$order_count;
                }
                else {
                    $count=59;
                }
                //


                ?>

                <div class="info-box-content">
                    <span class="info-box-text">Target  6</span>
                    <span class="info-box-number">  Need 100000 sales</span>

                    <div class="progress">
                        <?php

                        if($order_count >50 ){
                        $order_countt= $order_count-49;
                        ?>
                        <div class="progress-bar" style="width: <?=$order_countt*10?>%"></div>
                        <?php }  else { ?>
                        <div class="progress-bar" style="width: 0%"></div>
                        <?php }?>

                    </div>
              <span class="progress-description">
                    @if(RemainingOrder($order_count,100000) <=0 )
                      achieved  Car
                  @else
                      {{RemainingOrder($order_count,100000)}} sales to Car

                  @endif
                  </span>
                </div>
                <!-- /.info-box-content -->
            </div>


        </div>




    </div>

</div>