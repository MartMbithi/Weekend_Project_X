<?php
/*
 *   Crafted On Sat Apr 01 2023
 *   Author Martin (martin@devlan.co.ke)
 */

/* Update Profile */
if (isset($_POST['Update_Personal_Details'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_login_name = mysqli_real_escape_string($mysqli, $_POST['user_login_name']);

    /* Persist */
    $update_details_sql = "UPDATE users SET user_names = '{$user_names}', user_login_username = '{$user_login_name}'
    WHERE user_id = '{$user_id}'";

    if (mysqli_query($mysqli, $update_details_sql)) {
        $success = "Personal details updated";
    } else {
        $err = "Failed, please try again";
    }
}


 /* Update Passwords */