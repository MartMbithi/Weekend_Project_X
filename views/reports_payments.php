<?php
/*
 *   Crafted On Fri Mar 31 2023
 *   Author Martin (martin@devlan.co.ke)
 */

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../config/codeGen.php');
require_once('../helpers/payments.php');
require_once('../partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Payments</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="payments">Payments</a></li>
                                <li class="breadcrumb-item active">Manage</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-outline-success">
                            Filter payments
                        </button>
                    </div>
                    <hr>
                    <!-- Add Modal -->
                    <div class="modal fade fixed-right" id="add_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div class="text-center">
                                        <h6 class="mb-0 text-bold">Filter rent payments</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">From date</label>
                                                <input type="text" required name="start_date" class="form-control filter_dp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">To date</label>
                                                <input type="text" required name="end_date" class="form-control filter_dp">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="Filter_Payment" class="btn btn-outline-success">Filter payments</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <?php if (isset($_POST['Filter_Payment'])) {
                        $start_date = mysqli_real_escape_string($mysqli, $_POST['start_date']);
                        $end_date = mysqli_real_escape_string($mysqli, $_POST['end_date']);
                    ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            Payments records from <?php echo date('d M Y', strtotime($_POST['start_date'])); ?> to
                                            <?php echo date('d M Y', strtotime($_POST['end_date'])); ?>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped export_dt">
                                            <thead>
                                                <tr>
                                                    <th>Ref Code</th>
                                                    <th>Inv Number</th>
                                                    <th>Amount</th>
                                                    <th>Payment Means</th>
                                                    <th>Paid By</th>
                                                    <th>Paid On</th>
                                                    <th>House Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $payments_sql = mysqli_query(
                                                    $mysqli,
                                                    "SELECT * FROM payments p
                                                INNER JOIN tenants t ON t.tenant_id = p.payment_tenant_id
                                                INNER JOIN houses h ON h.house_id = t.tenant_house_id
                                                WHERE payment_date BETWEEN '{$start_date}' AND '{$end_date}'
                                                "
                                                );
                                                if (mysqli_num_rows($payments_sql) > 0) {
                                                    while ($payments = mysqli_fetch_array($payments_sql)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <a href="receipt?view=<?php echo $payments['payment_id']; ?>">
                                                                    <?php echo $payments['payment_ref_code']; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $payments['payment_invoice_number']; ?></td>
                                                            <td>Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
                                                            <td><?php echo $payments['payment_type']; ?></td>
                                                            <td><?php echo $payments['tenant_name']; ?></td>
                                                            <td><?php echo date('d M Y', strtotime($payments['payment_date'])); ?></td>
                                                            <td><?php echo $payments['house_number']; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            Payments records
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped export_dt">
                                            <thead>
                                                <tr>
                                                    <th>Ref Code</th>
                                                    <th>Inv Number</th>
                                                    <th>Amount</th>
                                                    <th>Payment Means</th>
                                                    <th>Paid By</th>
                                                    <th>Paid On</th>
                                                    <th>House Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $payments_sql = mysqli_query(
                                                    $mysqli,
                                                    "SELECT * FROM payments p
                                                    INNER JOIN tenants t ON t.tenant_id = p.payment_tenant_id
                                                    INNER JOIN houses h ON h.house_id = t.tenant_house_id
                                                    WHERE payment_date"
                                                );
                                                if (mysqli_num_rows($payments_sql) > 0) {
                                                    while ($payments = mysqli_fetch_array($payments_sql)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <a href="receipt?view=<?php echo $payments['payment_id']; ?>">
                                                                    <?php echo $payments['payment_ref_code']; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $payments['payment_invoice_number']; ?></td>
                                                            <td>Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
                                                            <td><?php echo $payments['payment_type']; ?></td>
                                                            <td><?php echo $payments['tenant_name']; ?></td>
                                                            <td><?php echo date('d M Y', strtotime($payments['payment_date'])); ?></td>
                                                            <td><?php echo $payments['house_number']; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </div>
                    <?php } ?>
                </div>
                <!-- /.content-wrapper -->

                <!-- Main Footer -->
                <?php
                include('../partials/content_breaker.php');
                require_once('../partials/footer.php');
                ?>
            </div>
            <!-- ./wrapper -->
        </div>
        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>
    </div>
</body>

</html>