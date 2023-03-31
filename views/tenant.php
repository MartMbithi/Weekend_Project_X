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
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h5 class="card-title">Registered tenats</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table data_table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S/no</th>
                                                        <th>Names</th>
                                                        <th>ID No</th>
                                                        <th>Contacts</th>
                                                        <th>House No</th>
                                                        <th>Type</th>
                                                        <th>Date registered</th>
                                                        <th>Manage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $tenants_details_sql = mysqli_query(
                                                        $mysqli,
                                                        "SELECT * FROM houses h
                                                INNER JOIN tenants t ON h.house_id = t.tenant_house_id
                                                INNER JOIN properties p ON h.house_property_id = p.property_id"
                                                    );
                                                    if (mysqli_num_rows($tenants_details_sql) > 0) {
                                                        $cnt = 1;
                                                        while ($tenants = mysqli_fetch_array($tenants_details_sql)) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $cnt; ?></td>
                                                                <td>
                                                                    <a href="tenant?view=<?php echo $tenants['tenant_id']; ?>">
                                                                        <?php echo $tenants['tenant_name']; ?>
                                                                    </a>
                                                                </td>
                                                                <td><?php echo $tenants['tenant_national_id']; ?></td>
                                                                <td><?php echo $tenants['tenant_mobile_number']; ?></td>
                                                                <td><?php echo $tenants['house_number']; ?></td>
                                                                <td><?php echo $tenants['house_category']; ?></td>
                                                                <td><?php echo date('d M Y', strtotime($tenants['tenant_date_of_registration'])); ?></td>
                                                                <td>
                                                                    <a data-toggle="modal" href="#update_<?php echo $tenants['tenant_id']; ?>" class="badge badge-primary"><i class="fas fa-edit"></i> Edit</a>
                                                                    <a data-toggle="modal" href="#swap_<?php echo $tenants['tenant_id']; ?>" class="badge badge-warning"><i class="fas fa-history"></i> Swap house</a>
                                                                    <a data-toggle="modal" href="#delete_<?php echo $tenants['tenant_id']; ?>" class="badge badge-danger"><i class="fas fa-trash"></i> Delete</a>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $cnt = $cnt + 1;
                                                            include('../modals/tenants.php');
                                                        }
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
        <?php }
        } ?>
        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>

    </div>
</body>

</html>