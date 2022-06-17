@extends('layouts.master')
@section('pageTitle')
    Inactive User
@endsection
@section('mainContent')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <br><br>
    <div style="margin: 10px">
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $counter=1;
            ?>
            @foreach ($inactiveUser as $user)
                <tr>
                    <td>{{$counter}}
                    	<?php
                        $counter++;
                        ?>
                    </td>

                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                    	<a class="btn btn-success" href=""></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );

    </script>
    
@endsection

