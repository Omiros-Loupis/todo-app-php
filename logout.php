<?php
session_start();
// Clear all session variables
$_SESSION = array();
session_destroy();
header("location: login.php");
exit;
?>