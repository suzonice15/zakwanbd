<footer class="footer-section bg-dark">
    <div class="container text-white    mt-md-5 mt-lg-5  pt-2 pt-md-4">
        <div class="row mt-1 mt-md-0 mb-4 mb-md-0">
            <div class="col-md-6 col-12 col-lg-3  mt-3 mt-md-0 mb-0 mb-md-4"><h5 class="text-start ms-3">Contacts</h5>
                <ul class="fa-ul foot-desc ml-0">  
                         <li class="mb-2"><span class="fa-li"><i class="fa fa-map"></i></span>Hazrat Shah Ali School & College Market Mirpur-1, Dhaka-1216</li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span>+8801970010605</li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-phone"></i></span>+8801710881833</li>
                        <li class="mb-2"><span class="fa-li"><i class="fa fa-envelope"></i></span>support@zakwanbd.com</li>
                        <li><span class="fa-li"><i class="fa fa-eye"></i></span><span>Friday-Wednesday: 08:00 AM-8:00 PM</span></li>


                </ul>
            </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-6 col-12 col-lg-3   mt-3 lg-ps-5   mb-md-4"><h5 class="text-start">About
                    Ecommerce</h5>
                <ul class="list-unstyled foot-desc">
                    <li class="mb-2"><a href="{{url('/')}}/about-us">About US</a></li>
                    <li class="mb-2"><a href="{{url('/')}}/contact-us">Contact US</a></li>
                    <li class="mb-2"><a href="{{url('/')}}/privacy-policy">Privacry Policy</a></li>
                    {{--<li class="mb-2"><a href="{{url('/')}}/sundarban">Sundarban Courier Service</a></li>--}}
                    <li class="mb-2"><a href="{{url('/')}}/super-shop">Address of all Super Shop </a></li>

                </ul>
              </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-lg-2 col-md-6 col-12  mt-3 mt-md-0 mb-0 mb-md-4"><h5 class="text-start">Customer
                    Care</h5>
                <ul class="list-unstyled ">
                    <li class="mb-2"><a target="_blank" href="{{url('/')}}/terms-and-conditions">Terms and Conditions</a></li>
                    <li class="mb-2"><a target="_blank" href="{{url('/')}}/track-your-order">Track Order</a></li>
                    <li class="mb-2"><a target="_blank"  href="{{url('/')}}/refund-and-returns-policy">Return and Refund Policy</a></li>
                    <li class="mb-2"><a target="_blank" href="{{url('/')}}/customer-service">Customer Service</a></li>
                    <li class="mb-2"><a  target="_blank" href="https://www.affiliate.zakwanbd.com/">Affiliate</a></li>
                </ul>
            </div>
            <hr class="clearfix w-100 d-md-none">
            <div class="col-lg-4  col-md-4 col-12 mt-3 mt-md-0 mb-0 mb-md-4">
                <div class="row">
                    <div class="col-7"><h5 class="text-start ">Payment System</h5>
                        <ul class="list-unstyled">
                            <li class="first">
                                <img
                                        alt="sohojbuy.com"
                                        src="{{url('/')}}/public/logo/nagad.png"
                                                   style="float:left;margin-left:3px;width:45px;height:40px;margin-bottom:2px"><img
                                        alt="sohojbuy.com"
                                        src="{{url('/')}}/public/logo/bkash.png"
                                        style="float:left;margin-left:3px;width:45px;height:40px;margin-bottom:2px">                                       
                                        
                                        <img
                                        alt="sohojbuy.com"
                                        src="{{url('/')}}/public/logo/brack.png"
                                        style="float:left;margin-left:3px;width:45px;height:40px;margin-bottom:2px">
                            </li>


                        </ul>
                    </div>
                    <div class="col-5"><h5 class="text-start ms-3">Our Apps</h5>
                        <ul class="list-unstyled">
                            <li class="first"><img
                                        src="{{url('/')}}/public/logo/play_store.jpg"
                                        alt="sohojbuy.com" title="play store"></li>
                            <li class="last mt-1"><img
                                        src="{{url('/')}}/public/logo/i-store.jpg"
                                        alt="sohojbuy.com" title="app store"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color:green" class="container-fluid  d-inline-block">
        <div class="row">
            <div class="col-md-12 col-lg-7 col-12 pt-2">
                <div class="text-start text-white ms-1"><p> © 2018 All Rights Reserved by zakwanbd.com Developed by <a
                                target="_blank " style="color:#ffffff" >Jibonpata IT Limited.</a></p></div>
            </div>
            <div class="col-md-12 col-lg-5 col-12 d-inline-block pt-2">
                <ul class="social">
                    <li><a target="_blank" href="<?=get_option('facebook')?>"><i class="fab fa-facebook"></i>
                            <span class="ms-1">Facebook</span></a></li>
                    <li><a target="_blank" href="<?=get_option('youtube')?>"><i
                                    class="fab fa-youtube"></i><span class="ms-1">Youtube</span></a></li>
                    <li><a target="_blank" href="<?=get_option('twitter')?>"><i
                                    class="fab fa-twitter mr-5"></i><span class="ms-1">Twitter</span></a></li>
                    <li><a target="_blank" href="<?=get_option('linked')?>"><i class="fab fa-instagram mr-5"></i> <span
                                    class="ms-1">Instagram</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php  $items = \Cart::getContent();
    $total = 0;
    $quantity = 0;
    foreach ($items as $row) {
        $total = \Cart::getTotal();
        $quantity = Cart::getContent()->count();
    }
    ?>
    <div class="container-fluid text-center  d-block d-md-block d-lg-none d-xl-none d-xxl-none "
         style="background-color:#fff;bottom:0px;position:fixed;color:black">
        <div class="row">
            <div class="col-3">
                <a href="{{url('/')}}">
                <img class="img-fluid" style="height:20px"
                                    src="<?=get_option('icon')?>"><br><span style="color:black">Home</span></a></div>
            <div class="col-3">
                <a href="{{url('/')}}/cart">
                    <i  style="color:black" class="fa fa-cart-arrow-down"></i><br><span style="color:black">Cart<span
                                class="footer-cart">{{$quantity}}</span></span></a></div>
            <div class="col-3">
                <a href="{{url('/')}}/wishlist">
                <i style="color:black" class="ms-2 fa fa-heart"></i><br><span style="color:black">Wishlist <span class="footer-wishlist">@if(Session::get('total_wishlist_count')>0){{Session::get('total_wishlist_count')}}@else 0 @endif</span></span>
                    </a>
            </div>
            <div class="col-3">


                @if(Session::get('customer_id'))
                    @if(Session::get('picture'))
                        <a href="{{url('/')}}/customer/dasboard">
                            <img style="border-radius: 50%;
width: 24px;
position: absolute;
top: 0px;
height: 30px;" class="img-fluid" src="{{url('/')}}/public/uploads/users/{{Session::get('picture')}}">
                        </a>
                    @else
                        <a href="{{url('/')}}/customer/dasboard">
                            <img style="border-radius: 50%;
width: 24px;
position: absolute;
top: 0px;
height: 30px;" class="img-fluid" src="{{url('/')}}/public/uploads/user.jpg">
                        </a>
                    @endif
                    <br>
                    <span style="color:black">Dasboard</span>

                @else

                    <a href="{{url('/')}}/customer/login"><i style="color: black;" class="ms-1 fa fa-user"></i><br><span style="color:black">Account</span></a>

                @endif


            </div>
        </div>
    </div>

    <a id="button_move_to_top" > </a>
    <button style="margin-top: 20px;" type="button" id="button_move_to_topm" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-envelope"></i>
    </button>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Send Message</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" id="" name="" method="post">
                        @csrf
                        <div class="form-group" >
                            <label for="billing_name"><b>Mobile Number</b></label>
                            <input type="number" name="mobile_number" id="mobile_number" value="" required="" class="form-control " placeholder="Mobile Number">

                            <p  style="color:red;font-size:18px" id="customer_phone_error"></p>
                        </div>
                        <div class="form-group">
                            <label for="billing_name"><b>Message</b></label>
                            <span style="color:red;font-size: 18px;margin-top: -7px;position: absolute;">*</span>
                            <textarea rows="5" required=""  name="message" id="customermessagebody" class="form-control" placeholder="Type Your Address"></textarea>
                            <p  style="color:red;font-size:18px" id="customer_address_error"></p>

                        </div>
                        <div class="form-group">
                            <button type="button" id="customerMessage" class="btn btn-info">Send Message</button>

                            <p id="successMessage"></p>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>

            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<script src="{{ asset('assets/font_end/')}}/js/stellarnav.js"></script>
@yield('js')
<script>
    $(document).ready(function ($) {
        $.ajax({
            url: "{{url('/visitor')}}",
            method: "get",
            success: function (data) {
            }
        });
        jQuery('#customerMessage').click(function(){
            var customer_phone = $('#mobile_number').val();
            var customermessagebody = $('#customermessagebody').val();
            var submit=false;
            if (!/^01\d{9}$/.test(customer_phone)) {
                $('#customer_phone_error').text("Invalid phone number: must have exactly 11 digits and begin with ");
                submit=false;
            } else {
                submit=true;
                $('#customer_phone_error').text("");
            }
            if(customermessagebody.length<30){
                submit=false;
                $('#customer_address_error').text("Enter at least 30 characters ");
            } else {
                submit=true;
                $('#customer_address_error').text("");
            }

            if(submit==true){
                $.ajax({
                    type: "POST",
                    data: {
                        mobile_number: customer_phone,
                        message:customermessagebody,
                        _token:"{{csrf_token()}}"
                    },
                    url: "{{url('/')}}/sendMessage",
                    success: function (result) {
                        var result=result
                        if(result==1){
                            $('#successMessage').html("<strong class='text-success'>Thank You Your Message Send SuccessFully</strong>")

                            $('#mobile_number').val('');
                            $('#customermessagebody').val('');
                            setTimeout(function(){
                                $("#exampleModal").modal('hide');
                            },3000)
                        }else {
                            $('#mobile_number').val('');
                            $('#customermessagebody').val('');
                            setTimeout(function(){
                                $("#exampleModal").modal('hide');
                            },3000)

                            $('#successMessage').html("<strong class='text-success'>Thank You Your Message Send SuccessFully</strong>")
                        }
                    },
                    error: function (result) {
                        console.log(result);
                    }
                });
            }
        })
        var btn = jQuery('#button_move_to_top');
        jQuery(window).scroll(function (e) {
            // OR  $(window).scroll(function() {
            var scroll = jQuery(document).scrollTop();
            if (scroll > 30) {
                btn.show();
            } else {
                btn.hide();
            }
        });
        btn.on('click', function (e) {
            e.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, '300');
        });
        jQuery('.stellarnav').stellarNav({
            theme: 'dark',
            breakpoint: 960,
            position: 'left',
            phoneBtn: '<?=get_option('phone')?>',
            locationBtn: '<?=get_option('map')?>'
        });
    });

    $('.desktop-search-field').on('input', function () {
        var search_query = $(this).val();
        if (search_query.length >= 1) {
            jQuery.ajax({
                type: "GET",
                url: "{{ url('search_ajax/')}}?search=" + search_query,
                success: function (data) {
                     jQuery(".desktop-menu").hide();
                     jQuery(".all-content-hide").empty();
                    jQuery(".main_content_for_ajax_search").html(data);
                }
            });
        }
    });
    $(document).on('click', '.desktopMenuCategoryClickShow', function () {
        $(".desktop-menu").toggle();
        $(".fa-angle-down").addClass("fa-angle-up");
    })

    $(document).on('click', '.add-to-wishlist', function () {
        let product_id = $(this).data("product_id"); // will return the number 123
        $(this).css("background-color", "red");
        $.ajax({
            type: "GET",
            url: "{{url('add-to-wishlist')}}?product_id=" + product_id,
            success: function (data) {
                location.reload();
            }
        })
    })
</script>
<script>
    $(document).on('click', '.add_to_cart', function () {
        let product_id = $(this).data("product_id"); // will return the number 123
        let picture = $(this).data("picture"); // will return the number 123
        let quntity = parseInt($('#quantity').text());
        if (typeof quntity === 'undefined') {
            quntity = 1;
        } else {
            quntity = quntity;
        }

        $.ajax({
            type: "GET",
            url: "{{url('add-to-cart')}}?product_id=" + product_id + "&picture=" + picture + "&quntity=" + quntity,
            success: function (data) {
                $('#cart_count').text(data.result.count);
                $('.total-price .value').text(data.result.total);
            }
        })
    })
</script>
<script>
    $(document).on('click', '.buy-now-cart', function () {
        let product_id = $(this).data("product_id"); // will return the number 123
        let picture = $(this).data("picture"); // will return the number 123
        let quntity = parseInt($('#quantity').text());
        if (typeof quntity === 'undefined') {
            quntity = 1;
        } else {
            quntity = quntity;
        }
        $.ajax({
            type: "GET",
            url: "{{url('add-to-cart')}}?product_id=" + product_id + "&picture=" + picture + "&quntity=" + quntity,
            success: function (data) {
                window.location.assign("{{ url('/') }}/cart")
            }
        })
    })
</script>
</body>
</html>
