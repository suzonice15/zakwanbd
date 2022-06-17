

@extends('website.master')
@section('mainContent')

    <style>
        ul.breadcrumb {
            padding: 10px 16px;
            list-style: none;
            background-color: #eee;;
            
        }
        ul.breadcrumb li {
            display: inline;
            font-size: 18px;
        }
        ul.breadcrumb li+li:before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }
        ul.breadcrumb li a {
            color: #0275d8;
            text-decoration: none;
        }
        ul.breadcrumb li a:hover {
            color: #01447e;
            text-decoration: underline;
        }
    </style>

<br/>

    <div class="container">







<div class="row">
            <ul class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li>Tearms & Conditions</li>

            </ul>
            
            </div>
            
            </div>



    <div class="container">







<div class="row">
    <div class="col-md-12 col-xs-12">


           


               <?php echo $page->page_content; ?>
            
    </div>

</div>

    </div>



@endsection
