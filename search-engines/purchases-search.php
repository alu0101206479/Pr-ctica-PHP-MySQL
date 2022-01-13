<?php
 include("../db.php");
 
 $salida = "";
 
   $query = "SELECT * FROM COMPRAS ORDER BY ID ASC";
  
   if(isset($_POST['consulta-compra'])) {
           $q = $conn->real_escape_string($_POST['consulta-compra']);
           $query = "SELECT * FROM COMPRAS WHERE " . $_POST['campo-compra'] . " LIKE '%". $q . "%'";
   }
   
   $result = mysqli_query($conn, $query);
   
   if(mysqli_num_rows($result) > 0) {
 
           $salida = "<table id='tabla-compras' class='table center-elements'>
                         <thead>
                            <tr>
                                <th id='id-compra' name='id'>ID ▼</th>
                                <th id='dni-cliente-compra' name='dni_cliente'>DNI del cliente</th>
                                <th id='productos-compra' name='prod_cant'>Productos comprados</th>
                            </tr>
                          </thead>
                          <tbody id='body-tabla-compras'>";
                          
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
            $salida.="</tbody></table>";
            
   } else {
           $salida = "No se han encontrado resultados";
   }
   
   echo $salida;

?>