<script src="views/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="views/snippets/dependencies/cash/includes/index/includes/lista/peticion.js"></script>


<div id="busquedaFormu">
<form onsubmit="return checkSubmit();" style="padding: 12px 20px;" class="" style="display: block;" id="formularioBusquedaProducto">
    <input class="form-control" type="text" autofocus name="busqueda" id="busqueda" placeholder="Buscar producto...">
</form>
</div>


<div id="procesarPago" style="display:none">
<?php 
 if(isset($_SESSION['adminUserNew'])){
    $iduser = $_SESSION['adminUserNew'];
  }else{
    $idUser = $_SESSION['administrador'];
  }
?>

    <form style="padding: 12px 20px;" class="" style="display: block;" id="formularioprocesarCompra" method="POST" action="views/snippets/layout/pages/cajas/php/agregarPagoVenta.php">
        <input type="hidden" name="usuario" value="<?php echo $iduser; ?>">
        <input class="form-control" type="text" autofocus name="pagoCompra" id="pagoCompra" placeholder="Ingresar pago">
    </form>
</div>



<div id="procesarCompra" style="display:none">
<center>Para finalizar su compra presione la tecla enter</center>
<?php 
 if(isset($_SESSION['adminUserNew'])){
    $iduser = $_SESSION['adminUserNew'];
  }else{
    $idUser = $_SESSION['administrador'];
  }
?>

    <form style="padding: 12px 20px;" class="" style="display: block;" id="formularioprocesarCompra" method="POST" action="views/snippets/layout/pages/cajas/php/procesarVenta.php">
    <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
    <table class="table stylish-table">
        <thead>
            <tr>
                <th>Imprimir</th>
                <th>Factura</th>
                <th>Procesar</th>
            </tr>
        </thead>
    </table> 

    <table class="table stylish-table">
      <tbody>
        <td>
        <select name="imprimir" class="form-control" id="exampleFormControlSelect1">
          <option>NO</option>
          <option>SI</option>
        </select>
        </td>
        <td width="450  ">
        <select name="tipo" class="form-control" id="exampleFormControlSelect1">
        <option>POS</option>
          <option>REMISION</option>
          <option>ELECTRONICA</option>
        </select>
        </td>
        <td>
        <input class="form-control" type="text" autofocus name="procesarCompraI" id="procesarCompraI" placeholder="ENTER">
        </td>
      </tbody>
    </table>  

        
        <input type="hidden" name="usuario" value="<?php echo $iduser; ?>">
    </form>
</div>