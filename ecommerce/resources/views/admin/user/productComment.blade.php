@extends('layouts.master')
@section('pageTitle')
   Product Comment View
@endsection
@section('mainContent')


    <div class="box" style="margin-top:50px">

        <div class="box-body">
            <form role="form" method="post" action="{{url('/')}}/admin/commentUpdate/{{$question->comment_id}}" >
                @csrf

                <div class="form-group">
                    <label>Customer Question</label>
                    <p>{{$question->comment_from_customer}}</p>
                </div>

                <!-- textarea -->
                <div class="form-group">
                    <label>Admin Anwser</label>
                    <textarea class="form-control" rows="5" name="comment_from_admin" placeholder="Replay" value="{{$question->comment_from_admin}}"></textarea>
                </div>
                <div class="form-group">
                     <input type="submit" value="Submit"  class="btn btn-success"/ >
                </div>




            </form>
        </div>
        <!-- /.box-body -->

@endsection