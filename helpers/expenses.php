<?php
/*
 *   Crafted On Fri Mar 31 2023
 *   Author Martin (martin@devlan.co.ke)
 */


/* Add Expense  */
if (isset($_POST['Add_Expense'])) {
    $expense_user_id = mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $expense_type = mysqli_real_escape_string($mysqli, $_POST['expense_type']);
    $expense_amount = mysqli_real_escape_string($mysqli, $_POST['expense_amount']);
    $expense_date = mysqli_real_escape_string($mysqli, $_POST['expense_date']);

    $add_expense_sql = "INSERT INTO expenses (expense_user_id, expense_type, expense_amount, expense_date)
     VALUES ('{$expense_user_id}', '{$expense_type}', '{$expense_amount}', '{$expense_date}')";

    if (mysqli_query($mysqli, $add_expense_sql)) {
        $success = "Expense added";
    } else {
        $error = "Error adding expense";
    }
}

/* Update Expense */
if (isset($_POST['Update_Expense'])) {
    $expense_type = mysqli_real_escape_string($mysqli, $_POST['expense_type']);
    $expense_amount = mysqli_real_escape_string($mysqli, $_POST['expense_amount']);
    $expense_date = mysqli_real_escape_string($mysqli, $_POST['expense_date']);
    $expense_id = mysqli_real_escape_string($mysqli, $_POST['expense_id']);

    /* Persist */
    $update_sql = "UPDATE expenses SET expense_type = '{$expense_type}', expense_amount = '{$expense_amount}', expense_date = '{$expense_date}' WHERE expense_id = '{$expense_id}'";

    if (mysqli_query($mysqli, $update_sql)) {
        $success = "Expense updated";
    } else {
        $err = "Failed, please try again";
    }
}

/* Delete Expense */
if (isset($_POST['Delete_Expense'])) {
    $expense_id = mysqli_real_escape_string($mysqli, $_POST['expense_id']);

    $delete_sql = "DELETE FROM expenses WHERE expense_id = '{$expense_id}'";

    if (mysqli_query($mysqli, $delete_sql)) {
        $success = "Expense deleted";
    } else {
        $err = "Failed, please try again";
    }
}
