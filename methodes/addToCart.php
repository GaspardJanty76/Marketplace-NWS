<?php
// Vérifiez si l'ID du produit a été envoyé
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Vérifiez si la quantité a été spécifiée
    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];

        // Vous devrez implémenter votre propre logique pour ajouter le produit au panier.
        // Dans cet exemple, nous allons stocker les produits dans une session PHP.

        // Démarrez la session si elle n'est pas déjà démarrée
        session_start();

        // Initialisez le panier s'il n'existe pas encore dans la session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Vérifiez si la quantité demandée ne dépasse pas la quantité en stock
        if ($quantity <= $_POST['stock']) {
            // Ajoutez le produit au panier avec la quantité spécifiée
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
