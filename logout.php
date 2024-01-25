<?php
session_start();
// Clearing all session variables
$_SESSION = array();

// Destroying the session
session_destroy();

// Redirecting to login page
header("Location: index.html");
exit;
?>
