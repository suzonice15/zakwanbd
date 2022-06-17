@extends('layouts.master')
@section('pageTitle')
    Top Referrals  List
@endsection
@section('mainContent')
<style type="text/css">

    tr {
        border: 1px solid #1D96B2;
    }

    th {
        border: 1px solid #1D96B2;
        border: 1px solid #fff;
    }

    .table tbody td {
        border: 1px solid #1D96B2 !important;
        height: 50px;
        font-size: 17px;
        color: #000
    }

    thead {
        background-color: #1d96b2;
        color: #fff
    }
</style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <br><br>
    <div style="margin: 10px">
    <div class="table-responsive">
        <table   class="table table-striped table-bordered">
            <thead>
            <tr>
                <th  style="text-align: center">Sl</th>
                <th style="text-align: center">ID</th>
                <th style="text-align: left">Name</th>
                <th  style="text-align: center">Referrals</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=$users->perPage() * ($users->currentPage()-1);?>

            @foreach ($users as $user)


                <?php
                $name=DB::table('users_public')->select('name')->where('id',$user->parent_id)->first();
                        if($name){
                            $name=$name->name;
                        } else {
                            $name='';
                        }


                ?>
                <tr>
                    <td  style="text-align: center">{{ ++$i}}</td>

                    <td  style="text-align: center"><?php


                        echo $user->parent_id;?>


                    </td>
                    <td style="text-align: left">{{ $name }}</td>
                    <td  style="text-align: center">{{ $user->total }}</td>

                </tr>

            @endforeach
            <tr>
                <td style="text-align: center" colspan="4">{!! $users->links() !!} </td>

            </tr>
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

