<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

session_start();
require_once('../config/config.php');
require_once('../helpers/tenants.php');
require_once('../partials/head.php');
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/navbar.php');
        $tenant_id = mysqli_real_escape_string($mysqli, $_GET['view']);
        $tenants_details_sql = mysqli_query(
            $mysqli,
            "SELECT * FROM houses h
            INNER JOIN tenants t ON h.house_id = t.tenant_house_id
            INNER JOIN properties p ON h.house_property_id = p.property_id
            WHERE t.tenant_id = '{$tenant_id}'"
        );
        if (mysqli_num_rows($tenants_details_sql) > 0) {
            $cnt = 1;
            while ($tenant = mysqli_fetch_array($tenants_details_sql)) {
        ?>
                <!-- /.navbar -->

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0"><?php echo $tenant['tenant_name']; ?></h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                        <li class="breadcrumb-item"><a href="tenants">Tenants</a></li>
                                        <li class="breadcrumb-item active"><?php echo $tenant['tenant_name']; ?></li>
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

                                            <h3 class="profile-username text-center"><?php echo $tenant['tenant_name']; ?></h3>

                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <b>ID Number: </b> <a class="float-right"><?php echo $tenant['tenant_national_id']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Phone Number</b> <a class="float-right"><?php echo $tenant['tenant_mobile_number']; ?></a>
                                                </li>
                                                <li class="list-group-item">
                                                    <b>Date Registered: </b> <a class="float-right"><?php echo date('d M Y', strtotime($tenant['tenant_date_of_registration'])); ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-success card-outline">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5 col-sm-3">
                                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">House Details</a>
                                                        <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Property Details</a>
                                                        <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Payment Logs</a>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-sm-9">
                                                    <div class="tab-content" id="vert-tabs-tabContent">
                                                        <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                                            <div class="card-header">
                                                                <h3 class="card-title">House rented details</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <strong><i class="fas fa-tag mr-1"></i> House Number</strong> : <?php echo $tenant['house_number']; ?>
                                                                <hr>
                                                                <strong><i class="fas fa-list mr-1"></i> House Category</strong>: <?php echo $tenant['house_category']; ?>
                                                                <hr>
                                                                <strong><i class="fas fa-hand-holding-usd mr-1"></i> House Rent</strong>: Ksh <?php echo number_format($tenant['house_rent']); ?>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </div>
                                                        <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Property details</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <strong><i class="fas fa-hotel mr-1"></i> Property Name</strong>: <?php echo $tenant['property_name']; ?>
                                                                <hr>
                                                                <strong><i class="fas fa-map-pin mr-1"></i> Property Location</strong>: <?php echo $tenant['property_location']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
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
                                                                            <th>Paid On</th>
                                                                            <th>House</th>
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
                                                                                    <td><?php echo $payments['payment_ref_code']; ?></td>
                                                                                    <td><?php echo $payments['payment_invoice_number']; ?></td>
                                                                                    <td>Ksh <?php echo number_format($payments['payment_amount'], 2); ?></td>
                                                                                    <td><?php echo date('d M Y g:ia', strtotime($payments['payment_date'])); ?></td>
                                                                                    <td><?php echo $payments['house_number']; ?></td>
                                                                                </tr>
                                                                        <?php }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
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
                        ?>
                    </div>
                    <!-- ./wrapper -->
            <?php }
        } ?>
                </div>

                <!-- Scripts -->
                <?php require_once('../partials/scripts.php'); ?>

    </div>
</body>

</html>