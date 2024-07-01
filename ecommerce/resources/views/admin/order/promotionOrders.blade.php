@extends('layouts.master')
@section('pageTitle')
    All Orders  List
@endsection
@section('mainContent')
    <div class="box-body">

        <div class="table-responsive">

            <table  class="table table-bordered  ">
                <thead>
                <tr style="background-color: #5f046c;color: white;text-align: center">

                    <th width="10%">Order Id</th>
                    <th width="15%">Customer Name</th>
                    <th width="15%">Customer Phone</th>
                    <th width="15%">Customer Address</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>


                @if(isset($orders))
                    <?php $i=$orders->perPage() * ($orders->currentPage()-1);?>
                    @foreach ($orders as $order)
                        <tr style="-webkit-box-shadow: 1px 2px 5px 1px #000000;
box-shadow: 1px 2px 5px 1px #000000;"> <td><span  style="background: red !important;"  class="label label-danger">{{ $order->id }}</span>



                            </td>
                            <td>{{ $order->customer_name }}        </td>
                            <td>     {{ $order->customer_phone }}

                            </td>
                            <td> {{ $order->customer_address }}       </td>


                            <td><?php
                                $order_items = unserialize($order->products);
                                $sku=0;
                                $name=0;
                                if(is_array($order_items['items'])) {
                                foreach ($order_items['items'] as $product_id => $item) {
                                $featured_image = isset($item['featured_image']) ? $item['featured_image'] : null;

                                $product = single_product_information($product_id);
                                if($product){
                                    $sku = $product->sku;
                                    $name = $product->product_name;
                                }

                                ?>
                                <a  target="_blank" href="{{url('/')}}/{{ $name }}">
                                    <span class="label label-info" style="width: 150px;display: block;overflow: hidden;" ><?=($item['name'])?></span>
                                    <br/>
                                    <img  src="<?=$featured_image?>" />
                                    ✖
                                    <?=($item['qty'])?>
                                </a>
                                <br>
                                <?php
                                }
                                }
                                ?>
                            </td>





                            <td> @money($order->order_total)
                            </td>
                            <td>  <br> {{date('d-F-Y h:i:s a',strtotime($order->order_date))}}
                            </td>


                        </tr>

                    @endforeach

                    <tr>
                        <td colspan="13" align="center">
                            {!! $orders->links() !!}
                        </td>
                    </tr>
                    @endif

                            <!-- /.modal -->

                    <script>

                        $(document).on('click','.orderPrint',function () {

                            var order_id= $(this).data("order_id")

                            $.ajax({
                                url:"{{url('/admin/orderModalPrint')}}/"+order_id,
                                method:"GET",
                                success:function (data) {
                                    $('#orderModalPrint').html(data);

                                }

                            })
                        })
                    </script>

                    <script>

                        $(document).on('click','.orderEditModal',function () {

                            var order_id= $(this).data("order_id")

                            $.ajax({
                                url:"{{url('/admin/orderEditHistory')}}/"+order_id,
                                method:"GET",
                                success:function (data) {
                                    console.log(data)
                                    $('.ordereditshow').html(data);

                                }

                            })
                        })
                    </script>





                </tbody>

            </table>

        </div>




    </div>


@endsection

