<?php
require_once 'dbConnect.php';

class ProductLister
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function displayProductList()
    {
        $sql = "SELECT * FROM products WHERE stock > 0";
        $stmt = $this->pdo->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($products)) {
            echo '<ul class="product-list">';
            foreach ($products as $product) {
                $this->renderProductCard($product);
            }
            echo '</ul>';
        } else {
            echo '<p class="no-products">Aucun produit n\'est disponible pour le moment.</p>';
        }
    }

    private function renderProductCard($product)
    {
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
}

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productLister = new ProductLister($pdo);
$productLister->displayProductList();
?>
