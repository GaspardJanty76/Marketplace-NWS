<?php
require_once("dbConnect.php"); // Assurez-vous que le fichier contenant la classe de gestion de la base de données est inclus ici.

class Authentification {
    private $pdo;

    public function __construct(DBManagement $pdoManager) {
        // Utilisez la connexion à la base de données fournie par le gestionnaire PDOManagerClass.
        $this->pdo = $pdoManager->getPDO();
    }

    public function verifierAuthentification($pseudo, $mot_de_passe) {
        $sql = "SELECT * FROM oauth WHERE auth = :pseudo";
        $requete = $this->pdo->prepare($sql);
        $requete->bindParam(':pseudo', $pseudo);
        $requete->execute();
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['password'])) {
            return true; // Authentification réussie
        }

        return false; // Authentification échouée
    }
}

$pdoManager = new DBManagement("maisonbayeul"); // Initialisez le gestionnaire de connexion.

$auth = new Authentification($pdoManager); // Utilisez la connexion à la base de données via le gestionnaire de connexion.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['auth'];
    $mot_de_passe = $_POST['password'];

    if ($auth->verifierAuthentification($pseudo, $mot_de_passe)) {
        // L'utilisateur est authentifié avec succès
        // Vous pouvez rediriger vers une page sécurisée ou effectuer d'autres actions ici
        echo "Authentification réussie. Vous pouvez accéder à votre compte.";
    } else {
        // L'authentification a échoué, affichez un message d'erreur ou redirigez vers une page de connexion
        echo "L'authentification a échoué. Veuillez réessayer.";
    }
}
?>
