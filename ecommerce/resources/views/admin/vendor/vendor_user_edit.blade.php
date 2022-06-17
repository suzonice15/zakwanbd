@extends('layouts.master')
@section('pageTitle')
    Update vendor Registration Form
@endsection
@section('mainContent')
    
    <div class="box-body">
        @if (count($errors) > 0)
            <div class=" alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <ul>

                    @foreach ($errors->all() as $error)

                        <li style="list-style: none">{{ $error }}</li>

                    @endforeach

                </ul>
            </div>
        @endif

        <div class="col-sm-offset-0 col-md-12">
            <form  name="vendor" action="{{ url('admin/vendor/edit/update') }}/{{ $vendor->vendor_id }}" class="form-horizontal"
                   method="post"
                   enctype="multipart/form-data">
                @csrf


                <div class="box" style="border: 2px solid #ddd;">
                    <div class="box-header with-border" style="background-color: green;color:white;">
                        <h3 class="box-title">vendor Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12" style="margin-left: 100px">
                                <div class="form-group">
                                    <label for="vendor_percent">Vendor Percent<span class="required">*</span></label>
                                    <input required="" type="text" id="vendor_percent" class="form-control the_title"
                                           name="vendor_percent" value="{{$vendor->vendor_percent}}">
                                </div>
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="row" style="margin-left: 5px;">
                        <div class="col-md-6 col-sm-6 zoomin">
                           @if($vendor->nid_image)
                            <a href="#" id="pop">
                                <img id="imageresource" src="{{URL::to('/public')}}/uploads/users/{{ $vendor->nid_image }}" style="width: 200px; height: 164px;">
                            </a>

                            <!-- Creates the bootstrap modal where the image will appear -->
                            <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                                  </div>
                                  <div class="modal-body">
                                    <img src="" id="imagepreview" style="width: 570px; height: 464px;" >
                                  </div>
                                  
                                </div>
                              </div>
                            </div>
                            @endif 
                        </div>
                        <div class="col-md-6 col-sm-6 zoomin" >
                            @if($vendor->bank_image)
                              <a href="#" id="pop1">
                                <img id="imageresource1" src="{{URL::to('/public')}}/uploads/users/{{ $vendor->bank_image }}" style="width: 200px; height: 164px;">
                                
                              </a>

                              <!-- Creates the bootstrap modal where the image will appear -->
                              <div class="modal fade" id="imagemodal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                      <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                                    </div>
                                    <div class="modal-body">
                                      <img src="" id="imagepreview1" style="width: 570px; height: 464px;" >
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endif
                        </div>
                    </div>

                    <div class="row" style="margin-left: 5px;">

                      <div class="col-md-6">
                          <div class="well well-sm">
                              <div class="panel panel-success">

                                  <div class="panel-heading" style="font-weight: bold;">Mobile Account Details </div>

                                  <div class="panel-body">
                                          <div class="form-group">
                                              <label for="ac_name">Ac Name:</label>
                                              <label>{{ $vendor->m_name }}</label>
                                          </div>
                                          <div class="form-group">
                                              <label for="ac_number">Ac Number:</label>
                                              <label>{{ $vendor->m_number }}</label>
                                          </div>
                                          <div class="form-group">
                                              <label for="ac_type">Ac Type:</label>
                                              <label>{{ $vendor->m_type }}</label>


                                          </div>
                                          <div class="form-group">
                                              <label for="service_name">Service Name:</label>
                                              <label>{{ $vendor->m_service }}</label>
                                          </div>
                                          
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="well well-sm">
                              <div class="panel panel-success">

                                  <div class="panel-heading" style="font-weight: bold;">Bank Account Details </div>

                                  <div class="panel-body">
                                      <div class="panel-body">

                                              <div class="form-group">
                                                  <label for="ac_name">Ac Name:</label>
                                                 <label>{{ $vendor->b_name }}</label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="ac_number">Ac Number:</label>
                                                 <label>{{ $vendor->b_number }}</label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="ac_branch">Branch Name:</label>
                                                  <label>{{ $vendor->b_branch }}</label>
                                              </div>
                                              <div class="form-group">
                                                  <label for="bank_name">Bank Name:</label>
                                                  <label>{{ $vendor->b_bank }}</label>
                                              </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                  </div>

                    <div class="row" style="margin-left: 5px;">
                        <div class="col-md-5 col-sm-5">
                           <div class="form-group">
                              <label for="sel1">First Verify :</label>
                              <select class="form-control" id="sel1" name="first_verify">
                                <option value="0" <?php if($vendor->first_verify=='0'){echo "selected";} ?>>De-Active</option>
                                <option value="1" <?php if($vendor->first_verify=='1'){echo "selected";} ?>>Active</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5" >
                            <div class="form-group">
                              <label for="sel1">Second Verify :</label>
                              <select class="form-control" id="sel1" name="second_verify">
                                <option value="0" <?php if($vendor->second_verify=='0'){echo "selected";} ?>>De-Active</option>
                                <option value="1" <?php if($vendor->second_verify=='1'){echo "selected";} ?>>Active</option>
                              </select>
                            </div>
                        </div>
                    </div>

                </div>

 <div class="box-footer">
                    <input type="submit" class="btn btn-success pull-left" value="Update">

                </div>
            </form>


            </form>
        </div>
    </div>


<script>
  $("#pop").on("click", function() {
     $('#imagepreview').attr('src', $('#imageresource').attr('src')); // here asign the image to the modal when the user click the enlarge link
     $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
  });
</script>

<script>
  $("#pop1").on("click", function() {
     $('#imagepreview1').attr('src', $('#imageresource1').attr('src')); // here asign the image to the modal when the user click the enlarge link
     $('#imagemodal1').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
  });
</script>
     






@endsection


