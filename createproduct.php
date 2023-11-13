<?php
session_start();
if (!isset($_SESSION['username'])) {
    include_once __DIR__. '/../createproduct.php';
     
}
include_once 'templates/adminheader.php'?>
    <br>
    <br>
    <form action="methodes/productCreate.php" method="post" enctype="multipart/form-data">
        <label for="pname">Nom Du Produit :</label>
        <input type="text" id="pname" name="pname" required><br><br>
        <label for="pprice">Prix Du Produit :</label>
        <input type="text" id="pprice" name="pprice" required><br><br>
        <label for="pdesc">Description Du Produit :</label>
        <input type="text" id="pdesc" name="pdesc" required><br><br>
        <label for="pprice">Stock Du Produit :</label>
        <input type="text" id="pstock" name="pstock" required><br><br>
        <label for="image">Image Du Produit :</label>
        <input type="file" id="pimage" name="pimage" accept="image/*"><br><br>
        <input type="submit" value="Mettre en ligne le produit">
    </form>
</body>
</html>
