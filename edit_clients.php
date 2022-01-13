<?php
    include("db.php");

    $dni_antiguo = $_GET['dni'];

    if (isset($_POST['edit_client'])){
        
        $user_name = $_POST['user_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_mail = $_POST['user_mail'];
        $user_phone = $_POST['user_phone'];
        $user_postal_address = $_POST['user_postal_address'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_dni = $_POST['user_dni'];
        
        $query = "UPDATE CLIENTES SET nombre = '$user_name', apellidos = '$user_last_name', email = '$user_mail', telefono = '$user_phone', direccion_postal = '$user_postal_address', codigo_postal = '$user_postal_code', dni = '$user_dni' WHERE dni = '$dni_antiguo'";
        
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Edit query failed!");
        }

        header("Location: clients.php");
    }
?>

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
                <form action="save_client.php" method="POST">
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
        <div class="scroll">
                <table class="table center-elements">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo electrónico</th>
                            <th>Teléfono</th>
                            <th>Dirección postal</th>
                            <th>Código postal</th>
                            <th>DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="edit_clients.php?dni=<?php echo $dni_antiguo ?>" method="POST">
                            <?php
                                $query = "SELECT * FROM CLIENTES";
                                $result = mysqli_query($conn, $query);
                                
                                while($row = mysqli_fetch_array($result)) {
                                    if ($row['dni'] == $dni_antiguo) {?>
                                        <tr id="edit-row">
                                            <td><input type="text" id="name" name="user_name" value="<?php echo $row['nombre'] ?>"></td>
                                            <td><input type="text" id="last_name" name="user_last_name" value="<?php echo $row['apellidos'] ?>"></td>
                                            <td><input type="email" id="mail" name="user_mail" value="<?php echo $row['email'] ?>"></td>
                                            <td><input type="text" id="phone" name="user_phone" value="<?php echo $row['telefono'] ?>"></td>
                                            <td><textarea id="postal_address" name="user_postal_address"><?php echo $row['direccion_postal'] ?></textarea></td>
                                            <td><input type="number" id="postal_code" name="user_postal_code" value="<?php echo $row['codigo_postal'] ?>"></td>
                                            <td><input type="text" id="dni" name="user_dni" value="<?php echo $row['dni'] ?>"></td>
                                            <td>
                                                <button type="submit" name="edit_client">Actualizar</button>
                                            </td>
                                        </tr>
                                    <?php } else {?>
                                    <tr>
                                        <td><?php echo $row['nombre'] ?></td>
                                        <td><?php echo $row['apellidos'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['telefono'] ?></td>
                                        <td><?php echo $row['direccion_postal'] ?></td>
                                        <td><?php echo $row['codigo_postal'] ?></td>
                                        <td><?php echo $row['dni'] ?></td>
                                        <td>
                                            <a href="edit_clients.php?dni=<?php echo $row['dni']?>">
                                                Editar
                                            </a>
                                            <a href="delete.php?dni=<?php echo $row['dni']?>">
                                                Borrar
                                            </a>
                                        </td>
                                     </tr>
                                    <?php }
                            } ?>
                        </form>
                    </tbody>
                </table>
           </div>
    </div>
    
    
    
    
    
    
</body>
</html>
