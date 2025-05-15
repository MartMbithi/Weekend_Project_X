<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../helpers/houses.php');
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
                            <h1 class="m-0"> Properties</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="properties">Properties</a></li>
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
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <button type="button" data-toggle="modal" data-target="#add_modal" class="btn btn-outline-success">
                            Add property
                        </button>
                    </div>
                    <hr>
                    <!-- Add Modal -->
                    <div class="modal fade fixed-right" id="add_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div class="text-center">
                                        <h6 class="mb-0 text-bold">Register new property</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="">Property name</label>
                                                <input type="text" required name="property_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Property location</label>
                                                <input type="text" required name="property_location" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="">Property caretaker</label>
                                                <?php
                                                $users_sql = mysqli_query(
                                                    $mysqli,
                                                    "SELECT * FROM users WHERE user_type = 'Caretaker'"
                                                );
                                                if (mysqli_num_rows($users_sql) > 0) {
                                                    while ($users = mysqli_fetch_array($users_sql)) {
                                                ?>

                                                <?php }
                                                } ?>
                                                <select type="text" required name="property_caretaker_id" class="form-control select2bs4">
                                                    <option>Select caretaker</option>
                                                    <?php
                                                    $users_sql = mysqli_query(
                                                        $mysqli,
                                                        "SELECT * FROM users WHERE user_type = 'Caretaker'"
                                                    );
                                                    if (mysqli_num_rows($users_sql) > 0) {
                                                        while ($users = mysqli_fetch_array($users_sql)) {
                                                    ?>
                                                            <option value="<?php echo $users['user_id']; ?>"><?php echo $users['user_names']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="Add_Property" class="btn btn-outline-success">Add</button>
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
                                    <h5 class="card-title">Registered properties</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table data_table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/no</th>
                                                <th>Property Name</th>
                                                <th>Property Location</th>
                                                <th>Caretaker</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $property_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM properties p
                                                INNER JOIN users u ON u.user_id = p.property_caretaker_id"
                                            );
                                            if (mysqli_num_rows($property_sql) > 0) {
                                                $cnt = 1;
                                                while ($properties = mysqli_fetch_array($property_sql)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $properties['property_name']; ?></td>
                                                        <td><?php echo $properties['property_location']; ?></td>
                                                        <td><?php echo $properties['user_names']; ?></td>
                                                        <td>
                                                            <a data-toggle="modal" href="#add_<?php echo $properties['property_id']; ?>" class="badge badge-success"><i class="fas fa-plus"></i> Add house</a>
                                                            <a data-toggle="modal" href="#update_<?php echo $properties['property_id']; ?>" class="badge badge-primary"><i class="fas fa-edit"></i> Edit</a>
                                                            <?php if ($_SESSION['user_type'] == 'Administrator') { ?>
                                                                <a data-toggle="modal" href="#delete_<?php echo $properties['property_id']; ?>" class="badge badge-danger"><i class="fas fa-trash"></i> Delete</a>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $cnt = $cnt + 1;
                                                    include('../modals/property.php');
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