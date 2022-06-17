@extends('layouts.master')
@section('pageTitle')
    Mission   List
@endsection
@section('mainContent')
    <div class="box-body">
        <div class="row">
            <div class="col-md-1 pull-right">
                <a href="{{url('/')}}/admin/coin/setting/create" class="form-control btn btn-success ">
                    Add New

                </a>
            </div>


        </div>
        <br/>
        <br/>
        <div class="table-responsive">

            <table  class="table table-bordered table-striped   ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Picture</th>
                    <th>Mission Title  </th>
                    <th>Mission Description  </th>
                    <th>Mission Link  </th>
                    <th >Action </th>
                </tr>
                </thead>
                <tbody>
                @foreach($coins as $key=>$coin)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>  <img width="100" src="{{url('/')}}/public/uploads/category/{{$coin->coin_icon}}" class="image-responsive"></td>
                        <td>{{$coin->coin_title}}</td>
                        <td>{{$coin->coin_description}}</td>
                        <td>{{$coin->coin_link}}</td>
                        <td><a href="{{url('/admin/coin/setting')}}/{{$coin->id}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> </a> </td>
                    </tr>


                 @endforeach
                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>



@endsection

