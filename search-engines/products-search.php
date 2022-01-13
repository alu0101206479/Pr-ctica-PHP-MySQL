<?php
 include("../db.php");
 
 $salida = "";
 
   $query = "SELECT * FROM PRODUCTOS ORDER BY nombre ASC";
  
   if(isset($_POST['consulta-producto'])) {
           $q = $conn->real_escape_string($_POST['consulta-producto']);
           $query = "SELECT * FROM PRODUCTOS WHERE " . $_POST['campo-producto'] . " LIKE '%". $q . "%'";
   }
   
   $result = mysqli_query($conn, $query);
   
   if(mysqli_num_rows($result) > 0) {
 
           $salida = "<table id='tabla-productos' class='table center-elements'>
                         <thead>
                            <tr>
                                <th id='nombre-producto' name='nombre'>Nombre ▼</th>
                                <th id='familia-producto' name='familia'>Familia</th>
                                <th id='id-producto' name='id'>ID</th>
                                <th id='descripcion-producto' name='descripcion'>Descripción</th>
                                <th id='stock-producto' name='stock'>Stock</th>
                                <th id='dimensiones-producto' name='dimensiones'>Dimensiones</th>
                                <th id='peso-pvp-producto' name='peso_pvp'>Peso PVP</th>
                                <th id='imagen-producto' name='imagen'>Imagen</th>
                            </tr>
                          </thead>
                          <tbody id='body-tabla-productos'>";
                          
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
            $salida.="</tbody></table>";
            
   } else {
           $salida = "No se han encontrado resultados";
   }
   
   echo $salida;

?>