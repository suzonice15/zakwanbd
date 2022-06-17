
                            <div class="form-group">
                                <label for="category_title">Product URL</label>
                                <p style="color:green">Copy the below link & promote to your audience/followers</p>
                                <input  type="text" id="generate_link" class="form-control"
                                        name="category_title" value="{{ env('APP_ECOMMERCE') }}{{$product->product_name}}/{{Session::get('id')}}">
                            </div>

                           <div class="mt-5">

                               <input type="button" onclick="myFunction()" class="btn btn-success" id="copy_link" value="Copy Link">

                               <a src="{{ env('APP_ECOMMERCE') }}public/uploads/798/798.MR200%20WiFi%204G%20Router.jpg" onclick='window.open("https://www.facebook.com/sharer/sharer.php?u={{ env('APP_ECOMMERCE') }}{{$product->product_name}}/{{Session::get('id')}}", "hello", "width=500,height=500");'>
                                <i style="font-size:35px;position: relative;
    top: 10px" class="fa fa-fw fa-facebook-official"></i>
                            </a>

                            <a href="" onclick='window.open("https://wa.me/?text={{ env('APP_ECOMMERCE') }}{{$product->product_name}}/{{Session::get('id')}}&app_id=123456789", "hello", "width=500,height=500");'>
                                <i style="font-size:35px;position: relative;
    top: 10px" class="fa fa-fw fa-whatsapp"></i>
                            </a>



                            <img  style="cursor: pointer" onclick='window.open("fb-messenger://share/?link={{ env('APP_ECOMMERCE') }}{{$product->product_name}}/{{Session::get('id')}}&app_id=123456789", "hello", "width=500,height=500");' src="{{url('/')}}/images/messenger.png">
                           </div>


    <script>

        $('meta[property=og\\:image]').attr('content', '{{ env('APP_ECOMMERCE') }}public/uploads/798/798.MR200%20WiFi%204G%20Router.jpg');

        function myFunction() {
            var copyText = document.getElementById("generate_link");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");

        }
    </script>