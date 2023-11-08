<?php
session_start();
if (isset($_SESSION['username'])) {
    include_once __DIR__. '/../createproduct.php';
     
}
else{
    header("Location: ../auth.php");
    exit();
}
?>
