<?php
require_once 'dbConnect.php';

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($products)) {
    echo '<ul class="product-list">';
    foreach ($products as $product) {
        echo '<li class="product-card">';
        echo '<a href="methodes/productDetails.php?id=' . $product['idproducts'] . '">';
        echo '<img class="product-image" src="db_images/' . $product['image_name'] . '" alt="Image du produit">';
        echo '<div class="product-details">';
        echo '<strong> ' . $product['name'] . '</strong><br>';
        echo '<strong> ' . $product['price'] . ' €</strong><br>';
        echo '</div>';
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p class="no-products">Aucun produit n\'est disponible pour le moment.</p>';
}
?>


