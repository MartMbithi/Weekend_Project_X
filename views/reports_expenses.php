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
                            <h1 class="m-0">Expenses Reports</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="">Reports</a></li>
                                <li class="breadcrumb-item active">Expenses</li>
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
                            Filter expenses
                        </button>
                    </div>
                    <hr>
                    <!-- Add Modal -->
                    <div class="modal fade fixed-right" id="add_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div class="text-center">
                                        <h6 class="mb-0 text-bold">Filter expenses</h6>
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
                                            <button type="submit" name="Filter_Expense" class="btn btn-outline-success">Filter expeses</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <?php if (isset($_POST['Filter_Expense'])) {
                        $start_date = mysqli_real_escape_string($mysqli, $_POST['start_date']);
                        $end_date = mysqli_real_escape_string($mysqli, $_POST['end_date']);
                    ?>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            Expense summary from <?php echo date('d M Y', strtotime($_POST['start_date'])); ?> to
                                            <?php echo date('d M Y', strtotime($_POST['end_date'])); ?>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table  table-striped export_dt">
                                            <thead>
                                                <tr>
                                                    <th>S/no</th>
                                                    <th>Expense Type</th>
                                                    <th>Property</th>
                                                    <th>Amount</th>
                                                    <th>Posted By</th>
                                                    <th>Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $expenses_sql = mysqli_query(
                                                    $mysqli,
                                                    "SELECT * FROM expenses e
                                                    INNER JOIN users u ON u.user_id = e.expense_user_id
                                                    INNER JOIN properties p ON p.property_id = e.expense_property_id
                                                    WHERE e.expense_date BETWEEN '{$start_date}' AND '{$end_date}'
                                                    ORDER BY expense_id ASC"
                                                );
                                                if (mysqli_num_rows($expenses_sql) > 0) {
                                                    $cnt = 1;
                                                    while ($expenses = mysqli_fetch_array($expenses_sql)) {
                                                        if (!empty($expenses['expense_house_number'])) {
                                                            $property = $expenses['property_name'] . ' - House Number' . $expenses['expense_house_number'];
                                                        } else {
                                                            $property = $expenses['property_name'];
                                                        }
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $cnt; ?>
                                                            </td>
                                                            <td><?php echo $expenses['expense_type']; ?></td>
                                                            <td><?php echo $property; ?></td>
                                                            <td>Ksh <?php echo number_format($expenses['expense_amount'], 2); ?></td>
                                                            <td><?php echo $expenses['user_names']; ?></td>
                                                            <td><?php echo date('d M Y', strtotime($expenses['expense_date'])); ?></td>
                                                        </tr>
                                                <?php
                                                        $cnt = $cnt + 1;
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
                                            Expense records
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table  table-striped export_dt">
                                            <thead>
                                                <tr>
                                                    <th>S/no</th>
                                                    <th>Expense Type</th>
                                                    <th>Property</th>
                                                    <th>Amount</th>
                                                    <th>Posted By</th>
                                                    <th>Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $expenses_sql = mysqli_query(
                                                    $mysqli,
                                                    "SELECT * FROM expenses e
                                                INNER JOIN users u ON u.user_id = e.expense_user_id
                                                INNER JOIN properties p ON p.property_id = e.expense_property_id
                                                ORDER BY expense_id ASC"
                                                );
                                                if (mysqli_num_rows($expenses_sql) > 0) {
                                                    $cnt = 1;
                                                    while ($expenses = mysqli_fetch_array($expenses_sql)) {
                                                        if (!empty($expenses['expense_house_number'])) {
                                                            $property = $expenses['property_name'] . ' - House Number' . $expenses['expense_house_number'];
                                                        } else {
                                                            $property = $expenses['property_name'];
                                                        }
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $cnt; ?>
                                                            </td>
                                                            <td><?php echo $expenses['expense_type']; ?></td>
                                                            <td><?php echo $property; ?></td>
                                                            <td>Ksh <?php echo number_format($expenses['expense_amount'], 2); ?></td>
                                                            <td><?php echo $expenses['user_names']; ?></td>
                                                            <td><?php echo date('d M Y', strtotime($expenses['expense_date'])); ?></td>
                                                        </tr>
                                                <?php
                                                        $cnt = $cnt + 1;
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