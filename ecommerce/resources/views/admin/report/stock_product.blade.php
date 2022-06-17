@extends('layouts.master')
@section('pageTitle')
  Limited Products
@endsection
@section('mainContent')



    <div class="box-body">



        <div class="table-responsive">

            <table  class="table table-bordered table-striped ">
                <thead>
                <tr>

                    <th>Product Code</th>
                    <th>Product</th>
                    <th>Purchase Price</th>
                    <th>Sell Price</th>
                    <th>Discount Price</th>
                    <th>Product Profite</th>

                    <th>Published Status</th>
                    <th>Registration date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @if(isset($products))

                    @foreach ($products as $product)
                        <tr>


                            <td>{{ $product->sku }}</td>
                            <td>
                                <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}">
                                <a href="{{ url('/') }}/{{$product->product_name}}"> {{$product->product_title}} </a>

                            </td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>{{ $product->product_profite }}</td>

                            <td><?php if($product->status==1) {echo "Publised" ;}else{ echo "Unpublished";} ?> </td>
                            <td>{{date('d-m-Y H:m s',strtotime($product->created_time))}}</td>
                            <td>
                                <a title="edit" href="{{ url('admin/product') }}/{{ $product->product_id }}">
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


