<?php
session_start();
if (!isset($_SESSION['username'])) {
    include_once __DIR__. '/../createproduct.php';
     
}
include_once 'templates/adminheader.php'; 
include_once 'methodes/productDisplay.php';
?>

