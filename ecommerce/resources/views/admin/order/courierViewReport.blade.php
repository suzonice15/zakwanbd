@extends('layouts.master')
@section('pageTitle')
    All Orders  List
@endsection
@section('mainContent')
    <div class="box-body">





        <div class="row">

            <div class="col-md-4 col-sm-12">
                <select name="courier_id" id="courier_id" class="form-control select2">
                    <option value="">select option</option>
                    <?php foreach ($couriers as $courier) { ?>


                    <option
                            value="{{ $courier->courier_id }}">{{ $courier->courier_name }} <?php if ($courier->courier_status == 1) {
                            echo " -Inside Dhaka";
                        } else {
                            echo " -Outside Dhaka";
                        }?></option>

                    <?php } ?>
                </select>
            </div>




        </div>


<span  id="table_result">


        @include('admin.order.courierViewReportPagination')
    </span>


        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="status" id="status" value="{{$order_status}}" />

    </div>

    <script>
        $(document).ready(function(){



            function fetch_data_search(page,courier_id)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/courier/view/report/pagination')}}?page="+page+"&courier_id="+courier_id,
                    success:function(data)
                    {
                        $('#table_result').html('');
                        $('#table_result').html(data);
                    }
                })
            }

            $(document).on('change', '#courier_id', function(){
                var courier_id = $('#courier_id').val();
                var page = $('#hidden_page').val();


                if(courier_id.length >0) {
                    fetch_data_search(page,courier_id);
                } else {
                    fetch_data_search(1, '');
                }
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var courier_id=$('#courier_id').val();
                fetch_data_search(page,courier_id);
            });


        });
    </script>


@endsection

