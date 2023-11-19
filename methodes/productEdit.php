<?php
require_once 'dbConnect.php';

class ProductEditor
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function editProduct()
    {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->updateProduct($productId);
            }

            $product = $this->getProductById($productId);

            if ($product) {
                $this->renderProductForm($product);
            } else {
                echo 'Produit non trouvé.';
            }
        } else {
            echo 'Identifiant du produit non spécifié.';
        }
    }

    private function updateProduct($productId)
    {
        $newName = $_POST['name'];
        $newPrice = $_POST['price'];
        $newDescription = $_POST['description'];

        $sqlUpdate = "UPDATE products SET name = :name, price = :price, description = :description WHERE idproducts = :id";
        $stmtUpdate = $this->pdo->prepare($sqlUpdate);
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

    private function getProductById($productId)
    {
        $sqlSelect = "SELECT * FROM products WHERE idproducts = :id";
        $stmtSelect = $this->pdo->prepare($sqlSelect);
        $stmtSelect->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmtSelect->execute();

        return $stmtSelect->fetch(PDO::FETCH_ASSOC);
    }

    private function renderProductForm($product)
    {
        echo 'Modifier le produit : <br>';
        echo '<form method="post" action="">';
        echo 'Nom : <input type="text" name="name" value="' . $product['name'] . '"><br>';
        echo 'Prix : <input type="text" name="price" value="' . $product['price'] . '"><br>';
        echo 'Description : <textarea name="description">' . $product['description'] . '</textarea><br>';
        echo '<input type="submit" value="Enregistrer les modifications">';
        echo '</form>';
    }
}

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productEditor = new ProductEditor($pdo);
$productEditor->editProduct();
?>
