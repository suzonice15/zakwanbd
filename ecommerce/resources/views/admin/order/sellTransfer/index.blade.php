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

          


                <div class="box-body">
                    <div class="row">
                    <form name="product"  action="{{ url('admin/sellTransfer') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf
                        <div class="col-md-6">
                            <div class="box box-primary" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color: #ddd;">
                                    <h3 class="box-title">User  Information</h3>
                                </div>
                                <div class="box-body">
                                <div class="row" >
                                            <div class="col-md-12" >
                                    <div class="order_data" style="padding: 20px;" id="customer_info_change"
                                         >
                                        

                                         <div class="form-group">
                                            <label for="billing_name">Name </label>
                                            <select required name="admin_id" id="admin_id" class='form-control select2'>
                                                <option value=''>Select Option</option>
                                                @foreach($admins as $admin)
                                                <option value='{{$admin->admin_id}}' balance="{{$admin->company_balance}}">{{$admin->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                  
                                        <div class="form-group">
                                            <label for="billing_email">Balance </label>
                                            <input required  readonly type="text" name="company_balance"  id="company_balance" class="form-control"
                                                   value=""/>
                                        </div> 
                                        <div class="form-group">
                                            <label for="billing_email">My Balance </label>
                                            <input readonly type="text"  class="form-control"
                                                   value="{{$company_balance}}"/>
                                        </div> 
    

                                        <div class="form-group " style="margin-top:20px;margin-right:5px"> 
                                            <button type="submit" class='btn btn-success pull-right''> Transfer Balance</button>
                                        </div> 

    </div>
    </div>
 
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>


                        <form name="product"  action="{{ url('admin/ManagersellTransfer') }}" class="form-horizontal"
                  method="post"
                  enctype="multipart/form-data">
                @csrf
                        <div class="col-md-6">
                            <div class="box box-primary" style="border:2px solid #ddd">
                                <div class="box-header" style="background-color: #ddd;">
                                    <h3 class="box-title">Manager  Balance</h3>
                                </div>
                                <div class="box-body">

                                    <div class="order_data" id="customer_info_change"
                                         >  
                                         <div class="row">
                                         <div class="col-md-12 ">
                                            <label for="billing_email">Bank Name</label>
                                            <input required name="bank_name"  type="text"  class="form-control"
                                                   value=""/>
                                        </div> 
                                        </div> 
                                        <div class="row">
                                        <div class="   col-md-6">
                                            <label for="billing_email">Voucer No</label>
                                            <input required  name="voucer_no" type="text"  class="form-control"
                                                   value=""/>
                                        </div> 
                                       
                                        <div class="col-md-6 "  >
                                        <label>Shipping Date</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input  required type="text" name="date" class="form-control pull-right datepicker" value="">
                                        </div>
                                    
                                        </div> 
    </div>
                                        
                                        <div class="row">
                                        
                                        <div class="  col-md-6 ">
                                            <label for="billing_email">My Balance </label>
                                            <input  required name="main_manager_account"  type="text"  class="form-control"
                                                   value="{{$company_balance}}"/>
                                        </div> 

                                        <div class="  col-md-6 ">
                                            <label for="billing_email">Picture</label>
                                            <input required  type="file" name="picture"   accept="image/*" class="form-control"
                                                   />
                                        </div> 
    </div>
    <br/>
   
    <div class="row">
                                         <div class="col-md-12 ">
                                            <label for="billing_email">Note (Optional)</label>
                                            <input   name="note"  type="text"  class="form-control"
                                                   value=""/>
                                        </div> 
                                        </div> 

                                        <div class="form-group" style="margin-top: 14px;margin-right:5px"> 
                                            <button type="submit" class='btn btn-success pull-right'>Submit</button>
                                        </div> 
 
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        
                    </div>


                    <table  class="table table-bordered table-striped   ">
            <thead>
            <tr>
                <th>Sl</th> 
                <th>Bank Name</th> 
                <th>Voucer No</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Picture</th>
               
                <th>date</th> 
                <th>Created date</th> 
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach($amounts as   $key=>$amount)

                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$amount->bank_name}}</td>
                    
                    <td>{{$amount->voucer_no}}</td>
                    <td>{{$amount->amount}}</td>
                    <td>{{$amount->note}}</td>
                    <td><a target="_blank" href="{{url('/')}}/public/voucer/{{$amount->picture}}" >Picture</a></td>
                    
                    <td>{{$amount->date}}</td>
                    <td>{{$amount->created_at}}</td>
                    <td>@if($amount->status==1)<span class="label label-success"> Approved </span> @else <span class="label label-danger">Pending </span> @endif</td>
    </tr>
    @endforeach

             
            </tbody>

        </table>
                    </div>

                  
                </div>
            

             <script>

   $("#admin_id").change(function(){
   let balance= $("#admin_id").find(':selected').attr('balance'); 
   $("#company_balance").val(balance); 

   })
</script>

           
           

@endsection


