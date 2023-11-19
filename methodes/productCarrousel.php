<?php
require_once 'dbConnect.php';

class ProductCarousel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function displayCarousel()
    {
        $products = $this->getFeaturedProducts();

        if (!empty($products)) {
            echo '<div id="product-carousel-container">';
            echo '<ul id="product-carousel" class="product-list owl-carousel">';
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
            echo '</div>';
        } else {
            echo '<p class="no-products">Aucun produit n\'est disponible pour le moment.</p>';
        }
    }

    private function getFeaturedProducts()
    {
        $sql = "SELECT * FROM products WHERE forward = 1";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

require_once 'dbConnect.php';
$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productCarousel = new ProductCarousel($pdo);
$productCarousel->displayCarousel();
?>
