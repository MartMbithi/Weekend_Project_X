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
        $success = "Property added successfully";
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
        $success = "Property updated successfully";
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
        $success = "Property deleted successfully";
    } else {
        $error = "Error deleting property";
    }
}

 /* Add house */

/* Update house */

/* Delete house */