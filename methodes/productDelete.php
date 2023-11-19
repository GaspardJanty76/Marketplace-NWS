<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'dbConnect.php';

    $pdoManager = new DBManager('maisonbayeul');
    $pdo = $pdoManager->getPDO();

    $productId = $_POST['id'];

    // Supprimer la ligne dans la base de données
    $sqlDelete = "DELETE FROM products WHERE idproducts = :id";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(':id', $productId, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        header('Location: ../modifyproduct.php');
    } else {
        echo 'Erreur lors de la suppression du produit.';
    }
} else {
    echo 'Méthode non autorisée.';
}
?>
