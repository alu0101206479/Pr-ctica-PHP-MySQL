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

    
    
    <div>
        <div class="center-elements insert">
                <h2 class="center-text title-form">Registro de clientes</h2>
                <form action="save.php" method="POST">
                    <label for="name">Nombre:</label>
                    <input class="input" type="text" id="name" name="user_name" placeholder="Nombre">
        
                    <label for="last_name">Apellidos:</label>
                    <input class="input" type="text" id="last_name" name="user_last_name" placeholder="Apellidos">
        
                    <label for="mail">Correo electrónico:</label>
                    <input class="input" type="email" id="mail" name="user_mail" placeholder="Correo electrónico">
        
                    <label for="phone">Teléfono:</label>
                    <input class="input" type="text" id="phone" name="user_phone" placeholder="Teléfono">
        
                    <label for="postal_address">Dirección postal:</label>
                    <textarea class="input" id="postal_address" name="user_postal_address" placeholder="Dirección postal"></textarea>
        
                    <label for="postal_code">Código postal:</label>
                    <input class="input" type="number" id="postal_code" name="user_postal_code" placeholder="Código postal">
        
                    <label for="dni">DNI:</label>
                    <input class="input" type="text" id="dni" name="user_dni" placeholder="DNI">
        
                    <button class="button-form" type="submit" name="save_client">Registrar cliente</button>
                </form>
        </div>
        <h2 class="center-text">Listado de clientes</h2>
                <h3>Buscar</h3>
                        <input class="input" type="text" id="buscar-cliente" name="buscar-cliente" placeholder="Buscar">
                           <select name="campo-cliente" id="campo-cliente">
                             <option value="nombre">Nombre</option>
                             <option value="apellidos">Apellidos</option>
                             <option value="email">Correo electrónico</option>
                             <option value="telefono">Teléfono</option>
                             <option value="direccion_postal">Dirección postal</option>
                             <option value="codigo_postal">Código postal</option>
                             <option value="dni">DNI</option>
                           </select>
                        <br>
                        <br>
                        
                        <div class="scroll" id="datos-clientes">

           </div>
   </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/customers.js"></script>
</body>
</html>