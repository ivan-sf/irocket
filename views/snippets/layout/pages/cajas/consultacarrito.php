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
if(isset($_SESSION['administrador'])){
  $user = $_SESSION['administrador'];
}else{
  $user = $_SESSION['adminUserNew'];
}
$query = "SELECT * FROM bills 
        INNER JOIN billdetails 
        ON bills.idbills=billdetails.bills_idbills
        WHERE users_idusers=$user AND stateBillDetail=1 AND typeBill=1
        ORDER BY idbillDetails desc";
///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if (isset($_POST['alumnos'])) {
  $q = $conexion->real_escape_string($_POST['alumnos']);


  if ($q == 1) {
    $query = "SELECT * FROM bills 
        INNER JOIN billdetails 
        ON bills.idbills=billdetails.bills_idbills ";
  } 
}




$buscarProductos = $conexion->query($query);

if ($buscarProductos->num_rows > 0) {

?>
  <table class="table stylish-table">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Venta</th>
              <th>IVA</th>
              <th>Total</th>
          </tr>
      </thead>
  </table>      
<?php
  while ($r = $buscarProductos->fetch_object()) :
?>
  <form action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocartUpdate.php" method="POST">
    <table class="table stylish-table">
        <tbody>
              <td><?php echo $r->nombre; ?>
                <input min="1" name="idupdate" id="idupdate" style="width: 60px;" class="form-control" type="hidden" value="<?php echo $r->idbillDetails; ?>">
                <input min="1" name="caja" id="idupdate" style="width:
                 60px;" class="form-control" type="hidden" value="ventas">
                <input min="1" name="iva" id="iva" style="width: 60px;" class="form-control" type="hidden" value="<?php echo $r->impuesto; ?>">
              </td>

              <?php 
                  if(isset($_SESSION['adminUserNew'])){
                    $iduser = $_SESSION['adminUserNew'];
                  }else{
                    $iduser = $_SESSION['administrador'];
                  }
                ?>




                
                <td><input min="1" name="cantidadP" id="cantidadP" style="width: 60px;" class="form-control" type="number" value="<?php echo $r->cantidad; ?>"></td>
                <td>
                  
                <input min="1" name="idFactura" id="idFactura" style="width: 60px;" class="form-control" type="hidden" value="<?php echo $r->bills_idbills; ?>">



                <div class="form-group m-form__group">
                <?php echo $r->precioUnidad; ?>
      
              <input min="1" name="precioUnidad" id="precioUnidad" style="width: 60px;" class="form-control" type="hidden" value="<?php echo $r->precioUnidad; ?>">

                    
                </div>
                <center>


                </td>
                <td>
                <?php echo $r->ivaPorcentaje; ?>%
                </td>
                <td>
                <?php echo $r->precioUnidad*$r->cantidad; ?>
                  
                </td>

                <td>
                  <button class="btn waves-effect waves-light btn-rounded btn-outline-success">
                    &#10004	
                  </button>

                 
                
                </td>
        </tbody>
    </table>
  </form>
  <form id="formEliminar" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/deleteproducttocart.php" method="POST">
    <input type="hidden" name='caja' value="ventas">
    <input min="1" name="idupdate" id="idupdate" style="width: 60px;" class="form-control" type="hidden" value="<?php echo $r->idbillDetails; ?>">
    <input min="1" name="idFactura" id="idFactura" style="width: 60px;" class="form-control" type="hidden" value="<?php echo $r->bills_idbills; ?>">
    <button type="submit" id="eliminar" class="btn waves-effect waves-light btn-rounded btn-outline-danger">
      Eliminar
    </button>
  </form>

<?php 
endwhile;
} else 
?>

<?php {
  $tabla = "";
}

echo $tabla;
?>

  <script>
    $('.agregarBusq').click(function() {
      alert($('#codeProduct').val())
    });
    
  </script>