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
        echo '<div class="product-details">';
        echo '<strong>Nom :</strong> ' . $product['name'] . '<br>';
        echo '<strong>Prix :</strong> ' . $product['price'] . '<br>';
        echo '<strong>Description :</strong> ' . $product['description'] . '<br>';
        echo '<strong>Stock :</strong> ' . $product['stock'] . '<br>';
        echo '</div>';
        echo '<img class="product-image" src="db_images/' . $product['image_name'] . '" alt="Image du produit">';
        echo '<hr class="product-divider">';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p class="no-products">Aucun produit n\'est disponible pour le moment.</p>';
}
?>

