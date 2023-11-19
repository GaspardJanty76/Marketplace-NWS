<?php
session_start();

class CartClearer
{
    public static function clearCart()
    {
        $_SESSION['cart'] = array();
        self::redirectToCart();
    }

    private static function redirectToCart()
    {
        header('Location: ../cart.php');
        exit();
    }
}

CartClearer::clearCart();
?>
