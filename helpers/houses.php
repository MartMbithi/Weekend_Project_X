<?php
/*
 *   Crafted On Thu May 15 2025
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



/* Add Property */
if (isset($_POST['Add_Property'])) {
    $property_name = mysqli_real_escape_string($mysqli, $_POST['property_name']);
    $property_caretaker_id = mysqli_real_escape_string($mysqli, $_POST['property_caretaker_id']);
    $property_location = mysqli_real_escape_string($mysqli, $_POST['property_location']);

    /* Persist */
    $add_sql = "INSERT INTO properties (property_name, property_location, property_caretaker_id) VALUES ('{$property_name}', '{$property_location}', '{$property_caretaker_id}')";
    if (mysqli_query($mysqli, $add_sql)) {
        $success = "Property added";
    } else {
        $error = "Error adding property";
    }
}

/* Update property */
if (isset($_POST['Update_Property'])) {
    $property_id = mysqli_real_escape_string($mysqli, $_POST['property_id']);
    $property_caretaker_id = mysqli_real_escape_string($mysqli, $_POST['property_caretaker_id']);
    $property_location = mysqli_real_escape_string($mysqli, $_POST['property_location']);
    $property_name = mysqli_real_escape_string($mysqli, $_POST['property_name']);

    /* Persist */
    $update_sql = "UPDATE properties SET property_name = '{$property_name}', 
    property_location = '{$property_location}', property_caretaker_id = '{$property_caretaker_id}'
    WHERE property_id = '{$property_id}'";
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
    if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM houses WHERE house_number = '{$house_number}' AND house_property_id = '{$house_property_id}'")) > 0) {
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
