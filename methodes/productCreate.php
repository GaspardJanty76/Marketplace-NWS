<?php
require_once 'dbConnect.php';

class ProductUploader
{
    const UPLOAD_PATH = "../db_images/";

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function uploadProduct()
    {
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
                $upload_img = move_uploaded_file($name_tmp, self::UPLOAD_PATH . $new_img_name);

                if ($upload_img) {
                    $this->insertProduct($pname, $pprice, $pdesc, $pstock, $new_img_name);
                } else {
                    echo "Error : Échec de l'upload de l'image.";
                }
            } else {
                echo "Error : Veuillez sélectionner une image valide.";
            }
        }
    }

    private function insertProduct($pname, $pprice, $pdesc, $pstock, $new_img_name)
    {
        $sql = "INSERT INTO products (name, price, description, stock, image_name, forward) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $pname);
        $stmt->bindParam(2, $pprice);
        $stmt->bindParam(3, $pdesc);
        $stmt->bindParam(4, $pstock);
        $stmt->bindParam(5, $new_img_name);
        $stmt->bindValue(6, "0");

        if ($stmt->execute()) {
            echo "Success : Le produit a été ajouté avec succès.";
        } else {
            echo "Error : " . $stmt->errorInfo()[2];
        }
    }
}

$pdoManager = new DBManager('maisonbayeul');
$pdo = $pdoManager->getPDO();

$productUploader = new ProductUploader($pdo);
$productUploader->uploadProduct();
?>
