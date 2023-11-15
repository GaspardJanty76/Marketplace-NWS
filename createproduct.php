<?php
session_start();
if (isset($_SESSION['username'])) {
    include_once 'templates/adminheader.php';
    echo '<br><br>';
    echo '<form action="methodes/productCreate.php" method="post" enctype="multipart/form-data">';
    echo '<label for="pname">Nom Du Produit :</label>';
    echo '<input type="text" id="pname" name="pname" required><br><br>';
    echo '<label for="pprice">Prix Du Produit :</label>';
    echo '<input type="text" id="pprice" name="pprice" required><br><br>';
    echo '<label for="pdesc">Description Du Produit :</label>';
    echo '<input type="text" id="pdesc" name="pdesc" required><br><br>';
    echo '<label for="pprice">Stock Du Produit :</label>';
    echo '<input type="text" id="pstock" name="pstock" required><br><br>';
    echo '<label for="image">Image Du Produit :</label>';
    echo '<input type="file" id="pimage" name="pimage" accept="image/*"><br><br>';
    echo '<input type="submit" value="Mettre en ligne le produit">';
    echo '</form>';
}
else{
    header("Location: adminauth.php");
    exit();
}

?>

