<!-- jQuery -->
<script src="<?php echo $base_dir; ?>../public/plugins/jquery/jquery.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Chart Js -->
<script src="<?php echo $base_dir; ?>../public/plugins/chart.js/Chart.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $base_dir; ?>../public/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $base_dir; ?>../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
<!-- Toastr -->
<script src="<?php echo $base_dir; ?>../public/plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo $base_dir; ?>../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

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
require_once('../modals/logout.php'); ?>
<script>
    /* Prevent double submissions */
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    /* Init Data tables */
    $('.data_table').DataTable({
        "responsive": true,
        "autoWidth": false,

    });

    /* Set active class */
    $(document).ready(function() {
        var url = window.location;
        $('li.nav-item a[href="' + url + '"]').parent().addClass('active');
        $('li.nav-item a').filter(function() {
            return this.href == url;
        }).parent().addClass('active');
    });

    /* Init Select2 */
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>