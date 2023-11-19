<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

require_once 'dbConnect.php';
$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();


echo '<h1>Votre Panier</h1>';

if (empty($_SESSION['cart'])) {
    echo '<p>Votre panier est vide.</p>';
} else {
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>Image</th>';
    echo '<th>Prix unitaire</th>';
    echo '<th>Quantité</th>';
    echo '<th>Prix total</th>';
    echo '</tr>';

    $totalPrice = 0;

    foreach ($_SESSION['cart'] as $productId) {
        $sql = "SELECT * FROM products WHERE idproducts = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        $productTotal = $productDetails['price'];
        $totalPrice += $productTotal;

        echo '<tr>';
        echo '<td><img src="db_images/' . $productDetails['image_name'] . '" alt="Image du produit" style="width: 100px;"></td>';
        echo '<td>' . $productDetails['price'] . ' €</td>';
        echo '<td>1</td>';
        echo '<td>' . $productTotal . ' €</td>';
        echo '</tr>';
    }

    echo '<tr>';
    echo '<td colspan="3"><strong>Prix total du panier</strong></td>';
    echo '<td>' . $totalPrice . ' €</td>';
    echo '</tr>';
    echo '</table>';
    echo '<p><a href="methodes/clearCart.php">Vider le panier</a></p>';
}

?>
