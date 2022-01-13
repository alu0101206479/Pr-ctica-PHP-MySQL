<?php
 include("../db.php");
 
  
  
   if(isset($_GET['campo-orden']) && isset($_GET['asc-desc'])) {
           $query = "SELECT * FROM COMPRAS ORDER BY " . $_GET['campo-orden'] . " " . $_GET['asc-desc'];
           $result = mysqli_query($conn, $query);
           
           
           $salida = "";
           while($row = mysqli_fetch_assoc($result)) {
                $salida.= "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['dni_cliente']."</td>
                        <td>";

                $json_productos = json_decode($row['prod_cant'], true);

                foreach ($json_productos['productos'] as $producto) {
                    $salida.= $producto['cantidad'] . " de " . $producto['nombre'] . ", ";
                }
                        
                        
                        
                $salida.= "</td><td>
                            <a href='delete.php?id_compra=".$row['id']."'>
                                Borrar
                            </a>
                        </td>
                </tr>";
            }
            
            echo $salida;
   }

?>