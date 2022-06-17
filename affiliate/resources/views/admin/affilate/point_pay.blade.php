@extends('layouts.master')
@section('pageTitle')
   Affilite Point  List
@endsection
@section('mainContent')
    <div class="box-body">

        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Date</th>
               </tr>
                </thead>
                <tbody>
                <?php
                $count=0;
                ?>

                @if($affilates)
                    @foreach($affilates as $affilate)
                    <tr>
                        <?php
                      ++$count;
                        ?>

                        <td>{{$count}}</td>
                        <td>{{$affilate->name}}</td>
                        <td>{{$affilate->phone}}</td>
                        <td>{{$affilate->email}}</td>
                        <td>{{$affilate->point}}</td>
                        <td>{{date('d-F-Y',strtotime($affilate->created_date))}}</td>

                    </tr>

                    @endforeach
                    @endif


                </tbody>

            </table>

        </div>



    </div>



@endsection

