
<style>


    .glow {
        font-size: 25px;
        color: #fff;
        text-align: center;
        animation: glow 1s ease-in-out infinite alternate;
    }

    @-webkit-keyframes glow {
        from {
            text-shadow: 0 0 8px #fff, 0 0 15px #fff, 0 0 25px #e60073, 0 0 35px #e60073, 0 0 45px #e60073, 0 0 55px #e60073, 0 0 65px #e60073;
        }

        to {
            text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
        }
    }
</style>
<div class="row">
    <div class="col-md-12 col-12">
        <div class="panel panel-default">
            <div class="panel-heading glow" style="background: black;color: white !important;font-weight: bold;">Contest Sponsors  </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-12 col-md-12 sponsor-1" style="text-align: center;margin-bottom:15px;display: flex;text-align: center;flex-direction: row;justify-content: center;">
                        @if(isset($sponsor->sponsor_1))
                            {!! $sponsor->sponsor_1  !!}
                        @else
                            <?php echo  $sponsor->sponsor_add ;  ?>
                        @endif


                    </div>



                    <div class="col-12 col-md-6 sponsor-2" >
                        @if(isset($sponsor->sponsor_2))
                            {!! $sponsor->sponsor_2  !!}
                        @else
                            {!! $sponsor->sponsor_add  !!}
                        @endif

                    </div>
                    <div class="col-12 col-md-6 sponsor-3" style="text-align: center;margin-bottom: 10px">

                        @if(isset($sponsor->sponsor_3))
                            {!!$sponsor->sponsor_3  !!}
                        @else
                            {!!$sponsor->sponsor_add  !!}
                        @endif
                    </div>



                    {{--<div class="col-12 col-md-3 sponsor-4" style="text-align: center;">--}}
                        {{--@if(isset($sponsor->sponsor_4))--}}
                            {{--{!!$sponsor->sponsor_4  !!}--}}
                        {{--@else--}}
                            {{--{!!$sponsor->sponsor_add  !!}--}}
                        {{--@endif--}}

                    {{--</div>--}}
                    {{--<div class="col-12 col-md-3 sponsor-5" style="text-align: center;">--}}
                        {{--@if(isset($sponsor->sponsor_5))--}}
                            {{--{!!$sponsor->sponsor_5  !!}--}}
                        {{--@else--}}
                            {{--{!!$sponsor->sponsor_add  !!}--}}
                        {{--@endif--}}

                    {{--</div>--}}
                    {{--<div class="col-12 col-md-3 sponsor-6" style="text-align: center;">--}}
                        {{--@if(isset($sponsor->sponsor_6))--}}
                            {{--{!!$sponsor->sponsor_6  !!}--}}
                        {{--@else--}}
                            {{--{!!$sponsor->sponsor_add  !!}--}}
                        {{--@endif--}}

                    {{--</div>--}}
                    {{--<div class="col-12 col-md-3 sponsor-7" style="text-align: center;">--}}
                        {{--@if(isset($sponsor->sponsor_7))--}}
                            {{--{!!$sponsor->sponsor_7  !!}--}}
                        {{--@else--}}
                            {{--{!!$sponsor->sponsor_add  !!}--}}
                        {{--@endif--}}

                    {{--</div>--}}


                </div>



            </div>
            <div class="panel-footer"></div>
        </div>
    </div>





</div>
