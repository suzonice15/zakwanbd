@extends('layouts.master')
@section('pageTitle')
    Affiliate Complain
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row">
            <div class="col-md-8">

                <form id="form" action="{{url("admin/affiliate/complainEditUpdate/")}}/{{$affilate->complain_id}}" method="post">
                    @csrf


                    <div class="form-group">
                        <h4 style="color:green">{{session::get('success')}}</h4>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Affiliate Complain</label>
                        <textarea   name="affiliate_complain"  readonly class="form-control" placeholder="Enter Your Complain" id="exampleFormControlTextarea1" rows="3">{{$affilate->affiliate_complain}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Enter Your Answer</label>
                        <textarea  required name="affiliate_answer" class="form-control" placeholder="Enter Your Complain" id="exampleFormControlTextarea1" rows="3">{{$affilate->affiliate_answer}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Status</label>

                        <select class="form-control" name="status" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Investigating">Investigating</option>
                            <option value="Solved">Solved</option>
                        </select>

                    </div>
                    <div class="form-group">

                        <input type="submit" class="btn btn-success" value="Submit">



                    </div>
                </form>



            </div>
        </div>
        <br/>


    </div>

    <script>


        document.forms['form'].elements['status'].value = "{{$affilate->status}}";

    </script>




@endsection

