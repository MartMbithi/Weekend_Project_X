<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];

$base_dir = $uri . "/rental_property_is/";
global $base_dir;
/* Redirect To Index Under Views */
header('Location: ' . $base_dir . 'views/login');
exit;
