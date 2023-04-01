<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

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
$start_date = date('Y-m-d', strtotime('-1 month'));


/* Received payment */
$query = "SELECT SUM(payment_amount) FROM payments WHERE payment_date BETWEEN '{$start_date}' AND '{$todays_date}'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($payment_amount);
$stmt->fetch();
$stmt->close();
