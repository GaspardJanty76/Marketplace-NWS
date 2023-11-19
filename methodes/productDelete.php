<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'dbConnect.php';

    class ProductDeleter
    {
        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function deleteProduct($productId)
        {
            $sqlDelete = "DELETE FROM products WHERE idproducts = :id";
            $stmtDelete = $this->pdo->prepare($sqlDelete);
            $stmtDelete->bindParam(':id', $productId, PDO::PARAM_INT);

            return $stmtDelete->execute();
        }
    }

    $pdoManager = new DBManager('maisonbayeul');
    $pdo = $pdoManager->getPDO();

    $productId = $_POST['id'];
    $productDeleter = new ProductDeleter($pdo);

    if ($productDeleter->deleteProduct($productId)) {
        header('Location: ../modifyproduct.php');
    } else {
        echo 'Erreur lors de la suppression du produit.';
    }
} else {
    echo 'Méthode non autorisée.';
}
?>
