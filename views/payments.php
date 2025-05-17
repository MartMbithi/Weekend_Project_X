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
                                                <select type="text" required name="payment_tenant_id" class="form-control select2bs4" id="TenantDetails">
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
                include('../partials/content_breaker.php');
                require_once('../partials/footer.php');
                ?>
            </div>
            <!-- ./wrapper -->
        </div>
        <!-- Scripts -->
        <?php require_once('../partials/scripts.php'); ?>
        <script>
            $(document).ready(function() {

                /*  Get Directories  */
                $("#TenantDetails").change(function() {
                    var tenant_id = $(this).val();

                    $.ajax({
                        url: 'get_payment_details.php',
                        type: 'post',
                        data: {
                            tenants: tenant_id
                        },
                        dataType: 'json',
                        success: function(response) {
                            var len = response.length;
                            $("#IDNumber").empty();
                            $("#TenantContacts").empty();
                            $("#HouseNumber").empty();
                            $("#HouseCategory").empty();
                            $("#HouseRent").empty();
                            $("#PropertyName").empty();
                            $("#PropertyLocation").empty();

                            for (var i = 0; i < len; i++) {
                                var tenant_national_id = response[i]['tenant_national_id'];
                                var tenant_mobile_number = response[i]['tenant_mobile_number'];
                                var house_number = response[i]['house_number'];
                                var house_category = response[i]['house_category'];
                                var house_rent = response[i]['house_rent'];
                                var property_name = response[i]['property_name'];
                                var property_location = response[i]['property_location'];

                                /* Pre Populate Items */
                                $("#IDNumber").append("<span>" + tenant_national_id + "</span>");
                                $("#TenantContacts").append("<span>" + tenant_mobile_number + "</span>");
                                $("#HouseNumber").append("<span>" + house_number + "</span>");
                                $("#HouseCategory").append("<span>" + house_category + "</span>");
                                $("#HouseRent").append("<span>" + house_rent + "</span>");
                                $("#PropertyName").append("<span>" + property_name + "</span>");
                                $("#PropertyLocation").append("<span>" + property_location + "</span>");
                            }
                        }
                    });
                });
            });
        </script>

    </div>
</body>

</html>