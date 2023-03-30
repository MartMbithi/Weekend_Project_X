<?php
/*
 *   Crafted On Thu Mar 30 2023
 *   Author Martin (martin@devlan.co.ke)
 */

/* Add Tenants */
if (isset($_POST['Add_Tenants'])) {
    $tenant_national_id  = mysqli_real_escape_string($mysqli, $_POST['tenant_national_id']);
    $tenant_name = mysqli_real_escape_string($mysqli, $_POST['tenant_name']);
    $tenant_mobile_number = mysqli_real_escape_string($mysqli, $_POST['tenant_mobile_number']);
    $tenant_house_id = mysqli_real_escape_string($mysqli, $_POST['tenant_house_id']);
    $tenant_date_of_registration = mysqli_real_escape_string($mysqli, $_POST['tenant_date_of_registration']);
    $house_status = mysqli_real_escape_string($mysqli, 'Occupied');


    /* Prevent Duplicate Tenants */
    /* 
    This will trigger a cascading effect, assume a tenant leaves then comes back and allocated same room number he was in it initially
    $check_tenant = mysqli_query($mysqli, 
    "SELECT * FROM tenants WHERE tenant_national_id = '{$tenant_national_id'
    AND tenant_house_id = '$tenant_house_id'");
    ");
     */
    /* Persist */
    $add_tenant = "INSERT INTO tenants (tenant_national_id, tenant_name, tenant_mobile_number, tenant_house_id, tenant_date_of_registration)
    VALUES ('{$tenant_national_id}', '{$tenant_name}', '{$tenant_mobile_number}', '{$tenant_house_id}', '{$tenant_date_of_registration}')";
    if (mysqli_query($mysqli, $add_tenant)) {
        $update_house_status = "UPDATE houses SET house_status = '{$house_status}' WHERE house_id = '{$tenant_house_id}'";
        if (mysqli_query($mysqli, $update_house_status)) {
            $success = "Tenant Added";
        } else {
            $error = "House allocation failed";
        }
    } else {
        $error = "Tenant addition failed";
    }
}


