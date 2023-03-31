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
                            <div class="col-12">
                                <div class="card card-outline card-success">
                                    <div class="card-body">
                                        <div class="row invoice-info">
                                            <div class="col-sm-12 invoice-col text-right">
                                                <address>
                                                    <strong> <?php echo $payments['tenant_name']; ?></strong><br>
                                                    Phone:  <?php echo $payments['tenant_mobile_number']; ?><br>
                                                </address>
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
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qty</th>
                                                            <th>Product</th>
                                                            <th>Serial #</th>
                                                            <th>Description</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Call of Duty</td>
                                                            <td>455-981-221</td>
                                                            <td>El snort testosterone trophy driving gloves handsome</td>
                                                            <td>$64.50</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Need for Speed IV</td>
                                                            <td>247-925-726</td>
                                                            <td>Wes Anderson umami biodiesel</td>
                                                            <td>$50.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Monsters DVD</td>
                                                            <td>735-845-642</td>
                                                            <td>Terry Richardson helvetica tousled street art master</td>
                                                            <td>$10.70</td>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Grown Ups Blue Ray</td>
                                                            <td>422-568-642</td>
                                                            <td>Tousled lomo letterpress</td>
                                                            <td>$25.99</td>
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
                                                <p class="lead">Payment Methods:</p>
                                                <img src="../../dist/img/credit/visa.png" alt="Visa">
                                                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                                <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                                    plugg
                                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                                </p>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-6">
                                                <p class="lead">Amount Due 2/22/2014</p>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width:50%">Subtotal:</th>
                                                            <td>$250.30</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tax (9.3%)</th>
                                                            <td>$10.34</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping:</th>
                                                            <td>$5.80</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td>$265.24</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <div class="card-footer">
                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-12">
                                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                                    Payment
                                                </button>
                                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                                    <i class="fas fa-download"></i> Generate PDF
                                                </button>
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