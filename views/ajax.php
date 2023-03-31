<?php
/*
 *   Crafted On Fri Mar 31 2023
 *   Author Martin (martin@devlan.co.ke)
 */

include('../config/config.php');

/* Get Tenant Details */
if (isset($_REQUEST['TenantDetails'])) {
    $tenant_details = "SELECT * FROM tenants WHERE tenant_id = '$tenant_id'";
    $tenant_details_result = mysqli_query($mysqli, $tenant_details);
    $tenant_details_row = mysqli_fetch_assoc($tenant_details_result);
    $tenant_details_row['tenant_id'];
    $tenant_details_row['tenant_national_id'];
    $tenant_details_row['tenant_contacts'];
    $tenant_details_row['tenant_house_number'];
    $tenant_details_row['tenant_house_category'];
    $tenant_details_row['tenant_house_rent'];
    $tenant_details_row['tenant_property_name'];
    $tenant_details_row['tenant_property_location'];
}
