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
                <a href="#" class="h1"><b>Property</b> Manager</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Enter your username - to reset password</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" required class="form-control" name="user_login_name" placeholder="Login username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-tag"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" name="Reset_Password_Step_1" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a href="../">I remember my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>