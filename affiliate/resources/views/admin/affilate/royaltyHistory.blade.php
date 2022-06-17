@extends('layouts.master')
@section('pageTitle')
    Royalty Fund Management
@endsection
@section('mainContent')
    <div class="box-body">
        <br/>


        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Home</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Royalty History</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Royalty Fund Distribution </a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">

                            <div class="row">
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><i
                                                    class="ion ion-ios-gear-outline"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Royalty Fund</span>
                                            <span class="info-box-number">{{$fund->amount}} Taka</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12">

                                    <form method="post" action="{{url('/')}}/royalty-commision">
                                        @csrf
                                        <div class="form-group">
                                            <label for="commistion_lavel_1">Position 1</label>
                                            <input type="number" class="form-control" name="commistion_lavel_1"
                                                   id="commistion_lavel_1" value="{{$commision->commistion_lavel_1}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 2</label>
                                            <input type="number" class="form-control" name="commistion_lavel_2"
                                                   id="commistion_lavel_2" value="{{$commision->commistion_lavel_2}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 3</label>
                                            <input type="number" class="form-control" name="commistion_lavel_3"
                                                   id="commistion_lavel_3" value="{{$commision->commistion_lavel_3}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 4</label>
                                            <input type="number" class="form-control" name="commistion_lavel_4"
                                                   id="commistion_lavel_4" value="{{$commision->commistion_lavel_4}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 5</label>
                                            <input type="number" class="form-control" name="commistion_lavel_5"
                                                   id="commistion_lavel_5" value="{{$commision->commistion_lavel_5}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 6</label>
                                            <input type="number" class="form-control" name="commistion_lavel_6"
                                                   id="commistion_lavel_6" value="{{$commision->commistion_lavel_6}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 7</label>
                                            <input type="number" class="form-control" name="commistion_lavel_7"
                                                   id="commistion_lavel_7" value="{{$commision->commistion_lavel_7}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 8</label>
                                            <input type="number" class="form-control" name="commistion_lavel_8"
                                                   id="commistion_lavel_8" value="{{$commision->commistion_lavel_8}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 9</label>
                                            <input type="number" class="form-control" name="commistion_lavel_9"
                                                   id="commistion_lavel_9" value="{{$commision->commistion_lavel_9}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>
                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 10</label>
                                            <input type="number" class="form-control" name="commistion_lavel_10"
                                                   id="commistion_lavel_10"  value="{{$commision->commistion_lavel_10}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 11</label>
                                            <input type="number" class="form-control" name="commistion_lavel_11"
                                                   id="commistion_lavel_11"  value="{{$commision->commistion_lavel_11}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 12</label>
                                            <input type="number" class="form-control" name="commistion_lavel_12"
                                                   id="commistion_lavel_12"  value="{{$commision->commistion_lavel_12}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 13</label>
                                            <input type="number" class="form-control" name="commistion_lavel_13"
                                                   id="commistion_lavel_13"  value="{{$commision->commistion_lavel_13}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 14</label>
                                            <input type="number" class="form-control" name="commistion_lavel_14"
                                                   id="commistion_lavel_14"  value="{{$commision->commistion_lavel_14}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 15</label>
                                            <input type="number" class="form-control" name="commistion_lavel_15"
                                                   id="commistion_lavel_15"  value="{{$commision->commistion_lavel_15}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 16</label>
                                            <input type="number" class="form-control" name="commistion_lavel_16"
                                                   id="commistion_lavel_16"  value="{{$commision->commistion_lavel_16}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 17</label>
                                            <input type="number" class="form-control" name="commistion_lavel_17"
                                                   id="commistion_lavel_17"  value="{{$commision->commistion_lavel_17}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 18</label>
                                            <input type="number" class="form-control" name="commistion_lavel_18"
                                                   id="commistion_lavel_18"  value="{{$commision->commistion_lavel_18}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 19</label>
                                            <input type="number" class="form-control" name="commistion_lavel_19"
                                                   id="commistion_lavel_19"  value="{{$commision->commistion_lavel_19}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>

                                        <div class="form-group">
                                            <label for="commistion_lavel_2">Position 20</label>
                                            <input type="number" class="form-control" name="commistion_lavel_20"
                                                   id="commistion_lavel_20"  value="{{$commision->commistion_lavel_20}}" aria-describedby="emailHelp"
                                                   placeholder="Enter Commision in desimal formate">
                                        </div>






                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>


                                </div>


                            </div>

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped   ">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Id</th>
                                        <th>Email</th>
                                        <th>Order Id</th>
                                        <th>Amount</th>
                                        <th>Date</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @include('admin.affilate.royaltyHistoryPagination')
                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="tab_3">
                            <form action="{{url('/')}}/royalty-found-distribution" method="post">
                                @csrf


                            <input type="submit" value="Distribute Royalty Fund" class="btn btn-danger">

                            </form>

                        </div>

                        <!-- /.tab-pane -->


                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->


        </div>


        <input type="hidden" name="hidden_page" id="hidden_page" value="1"/>

    </div>


    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Product View</h4>
                </div>
                <div class="modal-body" id="orderView">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script>
        $(document).ready(function () {


            function fetch_data(page, query) {
                $.ajax({
                    type: "GET",
                    url: "{{url('admin/royalty/history/pagination')}}?page=" + page + "&query=" + query,
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

