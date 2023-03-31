<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../helpers/tenants.php');
require_once('../partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/navbar.php');
        $payment_id = mysqli_real_escape_string($mysqli, $_GET['view']);
        $payments_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM payments p
            INNER JOIN tenants t ON t.tenant_id = p.payment_tenant_id
            INNER JOIN houses h ON h.house_id = t.tenant_house_id
            WHERE payment_id = '{$payment_id}'"
        );
        if (mysqli_num_rows($payments_sql) > 0) {
            while ($payments = mysqli_fetch_array($payments_sql)) {
        ?>
                <!-- /.navbar -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0"><?php echo $payments['tenant_name']; ?> Payment Receipt</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="tenants">Payments</a></li>
                                        <li class="breadcrumb-item active"><?php echo $payments['payment_ref_code']; ?></li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <!-- Profile Image -->
                                    <div class="card card-success card-outline">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="../public/img/avatar.png" alt="User profile picture">
                                            </div>
                                            <h3 class="profile-username text-center"><?php echo $payments['tenant_name']; ?></h3>
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>ID Number: </b> <a class="float-right"><?php echo $payments['tenant_national_id']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Phone Number</b> <a class="float-right"><?php echo $payments['tenant_mobile_number']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Date Registered: </b> <a class="float-right"><?php echo date('d M Y', strtotime($payments['tenant_date_of_registration'])); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="card card-success card-outline">
                                        <div id="Print">
                                            <div class="card-body">
                                                <div class="row invoice-info">
                                                    <div class="col-sm-12 invoice-col text-right">
                                                        <b>Invoice # <?php echo $payments['payment_invoice_number']; ?></b><br>
                                                        <b>Payment # :</b> <?php echo $payments['payment_ref_code']; ?><br>
                                                        <b>Payment Date:</b> <?php echo date('d M Y', strtotime($payments['payment_date'])); ?><br>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->

                                                <!-- Table row -->
                                                <div class="row">
                                                    <div class="col-12 table-responsive">
                                                        <table class="table table-striped text-right">
                                                            <thead>
                                                                <tr>
                                                                    <th>Qty</th>
                                                                    <th>Product</th>
                                                                    <th>Description</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>House rent</td>
                                                                    <td>Rent payment for house number <?php echo $payments['house_number']; ?></td>
                                                                    <td>Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->

                                                <div class="row">
                                                    <!-- accepted payments column -->
                                                    <div class="col-6">
                                                        <p class="lead"></p>
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-6 text-right">
                                                        <p class="lead">Payment Method: <?php echo $payments['payment_type']; ?></p>
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tr>
                                                                    <th style="width:50%">Subtotal:</th>
                                                                    <td>Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total:</th>
                                                                    <td>Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                        <div class="card-footer">
                                            <!-- this row will not appear when printing -->
                                            <div class="row no-print">
                                                <div class="col-12">
                                                    <button type="button" id="print" onclick="printContent('Print');" class="btn btn-success float-right"><i class="fas fa-print"></i>
                                                        Print
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Main Footer -->
        <?php
                $i = 0;
                while ($i <= 4) {
                    echo "<br>";
                    $i++;
                }
                require_once('../partials/footer.php');
            }
        } ?>
    </div>

    </div>

    <!-- Scripts -->
    <?php require_once('../partials/scripts.php'); ?>

    </div>
</body>

</html>