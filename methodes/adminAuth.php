<?php
require_once 'dbConnect.php';

class Authentification {
    private $pdo;

    public function __construct(DBManager $pdoManager) {
        $this->pdo = $pdoManager->getPDO();
    }

    public function verifierAuthentification($pseudo, $mot_de_passe) {
        $sql = "SELECT * FROM oauth WHERE auth = :pseudo";
        $requete = $this->pdo->prepare($sql);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
            session_start();

            // Définir une durée de vie pour la session (30 minutes)
            $session_duration = 60; // 1 minute en secondes
            session_set_cookie_params($session_duration);

            // Stockez des informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $utilisateur['id'];
            $_SESSION['username'] = $utilisateur['auth'];

            return true;
        }

        return false;
    }
}

$pdoManager = new DBManager("maisonbayeul");

$auth = new Authentification($pdoManager);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['auth'];
    $mot_de_passe = $_POST['password'];

    if ($auth->verifierAuthentification($pseudo, $mot_de_passe)) {
        // Redirigez l'utilisateur vers la page "createproduct.php"
        header("Location: ../createproduct.php");
        exit();
    } else {
        echo "L'authentification a échoué. Veuillez réessayer.";
    }
}
?>
