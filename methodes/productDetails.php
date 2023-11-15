<?php
require_once 'dbConnect.php';

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Retrieve product details based on the ID
    $sql = "SELECT * FROM products WHERE idproducts = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($productDetails) {
        // Display product details
        echo '<h1>' . $productDetails['name'] . '</h1>';
        echo '<img src="../db_images/' . $productDetails['image_name'] . '" alt="Image du produit">';
        echo '<p><strong>Prix :</strong> ' . $productDetails['price'] . ' €</p>';
        echo '<p><strong>Description :</strong> ' . $productDetails['description'] . '</p>';
        echo '<p><strong>Stock :</strong> ' . $productDetails['stock'] . '</p>';
    } else {
        echo '<p>Product not found.</p>';
    }
} else {
    echo '<p>Invalid request. Please provide a product ID.</p>';
}
?>
