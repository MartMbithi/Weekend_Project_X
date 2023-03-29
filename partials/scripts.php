<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo $base_dir; ?>../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo $base_dir; ?>../public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo $base_dir; ?>../public/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo $base_dir; ?>../public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo $base_dir; ?>../public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo $base_dir; ?>../public/plugins/moment/moment.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $base_dir; ?>../public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo $base_dir; ?>../public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo $base_dir; ?>../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $base_dir; ?>../public/js/adminlte.js"></script>
<!-- Dashboard -->
<script src="<?php echo $base_dir; ?>../public/js/pages/dashboard.js"></script>
<!-- Toastr -->
<script src="<?php echo $base_dir; ?>../public/plugins/toastr/toastr.min.js"></script>
<!-- Load alerts -->
<?php if (isset($success)) { ?>
    <!-- Pop Success Alert -->
    <script>
        toastr.success('<?php echo $success; ?>')
    </script>

<?php }
if (isset($err)) { ?>
    <script>
        toastr.error('<?php echo $err; ?>')
    </script>
<?php }
if (isset($info)) { ?>
    <script>
        toastr.warning('<?php echo $info; ?>')
    </script>
<?php }
?>
<script>
    /* Custom Scripts */
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    /* Initiate data tables */

</script>