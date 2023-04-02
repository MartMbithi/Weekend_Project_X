<?php
/*
 *   Crafted On Sun Apr 02 2023
 *   Author Martin (martin@devlan.co.ke)
 */

$access_level = mysqli_real_escape_string($mysqli, $_SESSION['user_type']);
if ($access_level == 'Administrator') { ?>
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white sticky-top">
        <div class="container">
            <a href="dashboard" class="navbar-brand">
                <img src="../public/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Property Manager</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="dashboard" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="properties" class="nav-link">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a href="houses" class="nav-link">Houses</a>
                    </li>
                    <li class="nav-item">
                        <a href="tenants" class="nav-link">Tenants</a>
                    </li>
                    <li class="nav-item">
                        <a href="payments" class="nav-link">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a href="users" class="nav-link">Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="expenses" class="nav-link">Expenses</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            Reports
                        </a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="reports_payments" class="dropdown-item">Payments</a></li>
                            <li><a href="reports_expenses" class="dropdown-item">Expenses summary</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="profile_settings" role="button">
                        <i class="fas fa-user-tag"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" data-target="#end_session" data-toggle="modal" href="#" role="button">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<?php } else { ?>
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white sticky-top">
        <div class="container">
            <a href="dashboard" class="navbar-brand">
                <img src="../public/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Property Manager</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="dashboard" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="properties" class="nav-link">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a href="houses" class="nav-link">Houses</a>
                    </li>
                    <li class="nav-item">
                        <a href="tenants" class="nav-link">Tenants</a>
                    </li>
                    <li class="nav-item">
                        <a href="payments" class="nav-link">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a href="expenses" class="nav-link">Expenses</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            Reports
                        </a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li><a href="reports_payments" class="dropdown-item">Payments</a></li>
                            <li><a href="reports_expenses" class="dropdown-item">Expenses summary</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="profile_settings" role="button">
                        <i class="fas fa-user-tag"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" data-target="#end_session" data-toggle="modal" href="#" role="button">
                        <i class="fas fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<?php } ?>