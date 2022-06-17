@extends('layouts.master')
@section('pageTitle')
    Update Wallet
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
        }
    </style>
    <div class="box-body">
        <div class="col-sm-offset-0 col-md-6">
            <form  id="product" action="{{ url('admin/wallet/') }}/{{ $wallet->wallet_history_id }}" class="form-horizontal" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group "><label for="media_title">Name<span class="required">*</span></label>
                    <select name="status" class="form-control" >
                        <option value="0">Pending</option>
                        <option value="1">Paid</option>
                        <option value="2">Rejected</option>
                     </select>
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-right" value="Update">
                </div>
            </form>
        </div>
    </div>
    <script>

        document.forms['product'].elements['status'].value ="{{ $wallet->status }}";


    </script>

@endsection


