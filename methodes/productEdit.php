<?php
require_once 'dbConnect.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $pdoManager = new DBManager('maisonbayeul');
    $pdo = $pdoManager->getPDO();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['name'];
        $newPrice = $_POST['price'];
        $newDescription = $_POST['description'];

        $sqlUpdate = "UPDATE products SET name = :name, price = :price, description = :description WHERE idproducts = :id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':name', $newName, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':price', $newPrice, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':description', $newDescription, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':id', $productId, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            echo 'Produit mis à jour avec succès.';
        } else {
            echo 'Erreur lors de la mise à jour du produit.';
        }
    }

    $sqlSelect = "SELECT * FROM products WHERE idproducts = :id";
    $stmtSelect = $pdo->prepare($sqlSelect);
    $stmtSelect->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmtSelect->execute();

    $product = $stmtSelect->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo 'Modifier le produit : <br>';
        echo '<form method="post" action="">';
        echo 'Nom : <input type="text" name="name" value="' . $product['name'] . '"><br>';
        echo 'Prix : <input type="text" name="price" value="' . $product['price'] . '"><br>';
        echo 'Description : <textarea name="description">' . $product['description'] . '</textarea><br>';
        echo '<input type="submit" value="Enregistrer les modifications">';
        echo '</form>';
    } else {
        echo 'Produit non trouvé.';
    }
} else {
    echo 'Identifiant du produit non spécifié.';
}
?>
