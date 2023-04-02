<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
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
                            <a href="properties" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-hotel"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Properties</span>
                                        <span class="info-box-number">
                                            <?php echo $properties; ?>
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
                            <a href="users" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-tie"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">System Users</span>
                                        <span class="info-box-number">
                                            <?php echo $users; ?>
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

                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="payments" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Cumulative Payments</span>
                                        <span class="info-box-number">
                                            Kes <?php echo number_format($payment_amount, 2); ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <a href="expenses" class="text-dark">
                                <div class="info-box card-outline card-success">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-funnel-dollar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Cumulative Expenses</span>
                                        <span class="info-box-number">
                                            Kes <?php echo number_format($expense_amount, 2); ?>
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
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h5 class="card-title">House Occupancy</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h5 class="card-title">Payments Vs Expenses</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
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
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h5 class="card-title">Recent expenses</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table data_table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Amount</th>
                                                <th>Posted By</th>
                                                <th>Type</th>
                                                <th>Date Posted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $expenses_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM expenses e
                                                INNER JOIN users u ON u.user_id = e.expense_user_id
                                                ORDER BY expense_id ASC"
                                            );
                                            if (mysqli_num_rows($expenses_sql) > 0) {
                                                while ($expenses = mysqli_fetch_array($expenses_sql)) {
                                            ?>
                                                    <tr>
                                                        <td>Ksh <?php echo number_format($expenses['expense_amount'], 2); ?></td>
                                                        <td><?php echo $expenses['user_names']; ?></td>
                                                        <td><?php echo $expenses['expense_type']; ?></td>
                                                        <td><?php echo date('d M Y g:ia', strtotime($expenses['expense_date'])); ?></td>
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
        <?php
        require_once('../partials/scripts.php');
        require_once('../partials/charts.php');
        ?>

    </div>
</body>

</html>