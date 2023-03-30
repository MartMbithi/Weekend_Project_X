<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */


/* Add Property */
if (isset($_POST['Add_Property'])) {
    $property_name = mysqli_real_escape_string($mysqli, $_POST['property_name']);
    $property_location = mysqli_real_escape_string($mysqli, $_POST['property_location']);

    /* Persist */
    $add_sql = "INSERT INTO properties (property_name, property_location) VALUES ('{$property_name}', '{$property_location}')";
    if (mysqli_query($mysqli, $add_sql)) {
        $success = "Property added";
    } else {
        $error = "Error adding property";
    }
}

/* Update property */
if (isset($_POST['Update_Property'])) {
    $property_id = mysqli_real_escape_string($mysqli, $_POST['property_id']);
    $property_location = mysqli_real_escape_string($mysqli, $_POST['property_location']);
    $property_name = mysqli_real_escape_string($mysqli, $_POST['property_name']);

    /* Persist */
    $update_sql = "UPDATE properties SET property_name = '{$property_name}', property_location = '{$property_location}' WHERE property_id = '{$property_id}'";
    if (mysqli_query($mysqli, $update_sql)) {
        $success = "Property updated";
    } else {
        $error = "Error updating property";
    }
}

/* Delete property */
if (isset($_POST['Delete_Property'])) {
    $property_id = mysqli_real_escape_string($mysqli, $_POST['property_id']);

    /* Persist */
    $delete_sql = "DELETE FROM properties WHERE property_id = '{$property_id}'";
    if (mysqli_query($mysqli, $delete_sql)) {
        $success = "Property deleted";
    } else {
        $error = "Error deleting property";
    }
}

/* Add house */
if (isset($_POST['Add_House'])) {
    $house_property_id = mysqli_real_escape_string($mysqli, $_POST['house_property_id']);
    $house_number = mysqli_real_escape_string($mysqli, $_POST['house_number']);
    $house_category = mysqli_real_escape_string($mysqli, $_POST['house_category']);
    $house_rent = mysqli_real_escape_string($mysqli, $_POST['house_rent']);

    /* Prevent double entries */
    if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM houses WHERE house_number = '{$house_number}'")) > 0) {
        $err = "House number already exists";
    } else {
        /* Persist */
        $add_sql = "INSERT INTO houses (house_property_id, house_number, house_category, house_rent) 
        VALUES ('{$house_property_id}', '{$house_number}', '{$house_category}', '{$house_rent}')";
        if (mysqli_query($mysqli, $add_sql)) {
            $success = "House added";
        } else {
            $error = "Error adding house";
        }
    }
}

/* Update house */
if (isset($_POST['Update_House'])) {
    $house_property_id = mysqli_real_escape_string($mysqli, $_POST['house_property_id']);
    $house_number = mysqli_real_escape_string($mysqli, $_POST['house_number']);
    $house_category = mysqli_real_escape_string($mysqli, $_POST['house_category']);
    $house_status = mysqli_real_escape_string($mysqli, $_POST['house_status']);
    $house_rent = mysqli_real_escape_string($mysqli, $_POST['house_rent']);
    $house_id = mysqli_real_escape_string($mysqli, $_POST['house_id']);

    /* Persist */
    $update_sql = "UPDATE houses SET house_property_id = '{$house_property_id}', house_number = '{$house_number}', house_category = '{$house_category}', house_status = '{$house_status}', house_rent = '{$house_rent}' WHERE house_id = '{$house_id}'";
    if (mysqli_query($mysqli, $update_sql)) {
        $success = "House updated";
    } else {
        $error = "Error updating house";
    }
}

/* Delete house */
if (isset($_POST['Delete_House'])) {
    $house_id = mysqli_real_escape_string($mysqli, $_POST['house_id']);
    /* Persist */
    $delete_sql = "DELETE FROM houses WHERE house_id = '{$house_id}'";
    if (mysqli_query($mysqli, $delete_sql)) {
        $success = "House deleted";
    } else {
        $error = "Error deleting house";
    }
}
