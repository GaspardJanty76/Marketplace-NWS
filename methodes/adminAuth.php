<?php
require_once("dbConnect.php");

class Authentification {
    private $pdo;

    public function __construct(DBManagement $pdoManager) {
        $this->pdo = $pdoManager->getPDO();
    }

    public function verifierAuthentification($pseudo, $mot_de_passe) {
        $sql = "SELECT * FROM oauth WHERE auth = :pseudo";
        $requete = $this->pdo->prepare($sql);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
            return true;
        }

        return false;
    }
}

$pdoManager = new DBManagement("maisonbayeul");

$auth = new Authentification($pdoManager);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['auth'];
    $mot_de_passe = $_POST['password'];

    if ($auth->verifierAuthentification($pseudo, $mot_de_passe)) {
        header("Location:../success.php");
        exit();
    } else {
        echo "L'authentification a échoué. Veuillez réessayer.";
    }
}
?>