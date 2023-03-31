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
                            <h1 class="m-0">Payments</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item"><a href="payments">Payments</a></li>
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
                            Add payment
                        </button>
                    </div>
                    <hr>
                    <!-- Add Modal -->
                    <div class="modal fade fixed-right" id="add_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div class="text-center">
                                        <h6 class="mb-0 text-bold">Register new payment</h6>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" role="form">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="">Tenant details</label>
                                                <select type="text" required name="payment_tenant_id" class="form-control select2bs4">
                                                    <option>Select tenant</option>
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
                                                            <option value="<?php echo $tenants['tenant_id']; ?>">Names: <?php echo $tenants['tenant_name']; ?>, ID Number: <?php echo $tenants['tenant_national_id']; ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <fieldset class="border border-primary p-2">
                                                    <legend class="w-auto text-primary font-weight-light">Tenant details</legend>
                                                    <div class="d-flex justify-content-between">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">National ID Number: <span id="IDNumber"></span></li>
                                                            <li class="list-group-item">Contacts: <span id="TenantContacts"></span></li>
                                                        </ul>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">House Number: <span id="HouseNumber"></span></li>
                                                            <li class="list-group-item">House Category: <span id="HouseCategory"></span></li>
                                                            <li class="list-group-item">House Rent: Ksh <span id="HouseRent"></span></li>
                                                        </ul>
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item">Property Name: <span id="PropertyName"></span> </li>
                                                            <li class="list-group-item">Property Location: <span id="PropertyLocation"></span></li>
                                                        </ul>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Payment Reference Code</label>
                                                <input type="text" required name="payment_ref_code" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Invoice Number</label>
                                                <input readonly type="text" value="INV/<?php echo date('m') . '/' . date('Y') . '/' . $inv_number; ?>" required name="payment_invoice_number" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Payment Amount</label>
                                                <input type="text" required name="payment_amount" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Payment Means</label>
                                                <select type="text" required name="payment_type" class="form-control select2bs4">
                                                    <option>Mpesa</option>
                                                    <option>Bank Deposit</option>
                                                    <option>Cash</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Date Paid(Ksh)</label>
                                                <input type="text" required name="payment_date" class="form-control datepicker">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" name="Add_Payment" class="btn btn-outline-success">Add</button>
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
                                    <h5 class="card-title">Payments records</h5>
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
                                                <th>Manage</th>
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
                                                        <td>
                                                            <a data-toggle="modal" href="#update_<?php echo $payments['payment_id']; ?>" class="badge badge-primary"><i class="fas fa-edit"></i> Edit</a>
                                                            <a data-toggle="modal" href="#delete_<?php echo $payments['payment_id']; ?>" class="badge badge-danger"><i class="fas fa-trash"></i> Delete</a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    include('../modals/payments.php');
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