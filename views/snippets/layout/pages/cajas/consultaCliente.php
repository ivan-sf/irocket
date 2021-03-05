<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
$host = 'localhost';
$basededatos = 'irocket';
$usuario = 'root';
$contraseña = '';
session_start();

$conexion = new mysqli($host, $usuario, $contraseña, $basededatos);


//////////////// VALORES INICIALES ///////////////////////
$tabla = "";
$query = "SELECT * FROM users 
INNER JOIN userdetails 
ON users.idusers=userdetails.users_idusers
WHERE users.stateBD = 1 AND userdetails.range=2
ORDER BY users.idusers desc";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if (isset($_POST['alumnos'])) {
  $q = $conexion->real_escape_string($_POST['alumnos']);


  //$palabras = explode(" ", $q);
  //$contadorPala = count($palabras);
  $query = "SELECT * FROM users 
  INNER JOIN userdetails 
  ON users.idusers=userdetails.users_idusers
  WHERE users.stateBD = 1 AND userdetails.range=2
  ORDER BY users.idusers desc";
}


$buscarClientes = $conexion->query($query);

if ($buscarClientes->num_rows > 0) {

?>
  <table class="table stylish-table">
      
      </table>
        
      <?php
  while ($r = $buscarClientes->fetch_object()) :
?>
<form action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocartVenta.php" method="POST">
<table class="table stylish-table">
<thead>
          <tr>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Venta</th>
              <th>Lote</th>
              <th>Vencimiento</th>
              <th>Opcion</th>
          </tr>
      </thead>
      
      <tbody>
      <td>
        <span class="round"><img src="<?php echo URL . $r->ruta; ?>"width="50"></span>
      </td>
      </tbody>
</table>
</form>

<?php endwhile; ?>

<?php } else ?>

    

<?php {
  $tabla = "";
}


echo $tabla;
  ?>


<script>
    $('#agregarProducto').click(function() {
      alert("Hola mundo")
    });
   
  </script>