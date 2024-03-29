@extends('layouts.master')
@section('pageTitle')
    Add New Product
@endsection
@section('mainContent')
    <style>
        .has-error {
            border-color: red;
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


        <form action="{{ url('/') }}/admin/product/store" class="form-horizontal" method="post"
              enctype="multipart/form-data">
            @csrf

            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="box box-primary" style="border: 2px solid #ddd;">
                            <div class="box-header" style="background-color: #bdbdbf;">
                                <h3 class="box-title">Product Information</h3>
                            </div>
                            <div class="box-body" style="padding: 22px;">
                                <div class="form-group">
                                    <label for="product_title">Product Title<span
                                                class="required">*</span></label>
                                    <input required type="text" class="form-control the_title"
                                           name="product_title" id="product_title"
                                           value="" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="product_title">Product Sub Title<span
                                                class="required"></span></label>
                                    <input   type="text" class="form-control "
                                           name="product_subtitle" id="product_subtitle"
                                           value="" autocomplete="off">
                                </div>


                                <div class="form-group ">
                                    <label for="product_name">Permalink<span class="required">*</span></label>
                                    <input required type="text" class="form-control the_name"
                                           name="product_name" id="product_name"
                                           value="" autocomplete="off">
                                    <p id="produtctError"></p>
                                </div>
                                <input  type="hidden" class="form-control" name="folder" id="folder" value="" >

                                <div class="form-group ">
                                    <label for="sku">Product Code(sku)<span class="required">*</span></label>
                                    <input required type="text" class="form-control" name="sku" id="sku"
                                           value="Z<?php echo $sku;?>" autocomplete="off">
                                    <span class="text-danger" id="sku_error"></span>
                                </div>
                                <div class="form-group ">
                                    <label for="sku">Product Bar Code<span class="required">*</span></label>
                                    <input required type="text" class="form-control" name="barcode" id="barcode"
                                           value="" autocomplete="off">
                                    <span class="text-danger" id="sku_error"></span>
                                </div>
                                <?php
                                $status= Session::get('status');
                                if ($status != 'editor') {
                                ?>
                                <div
                                     class="form-group ">
                                    <label for="purchase_price">Purchase Price<span
                                                class="required">*</span></label>
                                    <input type="number" class="form-control" name="purchase_price"
                                           id="purchase_price"
                                           value="" autocomplete="off">
                                </div>
                                <?php
                                    }
                                ?>
                                <div class="form-group ">
                                    <label for="sell_price">Regular Price<span class="required">*</span></label>
                                    <input required type="number" class="form-control" name="product_price"
                                           id="product_price" value="" autocomplete="off">
                                </div>


                                <div class="form-group ">
                                    <label for="discount_price"> Discount Price</label>
                                    <input type="number" class="form-control" name="discount_price"
                                           id="discount_price"
                                           value="" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="commision_percent"> Profit</label>
                                    <input type="number" readonly class="form-control" name="product_profite"
                                           id="product_profite"
                                           value="" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="commision_percent">affiliate  commision %</label>
                                    <input type="text" class="form-control" name="commision_percent"
                                           id="commision_percent"
                                           value="" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="discount_price">affiliate  Commision</label>
                                    <input type="text" class="form-control" name="top_deal"
                                           id="top_deal"
                                           value="" autocomplete="off">
                                </div>


                                <div class="form-group ">
                                    <label for="product_availability">Product Published
                                        Status</label> <select name="status"
                                                               class="form-control">
                                        <option value="1">Published</option>
                                        <option value="0">Unpublished</option>
                                    </select></div>
                                <div class="form-group ">
                                    <label for="product_promotion_active">Promosion Product
                                        </label> <select name="product_promotion_active"
                                                               class="form-control">
                                        <option value="0">Select</option>
                                        <option value="1">Promosion Product Active</option>
                                    </select>
                                </div>


                                <div class="form-group ">
                                    <label for="">Hot Product</label>
                                    <select name="hot_product" class="form-control">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                               
                                <div class="form-group" hidden>
                                    <label for="stock_qty">Stock Alert.</label>
                                    <input type="text" class="form-control" name="stock_alert" id="stock_alert"
                                           value="" autocomplete="off">
                                </div>


                                <div class="form-group ">
                                    <label for="product_type">Product Location</label>
                                    <select name="product_type" id="product_type"
                                            class="form-control">
                                        <option value="general">General</option>
                                        <option value="home">Home</option>
                                        <option value="hot">Hot Sell</option>
                                    </select>

                                </div>



                                <div  class="form-group ">
                                    <label for="product_video">Youtube Video Id</label>
                                    <input type="text" class="form-control" name="product_video"
                                           id="product_video" value="" placeholder="_J1yEsTYXWQ" autocomplete="off">
                                </div>

                                <div  class="form-group ">
                                    <label for="product_video">Collection Product From User</label>


                                     <textarea class="form-control" rows="3" name="collection_product_from_user"
                                               id="collection_product_from_user"> </textarea>
                                </div>



                                <div class="form-group ">
                                    <label for="discount_price">Delivery Charge Inside Dhaka</label>
                                    <input type="text" class="form-control" name="delivery_in_dhaka"
                                           id="discount_price"
                                           value="<?= get_option('shipping_charge_in_dhaka') ?>" autocomplete="off">
                                </div>
                                <div class="form-group ">
                                    <label for="discount_price">Delivery Charge Outside Dhaka</label>
                                    <input type="text" class="form-control" name="delivery_out_dhaka"
                                           id="discount_price"
                                           value="<?= get_option('shipping_charge_out_of_dhaka') ?>" autocomplete="off">
                                </div>

                                <div class="form-group ">
                                    <label for="product_type">Hot Deal Products</label>
                                    <select name="hot_deal_product" id="hot_deal_product"
                                            class="form-control">
                                        <option value="0">Select Option</option>
                                        <option value="1">First Hot Deals</option>
                                        <option value="2">Second Hot Deals</option>
                                    </select>
                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">

                        <div class="box box-primary" style="border: 2px solid #ddd;height: 600px">
                            <div class="box-header" style="background-color: #bdbdbf;">

                                <h3 class="box-title">Image and Gallary</h3>
                            </div>
                            <div class="box-body" style="padding: 22px;">

                                <div class="form-group featured-image">
                                    <label>Featured Image<span class="required">* Size(800*800)</span></label>
                                    <input  required type="file" class="form-control" name="featured_image"/>

                                </div>
                            </div>

                            <div class="box-body" style="padding: 22px;">

                                <div class="form-group featured-image">
                                    <label>Product Gallary<span class="required">* Size(800*800)</span></label>
                                    <input type="file" class="form-control" name="product_image1"/>
                                    <br>
                                    <input type="file" class="form-control" name="product_image2"/>
                                    <br>
                                    <input type="file" class="form-control" name="product_image3"/>
                                    <br>
                                    <input type="file" class="form-control" name="product_image4"/>
                                    <br>
                                    <input type="file" class="form-control" name="product_image5"/>
                                    <br>
                                    <input type="file" class="form-control" name="product_image6"/>
                                    <br>
                                    <input type="file" class="form-control" name="product_image7"/>
                                    <br>
                                    <br>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary" style="border: 2px solid #ddd;">
                                <div class="box-header" style="background-color: #bdbdbf;">

                                    <h3 class="box-title">Categories<span class="required">*</span></h3>
                                </div>
                                <div class="box-body" style="padding: 22px;height: 300px;overflow: scroll">
                                    <div class="form-group">
                                        <?php




                                        if (isset($categories)) {
                                        foreach ($categories as $category) {
                                            


                                       $subCategory_id = $category->category_id;
                                        $subCategories=DB::table('category')->where('parent_id',$subCategory_id)->orderBy('category_id','ASC')->get();


                                        ?>
                                        <input type="checkbox"   name="category_id[]" value="<?php echo $category->category_id;?>">
                                            <span><?php echo $category->category_title;?></span>
                                            <br>
                                            <?php

                                            if($subCategories) {
                                                foreach ($subCategories as $subCategory) {

                                            $childCategory_id = $subCategory->category_id;
                                            $childCategories=DB::table('category')->where('parent_id',$childCategory_id)->orderBy('category_id','ASC')->get();

                                            ?>



                                            <input type="checkbox"  style="margin-left: 30px" name="category_id[]" value="<?php echo $subCategory->category_id;?>">
                                            <span><?php echo $subCategory->category_title;?></span>
                                            <br/>

                                            <?php

                                            if($childCategories){
                                                foreach ($childCategories as $childCategory) {
                                            ?>
                                            <input type="checkbox"  style="margin-left: 60px" name="category_id[]" value="<?php echo $childCategory->category_id;?>">
                                            <span><?php echo $childCategory->category_title;?></span>
                                            <br/>

                                        <?php
                                                    }
                                              }  }

                                                }

                                        }


                                        }


                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>


                <div class="box box-primary" style="border: 2px solid #ddd;">
                    <div class="box-header" style="background-color: #ddd;">
                        <h3 class="box-title">Product Summary
                        </h3>
                    </div>
                    <div class="box-body" style="padding: 22px; ">
                        <div class="form-group ">
                            <textarea class="form-control ckeditor" rows="3" name="product_specification"
                                      id="product_specification"> </textarea>
                        </div>
                    </div>
                </div>
                <div class="box box-primary" style="border: 2px solid #ddd;">
                    <div class="box-header" style="background-color: #bdbdbf;">

                        <h3 class="box-title">Description</h3>
                    </div>
                    <div class="box-body" style="padding: 22px; ">
                        <div class="form-group ">
                <textarea   class="form-control ckeditor" rows="10" name="product_description"
                          id="product_description"></textarea>
                        </div>
                    </div>
                </div>


                <div class="box box-primary" style="border: 2px solid #ddd;" >
                    <div class="box-header" style="background-color: #bdbdbf;">

                        <h3 class="box-title">Terms &amp; Conditions</h3>
                    </div>
                    <div class="box-body" style="padding: 22px; ">
                        <div class="form-group ">
									<textarea class="form-control ckeditor " rows="5" name="product_terms"
                                              id="product_terms"></textarea>
                        </div>
                    </div>
                </div>

                <div class="box box-primary" style="border: 2px solid #ddd;">
                    <div class="box-header" style="background-color: #bdbdbf;">

                        <h3 class="box-title">SEO Options</h3>
                    </div>


                    <div class="box-body" style="padding: 22px; ">
                        <div class="form-group  ">
                            <label for="seo_title"> Title</label>
                            <input type="text" class="form-control" name="seo_title" id="seo_title"
                                   value=" ">
                        </div>


                        <div class="form-group  ">
                            <label for="seo_content">Meta description</label>
								<textarea class="form-control" rows="5" name="seo_content"
                                          id="seo_content"> </textarea>
                        </div>

                        <div class="form-group  ">
                            <label for="seo_keywords">Meta Keywords</label>

                            <input type="text" class="form-control" name="seo_keywords" id="seo_title"
                                   value=" ">


                        </div>
                    </div>
                </div>
                <div class="box-footer">

                    <button type="submit" class="btn btn-success pull-left">Save</button>
                </div>
            </div>


        </form>

    </div>


    <script>
        $(document).ready(function () {
            $("#product_title").on('input click', function () {
                var text = $("#product_title").val();
                var _token = $("input[name='_token']").val();
                var word = text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                $("#product_name").val(word);

            });

            $('#product_price , #discount_price,#purchase_price').on('input', function () {

                let purchase_price=parseFloat($("#purchase_price").val());
                let product_price=parseFloat($("#product_price").val());
                let discount_price=parseFloat($("#discount_price").val());
                let sell_price=0;
                if(purchase_price <=0 ){
                    alert("please Enter Purchase Price")
                }
                if(discount_price >0){
                    sell_price=discount_price;
                } else {
                    sell_price=product_price;
                }
                let product_profit=sell_price-purchase_price
                product_profit.toFixed(2)
              
               
                $("#product_profite").val(product_profit.toFixed(2));
            });

            $('#commision_percent').on('input', function () {
                let commision_percent=parseInt($(this).val());
                let product_profite=parseFloat($("#product_profite").val());
                let affilite_profit=parseFloat((commision_percent*product_profite)/100);
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


