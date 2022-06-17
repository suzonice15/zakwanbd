@extends('layouts.master')
@section('pageTitle')
    Achivement
@endsection
@section('mainContent')
    <style type="text/css">
        option{
            color: #000;
        }
    </style>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12" id="orderhistory">
                <h3>Transaction History</h3>
                <div class="table-responsive">
                    <table class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Achivement</th>
                            <th>Status</th>
                            <th>Created Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @include('admin.affilate.achievement_pagination')

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
    <script type="text/javascript">

    </script>

@endsection

