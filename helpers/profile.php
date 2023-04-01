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
    $update_details_sql = "UPDATE users SET user_names = '{$user_names}', user_login_name = '{$user_login_name}'
    WHERE user_id = '{$user_id}'";

    if (mysqli_query($mysqli, $update_details_sql)) {
        $success = "Personal details updated";
    } else {
        $err = "Failed, please try again";
    }
}


/* Update Passwords */
if (isset($_POST['Update_Personal_Password'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $old_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['old_password'])));
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check if new & confirm passwords match */
    if ($new_password != $confirm_password) {
        $err = "Passwords does not match";
    } else {
        $old_pass_checker_sql = "SELECT * FROM users WHERE user_id = '{$user_id}'";
        $res = mysqli_query($mysqli, $old_pass_checker_sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            /* Check if old password matches */
            if ($old_password != $row['user_password']) {
                $err = "Old passwords does not match";
            } else {
                /* Persist */
                $change_password_sql = "UPDATE users SET user_password = '{$confirm_password}' WHERE user_id = '{$user_id}'";

                if (mysqli_query($mysqli, $change_password_sql)) {
                    $success = "Password updated";
                } else {
                    $err = "Failed, please try again";
                }
            }
        } else {
            $err = "Internal system error, please try again";
        }
    }
}
