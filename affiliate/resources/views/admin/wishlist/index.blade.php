@extends('layouts.master')
@section('pageTitle')
    All Products   List
@endsection
@section('mainContent')

    <div class="box-body" style="background: #f2f2f2;">
        <div class="row">
            <div class="col-md-8">

                <label> Category list</label>

                <select name="category_id" id="category_id" class=" form-controll select2">
                    <option value="">
                        select categoy

                    </option>
                    <?php foreach ($categories as $category) { ?>
                    <option value="{{$category->category_id}}">{{$category->category_title}}</option>
                    <?php } ?>
                </select>
                <a href="{{url('/user/product/hot-deals')}}" class="btn btn-success">Top Deals </a>
                <a href="{{url('/user/tending/products')}}" class="btn btn-success">Tending Products</a>
            </div>

            <div class="col-md-4 ">
                <input type="text" id="serach" name="search" placeholder="Search Product By Product Code Or Product Name" class="form-control" >
            </div>
        </div>
        <br/>
        <hr/>
        <div class="row" id="link_products">

            @include('admin.affilate.product_pagination')


        </div>


        <style>
            .name{
                height: 33px;


            }
        </style>


    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Product Link Generator</h4>
                </div>
                <div class="modal-body" id="view_page">

                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    </div>


@endsection

