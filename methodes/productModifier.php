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
        echo 'Prix : ' . $product['price'] . '<br>';
        echo 'Description : ' . $product['description'] . '<br>';
        echo 'Stock : ' . $product['stock'] . '<br>';

        if ($product['forward'] == 0) {
            echo '<form method="post" action="methodes/updateForward.php">';
            echo '<input type="hidden" name="id" value="' . $product['idproducts'] . '">';
            echo '<input type="submit" name="forwardButton" value="Mettre en avant">';
            echo '</form>';
        } else {
            echo '<form method="post" action="methodes/updateForward.php">';
            echo '<input type="hidden" name="id" value="' . $product['idproducts'] . '">';
            echo '<input type="submit" name="forwardButton" value="Ne plus mettre en avant">';
            echo '</form>';
        }

        echo '<form method="post" action="methodes/productDelete.php" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer ce produit ?\');">';
        echo '<input type="hidden" name="id" value="' . $product['idproducts'] . '">';
        echo '<input type="submit" name="deleteButton" value="Supprimer">';
        echo '</form>';

        echo '<a href="methodes/productEdit.php?id=' . $product['idproducts'] . '">Modifier</a>';
        echo '<hr>';
    }
}

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productListWithActions = new ProductListWithActions($pdo);
$productListWithActions->displayProductList();
?>
