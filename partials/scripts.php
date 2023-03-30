<!-- jQuery -->
<script src="<?php echo $base_dir; ?>../public/plugins/jquery/jquery.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Chart Js -->
<script src="<?php echo $base_dir; ?>../public/plugins/chart.js/Chart.min.js"></script>
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
<!-- Data tables -->
<script src="<?php echo $base_dir; ?>../public/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables/dataTables.dateTime.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $base_dir; ?>../public/plugins/datatables/searchBuilder.bootstrap4.js"></script>

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
<!-- Load Charts -->
<script>
    $(function() {
        /* House  */
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Vacant',
                'Occupied',
            ],
            datasets: [{
                data: [700, 500],
                backgroundColor: ['#f56954', '#00a65a'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }

        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })

        /* Expenses Vs Revenue */
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
                'Expenses',
                'Revenue',
            ],
            datasets: [{
                data: [7000, 500],
                backgroundColor: ['#00c0ef', '#3c8dbc'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        })

    })
</script>
<?php require_once('../modals/logout.php'); ?>