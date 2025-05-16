<?php
/*
 *   Crafted On Fri May 16 2025
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

if ($_SESSION['user_type'] == 'Administrator') {

    /* Properties */
    $query = "SELECT COUNT(*) FROM properties";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($properties);
    $stmt->fetch();
    $stmt->close();

    /* Houses */
    $query = "SELECT COUNT(*) FROM houses";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($houses);
    $stmt->fetch();
    $stmt->close();

    /* Tenants */
    $query = "SELECT COUNT(*) FROM tenants";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($tenants);
    $stmt->fetch();
    $stmt->close();

    /* System Users */
    $query = "SELECT COUNT(*) FROM users";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($users);
    $stmt->fetch();
    $stmt->close();

    /* Vacant Houses */
    $query = "SELECT COUNT(*) FROM houses WHERE house_status = 'vacant'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($vacant);
    $stmt->fetch();
    $stmt->close();

    /* Occupied Houses */
    $query = "SELECT COUNT(*) FROM houses WHERE house_status = 'occupied'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($occupied);
    $stmt->fetch();
    $stmt->close();

    /* Cumulative Payments */
    $query = "SELECT SUM(payment_amount) FROM payments";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($payment_amount);
    $stmt->fetch();
    $stmt->close();

    /* Cumulative Expenses */
    $query = "SELECT SUM(expense_amount) FROM expenses";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($expense_amount);
    $stmt->fetch();
    $stmt->close();


    /* Compute Projected Amounts 
Logic 
 Get sum of all amount of all occupied houses
 Compare with the paid amount on that duration
*/

    /* Projected amount */
    $query = "SELECT SUM(house_rent) FROM houses WHERE house_status = 'occupied'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($projected_amount);
    $stmt->fetch();
    $stmt->close();

    /* Get 30 days before today */
    $start_date = date('m/01/Y', strtotime('-1 month'));
    $end_date = date('m/01/Y', strtotime($start_date . '+1 month'));


    /* Received payment */
    $query = "SELECT SUM(payment_amount) FROM payments WHERE payment_date BETWEEN '{$start_date}' AND '{$end_date}'";
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($payment_amount);
    $stmt->fetch();
    $stmt->close();
} else if ($_SESSION['user_type'] == 'Caretaker') {
    $property_sql = mysqli_query(
        $mysqli,
        "SELECT * FROM properties WHERE property_caretaker_id = '{$_SESSION['user_id']}'"
    );
    while ($properties = mysqli_fetch_array($property_sql)) {
        /* Caretaker Analytics */
        /* All Houses */
        $query = "SELECT COUNT(*) FROM houses WHERE house_property_id = '{$properties['property_id']}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($houses);
        $stmt->fetch();
        $stmt->close();

        /* Vacant Houses */
        $query = "SELECT COUNT(*) FROM houses WHERE house_status = 'vacant' AND house_property_id = '{$properties['property_id']}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($vacant);
        $stmt->fetch();
        $stmt->close();

        /* Occupied Houses */
        $query = "SELECT COUNT(*) FROM houses WHERE house_status = 'occupied' AND house_property_id = '{$properties['property_id']}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($occupied);
        $stmt->fetch();
        $stmt->close();


        /* Tenants */
        $query = "SELECT COUNT(*) FROM tenants t INNER JOIN houses h on h.house_tenant = t.tenant_id WHERE h.house_property_id = '{$properties['property_id']}'";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $stmt->bind_result($tenants);
        $stmt->fetch();
        $stmt->close();
    }
} else {
    /* Tenant */
}
