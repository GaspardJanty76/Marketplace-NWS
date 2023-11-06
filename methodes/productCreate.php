<?php
require_once 'dbConnect.php';

$pdoManager = new DBManagement('maisonbayeul');
$pdo = $pdoManager->getPDO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST["pname"];
    $pprice = $_POST["pprice"];
    $pdesc = $_POST["pdesc"];
    $pstock = $_POST["pstock"];

    if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["pimage"]["tmp_name"]);
        $imageType = $_FILES["pimage"]["type"];
    } else {
        echo "Erreur : Veuillez sélectionner une image valide.";
        exit;
    }

    $sql = "INSERT INTO products (name, price, description, stock, image_data, image_type) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bind_param("ssssbs", $pname, $pprice, $pdesc, $pstock, $imageData, $imageType);

    if ($stmt->execute()) {
        echo "Le produit a été ajouté avec succès.";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$pdoManager->closeConnection();
?>
