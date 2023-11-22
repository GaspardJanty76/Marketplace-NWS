<?php
require_once 'dbConnect.php';

class ProductListWithActions
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function displayProductList()
    {
        $sql = "SELECT * FROM products";
        $stmt = $this->pdo->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($products)) {
            foreach ($products as $product) {
                $this->renderProductDetails($product);
            }
        } else {
            echo 'Aucun produit n\'est disponible pour le moment.';
        }
    }

    private function renderProductDetails($product)
    {
        echo 'Nom : ' . $product['name'] . '<br>';
        echo 'Stock : ' . $product['stock'] . '<br>';
        echo '<a href="methodes/productStockModifier.php?id=' . $product['idproducts'] . '">Modifier</a>';
        echo '<hr>';
    }
}

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productListWithActions = new ProductListWithActions($pdo);
$productListWithActions->displayProductList();
?>
