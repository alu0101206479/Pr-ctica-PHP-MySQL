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
                <h2 class="center-text title-form">Registro de compras</h2>
                <form action="save.php" method="POST" enctype="multipart/form-data">
                    <label for="name">DNI del cliente:</label>
                    <input class="input" type="text" id="dni" name="purchase_dni" placeholder="DNI" required>

                    <label for="name">Productos:</label><br>
                    <?php
                            $query = "SELECT * FROM PRODUCTOS";
                            $result = mysqli_query($conn, $query);
                            $count = 0;
                            
                            while($row = mysqli_fetch_array($result)) { ?>
                            <div id="producto-<?php echo $count ?>" class="inline_block">
                                    <label class="label-product-purchase"><input id="check-<?php echo $count ?>"class="checkbox-purchase" type="checkbox" id=<?php echo $row['nombre'] ?> name="products[]" value="<?php echo $row['id'] ?>" value="yes"> <?php echo $row['nombre'] ?></label>
                            </div><br>
                            
                            <?php
                            $count = $count+1;
                       } ?>
        
                    <button class="button-form" type="submit" name="save_purchase">Registrar producto</button>
                </form>
        </div>
        <h2 class="center-text">Listado de compras</h2>
        <h3>Buscar</h3>
        
        <input class="input" type="text" id="buscar-compra" name="buscar-compra" placeholder="Buscar">
           <select name="campo-compra" id="campo-compra">
             <option value="id">ID</option>
             <option value="dni_cliente">DNI del cliente</option>
             <option value="prod_cant">Productos comprados</option>
           </select>
        <br>
        <br>
        
        <div class="scroll" id="datos-compras">

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/purchases.js"></script>
</body>
</html>