
<!-- ./wrapper -->

<!-- jQuery 3 -->
 <!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('assets/adminfile')); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('assets/adminfile')); ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('assets/adminfile')); ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/adminfile')); ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('assets/adminfile')); ?>/dist/js/demo.js"></script>
<script src="<?php echo e(asset('assets/adminfile')); ?>/plugins/select2/select2.full.min.js"></script>

<script src="<?php echo e(asset('assets/adminfile')); ?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo e(asset('assets/adminfile')); ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
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
        $(":selected").css("background-color", "green");

    });
</script>


</body>

 </html>
<?php /**PATH C:\SXampp\htdocs\Jacwan\affiliate\resources\views/layouts/includes/footer.blade.php ENDPATH**/ ?>