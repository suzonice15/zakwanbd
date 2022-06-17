<div class="container">

    <div class="row">

        <div class="col-md-6">

            <h4 class="text-center mb-5">Basic Information</h4>


            <table class="table table-bordered">


                <tr>

                    <td>Material Name:</td>
                    <td>{{$affilate->metarial_name}}</td>

                </tr>

                <tr>

                    <td>Material Value:</td>
                    <td>{{$affilate->metarial_value}}</td>

                </tr>





            </table>

            <form>

                <div class="form-group">

                    <label for="username">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0" <?php if($affilate->status==0) { echo "selected";} ?>>Pending</option>
                        <option value="1" <?php if($affilate->status==1) { echo "selected";} ?> >Aproved</option>
                        <option value="2" <?php if($affilate->status==2) { echo "selected";} ?> >Rejected</option>
                    </select>


                </div>
                <div class="form-group">

                    <label for="username">Reject Note</label>
                    <textarea  name="reject_note" id="reject_note" class="form-control">{{$affilate->reject_note}}</textarea>


                </div>

                <div class="form-group">


                    <input type="button" name="submitButoon" id="submitButoon" value="Update" class="btn btn-success">
                    <input type="hidden" name="marketing_id" id="marketing_id" value="{{$affilate->marketing_id}}" >


                </div>
            </form>

            <script>

                $('#submitButoon').click(function () {
                  var status= $('#status').val();
                  var marketing_id= $('#marketing_id').val();
                  var reject_note= $('#reject_note').val();

                    $.ajax({
                        url:"{{url('/')}}/marketing/memberUpdate?marketing_id="+marketing_id+"&status="+status+"&reject_note="+reject_note,
                        method:'get',
                        success:function (data) {
                            if(data.success=='done'){
                                $('#modal-suspend').modal('hide');
                                window.location.href="{{url('/')}}/admin/marketing/metarial"
                            }
                        }
                        
                    })
                })
            </script>







        </div>


    </div>


</div>