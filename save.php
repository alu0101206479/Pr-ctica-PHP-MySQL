<?php
    include("db.php");

    if (isset($_POST['save_client'])){
        $user_name = $_POST['user_name'];
        $user_last_name = $_POST['user_last_name'];
        $user_mail = $_POST['user_mail'];
        $user_phone = $_POST['user_phone'];
        $user_postal_address = $_POST['user_postal_address'];
        $user_postal_code = $_POST['user_postal_code'];
        $user_dni = $_POST['user_dni'];
        
        $query = "INSERT INTO CLIENTES(nombre, apellidos, email, telefono, direccion_postal, codigo_postal, dni) VALUES ('$user_name', '$user_last_name', '$user_mail', '$user_phone', '$user_postal_address', $user_postal_code, '$user_dni')";
        
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Insert query failed!");
        }

        header("Location: clients.php");
    }
    
    if (isset($_POST['save_product'])){
        $product_name = $_POST['product_name'];
        $product_family = $_POST['product_family'];
        $product_description = $_POST['product_description'];
        $product_stock = $_POST['product_stock'];
        $product_dimensions = $_POST['product_dimensions'];
        $product_peso_PVP = $_POST['product_peso_PVP'];
        $product_image = addslashes(file_get_contents($_FILES['product_image']['tmp_name']));
        
        $query = "INSERT INTO `PRODUCTOS` (`nombre`, `familia`, `id`, `descripcion`, `stock`, `dimensiones`, `peso_PVP`, `imagen`) VALUES ('$product_name', '$product_family', NULL, '$product_description', '$product_stock', '$product_dimensions', '$product_peso_PVP', '$product_image')";
        
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo $query;
            die("Insert query failed!");
        }

        header("Location: products.php");
    }
    
    if (isset($_POST['save_purchase'])){
    
            if (isset($_POST['products']) && isset($_POST['products'])) {
                    $purchase_dni = $_POST['purchase_dni'];
                    $array = [
                            "productos" => [],
                    ];
            
                    $products = $_POST['products'];
                    $quantities = $_POST['quantities'];
                    
                    for($i = 0, $size = count($products); $i < $size; ++$i) {
                            $query_nombre_producto = "SELECT nombre FROM PRODUCTOS WHERE id=" . $products[$i];
                            $result_nombre_producto = mysqli_query($conn, $query_nombre_producto);
                                                      
                            $array_aux = [
                                    "id" => $products[$i],
                                    "nombre" => mysqli_fetch_assoc($result_nombre_producto)['nombre'],
                                    "cantidad" => $quantities[$i],
                            ];
                            array_push($array['productos'], $array_aux);
                    }
                    
                    $products_json = json_encode($array);
                    
                    $query = "INSERT INTO `COMPRAS` (`id`, `dni_cliente`, `prod_cant`) VALUES (NULL, '$purchase_dni', '$products_json')";
                    
                    $result = mysqli_query($conn, $query);
                    
                    if (!$result) {
                        echo $query;
                        echo $result;
                        die("Insert query failed!");
                    }
                
                    header("Location: purchases.php");
            }

    }
?>