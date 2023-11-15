<?php
require_once 'dbConnect.php';

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

// Récupérer les produits depuis la base de données
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!empty($products)): ?>
        <ul class="product-list">
            <?php foreach ($products as $product): ?>
                <li class="product-card">
                    <div class="product-details">
                        <strong>Nom :</strong> <?php echo $product['name']; ?><br>
                        <strong>Prix :</strong> <?php echo $product['price']; ?><br>
                        <strong>Description :</strong> <?php echo $product['description']; ?><br>
                        <strong>Stock :</strong> <?php echo $product['stock']; ?><br>
                    </div>
                    <img class="product-image" src="db_images/<?php echo $product['image_name']; ?>" alt="Image du produit">
                    <hr class="product-divider">
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="no-products">Aucun produit n'est disponible pour le moment.</p>
    <?php endif; ?>

