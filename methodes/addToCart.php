<?php

class CartManager
{
    public static function addToCart($productId, $quantity)
    {
        session_start();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (self::isValidQuantity($quantity, $productId)) {
            self::addProductToCart($productId, $quantity);
            echo 'Produit ajouté au panier avec succès.';
            header('Location: ../cart.php');
        } else {
            echo 'Erreur : La quantité demandée dépasse la quantité en stock.';
        }
    }

    private static function isValidQuantity($quantity, $productId)
    {
        return $quantity <= self::getStock($productId);
    }

    private static function addProductToCart($productId, $quantity)
    {
        for ($i = 0; $i < $quantity; $i++) {
            $_SESSION['cart'][] = $productId;
        }
    }

    private static function getStock($productId)
    {
        return 10; // Remplacez cela par votre logique pour obtenir le stock réel
    }
}

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    if (isset($_POST['quantity'])) {
        $quantity = $_POST['quantity'];
        CartManager::addToCart($productId, $quantity);
    } else {
        echo 'Erreur : La quantité n\'a pas été spécifiée.';
    }
} else {
    echo 'Erreur : ID du produit non spécifié.';
}
?>
