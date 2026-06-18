@extends('layouts.master')
@section('pageTitle')
    Add New Product
@endsection
@section('mainContent')
<style>
    .has-error {
        border-color: red;
    }
    .floating-update-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 9999;
    }
    .floating-update-btn button {
        padding: 12px 30px;
        font-size: 15px;
        font-weight: 600;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.5);
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .floating-update-btn button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.7);
    }
</style>
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
        <form name="product" action="{{ url('/') }}/admin/product/store" class="form-horizontal" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

                {{-- Product Information full width --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">Product Information</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <input type="hidden" name="folder" id="folder" value="">
                            <style>
                                .product-info-row { margin-bottom: 5px; }
                                .product-info-row .col-md-3 { padding-left: 20px; padding-right: 20px; }
                                .one-page-col { padding-left: 25px; padding-right: 25px; }
                                .customer-info-col { padding-left: 25px; padding-right: 25px; }
                            </style>

                            <div class="row product-info-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Title<span class="required">*</span></label>
                                        <input required type="text" class="form-control the_title" name="product_title" id="product_title" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Sub Title</label>
                                        <input type="text" class="form-control" name="product_subtitle" id="product_subtitle" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Permalink<span class="required">*</span></label>
                                        <input required type="text" class="form-control the_name" name="product_name" id="product_name" value="" autocomplete="off">
                                        <p id="produtctError"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Code (SKU)<span class="required">*</span></label>
                                        <input required type="text" class="form-control" name="sku" id="sku" value="Z{{ $sku }}" autocomplete="off">
                                        <span class="text-danger" id="sku_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row product-info-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Bar Code<span class="required">*</span></label>
                                        <input required type="text" class="form-control" name="barcode" id="barcode" value="" autocomplete="off">
                                        <span class="text-danger" id="sku_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php $status = Session::get('status');
                                    if ($status != 'editor') { ?>
                                        <div class="form-group">
                                            <label>Purchase Price<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="purchase_price" id="purchase_price" value="" autocomplete="off">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Regular Price<span class="required">*</span></label>
                                        <input required type="text" class="form-control" name="product_price" id="product_price" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Discount Price</label>
                                        <input type="text" class="form-control" name="discount_price" id="discount_price" value="" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row product-info-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Profit</label>
                                        <input type="text" readonly class="form-control" name="product_profite" id="product_profite" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Affiliate Commission %</label>
                                        <input type="text" class="form-control" name="commision_percent" id="commision_percent" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Affiliate Commission</label>
                                        <input type="text" class="form-control" name="top_deal" id="top_deal" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Published Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Published</option>
                                            <option value="0">Unpublished</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row product-info-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Location</label>
                                        <select name="product_type" id="product_type" class="form-control">
                                            <option value="general">General</option>
                                            <option value="home">Home</option>
                                            <option value="hot">Hot Sell</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Hot Deal Products</label>
                                        <select name="hot_deal_product" id="hot_deal_product" class="form-control">
                                            <option value="0">Select Option</option>
                                            <option value="1">First Hot Deals</option>
                                            <option value="2">Second Hot Deals</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Youtube Video Id</label>
                                        <input type="text" class="form-control" name="product_video" id="product_video" placeholder="_J1yEsTYXWQ" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Delivery Charge Inside Dhaka</label>
                                        <input type="text" class="form-control" name="delivery_in_dhaka" value="{{ get_option('shipping_charge_in_dhaka') }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="row product-info-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Delivery Charge Outside Dhaka</label>
                                        <input type="text" class="form-control" name="delivery_out_dhaka" value="{{ get_option('shipping_charge_out_of_dhaka') }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Packages</label>
                                        <select name="package[]" id="package" class="form-control select2" multiple>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product_row)
                                            <option value="{{ $product_row->product_id }}">{{ $product_row->product_title }} ({{ $product_row->sku }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Image & Gallery --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">Image and Gallery</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <style>
                                .gallery-col { padding-left: 20px; padding-right: 20px; }
                            </style>
                            <div class="row">
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Featured Image<span class="required">* Size(800*800)</span></label>
                                        <input required type="file" class="form-control" name="featured_image" />
                                    </div>
                                </div>
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Gallery Image 1<span class="required">* Size(800*800)</span></label>
                                        <input type="file" class="form-control" name="product_image1" />
                                    </div>
                                </div>
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Gallery Image 2<span class="required">* Size(800*800)</span></label>
                                        <input type="file" class="form-control" name="product_image2" />
                                    </div>
                                </div>
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Gallery Image 3<span class="required">* Size(800*800)</span></label>
                                        <input type="file" class="form-control" name="product_image3" />
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Gallery Image 4<span class="required">* Size(800*800)</span></label>
                                        <input type="file" class="form-control" name="product_image4" />
                                    </div>
                                </div>
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Gallery Image 5<span class="required">* Size(800*800)</span></label>
                                        <input type="file" class="form-control" name="product_image5" />
                                    </div>
                                </div>
                                <div class="col-md-3 gallery-col">
                                    <div class="form-group">
                                        <label>Gallery Image 6<span class="required">* Size(800*800)</span></label>
                                        <input type="file" class="form-control" name="product_image6" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Categories --}}
                <div class="col-md-6">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">Categories<span class="required">*</span></h3>
                        </div>
                        <div class="box-body" style="padding: 22px; height: 300px; overflow: scroll">
                            <?php if (isset($categories)) {
                                foreach ($categories as $category) {
                                    $subCategory_id = $category->category_id;
                                    $subCategories = DB::table('category')->where('parent_id', $subCategory_id)->orderBy('category_id', 'ASC')->get(); ?>
                                    <input type="checkbox" name="category_id[]" value="<?php echo $category->category_id; ?>">
                                    <span><?php echo $category->category_title; ?></span><br>
                                    <?php if ($subCategories) {
                                        foreach ($subCategories as $subCategory) {
                                            $childCategory_id = $subCategory->category_id;
                                            $childCategories = DB::table('category')->where('parent_id', $childCategory_id)->orderBy('category_id', 'ASC')->get(); ?>
                                            <input type="checkbox" style="margin-left: 30px" name="category_id[]" value="<?php echo $subCategory->category_id; ?>">
                                            <span><?php echo $subCategory->category_title; ?></span><br />
                                            <?php if ($childCategories) {
                                                foreach ($childCategories as $childCategory) { ?>
                                                    <input type="checkbox" style="margin-left: 60px" name="category_id[]" value="<?php echo $childCategory->category_id; ?>">
                                                    <span><?php echo $childCategory->category_title; ?></span><br />
                                            <?php }
                                            } ?>
                                    <?php }
                                    } ?>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>

                {{-- One Page Content - full width --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">One Page Content</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <div class="row">
                                <div class="col-md-12 one-page-col">
                                    <div class="form-group">
                                        <label>One Page Title</label>
                                        <input type="text" class="form-control" name="one_page_title" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12 one-page-col">
                                    <div class="form-group">
                                        <label>One Page Sub Title</label>
                                        <input type="text" class="form-control" name="one_page_subtitle" value="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 one-page-col">
                                    <div class="form-group">
                                        <label>Why One Page</label>
                                        <input type="text" class="form-control" name="one_page_why" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12 one-page-col">
                                    <div class="form-group">
                                        <label>One Page Content Description</label>
                                        <textarea class="form-control" rows="10" name="one_page_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 one-page-col">
                                    <div class="form-group">
                                        <label>আল্লাহর উপর ভরসা</label>
                                        <input type="text" class="form-control" name="allahr_opor_voro" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3 one-page-col">
                                    <div class="form-group">
                                        <label>Best Selling</label>
                                        <input type="text" class="form-control" name="best_selling" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3 one-page-col">
                                    <div class="form-group">
                                        <label>Product Weight (gm)</label>
                                        <input type="text" class="form-control" name="product_weight" value="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 one-page-col">
                                    <div class="form-group">
                                        <label>খাওয়ার নিয়মাবলী</label>
                                        <textarea class="form-control" rows="3" name="khawa_niyom"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- কাস্টমারদের মতামত --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">কাস্টমারদের মতামত & ISO এবং BSTI ও BCSIR থেকে সার্টিফাইড</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <div class="row customer-info">
                                <div class="col-md-6 customer-info-col">
                                    <div class="form-group">
                                        <label>ISO এবং BSTI ও BCSIR থেকে সার্টিফাইড</label>
                                        <input type="file" class="form-control" name="certified_images[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6 customer-info-col">
                                    <div class="form-group">
                                        <label>মতামত ফোটো (Multiple)</label>
                                        <input type="file" class="form-control" name="review_photos[]" multiple>
                                    </div>
                                </div>
                                <div class="col-md-6 customer-info-col">
                                    <div class="form-group">
                                        <label>মতামত YouTube Video ID</label>
                                        <input type="text" class="form-control" name="review_video_id" value="" placeholder="_J1yEsTYXWQ" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product Summary --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #ddd;">
                            <h3 class="box-title">Product Summary</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <textarea class="form-control ckeditor" rows="10" name="product_specification" id="product_specification"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">Description</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <textarea class="form-control ckeditor" rows="10" name="product_description" id="product_description"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Terms & Conditions --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">Terms &amp; Conditions</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <textarea class="form-control ckeditor" rows="5" name="product_terms" id="product_terms"></textarea>
                        </div>
                    </div>
                </div>

                {{-- SEO Options --}}
                <div class="col-md-12">
                    <div class="box box-primary" style="border: 2px solid #ddd; margin-top: 15px;">
                        <div class="box-header" style="background-color: #bdbdbf;">
                            <h3 class="box-title">SEO Options</h3>
                        </div>
                        <div class="box-body" style="padding: 22px;">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="seo_title" id="seo_title" value="">
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" rows="5" name="seo_content" id="seo_content"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input type="text" class="form-control" name="seo_keywords" value="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;"></div>

                <div class="floating-update-btn">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check-circle"></i> Save Product
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#product_title").on('input click', function () {
            var text = $("#product_title").val();
            var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#product_name").val(word);
        });

        $('#product_price, #discount_price, #purchase_price').on('input', function () {
            let purchase_price = parseFloat($("#purchase_price").val());
            let product_price = parseFloat($("#product_price").val());
            let discount_price = parseFloat($("#discount_price").val());
            let sell_price = discount_price > 0 ? discount_price : product_price;
            let product_profit = sell_price - purchase_price;
            $("#product_profite").val(product_profit.toFixed(2));
        });

        $('#commision_percent').on('input', function () {
            let commision_percent = parseInt($(this).val());
            let product_profite = parseFloat($("#product_profite").val());
            let affilite_profit = parseFloat((commision_percent * product_profite) / 100);
            $("#top_deal").val(affilite_profit);
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("body").on('mousemove', function () {
            var _token = $("input[name='_token']").val();
            $.ajax({
                data: {_token: _token},
                type: "POST",
                url: "{{route('product.foldercheck')}}",
                success: function (result) {
                    $('#folder').val(result);
                }
            });
        });
    });
</script>

@endsection
