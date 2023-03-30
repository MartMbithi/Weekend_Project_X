<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

session_start();
require_once('../config/config.php');
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
                            <h1 class="m-0"> Houses</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="houses">Houses</a></li>
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
                            Add house
                        </button>
                    </div>
                    <hr>
                    <!-- Add Modal -->
                    <div class="modal fade fixed-right" id="add_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div class="text-center">
                                        <h6 class="mb-0 text-bold">Register new house</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">Property name</label>
                                                <select type="text" required name="house_property_id" class="form-control">
                                                    <option value="">Select property</option>
                                                    <?php
                                                    $property_sql = mysqli_query(
                                                        $mysqli,
                                                        "SELECT * FROM properties"
                                                    );
                                                    if (mysqli_num_rows($property_sql) > 0) {
                                                        while ($properties = mysqli_fetch_array($property_sql)) {
                                                    ?>
                                                            <option value="<?php echo $properties['property_id']; ?>"><?php echo $properties['property_name'] . ' ' . $properties['property_location']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">House number</label>
                                                <input type="text" required name="house_number" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">House category</label>
                                                <select type="text" required name="house_category" class="form-control">
                                                    <option>Singles</option>
                                                    <option>Bedsitters</option>
                                                    <option>One Bedrooms</option>
                                                    <option>Two Bedrooms</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">House rent(Ksh)</label>
                                                <input type="text" required name="house_rent" class="form-control">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="Add_House" class="btn btn-outline-success">Add</button>
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
                                                <th>House Number</th>
                                                <th>House Category</th>
                                                <th>House Status</th>
                                                <th>House Rent</th>
                                                <th>Manage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $house_sql = mysqli_query(
                                                $mysqli,
                                                "SELECT * FROM houses h
                                                INNER JOIN properties p ON h.house_property_id = p.property_id "
                                            );
                                            if (mysqli_num_rows($house_sql) > 0) {
                                                $cnt = 1;
                                                while ($houses = mysqli_fetch_array($house_sql)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td><?php echo $houses['property_name']; ?></td>
                                                        <td><?php echo $houses['house_number']; ?></td>
                                                        <td><?php echo $houses['house_category']; ?></td>
                                                        <td><?php echo $houses['house_status']; ?></td>
                                                        <td>Ksh <?php echo number_format($houses['house_rent'], 2); ?></td>
                                                        <td>
                                                            <a data-toggle="modal" href="#update_<?php echo $houses['house_id']; ?>" class="badge badge-primary"><i class="fas fa-edit"></i> Edit</a>
                                                            <a data-toggle="modal" href="#delete_<?php echo $houses['house_id']; ?>" class="badge badge-danger"><i class="fas fa-trash"></i> Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $cnt = $cnt + 1;
                                                    include('../modals/house.php');
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