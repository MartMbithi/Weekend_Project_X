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
        <?php require_once('../partials/navbar.php'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Tenants</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="tenants">Tenants</a></li>
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
                    <div class="text-right">
                        <a href="export?module=Tenant" class="btn btn-outline-success">
                            Export
                        </a>
                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-outline-success">
                            Add tenant
                        </button>
                    </div>
                    <hr>
                    <!-- Add Modal -->
                    <div class="modal fade fixed-right" id="add_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div class="text-center">
                                        <h6 class="mb-0 text-bold">Register new tenant</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">House details</label>
                                                <select type="text" required name="tenant_house_id" class="form-control select2bs4" style="width: 100%;">
                                                    <option value="">Select house details</option>
                                                    <?php
                                                    $property_sql = mysqli_query(
                                                        $mysqli,
                                                        "SELECT * FROM properties p
                                                        INNER JOIN houses h ON p.property_id = h.house_property_id
                                                        WHERE h.house_status = 'Vacant'"
                                                    );
                                                    if (mysqli_num_rows($property_sql) > 0) {
                                                        while ($houses = mysqli_fetch_array($property_sql)) {
                                                    ?>
                                                            <option value="<?php echo $houses['house_id']; ?>">Property name: <?php echo $houses['property_name'] . ' - House number:' . $houses['house_number']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tenant full names</label>
                                                <input type="text" required name="tenant_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tenant national id</label>
                                                <input type="text" required name="tenant_national_id" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tenant mobile number</label>
                                                <input type="text" required name="tenant_mobile_number" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tenant date registered</label>
                                                <input type="text" required name="tenant_date_of_registration" class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="Add_Tenants" class="btn btn-outline-success">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
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
        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>

    </div>
</body>

</html>