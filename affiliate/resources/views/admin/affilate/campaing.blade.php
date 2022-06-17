@extends('layouts.master')
@section('pageTitle')
    My Campain Satatistics

@endsection
@section('mainContent')
    <div class="box-body">

        <br/>
        <div class="table-responsive">

            <table class="table table-bordered table-striped   ">
                <thead>
                <tr>

                    <th>Link</th>
                    <th>Click</th>
                    <th>Sell</th>
                    <th>Commision</th>
                    <th>Campaign Created </th>


                </tr>
                </thead>
                <tbody>


                <?php

                if($campaings){

                foreach($campaings as $row ){

                $click = DB::table('product_hit_count')->where('user_id', $row->user_id)->where('product_id', $row->product_id)->count();
                $order = DB::table('user_order_count')->where('user_id', $row->user_id)->where('link_id', $row->id)->count();
                $sum_order = DB::table('product_link_info')->select('commision')
                        ->join('user_commission', 'user_commission.link_id', '=', 'product_link_info.id')
                        ->join('earning_history', 'earning_history.order_id', '=', 'user_commission.order_id')
                        ->where('product_link_info.user_id', $row->user_id)
                        ->where('product_link_info.id', $row->id)
                        ->sum('earning_history.commision');

                ?>

                <tr>

                    <td>{{$row->product_link}}</td>


                    <td>{{$click}}</td>
                    <td>{{$order}}</td>
                    <td>{{$sum_order}}</td>
                    <td>{{ date('d/m/Y',strtotime($row->create_date))}}</td>
                    <?php
                    }


                    } ?>
                </tr>
                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>

    </div>

    <script>
        $(document).ready(function () {

            function fetch_data(page, query) {
                $.ajax({
                    type: "GET",
                    url: "{{url('admin/affilite/earning/pagination')}}?page=" + page + "&query=" + query,
                    success: function (data) {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serach', function () {
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                if (query.length > 0) {
                    fetch_data(page, query);
                } else {
                    fetch_data(1, '');
                }
            });


            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                fetch_data(page, query);
            });

        });
    </script>


@endsection

