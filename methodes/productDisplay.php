<?php
require_once 'dbConnect.php';

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

// Récupérer les produits depuis la base de données
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
</head>
<body>
    <h1>Liste des Produits</h1>

    <?php if (!empty($products)): ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <strong>Nom :</strong> <?php echo $product['name']; ?><br>
                    <strong>Prix :</strong> <?php echo $product['price']; ?><br>
                    <strong>Description :</strong> <?php echo $product['description']; ?><br>
                    <strong>Stock :</strong> <?php echo $product['stock']; ?><br>
                    <img src="../db_images/<?php echo $product['image_name']; ?>" alt="Image du produit">
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun produit n'est disponible pour le moment.</p>
    <?php endif; ?>
</body>
</html>
