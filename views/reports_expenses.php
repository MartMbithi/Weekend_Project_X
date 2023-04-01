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
                                        <table class="table table-striped export_dt">
                                            <thead>
                                                <tr>
                                                    <th>S/no</th>
                                                    <th>Expense Type</th>
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
                                                    WHERE e.expense_date BETWEEN '{$start_date}' AND '{$end_date}'"
                                                );
                                                if (mysqli_num_rows($expenses_sql) > 0) {
                                                    $cnt = 1;
                                                    while ($expenses = mysqli_fetch_array($expenses_sql)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $cnt; ?>
                                                            </td>
                                                            <td><?php echo $expenses['expense_type']; ?></td>
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
                                        <table class="table table-striped export_dt">
                                            <thead>
                                                <tr>
                                                    <th>S/no</th>
                                                    <th>Expense Type</th>
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
                                                    ORDER BY e.expense_id ASC"
                                                );
                                                if (mysqli_num_rows($expenses_sql) > 0) {
                                                    $cnt = 1;
                                                    while ($expenses = mysqli_fetch_array($expenses_sql)) {
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $cnt; ?>
                                                            </td>
                                                            <td><?php echo $expenses['expense_type']; ?></td>
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
                $i = 0;
                while ($i <= 4) {
                    echo "<br>";
                    $i++;
                }
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