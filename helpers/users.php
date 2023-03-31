<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */


/* Add users */
if (isset($_POST['Add_Users'])) {
    $user_type = mysqli_real_escape_string($mysqli, $_POST['user_type']);
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_login_name = mysqli_real_escape_string($mysqli, $_POST['user_login_name']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));
    $user_access_level = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);

    /* Prevent duplicates */
    $user_checker_sql = "SELECT * FROM users WHERE user_login_name = '{$user_login_name}'";
    $res = mysqli_query($mysqli, $user_checker_sql);
    if (mysqli_num_rows($res) > 0) {
        $err = "User with this login username already exists";
    } else {
        /* Add user */
        $user_add_sql = "INSERT INTO users (user_type, user_names, user_login_name, user_password, user_access_level)
        VALUES ('{$user_type}', '{$user_names}', '{$user_login_name}', '{$user_password}', '{$user_access_level}')";
        $res = mysqli_query($mysqli, $user_add_sql);
        if ($res) {
            $success = "User registered successfully";
        } else {
            $err = "Something went wrong, please try again";
        }
    }
}


/* Update users */
if (isset($_POST['Update_Users'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $user_type = mysqli_real_escape_string($mysqli, $_POST['user_type']);
    $user_names = mysqli_real_escape_string($mysqli, $_POST['user_names']);
    $user_login_name = mysqli_real_escape_string($mysqli, $_POST['user_login_name']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));
    $user_access_level = mysqli_real_escape_string($mysqli, $_POST['user_access_level']);

    /* Update user */
    $user_update_sql = "UPDATE users SET user_type = '{$user_type}', user_names = '{$user_names}', user_login_name = '{$user_login_name}', user_password = '{$user_password}', user_access_level = '{$user_access_level}' 
    WHERE user_id = '{$user_id}'";
    $res = mysqli_query($mysqli, $user_update_sql);
    if ($res) {
        $success = "User updated successfully";
    } else {
        $err = "Something went wrong, please try again";
    }
}

/* Delete users */
if (isset($_POST['Delete_Users'])) {
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);

    /* Delete user */
    $user_delete_sql = "DELETE FROM users WHERE user_id = '{$user_id}'";
    $res = mysqli_query($mysqli, $user_delete_sql);
    if ($res) {
        $success = "User deleted successfully";
    } else {
        $err = "Something went wrong, please try again";
    }
}
