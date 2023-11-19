<?php
// Démarrez la session
session_start();

// Videz le panier en réinitialisant le tableau de la session
$_SESSION['cart'] = array();

// Redirigez l'utilisateur vers la page du panier
header('Location: ../cart.php');
?>