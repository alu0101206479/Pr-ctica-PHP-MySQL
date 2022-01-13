<?php
 include("../db.php");
 
 $salida = "";
 
   $query = "SELECT * FROM CLIENTES ORDER BY nombre ASC";
  
   if(isset($_POST['consulta-cliente'])) {
           $q = $conn->real_escape_string($_POST['consulta-cliente']);
           $query = "SELECT * FROM CLIENTES WHERE " . $_POST['campo-cliente'] . " LIKE '%". $q . "%'";
   }
   
   $result = mysqli_query($conn, $query);
   
   if(mysqli_num_rows($result) > 0) {
 
           $salida = "<table class='table center-elements' id='tabla-clientes'>
                    <thead>
                        <tr>
                            <th id='nombre-cliente' name='nombre'>Nombre ▼</th>
                            <th id='apellidos-cliente' name='apellidos'>Apellidos</th>
                            <th id='email-cliente' name='email'>Correo electrónico</th>
                            <th id='telefono-cliente' name='telefono'>Teléfono</th>
                            <th id='dp-cliente' name='direccion_postal'>Dirección postal</th>
                            <th id='cp-cliente' name='codigo_postal'>Código postal</th>
                            <th id='dni-cliente' name='dni'>DNI</th>
                        </tr>
                    </thead>
                    <tbody id='body-tabla-cliente'>";
                          
            while($row = mysqli_fetch_assoc($result)) {
                $salida.= "<tr>
                    <td>".$row['nombre']."</td>
                    <td>".$row['apellidos']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['telefono']."</td>
                    <td>".$row['direccion_postal']."</td>
                    <td>".$row['codigo_postal']."</td>
                    <td>".$row['dni']."</td>
                    <td>
                        <a href='edit_clients.php?dni=".$row['dni']."'>
                            Editar
                        </a>
                        <a href='delete.php?dni=".$row['dni']."'>
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