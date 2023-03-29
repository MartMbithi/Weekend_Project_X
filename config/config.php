<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

/* Procedural Database Connecrions */
$dbuser = "root"; /* Database Username */
$dbpass = ""; /* Database Username Password */
$host = "localhost"; /* Database Host */
$db = "rental_property_is";  /* Database Name */
$mysqli = new mysqli($host, $dbuser, $dbpass, $db); /* Connection Function */

/* Determine if its running on HTTP */
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];

/* Global directory */
$base_dir = $uri . "/property_manager/views/";
global $base_dir;
