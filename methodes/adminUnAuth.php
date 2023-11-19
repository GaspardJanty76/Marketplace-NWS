<?php
session_start();

$_SESSION = array();
session_destroy();

header("Location: /../GitHub/Marketplace-NWS/adminauth.php");
exit();
?>