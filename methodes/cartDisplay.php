<?php
// Démarrez la session
session_start();

// Initialisez le panier s'il n'existe pas encore dans la session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Incluez le fichier de connexion à la base de données si nécessaire
require_once 'dbConnect.php';
$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();


// Affichez le titre de la page
echo '<h1>Votre Panier</h1>';

// Vérifiez si le panier est vide
if (empty($_SESSION['cart'])) {
    echo '<p>Votre panier est vide.</p>';
} else {
    // Affichez les produits du panier
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>Image</th>';
    echo '<th>Prix unitaire</th>';
    echo '<th>Quantité</th>';
    echo '<th>Prix total</th>';
    echo '</tr>';

    $totalPrice = 0; // Initialiser le prix total du panier à zéro

    foreach ($_SESSION['cart'] as $productId) {
        // Vous devrez récupérer les détails du produit à partir de la base de données
        // et afficher les informations nécessaires (image, prix, quantité, prix total).

        // Exemple de récupération des détails du produit à partir de la base de données
        // Remplacez cette section par votre propre logique de récupération des détails du produit.
        $sql = "SELECT * FROM products WHERE idproducts = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calculer le prix total du produit
        $productTotal = $productDetails['price']; // Vous devrez ajuster cette valeur en fonction de votre logique de quantité
        $totalPrice += $productTotal; // Ajouter le prix total du produit au prix total du panier

        // Affichez les détails du produit dans le tableau
        echo '<tr>';
        echo '<td><img src="db_images/' . $productDetails['image_name'] . '" alt="Image du produit" style="width: 100px;"></td>';
        echo '<td>' . $productDetails['price'] . ' €</td>';
        echo '<td>1</td>'; // Vous devrez ajuster cette valeur en fonction de votre logique de quantité
        echo '<td>' . $productTotal . ' €</td>'; // Vous devrez ajuster cette valeur en fonction de votre logique de prix total
        echo '</tr>';
    }

    // Afficher le prix total du panier
    echo '<tr>';
    echo '<td colspan="3"><strong>Prix total du panier</strong></td>';
    echo '<td>' . $totalPrice . ' €</td>';
    echo '</tr>';

    echo '</table>';

    // Ajoutez un lien pour vider le panier si nécessaire
    echo '<p><a href="methodes/clearCart.php">Vider le panier</a></p>';
}

?>
