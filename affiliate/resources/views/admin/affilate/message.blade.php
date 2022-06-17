@extends('layouts.master')
@section('pageTitle')
    Message
@endsection
@section('mainContent')

    <section class="invoice">

        <div class="row invoice-info">

            <div class="col-md-12">

                <form action="{{url('/')}}/admin/message" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Affilator List</label>
                        <select name="user_id" class="form-control select2">

                            <option value="0">All</option>
                           @foreach($affilator as $affilate)
                            <option value="{{$affilate->id}}">{{$affilate->name}}</option>
                               @endforeach
                        </select>

                    </div>
                    
                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="10" name="message" cols="10" class="form-control ckeditor"></textarea>

                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-success">Send</button>

                    </div>


                </form>
            </div>


        </div>




    </section>

@endsection

