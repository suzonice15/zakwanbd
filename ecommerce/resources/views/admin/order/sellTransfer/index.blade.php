@extends('layouts.master')
@section('pageTitle')
  Sell Transfer  
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">


        <div class="col-sm-offset-0 col-md-12"> 

            <form name="product"  action="{{ url('admin/sellTransfer') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf


                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box box-primary" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color: #ddd;">
                                    <h3 class="box-title">User  Information</h3>
                                </div>
                                <div class="box-body">

                                    <div class="order_data" id="customer_info_change"
                                         style="padding: 18px;">

                                         <div class="form-group ">
                                            <label for="billing_name">Name </label>
                                            <select name="admin_id" id="admin_id" class='form-control select2'>
                                                <option value=''>Select Option</option>
                                                @foreach($admins as $admin)
                                                <option value='{{$admin->admin_id}}' balance="{{$admin->company_balance}}">{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                        <div class="form-group ">
                                            <label for="billing_email">Balance </label>
                                            <input required  readonly type="text" name="company_balance"  id="company_balance" class="form-control"
                                                   value=""/>
                                        </div> 
                                        <div class="form-group ">
                                            <label for="billing_email">My Balance </label>
                                            <input readonly type="text"  class="form-control"
                                                   value="{{$company_balance}}"/>
                                        </div> 

                                        <div class="form-group "> 
                                            <button type="submit" class='btn btn-success'> Transfer Balance</button>
                                        </div> 
 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </div>

                  
                </div>
             </form>

             <script>

   $("#admin_id").change(function(){
   let balance= $("#admin_id").find(':selected').attr('balance'); 
   $("#company_balance").val(balance); 

   })
</script>

           
           

@endsection


