@extends('website.master')
@section('mainContent')


    <section class="all-content-hide breadcrumb-section-main">
        <div class="container my-2">
            <div class="row">
                <div class="col-md-6 col-12 col-lg-6 col-xl-6 d-flex justify-content-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/customer/coin/history')}}">Coin History</a>
                            </li>

                        </ol>
                    </nav>

                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="container mt-2">
            <span id="data_id">   @include('website.coin_ajax')  </span>


        </div>
    </section>


    @if($user_id)
        <script>
            setInterval(()=>{getCoinDataByAjax()},15000);
            function getCoinDataByAjax() {
                $.ajax({
                    url:"{{url('/')}}/getCoinDataByAjax",
                    success:function (data) {

                        console.log("=cal_api=")
                        $('#data_id').html('')
                        $('#data_id').html(data.html)
                    }
                })
            }
        </script>
    @endif
@endsection
