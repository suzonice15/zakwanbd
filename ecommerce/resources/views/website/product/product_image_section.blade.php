<div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5 col-xxl-5">
    <div class="card">
        <img src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->feasured_image }}"
             class="card-img-top xzoom"
             xoriginal="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->feasured_image }}"
             id="main_picture" alt="{{ $product->product_title }}">
    </div>

    <ul class="thumb-image">
        <?php
        if($product->galary_image_1){
        ?>

        <li>
            <img class="img-responsive thum_image_hover " width="85"
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->feasured_image }}"/>

        </li>
        <?php } ?>
        <?php
        if($product->galary_image_1){
        ?>

        <li>
            <img class="  thum_image_hover " width="85" alt=""
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_1 }}"/>

        </li>
        <?php } ?>
        <?php
        if($product->galary_image_2){
        ?>

        <li>
            <img class="img-responsive thum_image_hover " width="85" alt=""
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_2 }}"/>

        </li>
        <?php } ?>
        <?php
        if($product->galary_image_3){
        ?>

        <li>
            <img class="img-responsive thum_image_hover " width="85" alt=""
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_3 }}"/>

        </li>
        <?php } ?>
        <?php
        if($product->galary_image_4){
        ?>

        <li>
            <img class="img-responsive thum_image_hover " width="85" alt=""
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_4 }}"/>

        </li>
        <?php } ?>
        <?php
        if($product->galary_image_5){
        ?>

        <li>
            <img class="img-responsive thum_image_hover " width="85" alt=""
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_5 }}"/>

        </li>
        <?php } ?>
        <?php
        if($product->galary_image_6){
        ?>

        <li>
            <img class="img-responsive thum_image_hover " width="85" alt=""
                 src="{{ url('/public/uploads') }}/{{ $product->folder }}/{{ $product->galary_image_6 }}"/>

        </li>
        <?php } ?>
    </ul>
</div>
