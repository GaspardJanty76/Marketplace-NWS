<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Boutique</title>

    <!-- Styles Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Votre CSS pour les cartes de produits et le carrousel -->
    <style>
/* Réinitialisation des styles de base */



    </style>
</head>
<body>

    <?php
    require_once 'dbConnect.php';

    $pdoManager = new DBManager('maisonbayeul');
    $pdo = $pdoManager->getPDO();

    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($products)) {
        echo '<div id="product-carousel-container">';
        echo '<ul id="product-carousel" class="product-list owl-carousel">';
        foreach ($products as $product) {
            echo '<li class="product-card">';
            echo '<a href="methodes/productDetails.php?id=' . $product['idproducts'] . '">';
            echo '<img class="product-image" src="../db_images/' . $product['image_name'] . '" alt="Image du produit">';
            echo '<div class="product-details">';
            echo '<strong> ' . $product['name'] . '</strong><br>';
            echo '<strong> ' . $product['price'] . ' €</strong><br>';
            echo '</div>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p class="no-products">Aucun produit n\'est disponible pour le moment.</p>';
    }
    ?>

    <!-- Scripts jQuery et Owl Carousel -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Script d'initialisation du carrousel -->
    <script>
        $(document).ready(function(){
            $("#product-carousel").owlCarousel({
                items: 1, // Afficher un produit à la fois
                loop: true, // Permet de faire une boucle infinie
                nav: true, // Affiche les flèches de navigation
                dots: false, // Désactive les points indicateurs
                autoplay: true, // Active le mode automatique
                autoplayTimeout: 5000, // Temps d'affichage de chaque produit en millisecondes
                autoplayHoverPause: true // Met en pause le carrousel lorsqu'on survole avec la souris
            });
        });
    </script>

</body>
</html>
