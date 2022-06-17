@extends('layouts.master')
@section('pageTitle')
    All Products   List
@endsection
@section('mainContent')
    <div class="box-body">

        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>

                    <th>Product Code</th>
                    <th>Product</th>
                    <th>Sell Price</th>
                    <th>Discount Price</th>
                    <?php
                    $status= Session::get('status');
                    if ($status != 'editor') {
                    ?>
                    <th>Product Profite</th>
                    <th>Affiliate Commision % </th> <th> Affiliate Profit</th>
                    <?php
                    }
                    ?>
                    <th>Published Status</th>
                    <th>Registration date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php $i=0;?>
                @if(isset($products))
                     @foreach ($products as $product)
                        <tr>

                            <td> {{ ++$i }} </td>
                            <td>{{ $product->sku }}</td>
                            <td>
                                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                                <a href="{{ url('/') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

                            </td>

                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <?php

                            if ($status != 'editor') {
                            ?>
                            <td>{{ $product->product_profite }}</td>
                            <td>
                                {{ $product->commision_percent }}
                            </td>
                            <td>{{ $product->top_deal  }}  </td>
                            <?php
                            }
                            ?>


                            <td><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
                            <td>{{date('d-m-Y H:m s',strtotime($product->created_time))}}</td>
                            <td>
                                <a title="edit" href="{{ url('admin/productEdit') }}/{{ $product->product_id }}">
                                    <span class="glyphicon glyphicon-edit btn btn-success"></span>
                                </a>

                                <a title="delete" href="{{ url('admin/product/delete') }}/{{ $product->product_id }}" onclick="return confirm('Are you want to delete this Product')">
                                    <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                                </a></td>
                        </tr>

                    @endforeach


                @endif



                </tbody>

            </table>

        </div>



    </div>




@endsection

