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


/* Update Tenants */
if (isset($_POST['Update_Tenants'])) {
    $tenant_national_id  = mysqli_real_escape_string($mysqli, $_POST['tenant_national_id']);
    $tenant_name = mysqli_real_escape_string($mysqli, $_POST['tenant_name']);
    $tenant_mobile_number = mysqli_real_escape_string($mysqli, $_POST['tenant_mobile_number']);
    $tenant_date_of_registration = mysqli_real_escape_string($mysqli, $_POST['tenant_date_of_registration']);
    $tenant_id = mysqli_real_escape_string($mysqli, $_POST['tenant_id']);

    /* Persist */
    $update_tenant_status = "UPDATE tenants SET tenant_national_id = '{$tenant_national_id}', tenant_name = '{$tenant_name}', tenant_mobile_number = '{$tenant_mobile_number}', tenant_date_of_registration = '{$tenant_date_of_registration}' 
    WHERE tenant_id = '{$tenant_id}'";
    if (mysqli_query($mysqli, $update_tenant_status)) {
        $success = "Tenant Updated";
    } else {
        $err = "Failed, please try again";
    }
}


/* Delete Tenants */
if (isset($_POST['Delete_Tenants'])) {
    $tenant_id = mysqli_real_escape_string($mysqli, $_POST['tenant_id']);
    $tenant_house_id = mysqli_real_escape_string($mysqli, $_POST['tenant_house_id']);
    $house_status = mysqli_real_escape_string($mysqli, 'Vacant');

    $delete_tenant = "DELETE FROM tenants WHERE tenant_id = '{$tenant_id}'";
    if (mysqli_query($mysqli, $delete_tenant)) {
        $update_house_status = "UPDATE houses SET house_status = '{$house_status}' WHERE house_id = '{$tenant_house_id}'";
        if (mysqli_query($mysqli, $update_house_status)) {
            $success = "Tenant deleted";
        } else {
            $error = "House eviction failed";
        }
    } else {
        $error = "Tenant deletion failed";
    }
}


/* Update Tenant House  */
if (isset($_POST['Update_House'])) {
    $tenant_id = mysqli_real_escape_string($mysqli, $_POST['tenant_id']);
    $tenant_old_house_id = mysqli_real_escape_string($mysqli, $_POST['tenant_old_house_id']);
    $tenant_house_id = mysqli_real_escape_string($mysqli, $_POST['tenant_house_id']);
    $house_status = mysqli_real_escape_string($mysqli, 'Vacant');

    /* Remove tenant from first house */
    $get_current_house = mysqli_query(
        $mysqli,
        "SELECT * FROM houses WHERE house_id = '{$tenant_old_house_id}'"
    );
    if (mysqli_num_rows($get_current_house) > 0) {
        /* Update this house to vacant */
        mysqli_query($mysqli, "UPDATE houses SET house_status = 'Vacant' WHERE house_id = '{$tenant_old_house_id}'");
    }
    /* Give tenant new house */
    $update_tenant_house = "UPDATE tenants SET tenant_house_id = '{$tenant_house_id}' WHERE tenant_id = '{$tenant_id}'";
    if (mysqli_query($mysqli, $update_tenant_house)) {
        $update_house_status = "UPDATE houses SET house_status = 'Occupied' WHERE house_id = '{$tenant_house_id}'";
        if (mysqli_query($mysqli, $update_house_status)) {
            $success = "Tenant house updated";
        } else {
            $error = "House swap failed";
        }
    } else {
        $error = "Tenant house update failed";
    }
}
