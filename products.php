<?php include("db.php")?>

<!DOCTYPE html>
<html lang="en">
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

    
    
    <div>
        <div class="center-elements insert">
                <h2 class="center-text title-form">Registro de productos</h2>
                <form action="save.php" method="POST" enctype="multipart/form-data">
                    <label for="name">Nombre:</label>
                    <input class="input" type="text" id="name" name="product_name" placeholder="Nombre" required>
        
                    <label for="family">Familia:</label>
                    <input class="input" type="text" id="family" name="product_family" placeholder="Familia" required>
        
                    <label for="description">Descripción:</label>
                    <textarea class="input" type="text" id="description" name="product_description" placeholder="Descripción" required></textarea>
        
                    <label for="stock">Stock:</label>
                    <input class="input" type="number" id="stock" name="product_stock" placeholder="Stock" required>
        
                    <label for="dimensions">Dimensiones:</label>
                    <input class="input" type="text" id="dimensions" name="product_dimensions" placeholder="Dimensiones" required>
        
                    <label for="peso_PVP">Peso PVP:</label>
                    <input class="input" type="text" id="peso_PVP" name="product_peso_PVP" placeholder="Peso PVP" required>
        
                    <label for="image">Imagen:</label>
                    <input class="input" type="file" id="image" name="product_image" placeholder="Imagen">
        
                    <button class="button-form" type="submit" name="save_product">Registrar producto</button>
                </form>
        </div>
        <h2 class="center-text">Listado de productos</h2>
        <h3>Buscar</h3>
        <input class="input" type="text" id="buscar-producto" name="buscar-producto" placeholder="Buscar">
           <select name="campo-producto" id="campo-producto">
             <option value="nombre">Nombre</option>
             <option value="familia">Familia</option>
             <option value="descripcion">Descripción</option>
             <option value="id">ID</option>
             <option value="stock">Stock</option>
             <option value="dimensiones">Dimensiones</option>
             <option value="peso_pvp">Peso PVP</option>
           </select>
        <br>
        <br>
        
        <div class="scroll" id="datos-productos">

           </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/products.js"></script>
</body>
</html>