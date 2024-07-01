<div class="add-cart-section" id="main_show_cart_item_{{$product->product_id}}" style="display:none">    
                                    <div class="add-cart-inner"> 
                                        <i class="fas fa-minus-circle fs-5" onclick="countDown({{$product->product_id}})"></i>
                                      <span>  <span id="product_count_{{$product->product_id}}">1</span>  in bag </span>
                                        <i class="fas fa-plus-circle fs-5" onclick="countUp({{$product->product_id}})"></i>                           
                                </div> 
                            </div> 

                            <div  onclick="show_hide_item({{$product->product_id}})" class="add-cart-section-show" id="main_show_item_{{$product->product_id}}">    
                                    <div class="add-cart-inner-show">  
                                    <i class="fas fa-bolt"></i>  <p style="margin-top: -3px;"> Add to bag  </p>                        
                                </div> 
                            </div>

                            @include('website.includes.javascript_common_file')
