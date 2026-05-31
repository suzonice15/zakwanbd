<div class="add-cart-section" id="main_show_cart_item_{{$product->product_id}}" style="display:none">    
                                    <div class="add-cart-inner"> 
                                        <i class="fas fa-minus-circle fs-5" onclick="countDown({{$product->product_id}})"></i>
                                      <span>  <span id="product_count_{{$product->product_id}}">1</span>  in bag </span>
                                        <i class="fas fa-plus-circle fs-5" onclick="countUp({{$product->product_id}})"></i>                           
                                </div> 
                            </div> 
<!-- 
                            <div  onclick="show_hide_item({{$product->product_id}})" class="add-cart-section-show" id="main_show_item_{{$product->product_id}}">    
                                    <div class="add-cart-inner-show">  
                                    <i class="fas fa-bolt"></i>  <p style="margin-top: -3px;"> Add to bag  </p>                        
                                </div> 
                            </div> -->
<a href="{{ url('/') }}/{{$product->product_name}}"
   style="display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #E91B2A, #ff8c42);
    color: #fff;
    width: 100%;
    border-radius: 50px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
    cursor: pointer;
    padding: 4px 7px;
    color: white !important;
    margin-top: 7px;
    margin-bottom: -3px;
   ">
    অর্ডার করুন
</a>

                            @include('website.includes.javascript_common_file')
