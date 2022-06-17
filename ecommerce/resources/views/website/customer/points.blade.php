@extends('website.customer.dashboard')
@section('profile_master')


    <div class="row">


        <div class="col-md-12 ">

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th scope="col">Order Id</th>
                        <th scope="col">points</th>
                        <th scope="col">Get Point date</th>

                    </tr>
                    </thead>
                    <tbody>

                    @if($points)
                        @foreach($points as $point)
                    <tr>

                        <td>{{$point->order_id}}</td>








                        <td>{{$point->point}}</td>
                        <td>{{$point->point_earning_date}}</td>



                    </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>
            </div>


        </div>

    </div>

@endsection