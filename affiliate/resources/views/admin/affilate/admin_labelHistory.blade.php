@extends('layouts.master')
@section('pageTitle')
  Label   Income History
@endsection
@section('mainContent')
    <div class="box-body">

    <style>
        .middle{
            vertical-align: middle !important; 
        }
    </style>

        <br/>

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-3">
                    <select name="income_for"  onchange="cahngeData()" id="income_for" class="form-control select2" >
                        <option value="">Income For  </option>
                        @foreach($affiliates as $key=>$name)
                        <option value="{{$key}}">{{$name}} ({{ $key}})</option>
                        @endforeach
                    </select> 
                </div>
                <div class="col-md-3">
                    <select name="income_for"  onchange="cahngeData()" id="income_from" class="form-control select2" >
                        <option value="">Income From</option>
                        @foreach($affiliates as  $key=>$name)
                        <option value="{{$key}}">{{$name}} ({{ $key}})</option>
                        @endforeach
                    </select> 
                </div>
                <div class="col-md-3">
                    <select name="layer" onchange="cahngeData()"  id="layer" class="form-control" >
                        <option value="">Label</option>
                        @foreach($configs as $key=>$name)
                        <option value="{{ $key}}">{{ $name}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="serach" placeholder="Order ID"> 
                </div>
            </div>

        </div>
        <br/>
        <div class="table-responsive"> 
            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th rowspan="2" class="text-center middle">Sl</th>
                    <th rowspan="2" class="text-left middle">Income For </th>
                    <!-- <th rowspan="2" class="text-center middle">Email</th> -->
                    <!-- <th rowspan="2">phone</th> -->
                    <th rowspan="2" class="text-left middle">Income From</th>
                    <th colspan="3" class="text-center middle">Income Statistic</th>
                    <th rowspan="2" class="text-center middle">Order Id</th>
                    <th rowspan="2" class="text-center middle">Label</th>
                    <th rowspan="2" class="text-center middle" style="width:150px">Date</th>
                </tr>

                <tr> 
                   
                    <th class="text-center">Previous</th>
                    <th class="text-center">Income</th>
                    <th class="text-center">After</th> 
                </tr>
                </thead>
                <tbody> 
                @include('admin.affilate.admin_labelHistoryPagination')
                </tbody> 
            </table> 
        </div> 
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    </div>

    <script>
   
   function cahngeData()
   {
    $('#hidden_page').val(1);
    fetch_data(); 
   }
            function fetch_data()
            {
                var order_id = $('#serach').val();
                var page = $('#hidden_page').val();
                var income_for = $('#income_for').val();  
                var income_from = $('#income_from').val();  
                var layer = $('#layer').val();  
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/labelHistory')}}",
                    data:{
                        page,order_id,income_from,income_for,layer
                    },
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serach', function(){
                var query = $('#serach').val();
                   $('#hidden_page').val(1);
                    fetch_data(); 
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page); 
                fetch_data();
            });

       
    </script>


@endsection

