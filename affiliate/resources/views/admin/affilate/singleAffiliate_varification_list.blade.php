@extends('layouts.master')
@section('pageTitle')
    Affiliate list

@endsection

<style>
    .hover-img:hover{
        position: absolute;
        width: 602px;
        left: 63px;
        top: -44px;
        background: white;
        border: 2px solid #ddd;
    }
</style>
@section('mainContent')
    <div class="box-body">

        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="POST" name="varification" action="{{url('singleAffiliateVarificationUpdate')}}" enctype="multipart/form-data" >

                                @csrf

  <input type="hidden" name="user_id" value="{{$user->id}}" />
                                <table class="table table-hovered">
                                    <tr>
                                        <td>National Id Card:</td>
                                        <td>
                                            @if($user->nationalIdPicture)

                                                <img class="hover-img img-responsive" src="{{url('/')}}/public/uploads/{{$user->nationalIdPicture}}">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address Varified:</td>
                                        <td>
                                            @if($user->addressVarifiedPicture)
                                                <img  class="hover-img img-responsive"  src="{{url('/')}}/public/uploads/{{$user->addressVarifiedPicture}}">
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <div class="form-group">
                                    <label for="username">Status</label>
                                    <select name="accountVarificationStatus" id="accountVarificationStatus" class="form-control" />
                                    <option value="1">Full Varified</option>
                                    <option value="2">National Id  Varified</option>
                                    <option value="3">Address  Varified</option>
                                    <option value="4">Pending</option>
                                    <option value="0">Rejected</option>
                                    </select>
                                </div>

                                <div class="form-group hideClass">
                                    <label for="username">Rejected Status</label>
                                    <select name="rejected"  id="rejected" class="form-control" />
                                    <option value="0">Select Rejected Status</option>
                                    <option value="1">National Id  Rejected</option>
                                    <option value="2">Address  Rejected</option>
                                    <option value="3">Both   Rejected</option>

                                    </select>

                                    <label for="username">Rejected Note</label>
                                    <textarea name="reject_note"   class="form-control">{{$user->reject_note}}</textarea>
                                </div>


                                <div class="form-group">
                                    <input type="submit" name="update" class="btn btn-primary pull-right" value="Update ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <legend>
                            <img src="{{url('/')}}/public/uploads/{{$user->picture}}">

                            User Profile</legend>
                        <h4>Wallet Balance: {{$user->ewallet_balance}} TK</h4>
                        <h4>Earning Balance: {{$user->earning_balance}} TK</h4>
                        <h4>Bonus: {{$user->bonus_balance}} TK</h4>
                        <div>Name: {{$user->name}}</div>
                        <div> Referral ID: {{$user->id}}</div>
                        <div>Address: {{$user->address}}</div>
                        <div>Email: {{$user->email}}</div>

                        <?php
                        $referrer_name=DB::table('users_public')
                                ->where('id','=',$user->parent_id)
                                ->first();
                        ?>
                        <div>Referrer: <?php if($referrer_name){echo $referrer_name->name;}else{echo "No Referrer";} ?></div>

                        <div>Created: {{$user->created}}</div>

                    </div>
                </div>

            </div>

            </div>

    </div>

    <script>
        $(".hideClass").hide();
        document.forms['varification'].elements['accountVarificationStatus'].value = "{{$user->accountVarificationStatus}}";
        $("#accountVarificationStatus").change(function () {

            var  status=$(this).val();
            $(".hideClass").show();
            if(status=='0'){
                $(".hideClass").show();

            } else {
                $(".hideClass").hide();
            }

        })


    </script>



@endsection

