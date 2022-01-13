<?php include("db.php")?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Práctica 1 - Tema 4 Desarrollo de Aplicaciones</title>
</head>
<body>
    <h1 class="center-text">Práctica 1 - Tema 4 Desarrollo de Aplicaciones</h1>

    <div class="center-elements-flex">
        <button class="managementButton" onclick="window.location='clients.php'">Gestión clientes</button>
        <button class="managementButton" onclick="window.location='products.php'">Gestión productos</button>
        <button class="managementButton" onclick="window.location='purchases.php'">Gestión compras</button>
    </div>
</body>
</html>