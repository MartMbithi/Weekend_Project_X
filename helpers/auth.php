<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */


/* Login */
if (isset($_POST['Login'])) {
    $user_login_name = mysqli_real_escape_string($mysqli, $_POST['user_login_name']);
    $user_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['user_password'])));

    /* Login */
    $user_login_sql = "SELECT * FROM users WHERE user_login_name = '{$user_login_name}' AND user_password = '{$user_password}'";
    $res = mysqli_query($mysqli, $user_login_sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_access_level'] = $row['user_access_level'];

        /* Auth Adminss */
        if ($_SESSION['user_access_level'] == '0') {
            $_SESSION['success'] = 'Logged in successfully as Admin';
            header('Location: dashboard');
            exit;
        } else if ($_SESSION['user_access_level'] == '1') {
            $_SESSION['success'] = 'Logged in successfully as User';
            header('Location: dashboard');
            exit;
        } else {
            $_SESSION['err'] = 'Invalid login details';
            header('Location: login');
            exit;
        }
    }
}


/* Reset Password */
if (isset($_POST['Reset_Password_Step_1'])) {
    $user_login_name = mysqli_real_escape_string($mysqli, $_POST['user_login_name']);

    /* Check if this fella exists */
    $user_checker_sql = "SELECT * FROM users WHERE user_login_name = '{$user_login_name}'";
    $res = mysqli_query($mysqli, $user_checker_sql);
    if (mysqli_num_rows($res) > 0) {
        /* Redirect to login password */
        $_SESSION['user_login_name'] = $user_login_name;
        header('Location: confirm_password');
        exit;
    } else {
        $err = "No account with this login username";
    }
}

/* Confirm Password */
if (isset($_POST['Reset_Password_Step_2'])) {
    $user_login_name = mysqli_real_escape_string($mysqli, $_SESSION['user_login_name']);
    $new_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['new_password'])));
    $confirm_password = sha1(md5(mysqli_real_escape_string($mysqli, $_POST['confirm_password'])));

    /* Check If Passwords Match */
    if ($new_password != $confirm_password) {
        $err = "Passwords do not match";
    } else {
        /* Change Passwords */
        $change_password_sql = "UPDATE users SET user_password = '{$new_password}' WHERE user_login_name = '{$user_login_name}'";
        if (mysqli_query($mysqli, $change_password_sql)) {
            $_SESSION['success'] = 'Password changed successfully, please login';
            header('Location: ../');
            exit;
        } else {
            $err = "Something went wrong, please try again";
        }
    }
}
