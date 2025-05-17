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
