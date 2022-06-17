@extends('website.customer.dashboard')
@section('profile_master')
    <div class="row">
        <div class="col-md-12 ">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th scope="col">Ser</th>
                        <th scope="col">Mission Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Parmalink</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($coins)
                        <?php $i=$coins->perPage() * ($coins->currentPage()-1);?>
                        @foreach($coins as $key=>$coin)
                            <tr class="text-center">
                                <td>{{++$i}}</td>
                                <td>{{$coin->coin_title}}</td>
                                <td>{{$coin->coin_description}}</td>
                                <td><a href="{{$coin->coin_link}}" style="color:white !important;font-weight: bold;width: 97px;" class="btn btn-success btn-sm">Visit Again</a></td>
                                <td>
                                @if($coin->status==0)
                                <button onclick="getCoinBonusById({{$coin->id}})"
                                        class="btn btn-danger btn-sm form-control font-weight-bold"
                                        style="font-weight: bold;background: #d04949;">Claim
                                </button>
                               @else
                                <a class="btn btn-success btn-sm form-control font-weight-bold"
                                   style="font-weight: bold;background: green;color:white !important;">Completed
                                </a>
                                @endif

                            </tr>
                        @endforeach
                    @endif
                    <tr class="text-center">
                        <td  colspan="5" class="text-center">
                            {!! $coins->links() !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>


        </div>

    </div>

    <script>
        function getCoinBonusById(id) {
            $.ajax({
                url: "{{url('/getCoinBonusById')}}/" + id,
                success: function (data) {
                    location.reload();
                }
            })
        }
    </script>

@endsection