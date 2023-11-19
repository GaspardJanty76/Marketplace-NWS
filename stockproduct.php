<?php
session_start();
if (isset($_SESSION['username'])) {
    include_once 'templates/adminheader.php'; 
    include_once 'methodes/productStock.php';
}
else{
    header("Location: adminauth.php");
    exit();
}

?>
