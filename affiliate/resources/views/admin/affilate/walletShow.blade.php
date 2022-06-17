<div class="container">

    <div class="row">
        <div  class="col-md-4">

            <form method="post" action="{{url('/admin/wallet/show')}}/{{$wallet->wallet_history_id}}">
                @csrf

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select name="status" class="form-control">
                        <option value="0">Pending</option>
                        <option value="2">Rejected</option>
                        <option value="1">Paid</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="affiliate_id" value="{{$wallet->affiliate_id}}" />
                    <input type="hidden" name="amount" value="{{$wallet->amount}}" />
                </div>


            </form>

        </div>



    </div>


</div>


