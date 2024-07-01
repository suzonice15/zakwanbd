@extends('website.master')
@section('mainContent')
        <div class="container my-2 all-content-hide">
            <div class="row">
                <div class="col-md-6 col-12 col-lg-6 col-xl-6 d-flex justify-content-start">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active " aria-current="page"> Package </li>
                        </ol>
                    </nav>
                </div>
                
            </div>
        </div>
         <div class="container all-content-hide"><span id="post-data">@include('website.package_ajax')</span>
            </div>
        </div>
       
@endsection
