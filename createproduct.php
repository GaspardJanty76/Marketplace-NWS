<?php
session_start();
if (!isset($_SESSION['username'])) {
    include_once __DIR__. '/../createproduct.php';
     
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Création de Produit</title>
</head>
<body>
    <h1>Bienvenue, <?php $connectedUsername = $_SESSION['username']; echo $connectedUsername; ?></h1>
    <form method="POST" action="methodes/productCreate.php" enctype="multipart/form-data">
        <label for="pname">Nom Du Produit :</label>
        <input type="text" id="pname" name="pname" required><br><br>
        <label for="pprice">Prix Du Produit :</label>
        <input type="text" id="pprice" name="pprice" required><br><br>
        <label for="pdesc">Description Du Produit :</label>
        <input type="text" id="pdesc" name="pdesc" required><br><br>
        <label for="pprice">Stock Du Produit :</label>
        <input type="text" id="pstock" name="pstock" required><br><br>
        <label for="pimage">Image Du Produit :</label>
        <input type="file" id="pimage" accept="image/*"><br><br>
        <input type="submit" value="Mettre en ligne le produit">
    </form>
</body>
</html>
