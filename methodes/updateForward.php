<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'dbConnect.php';

    $pdoManager = new DBManager('maisonbayeul');
    $pdo = $pdoManager->getPDO();

    $productId = $_POST['id'];

    // Vérifier si le bouton "Mettre en avant" ou "Ne plus mettre en avant" a été cliqué
    if (isset($_POST['forwardButton'])) {
        $forwardValue = ($_POST['forwardButton'] === 'Mettre en avant') ? 1 : 0;

        // Mettre à jour la colonne "forward" dans la base de données
        $sqlUpdate = "UPDATE products SET forward = :forward WHERE idproducts = :id";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':forward', $forwardValue, PDO::PARAM_INT);
        $stmtUpdate->bindParam(':id', $productId, PDO::PARAM_INT);

        if ($stmtUpdate->execute()) {
            header('Location: ../modifyproduct.php');
        } else {
            echo 'Erreur lors de la mise à jour.';
        }
    } else {
        echo 'Action non spécifiée.';
    }
} else {
    echo 'Méthode non autorisée.';
}
?>
