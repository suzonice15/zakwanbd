@extends('layouts.master')
@section('pageTitle')
    Affiliate list

@endsection
@section('mainContent')
    <div class="box-body">
        <br/>
        <div class="table-responsive">
            <table  id="main_table" class="table table-bordered table-striped   ">
                <thead>
                <tr>
                     <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Lavel</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Life Time Income</th>
                    <th>Life Time Withdraw</th>
                    <th>Skill Point</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                if($affilates){
                foreach($affilates as $row ){
                $skil_point=DB::table('marketing_metarial')->where('affiliate_id',$row->id)->where('status',1)->sum('marketing_metarial.skill_point');
                 $account_suspend=DB::table('account_suspend')->where('user_id',$row->id)->orderBy('account_suspend_id','desc')->first();
                if($account_suspend){
                    $account_suspend= $account_suspend->status;
                } else {
                    $account_suspend=0;
                }
                ?>

                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>
                        <?php
                        $lavel = DB::table('affilite_commission_lavel')->where('user_id',$row->id)->where('active', '=', 1)->orderBy('commision_lavel_id', 'desc')->first();
                        if ($lavel) {
                            echo $lavel->lavel;
                        }else{
                            echo "1";
                        }
                        ?>
                    </td>
                    <td>{{$row->phone}}</td>

                    <td>
                        @if($row->status==1)

                            <span class = "label label-success">Active</span>
                        @else
                            <span class = "label label-danger">Inactive</span>

                        @endif

                    </td>
                    <td>{{$row->life_time_earning}}</td>
                    <td>{{$row->withdraw_balance}}</td>

                    <td>{{$skil_point}}</td>
                    <td>{{ date('d,M,Y',strtotime($row->created))}}</td>
                    <td>
                        <a    href="{{url('/admin/affiliate_varification_list')}}/{{$row->id}}">
                            <span class="glyphicon glyphicon-eye-open btn btn-success"></span>
                        </a>

                    </td>

                </tr>

                <?php
                }


                } ?>

                <tr>
                    <td colspan="9" align="center">
                        {!! $affilates->links() !!}
                    </td>
                </tr>


                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center">Affiliate Details</h4>
                            </div>
                            <div class="modal-body" >
                                <span class="affilite_details_id"></span>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>




                <div class="modal fade" id="modal-suspend">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center">Affiliate  Suspend Details</h4>
                            </div>
                            <div class="modal-body" >

                                <span class="suspend_id"></span>


                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>



                </tbody>

            </table>

        </div>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />

    </div>




    <script>
        $(document).ready(function(){

            function fetch_data(page, query)
            {
                $.ajax({
                    type:"GET",
                    url:"{{url('/admin/affilite/affilite_pagination')}}?page="+page+"&query="+query,
                    success:function(data)
                    {
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }

            $(document).on('keyup input', '#serach', function(){
                var query = $('#serach').val();
                var page = $('#hidden_page').val();
                if(query.length >0) {
                    fetch_data(page, query);
                } else {
                    fetch_data(1, '');
                }
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var query = $('#serach').val();
                fetch_data(page, query);
            });

        });




        $(document).on('click', '#affilite_id', function(){
            var affilite_id=  $(this).attr("data-id") // will return the string "123"


            if(affilite_id) {


                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/affilite/affilite/show')}}?affilite_id=" + affilite_id,
                    success: function (data) {

                        $('.affilite_details_id').empty();
                        $('.affilite_details_id').html(data);
                    }
                })
            }

        });

        $(document).on('click', '#suspend_id', function(){
            var affilite_id=  $(this).attr("data-id") // will return the string "123"


            if(affilite_id) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/affilite/suspend/show')}}?affilite_id=" + affilite_id,
                    success: function (data) {

                        $('.suspend_id').empty();
                        $('.suspend_id').html(data);
                    }
                })
            }

        });
    </script>


@endsection

