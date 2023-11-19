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

        // Add a form to handle adding the product to the cart
        echo '<form method="post" action="addToCart.php">';
        
        // Pass the product ID as a hidden field
        echo '<input type="hidden" name="productId" value="' . $productId . '">';
        
        // Pass all product details as hidden fields in the form
        foreach ($productDetails as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }

        // Ajouter un champ pour la quantité
        echo '<label for="quantity">Quantité :</label>';
        echo '<input type="number" name="quantity" id="quantity" value="1" min="1" max="' . $productDetails['stock'] . '">';

        echo '<input type="submit" value="Ajouter au panier">';
        echo '</form>';
    } else {
        echo '<p>Product not found.</p>';
    }
} else {
    echo '<p>Invalid request. Please provide a product ID.</p>';
}
?>
