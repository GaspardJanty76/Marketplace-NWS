<?php
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];

        session_start();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if ($quantity <= $_POST['stock']) {
            for ($i = 0; $i < $quantity; $i++) {
                $_SESSION['cart'][] = $productId;
            }

            echo 'Produit ajouté au panier avec succès.';
            header('Location: ../cart.php');
        } else {
            echo 'Erreur : La quantité demandée dépasse la quantité en stock.';
        }
    } else {
        echo 'Erreur : La quantité n\'a pas été spécifiée.';
    }
} else {
    echo 'Erreur : ID du produit non spécifié.';
}
?>
