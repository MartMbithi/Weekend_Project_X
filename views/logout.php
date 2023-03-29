<?php
/*
 *   Crafted On Wed Mar 29 2023
 *   Author Martin (martin@devlan.co.ke)
 */
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_access_level']);
session_destroy();
header("Location: ../");
exit;
