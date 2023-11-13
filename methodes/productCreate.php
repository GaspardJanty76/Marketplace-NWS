<?php
require_once 'dbConnect.php';

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST["pname"];
    $pprice = $_POST["pprice"];
    $pdesc = $_POST["pdesc"];
    $pstock = $_POST["pstock"];

    if (!empty($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
        $img_name = $_FILES["pimage"]["name"];
        $name_tmp = $_FILES["pimage"]["tmp_name"];

        $time = time();
        $new_img_name = $time . $img_name;
        $upload_img = move_uploaded_file($name_tmp, "../db_images/" . $new_img_name);
        if ($upload_img) {
            $sql = "INSERT INTO products (name, price, description, stock, image_name) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $pname);
            $stmt->bindParam(2, $pprice);
            $stmt->bindParam(3, $pdesc);
            $stmt->bindParam(4, $pstock);
            $stmt->bindParam(5, $new_img_name);

            if ($stmt->execute()) {
                echo "Le produit a été ajouté avec succès.";
            } else {
                echo "Erreur : " . $stmt->errorInfo()[2];
            }
        } else {
            echo "Erreur : Échec de l'upload de l'image.";
        }
    } else {
        echo "Erreur : Veuillez sélectionner une image valide.";
    }
}
?>
