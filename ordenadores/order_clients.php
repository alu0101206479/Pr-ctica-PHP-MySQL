<?php
 include("../db.php");
 
  
  
   if(isset($_GET['campo-orden']) && isset($_GET['asc-desc'])) {
           $query = "SELECT * FROM CLIENTES ORDER BY " . $_GET['campo-orden'] . " " . $_GET['asc-desc'];
           $result = mysqli_query($conn, $query);
           
           
           $salida = "";
           while($row = mysqli_fetch_assoc($result)) {
                $salida .= "<tr>
                    <td>".$row['nombre']."</td>
                    <td>".$row['apellidos']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['telefono']."</td>
                    <td>".$row['direccion_postal']."</td>
                    <td>".$row['codigo_postal']."</td>
                    <td>".$row['dni']."</td>
                    <td>
                        <a href='edit.php?dni=".$row['dni']."'>
                            Editar
                        </a>
                        <a href='delete.php?dni=".$row['dni']."'>
                            Borrar
                        </a>
                    </td>
                </tr>";
            }
            
            echo $salida;
   }

?>