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
require_once('../helpers/analytics.php');
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
                            <h1 class="m-0"> Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="text-right">
                    <!-- Add Filter Button -->
                </div>
                <div class="container">
                    <div class="row">


                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="houses" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-home"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Houses</span>
                                        <span class="info-box-number">
                                            <?php echo $houses; ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="tenants" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tenants</span>
                                        <span class="info-box-number">
                                            <?php echo $tenants; ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>



                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="houses" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Vacant Houses</span>
                                        <span class="info-box-number">
                                            <?php echo $vacant; ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="houses" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-check"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Occupied Houses</span>
                                        <span class="info-box-number">
                                            <?php echo $occupied; ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <a href="payments" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-check-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Projected Revenue For <?php echo date('M Y', strtotime('-1 month')); ?></span>
                                        <span class="info-box-number">
                                            Kes <?php echo number_format($projected_amount, 2); ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6">
                            <a href="payments" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-wallet"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Received Revenue For <?php echo date('M Y', strtotime('-1 month')); ?></span>
                                        <span class="info-box-number">
                                            Kes <?php echo number_format($payment_amount, 2); ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h5 class="card-title">Recent rent payments</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table data_table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Ref Code</th>
                                                <th>Inv Number</th>
                                                <th>Amount</th>
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
                                                ORDER BY payment_id ASC"
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
                                                        <td><?php echo $payments['tenant_name']; ?></td>
                                                        <td><?php echo date('d M Y', strtotime($payments['payment_date'])); ?></td>
                                                        <td><?php echo $payments['house_number']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </div>
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
        <?php
        require_once('../partials/scripts.php');
        ?>

    </div>
</body>

</html>