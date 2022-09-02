@extends('layouts.master')
@section('pageTitle')
    All Products   List
@endsection
@section('mainContent')
<div class="box-body">
    <div class="row">
        @if(Session::get('status') !=4)
        <div class="col-md-2">
<a href="{{url('/admin/product/create')}}" class="form-control btn btn-success">
    Add New Product

</a>      </div>
@endif 

      
        <div class="col-md-5 pull-right ">
            <input type="text" id="serach" name="search" placeholder="Search Product By Product Code Or Product Name" class="form-control" >
        </div>
    </div>
    <br/>
    <div class="table-responsive">

        <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th>

                <th>Product Code</th>
                <th>Bar Code</th>
                <th>Product</th>
                @if(Session::get('status') !=4)
                <th>Purchase Price</th>
               @endif
                <th>Sell Price</th>
                <th>Discount Price</th>
                @if(Session::get('status') !=4)
                <th>Product Profite</th>
                <th>Affiliate Commision % </th> <th> Affiliate Profit</th>
                @endif

                <th>Published Status</th>
                <th>Stock</th>
                <th>Total Sold</th>
                <th>Created date</th>

               
                <th>Action</th>
 


            </tr>
            </thead>
            <tbody>

               @include('admin.product.pagination')
            </tbody>

        </table>

    </div>

    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

</div>

<div class="modal fade in" id="modal-default" style="padding-right: 17px;">
            <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Product Stock Update </h4>
              </div>
            <div class="modal-body" id="stock_update">
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" id="update_stock_product" class="btn btn-primary">Update</button>
            </div>
            </div>

            </div>

</div>

<script>

   

    function StockUpdate(product_id){
       $.ajax({
        url:"{{url('/')}}/admin/product/StockUpdate/"+product_id,
        success:function(data){
            $("#stock_update").html(data)
        }
       })
    }

    $("#update_stock_product").click(function(){
       let product_id=$("#product_id_s").val();
       let stock=$("#stock").val();

       $.ajax({
        url:"{{url('/')}}/admin/product/productStockUpdate",
        data:{
            product_id:product_id,
            stock:stock,
        },
        success:function(data){           
            if(data='success'){
                alert("Successfully Inserted");
                $("#modal-default").modal('hide')
            }
        }
       })
        
    })

    $(document).ready(function(){

        function fetch_data(page, query)
        {
          $.ajax({
                type:"GET",
                url:"{{url('products/pagination')}}?page="+page+"&query="+query,
                success:function(data)
                {
                    $('tbody').html('');
                    $('tbody').html(data);
                }
            })
        }

        $(document).on('keyup input', '#serach', function(){
            var query = $('#serach').val();
            var page = $('#hidden_page').val();
            if(query.length >0) {
                fetch_data(page, query);
            } else {
                fetch_data(1, '');
            }
        });


        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            var query = $('#serach').val();
            fetch_data(page, query);
        });

    });
</script>


@endsection

