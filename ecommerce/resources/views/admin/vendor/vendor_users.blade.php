@extends('layouts.master')
@section('pageTitle')
    All Vendor list
@endsection
@section('mainContent')

    <div class="box-body">
        <div class="table-responsive" >
            <table id="example1" class="table table-bordered table-striped table-responsive ">
                <thead>
                <tr>
                    <th>Sl</th>
                    <th>Seller </th>
                    <th >Shop Name </th>
                    <th>Total</th>

                    <th>Withdraw</th>
                    <th>Remaining Blance</th>
                    <th >Vendor Percent </th>
                    <th >Status </th>
                    <th>Verify</th>

                    <th >date </th>
                    <th >Action </th>
                </tr>
                </thead>
                <tbody>

                @if(isset($vendors))
                    <?php $i=0;?>
                    @foreach ($vendors as $user)
                        <?php

                        $withdraw_by_vendor = DB::table('vendor_withdraw_amount')
                                ->where('vendorId', $user->vendor_id)->where('status', 1)->sum('withdrawAmount');

                                ?>
                        <tr>
                            <td>{{ ++$i }}</td>

                            <td>
                                {{$user->vendor_f_name.' '.$user->vendor_l_name}}
                                <br>
                                {{$user->vendor_email}}
                                <br>
                                {{$user->vendor_phone}}
                            </td>

                            <td><a href="{{url('/')}}/shop/{{$user->vendor_link}}"  target="_blank">{{$user->vendor_shop}} </a></td>
                            <td>
                                Product
                                <?php
                                    $Total=DB::table('product')->where('vendor_id', $user->vendor_id)->count();
                                    echo $Total;
                                ?>
                                <br>
                                Sell
                                <a href="{{url('/admin/vendor/order/check')}}/{{ $user->vendor_id}}">{{$user->life_time_earning}} </a>
                            </td>

                            <td>{{$withdraw_by_vendor}} </td>
                            <td>  {{$user->amount}} </td>
                            <td>{{$user->vendor_percent}} </td>

                            <td>
                                <?php

                            if($user->status==0){
                            ?>
                                <label class="label label-danger">Pending</label>
                                <?php } else { ?>
                                    <label class="label label-success">Active</label>
                                <?php } ?>
                            </td>
                            <td>
                                First
                                <?php
                                    if($user->nid_image=='' && $user->bank_image==''){
                                ?>
                                <label class="label label-danger">Not Insert</label>
                                <?php
                                    }else if($user->first_verify=='1'){
                                ?>
                                <label class="label label-success">Complete</label>
                                <?php
                                    }else{
                                ?>
                                <label class="label label-info">Waiting verify</label>
                                <?php
                                    }
                                ?>
secend
                                <?php
                                if($user->m_name==''||$user->b_name==''){
                                ?>
                                <label class="label label-danger">Not Insert</label>
                                <?php
                                }else if($user->m_number==''||$user->b_number==''){
                                ?>
                                <label class="label label-danger">Not Insert</label>
                                <?php
                                }else if($user->m_type==''||$user->b_branch==''){
                                ?>
                                <label class="label label-danger">Not Insert</label>
                                <?php
                                }else if($user->m_service==''||$user->b_bank==''){
                                ?>
                                <label class="label label-danger">Not Insert</label>
                                <?php
                                }else if($user->second_verify=='1'){
                                ?>
                                <label class="label label-success">Complete</label>
                                <?php
                                }else{
                                ?>
                                <label class="label label-info">Waiting verify</label>
                                <?php
                                }
                                ?>

                            </td>

                            <td>{{date('d-m-Y',strtotime($user->registered_date))}}</td>
                            <td>
                                {{--<a title="edit" class="btn btn-success" href="{{ url('/admin/vendor/active') }}/{{ $user->vendor_id }}">--}}
                                    {{--Active--}}
                                {{--</a>--}}

                                {{--<a title="edit" href="{{ url('/admin/vendor/edit') }}/{{ $user->vendor_id }}" >--}}
                                    {{--<span class="glyphicon glyphicon-edit btn btn-success"></span>--}}
                                {{--</a>--}}
                                {{--<a title="edit"  class="btn btn-danger"href="{{ url('/admin/vendor/inactive') }}/{{ $user->vendor_id }}">--}}
                                    {{--Inactive--}}
                                {{--</a>--}}
                                {{--<a title="delete" href="{{ url('/admin/vendor/delete') }}/{{ $user->vendor_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">--}}
                                    {{--<span class="glyphicon glyphicon-trash btn btn-danger"></span>--}}
                                {{--</a>--}}
                                {{--<a title="delete" class="btn btn-info" href="{{ url('/admin/vendor/order/show') }}/{{ $user->vendor_id }}" >--}}
                                   {{--Order Show--}}
                                {{--</a>--}}
                                {{--<button type="button" class="mt-1 btn btn-default btn-sm " data-toggle="modal" data-target="#myModal{{ $user->vendor_id }}">--}}
                                  {{--<span class="glyphicon glyphicon-eye-open"></span> --}}
                                {{--</button>--}}
                                <div class="btn-group-vertical">
                                    <button type="button" class="btn btn-success">
                                        <a title="edit"  style="color:white" href="{{ url('/admin/vendor/active') }}/{{ $user->vendor_id }}">
                                            Active
                                        </a></button>
                                    <button type="button" class="btn btn-danger">
                                        <a title="edit"   style="color:white"  href="{{ url('/admin/vendor/inactive') }}/{{ $user->vendor_id }}">
                                            Inactive
                                        </a>
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <a title="edit"  style="color:white" href="{{ url('/admin/vendor/edit') }}/{{ $user->vendor_id }}" >
                                            Edit
                                        </a>
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <a title="delete"  style="color:white" href="{{ url('/admin/vendor/delete') }}/{{ $user->vendor_id }}" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                                           Delete
                                        </a>
                                    </button>

                                    <button type="button" class="btn btn-info">
                                        <a title="delete"   style="color:white"  href="{{ url('/admin/vendor/order/show') }}/{{ $user->vendor_id }}" >
                                            Order Show
                                        </a>
                                    </button>
                                    <button type="button"   data-toggle="modal" data-target="#myModal{{ $user->vendor_id }}" class="btn btn-success">

                                            Profile View

                                    </button>
                                </div>
                            </td>
                        </tr>

                        <div id="myModal{{ $user->vendor_id }}" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                
                                <h4 class="modal-title">Address</h4>
                              </div>
                              <div class="modal-body">
                                <p>{{$user->vendor_address}}</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>

                    @endforeach
                @endif
                </tbody>

            </table>

        </div>



    </div>


@endsection
