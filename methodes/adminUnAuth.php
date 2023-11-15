<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to a login page or wherever you want after logging out
header("Location: /../GitHub/Marketplace-NWS/adminauth.php");
exit();
?>