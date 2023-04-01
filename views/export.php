<?php
/*
 *   Crafted On Sat Apr 01 2023
 *   Author Martin (martin@devlan.co.ke)
 */

session_start();
require_once('../config/config.php');
require_once('../config/checklogin.php');
require_once('../vendor/autoload.php');

$module = mysqli_real_escape_string($mysqli, $_GET['module']);

/* Export  */
if ($module == 'Tenant') {
    /* Generate Tenant Details On CSV File */
    require_once('../reports/tenants.php');
} else if ($module == 'Houses') {
    /* Generate Houses List On CSV */
    require_once('../reports/houses.php');
} else {
    /* Die */
    header("Location: logout");
}
