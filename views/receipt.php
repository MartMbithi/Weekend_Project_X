<?php
/*
 *   Crafted On Sat May 17 2025
 *   From his finger tips, through his IDE to your deployment environment at full throttle with no bugs, loss of data,
 *   fluctuations, signal interference, or doubt—it can only be
 *   the legendary coding wizard, Martin Mbithi (martin@devlan.co.ke, www.martmbithi.github.io)
 *   
 *   www.devlan.co.ke
 *   hello@devlan.co.ke
 *
 *
 *   The Devlan Solutions LTD Super Duper User License Agreement
 *   Copyright (c) 2022 Devlan Solutions LTD
 *
 *
 *   1. LICENSE TO BE AWESOME
 *   Congrats, you lucky human! Devlan Solutions LTD hereby bestows upon you the magical,
 *   revocable, personal, non-exclusive, and totally non-transferable right to install this epic system
 *   on not one, but TWO separate computers for your personal, non-commercial shenanigans.
 *   Unless, of course, you've leveled up with a commercial license from Devlan Solutions LTD.
 *   Sharing this software with others or letting them even peek at it? Nope, that's a big no-no.
 *   And don't even think about putting this on a network or letting a crowd join the fun unless you
 *   first scored a multi-user license from us. Sharing is caring, but rules are rules!
 *
 *   2. COPYRIGHT POWER-UP
 *   This Software is the prized possession of Devlan Solutions LTD and is shielded by copyright law
 *   and the forces of international copyright treaties. You better not try to hide or mess with
 *   any of our awesome proprietary notices, labels, or marks. Respect the swag!
 *
 *
 *   3. RESTRICTIONS, NO CHEAT CODES ALLOWED
 *   You may not, and you shall not let anyone else:
 *   (a) reverse engineer, decompile, decode, decrypt, disassemble, or do any sneaky stuff to
 *   figure out the source code of this software;
 *   (b) modify, remix, distribute, or create your own funky version of this masterpiece;
 *   (c) copy (except for that one precious backup), distribute, show off in public, transmit, sell, rent,
 *   lease, or otherwise exploit the Software like it's your own.
 *
 *
 *   4. THE ENDGAME
 *   This License lasts until one of us says 'Game Over'. You can call it quits anytime by
 *   destroying the Software and all the copies you made (no hiding them under your bed).
 *   If you break any of these sacred rules, this License self-destructs, and you must obliterate
 *   every copy of the Software, no questions asked.
 *
 *
 *   5. NO GUARANTEES, JUST PIXELS
 *   DEVLAN SOLUTIONS LTD doesn’t guarantee this Software is flawless—it might have a few
 *   quirks, but who doesn’t? DEVLAN SOLUTIONS LTD washes its hands of any other warranties,
 *   implied or otherwise. That means no promises of perfect performance, marketability, or
 *   non-infringement. Some places have different rules, so you might have extra rights, but don’t
 *   count on us for backup if things go sideways. Use at your own risk, brave adventurer!
 *
 *
 *   6. SEVERABILITY—KEEP THE GOOD STUFF
 *   If any part of this License gets tossed out by a judge, don’t worry—the rest of the agreement
 *   still stands like a boss. Just because one piece fails doesn’t mean the whole thing crumbles.
 *
 *
 *   7. NO DAMAGE, NO DRAMA
 *   Under no circumstances will Devlan Solutions LTD or its squad be held responsible for any wild,
 *   indirect, or accidental chaos that might come from using this software—even if we warned you!
 *   And if you ever think you’ve got a claim, the most you’re getting out of us is the license fee you
 *   paid—if any. No drama, no big payouts, just pixels and code.
 *
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
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">Qty</th>
                                                                    <th class="text-center">Product</th>
                                                                    <th class="text-center">Description</th>
                                                                    <th class="text-right">Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">1</td>
                                                                    <td class="text-center">House rent</td>
                                                                    <td class="text-center">Rent payment for house number <?php echo $payments['house_number']; ?></td>
                                                                    <td class="text-right">Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
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
                    <?php include('../partials/content_breaker.php'); ?>
                </div>
                <!-- Main Footer -->
        <?php
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