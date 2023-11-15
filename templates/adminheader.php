<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cartes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>Maison Bayeul</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="brand"><?php $connectedUsername = $_SESSION['username']; echo $connectedUsername; ?></div>
            <ul class="nav-links">
                <li><a href="createproduct.php">Créer un produit</a></li>
                <li><a href="modifyproduct.php">Modifier les produits</a></li>
                <li><a href="stockproduct.php">Gestion des stocks</a></li>
            </ul>
            <div class="icon">
                <a href="/../GitHub/Marketplace-NWS/methodes/adminUnAuth.php"><i class="fa fa-sign-out"></i></a>
            </div>
        </nav>
    </header>