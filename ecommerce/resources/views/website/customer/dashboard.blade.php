@extends('website.master')
@section('mainContent')

    <style>
        .vertical-menu {
            width: 100%;
        }

        .vertical-menu a {
            background-color: #eee;
            color: black;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu a:hover {
            background-color: #ccc;
        }

        .vertical-menu a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>

    <div class="container mt-3" style="background: white;">

        <div class="row pt-4">
            <div class="col-md-12 col-12 col-sm-12 col-lg-3 col-xl-3 col-xxl-3">
                    @include('website.customer.sidebar')

            </div>


            <div class="col-md-12 col-12 col-sm-12 col-lg-9 col-xl-9 col-xxl-9">
                @yield('profile_master')


            </div>


        </div>


    </div>



@endsection

