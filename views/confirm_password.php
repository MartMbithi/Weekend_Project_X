<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 * 
 */
session_start();
require_once('../config/config.php');
require_once('../helpers/auth.php');
require_once('../partials/head.php');
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>Property</b> Manager</span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Confirm your passwords</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="password" required class="form-control" name="new_password" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" required class="form-control" name="confirm_password" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" name="Reset_Password_Step_2" class="btn btn-primary btn-block">Confirm Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>