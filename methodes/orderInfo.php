<?php
echo '<h1>Formulaire de Commande</h1>';
echo '<form method="post" action="">';
echo 'Nom : <input type="text" name="nom"><br>';
echo 'Prenom : <input type="text" name="prenom"><br>';
echo 'Adresse : <input type="text" name="adresse"><br>';
echo 'Ville : <input type="text" name="ville"><br>';
echo 'Code postal : <input type="text" name="code_postal"><br>';
echo '<input type="submit" value="Confirmer la commande">';
echo '</form>';
echo '<p><a href="panier.php">Retour au panier</a></p>';
?>
