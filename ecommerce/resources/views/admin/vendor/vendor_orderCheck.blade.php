@extends('layouts.master')
@section('pageTitle')
   Single Vendor Orders List
@endsection
@section('mainContent')
    <div class="box-body">

        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
                </thead>
                <tbody>

                <?php
                if($vendors){
                        $count=0;
                        foreach ($vendors as $vendor) {
               $product= single_vendor_product($vendor->product_id);

                ?>
                <tr>
                    <td><?=++$count?></td>
                    <td>{{$vendor->order_id}}</td>
                    <td>{{$vendor->customer_name}}
                        {{$vendor->customer_phone}}
                    </td>
                    <td>
                        <?php if($product){

                            ?>
                            <img
                                    src="{{ url('/public/uploads') }}/{{ $product->folder }}/small/{{ $product->feasured_image }}"
                                    alt="">
                        <?php
                        echo $product->product_title;

                        } ?>

                        </td>
                    <td>{{$vendor->order_total}}</td>


                    <td>

                        <?php if($vendor->order_status=='pending_payment'){
                        ?>
                        <span   style="background-color:yellow">{{ $vendor->order_status }}</span>
                        <?php  } elseif ($vendor->order_status=='new') { ?>
                        <span   class="btn btn-info">{{ $vendor->order_status }}</span>

                        <?php  } elseif ($vendor->order_status=='processing') { ?>
                        <span   class="btn btn-info">{{ $vendor->order_status }}</span>

                        <?php  } elseif ($vendor->order_status=='on_courier') { ?>

                        <span   class="btn btn-danger">{{ $vendor->order_status }}</span>
                        <?php  } elseif ($vendor->order_status=='delivered') { ?>
                        <span   class="btn btn-success">{{ $vendor->order_status }}</span>

                        <?php  } elseif ($vendor->order_status=='refund') { ?>

                        <span   class="btn btn-danger">{{ $vendor->order_status }}</span>
                        <?php  } elseif ($vendor->order_status=='cancled') { ?>
                        <span   class="btn btn-danger">{{ $vendor->order_status }}</span>
                        <?php } else {  ?>

                        <span   class="btn btn-success">{{ $vendor->order_status }}</span>
                        <?php } ?>
                    </td>
                    <td>{{$vendor->order_date}}</td>

                </tr>
                <?php } } ?>


                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>

    <script>
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

