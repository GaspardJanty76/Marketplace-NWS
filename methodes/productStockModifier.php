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
        $newStock = $_POST['stock'];

        $sqlUpdate = "UPDATE products SET stock = :stock WHERE idproducts = :id";
        $stmtUpdate = $this->pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':stock', $newStock, PDO::PARAM_STR);
        $stmtUpdate->bindParam(':id', $productId, PDO::PARAM_INT); // Add this line

        try {
            if ($stmtUpdate->execute()) {
                echo 'Produit mis à jour avec succès.';
                header('Location: ../stockproduct.php');
            } else {
                echo 'Erreur lors de la mise à jour du produit.';
            }
        } catch (PDOException $e) {
            echo 'Erreur PDO : ' . $e->getMessage();
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
        echo 'Nom : "'. $product['name'] . '"<br>';
        echo 'Stock : <input type="text" name="stock" value="' . $product['stock'] . '"><br>';
        echo '<input type="submit" value="Enregistrer les modifications">';
        echo '</form>';
    }
}

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productEditor = new ProductEditor($pdo);
$productEditor->editProduct();
?>
