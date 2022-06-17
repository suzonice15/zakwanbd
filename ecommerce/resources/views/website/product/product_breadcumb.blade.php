<section class="all-content-hide breadcrumb-section-main"  >
    <div class="container my-2 px-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home </a></li>
                <?php if(isset($category_name_first)) { ?>
                <li class="breadcrumb-item"><a
                            href="{{url('/category/')}}/{{$category_name_first}}">{{$category_title_first}}</a></li>
                <?php } ?>
                <?php if(isset($category_name_middle)) { ?>
                <li class="breadcrumb-item"><a
                            href="{{url('/category/')}}/{{$category_name_middle}}">{{$category_title_middle}}</a></li>
                <?php } ?>
                <li class="breadcrumb-item"><a
                            href="{{url('/category/')}}/{{$category_name_last}}">{{$category_title_last}}</a></li>
                <li class="breadcrumb-item active">{{$product->product_title}}</li>
            </ol>
        </nav>
    </div>
</section>