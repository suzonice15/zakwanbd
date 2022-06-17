
<!-- ./wrapper -->

<!-- jQuery 3 -->
 <!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/adminfile')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('assets/adminfile')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('assets/adminfile')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminfile')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/adminfile')}}/dist/js/demo.js"></script>
<script src="{{ asset('assets/adminfile')}}/plugins/select2/select2.full.min.js"></script>

<script src="{{ asset('assets/adminfile')}}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ asset('assets/adminfile')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>

<script>
    $(function () {

        $("#fadeout").fadeOut(500000);

        var url = window.location;
// for sidebar menu but not for treeview submenu
        $('ul.sidebar-menu a').filter(function() {
            return this.href == url;
        }).parent().siblings().removeClass('active').end().addClass('active');
// for treeview which is like a submenu
        $('ul.treeview-menu a').filter(function() {
            return this.href == url;
        }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');

        //Initialize Select2 Elements
        $('.select2').select2();
        $('.datepicker').datepicker(
            {
                format: "dd-mm-yyyy",
                autoclose: true,


            });
        $('.withoutFixedDate').datepicker(
            {

                autoclose: true,


            });
//
     //  $(".datepicker").datepicker().datepicker("setDate", new Date());

        $(":selected").css("background-color", "green");
//        $('.timepicker').timepicker({
//            showInputs: false,
//        });




// Add the following attributes into your BODY tag





    });
</script>
<script>

    var timer = 0;
    function set_interval() {
        //36000000
        // the interval 'timer' is set as soon as the page loads
        timer = setInterval("auto_logout()", 3600000);
        // the figure '10000' above indicates how many milliseconds the timer be set to.
        // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
        // So set it to 300000
    }

    function reset_interval() {
        //resets the timer. The timer is reset on each of the below events:
        // 1. mousemove   2. mouseclick   3. key press 4. scroliing
        //first step: clear the existing timer

        if (timer != 0) {
            clearInterval(timer);
            timer = 0;
            // second step: implement the timer again
            timer = setInterval("auto_logout()", 36000000);
            // completed the reset of the timer
        }
    }

    function auto_logout() {
        // this function will redirect the user to the logout script
        window.location = "UserController/logOut";
    }


</script>

</body>
</html>
