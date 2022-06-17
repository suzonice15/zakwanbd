

@extends('website.master')
@section('mainContent')

    <div class="container my-2 all-content-hide">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

                <li class="breadcrumb-item active " aria-current="page">{{$page->page_name}}</li>

            </ol>
        </nav>
    </div>
    <div class="container">
<br/>
    <div class="row">
        <div class="col-md-12">
               <?php echo $page->page_content; ?>
         </div>
    </div>
</div>
@endsection
