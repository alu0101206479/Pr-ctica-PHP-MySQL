<?php
    include("db.php");

    if (isset($_POST['edit_product'])){
        
        $product_name = $_POST['product_name'];
        $product_family = $_POST['product_family'];
        $product_id = $_GET['id_producto'];
        $product_description = $_POST['product_description'];
        $product_stock = $_POST['product_stock'];
        $product_dimensions = $_POST['product_dimensions'];
        $product_peso_PVP = $_POST['product_peso_PVP'];

        if(!empty($_FILES["product_image"]["tmp_name"])) {
                $product_image = addslashes(file_get_contents($_FILES['product_image']['tmp_name']));
                $query = "UPDATE PRODUCTOS SET nombre = '$product_name', familia = '$product_family', id = id, descripcion = '$product_description', stock = '$product_stock', dimensiones = '$product_dimensions', peso_PVP = '$product_peso_PVP', imagen = '$product_image' WHERE id = '$product_id'";
        } else {
                $query = "UPDATE PRODUCTOS SET nombre = '$product_name', familia = '$product_family', id = id, descripcion = '$product_description', stock = '$product_stock', dimensiones = '$product_dimensions', peso_PVP = '$product_peso_PVP' WHERE id = '$product_id'";
        }
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo $query;
            die("Edit query failed!");
        }


        header("Location: products.php");
    }
?>

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
        <div class="scroll">
                <table class="table center-elements">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Familia</th>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Stock</th>
                            <th>Dimensiones</th>
                            <th>Peso PVP</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="edit_product.php?id_producto=<?php echo $_GET['id_producto'] ?>" method="POST" enctype="multipart/form-data">
                            <?php
                                $query = "SELECT * FROM PRODUCTOS";
                                $result = mysqli_query($conn, $query);
                                
                                while($row = mysqli_fetch_array($result)) {
                                    if ($row['id'] == $_GET['id_producto']) {?>
                                        <tr id="edit-row">
                                            <td><input type="text" id="name" name="product_name" value="<?php echo $row['nombre'] ?>"></td>
                                            <td><input type="text" id="family" name="product_family" value="<?php echo $row['familia'] ?>"></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><textarea type="text" id="description" name="product_description"><?php echo $row['descripcion'] ?></textarea></td>
                                            <td><input type="number" id="stock" name="product_stock" value="<?php echo $row['stock'] ?>"></td>
                                            <td><input type="text" id="dimensions" name="product_dimensions" value="<?php echo $row['dimensiones'] ?>"></td>
                                            <td><input type="text" id="peso_PVP" name="product_peso_PVP" value="<?php echo $row['peso_PVP'] ?>"></td>
                                            <td><?php echo '<img class = "imagenProducto" src = "data:image/png;base64,' . base64_encode($row['imagen']) . '"/>' ?><input type="file" id="image" name="product_image" placeholder="Imagen"></td>
                                            <td>
                                                <button type="submit" name="edit_product">Actualizar</button>
                                            </td>
                                        </tr>
                                    <?php } else {?>
                                    <tr>
                                            <td><?php echo $row['nombre'] ?></td>
                                            <td><?php echo $row['familia'] ?></td>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['descripcion'] ?></td>
                                            <td><?php echo $row['stock'] ?></td>
                                            <td><?php echo $row['dimensiones'] ?></td>
                                            <td><?php echo $row['peso_PVP'] ?></td>
                                            <td><?php echo '<img class = "imagenProducto" src = "data:image/png;base64,' . base64_encode($row['imagen']) . '"/>' ?></td>
                                            <td>
                                                <a href="edit_product.php?id_producto=<?php echo $row['id']?>">
                                                    Editar
                                                </a>
                                                <a href="delete.php?id_producto=<?php echo $row['id']?>">
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