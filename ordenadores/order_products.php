<?php
 include("../db.php");
 
   if(isset($_GET['campo-orden']) && isset($_GET['asc-desc'])) {
           $query = "SELECT * FROM PRODUCTOS ORDER BY " . $_GET['campo-orden'] . " " . $_GET['asc-desc'];
           $result = mysqli_query($conn, $query);
           $salida = "";
           
           while($row = mysqli_fetch_assoc($result)) {
                $salida.= "<tr>
                        <td>".$row['nombre']."</td>
                        <td>".$row['familia']."</td>
                        <td>".$row['id']."</td>
                        <td>".$row['descripcion']."</td>
                        <td>".$row['stock']."</td>
                        <td>".$row['dimensiones']."</td>
                        <td>".$row['peso_PVP']."</td>
                        <td><img class = 'imagenProducto' src = 'data:image/png;base64," . base64_encode($row['imagen']) . "'/></td>
                        <td>
                            <a href='edit_product.php?id_producto=".$row['id']."'>
                                Editar
                            </a>
                            <a href='delete.php?id_producto=".$row['id']."'>
                                Borrar
                            </a>
                        </td>
                </tr>";
            }
            
            echo $salida;
   }

?>