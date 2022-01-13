<?php
    include("db.php");

    if (isset($_GET['dni'])) {
        $dni = $_GET['dni'];
        $query = "DELETE FROM CLIENTES WHERE dni = '$dni'";
        
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo $query;
            die("Delete query failed!");
        }
        
        header("Location: clients.php");
    }
    
    if (isset($_GET['id_producto'])) {
        $id = $_GET['id_producto'];
        $query = "DELETE FROM PRODUCTOS WHERE id = '$id'";
        
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo $query;
            die("Delete query failed!");
        }
        
        header("Location: products.php");
    }
    
    if (isset($_GET['id_compra'])) {
        $id = $_GET['id_compra'];
        $query = "DELETE FROM COMPRAS WHERE id = '$id'";
        
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo $query;
            die("Delete query failed!");
        }
        
        header("Location: purchases.php");
    }
?>