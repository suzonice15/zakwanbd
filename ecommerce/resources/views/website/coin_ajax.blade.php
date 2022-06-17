<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color:darkviolet;text-align: center;">
                @if($user_id)
                  <p style="color:white;font-weight:bold">  <img class="img-fluid blink_me " src="http://localhost/suhojbuy.com//public/logo/coin.png" > <span style="color:black;background-color:#fff;margin-top: 3px;padding:3px;position: relative;top: 4px;left:1px;border-radius:3%">{{number_format($bonus_blance,2)}} coins </span>
                  </p>
                    @else
                   <span style="color:white"> Please login to earn coin  </span><a  style="color:white !important;" class="ms-5" href="{{url('/customer/login')}}/">Login....</a>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                    @foreach($coins as $coin)
                        <tr>
                             <td>  <img width="60" src="{{url('/')}}/public/uploads/category/{{$coin->coin_icon}}" class="image-responsive"></td>
                            <td width="90%">
                               <h5> {{$coin->coin_title}} </h5>
                                <p>{{$coin->coin_description}}</p>
                            </td>
                            <td width="10%" class="text-end">
                                <img class="img-fluid blink_me" src="{{asset('/')}}public/logo/coin.png" />
                                x100

                                </br>
                                @if(isset($user_id))
                                    <?php $coin_history = checkCoinHistoryByUserId($user_id, $coin->id);
                                    if ($coin_history) {
                                    if($coin_history->status==0){
                                    ?>
                                    <button onclick="getCoinBonusById({{$coin_history->id}})"
                                            class="btn btn-danger btn-sm form-control font-weight-bold"
                                            style="font-weight: bold;background:yellow;border: none;color:black !important;">Claim
                                    </button>
                                    <?php } else {  ?>
                                    <a class="btn btn-success btn-sm form-control font-weight-bold"
                                       style="font-weight: bold;background: green;color:white !important;">Completed
                                    </a>

                                    <?php } }else { ?>
                                    <a target="_blank" href="{{$coin->coin_link}}?coin={{$coin->id}}"
                                       class="btn btn-info btn-sm form-control font-weight-bold"
                                       style="color:white !important;font-weight:bold">Go
                                    </a>
                                    <?php } ?>
                                @else
                                    <a target="_blank" href="{{$coin->coin_link}}?coin={{$coin->id}}"
                                       class="btn btn-info btn-sm form-control font-weight-bold"
                                       style="color:white !important;font-weight:bold;">Go
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
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
    function getCoinBonusById(id) {
        $.ajax({
            url: "{{url('/getCoinBonusById')}}/" + id,
            success: function (data) {
                getCoinDataByAjax()
            }
        })
    }

</script>