<?php
require_once 'dbConnect.php'; // Assurez-vous de spécifier le bon chemin

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST["pname"];
    $pprice = $_POST["pprice"];
    $pdesc = $_POST["pdesc"];
    $pstock = $_POST["pstock"];

    if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
        $imageData = file_get_contents($_FILES["pimage"]["tmp_name"]);
        $imageType = $_FILES["pimage"]["type"];

        $sql = "INSERT INTO products (name, price, description, stock, image_data, image_type) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $pname);
        $stmt->bindParam(2, $pprice);
        $stmt->bindParam(3, $pdesc);
        $stmt->bindParam(4, $pstock);
        $stmt->bindParam(5, $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(6, $imageType);

        if ($stmt->execute()) {
            echo "Le produit a été ajouté avec succès.";
        } else {
            echo "Erreur : " . $stmt->errorInfo()[2];
        }

        $stmt->close();
    } else {
        echo "Erreur : Veuillez sélectionner une image valide.";
    }
}
?>
