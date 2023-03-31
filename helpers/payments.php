<?php
/*
 *   Crafted On Fri Mar 31 2023
 *   Author Martin (martin@devlan.co.ke)
 */


/* Add Payments */
if (isset($_POST['Add_Payment'])) {
    $payment_ref_code = mysqli_real_escape_string($mysqli, $_POST['payment_ref_code']);
    $payment_invoice_number = mysqli_real_escape_string($mysqli, $_POST['payment_invoice_number']);
    $payment_amount = mysqli_real_escape_string($mysqli, $_POST['payment_amount']);
    $payment_type = mysqli_real_escape_string($mysqli, $_POST['payment_type']);
    $payment_tenant_id = mysqli_real_escape_string($mysqli, $_POST['payment_tenant_id']);
    $payment_date = mysqli_real_escape_string($mysqli, $_POST['payment_date']);


    /* Prevent Duplications */
    $duplication_checker = "SELECT * FROM payments WHERE payment_ref_code = '$payment_ref_code'";
    $duplication_checker_result = mysqli_query($mysqli, $duplication_checker);
    if (mysqli_num_rows($duplication_checker_result) > 0) {
        $err = "Payment Reference Code Already Exists";
    } else {
        $add_payment = "INSERT INTO payments (payment_ref_code, payment_invoice_number, payment_amount, payment_type, payment_tenant_id, payment_date) 
        VALUES ('{$payment_ref_code}', '{$payment_invoice_number}', '{$payment_amount}', '{$payment_type}', '{$payment_tenant_id}', '{$payment_date}')";

        if (mysqli_query($mysqli, $add_payment)) {
            $success = "Payment added successfully";
        } else {
            $err = "Failed to add payment";
        }
    }
}


/* Update Payments */
if (isset($_POST['Update_Payment'])) {
    $payment_amount = mysqli_real_escape_string($mysqli, $_POST['payment_amount']);
    $payment_type = mysqli_real_escape_string($mysqli, $_POST['payment_type']);
    $payment_date = mysqli_real_escape_string($mysqli, $_POST['payment_date']);
    $payment_id = mysqli_real_escape_string($mysqli, $_POST['payment_id']);

    /* Update */
    $update_payment = "UPDATE payments SET payment_amount = '{$payment_amount}', payment_type = '{$payment_type}',
    payment_date = '{$payment_date}' WHERE payment_id = '{$payment_id}'";

    if (mysqli_query($mysqli, $update_payment)) {
        $success = "Payment updated successfully";
    } else {
        $err = "Failed to update payment";
    }
}

/* Delete Payments */
if (isset($_POST['Delete_Payment'])) {
    $payment_id = mysqli_real_escape_string($mysqli, $_POST['payment_id']);

    /* Persist */
    $delete_sql = "DELETE FROM payments WHERE payment_id = '{$payment_id}'";

    if (mysqli_query($mysqli, $delete_sql)) {
        $success = "Payment deleted successfully";
    } else {
        $err = "Failed to delete payment";
    }
}
