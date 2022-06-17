<div class="container">

    <div class="row">

        <div class="col-md-6">



            <table class="table table-bordered">



                <tr>

                    <td>Name :</td>
                    <td>

                        {{$user->name}}

                    </td>

                </tr>

                <tr>

                    <td>Name :</td>
                    <td>
                        {{$user->phone}}
                    </td>

                </tr>

                <tr>

                    <td>Name :</td>
                    <td>
                        {{$user->email}}
                    </td>

                </tr>


            </table>

            <form method="POST" name="supend" action="{{url('/affiliate/supend/save')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Start Date:</label>
                    <input type="text"   class="form-control pull-right withoutFixedDate" value="<?php  if(isset($suspend->start_date)) { echo date("d-m-Y",strtotime($suspend->start_date)); } ?>" name="start_date" >
                    <br>
                    <label for="name">End Date:</label>

                    <input type="text"  class="form-control pull-right withoutFixedDate" name="end_date" value="<?php  if(isset($suspend->end_date)) { echo date("d-m-Y",strtotime($suspend->end_date)); } ?>" >
                </div>

                <div class="form-group">
                    <label for="name">Suspend Note</label>
                    <textarea rows="5" name="message" class="form-control"><?php if(isset($suspend->message)) { echo $suspend->message; } ?></textarea>
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                </div>
                <div class="form-group">
                    <label for="name">Suspend Status</label>
                   <select name="status" class="form-control">
                       <option value="0">Unsuspend</option>
                       <option value="1">Suspend</option>
                   </select>
                </div>
                <div class="form-group">
                    <label for="name">Suspend For Life Time</label>
                    <select name="life_time" class="form-control">
                        <option value="0">Temporary</option>
                        <option value="1">Life Time </option>
                    </select>
                </div>
                <div class="form-group pull-right">
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
            </form>

            <script>
                document.forms['supend'].elements['status'].value="<?php if(isset($suspend->status)) { echo $suspend->status; } ?>";
                document.forms['supend'].elements['life_time'].value="<?php if(isset($suspend->life_time)) { echo $suspend->life_time; } ?>";
                $('.withoutFixedDate').datepicker(
                        {

                            autoclose: true,


                        });
            </script>







        </div>


    </div>


</div>