<style>
    @media  (max-width:600px) {
        .left_image_class{

            margin-left: -39px !important;
        }
        .footer-payment-method {
            padding-left: 5px !important;
        }
        .right_image_class {

            float: left !important;
        }
        .app_image_class{
            margin-left: -2px !important;
        }
    }
    .left_image_class{
        list-style: none;float: left;
        margin-left: 28px;
    }
    .footer-payment-method{
        padding-left: 67px;
    }
    .right_image_class{
        list-style: none;float: right
    }
    .app_image_class{
        margin-top: 70px;
        margin-left: 68px;
    }

</style>

<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('assets/font_end/')}}/js/bootstrap.min.js"></script>



<script>
    
    
    let width_dektop=$(window).width();
    
if(width_dektop<700){
    
    
 $('.remove_class').removeClass('desktop_image');
           

          
       

}
</script>

</body>
</html>