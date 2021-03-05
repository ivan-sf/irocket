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
$query = "SELECT * FROM products 
    INNER JOIN productdetails 
    ON products.idproducts=productdetails.products_idproducts
    INNER JOIN inventory
    ON products.inventory_idinventory=inventory.idinventory
    INNER JOIN inventorydetails
    ON products.inventory_idinventory=inventorydetails.inventory_idinventory
    WHERE products.stateBD = 1
    ORDER BY products.idproducts desc
    LIMIT 20";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if (isset($_POST['alumnos'])) {
  $q = $conexion->real_escape_string($_POST['alumnos']);


  $palabras = explode(" ", $q);
  $contadorPala = count($palabras);
  if ($contadorPala == 1) {
    $query = "SELECT * FROM products 
        INNER JOIN productdetails 
        ON products.idproducts=productdetails.products_idproducts
        WHERE 
        products.stateBD = 1 AND products.codeProduct = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_promotion = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_promotion2 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_4 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_5 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_6 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_7 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_8 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_9 = '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_10 = '$palabras[0]' 
        LIMIT 1";
  } elseif ($contadorPala == 2) {
    $query = "SELECT * FROM products 
        INNER JOIN productdetails 
        ON products.idproducts=productdetails.products_idproducts
        WHERE 
        products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
        products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
        products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'
        LIMIT 20";
  } elseif ($contadorPala == 3) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'
  LIMIT 20";
  } elseif ($contadorPala == 4) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'
  LIMIT 20";
  } elseif ($contadorPala == 5) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'
  LIMIT 20";
  } elseif ($contadorPala == 6) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'
  LIMIT 20";
  } elseif ($contadorPala == 7) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'
  LIMIT 20";
  } elseif ($contadorPala == 8) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[7]%'
  LIMIT 20";
  } elseif ($contadorPala == 9) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[7]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[8]%'
  LIMIT 20";
  } elseif ($contadorPala == 10) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[2]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[3]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[4]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[5]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[6]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[7]%'AND
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[8]%'
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[9]%'
  LIMIT 0";
  } elseif ($contadorPala > 10) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_4 LIKE '%$palabras[0]%'OR 
  products.stateBD = 1 AND products.codeProduct_5 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_6 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_7 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_8 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_9 LIKE '%$palabras[0]%'OR
  products.stateBD = 1 AND products.codeProduct_10 LIKE '%$palabras[0]%' OR
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$q%'
  LIMIT 0";
  }
}




$buscarProductos = $conexion->query($query);

if ($buscarProductos->num_rows > 0) {

?>
  <table class="table stylish-table">
      
      </table>
        
      <?php
  while ($r = $buscarProductos->fetch_object()) :
?>
<form action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocartCompra.php" method="POST">
<table class="table stylish-table">
<thead>
          <tr>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Codigo</th>
              <th>Cantidad</th>
              <th>Existencias</th>
              <th>Compra</th>
              <th>Iva</th>
              <th>Opcion</th>
          </tr>
      </thead>
      <tbody>
          <tr>
          <td>
            <span class="round"><img src="<?php echo URL . $r->ruta; ?>"width="50"></span>
          </td>
          <td width="100px">
            <?php echo strtolower($r->nameProduct); ?>
          </td>
          <td>  
            <?php echo $r->codeProduct; ?>
          </td>
              <input type="hidden" name="inventory_idinventory" value="<?php echo $r->inventory_idinventory; ?>">
              <input type="hidden" name="nameProduct" value="<?php echo $r->nameProduct; ?>">
              <input type="hidden" name="codigo" value="<?php echo $r->codeProduct; ?>">

              <input type="hidden" name="ubicacionAlmacen" value="<?php echo $r->ubicacionAlmacen; ?>">
              <input type="hidden" name="ubicacionBodega" value="<?php echo $r->ubicacionBodega; ?>">
              <input type="hidden" name="unidadesCaja" value="<?php echo $r->unidadesCaja; ?>">
              <input type="hidden" name="presentacionFarmaceutica" value="<?php echo $r->presentacionFarmaceutica; ?>">
              <input type="hidden" name="consentracion" value="<?php echo $r->consentracion; ?>">
              <input type="hidden" name="laboratorio" value="<?php echo $r->laboratorio; ?>">
              <input type="hidden" name="registroSanitario" value="<?php echo $r->registroSanitario; ?>">
              <input type="hidden" name="inventory_idinventory" value="<?php echo $r->inventory_idinventory; ?>">
              
              <input type="hidden" name="iva" value="<?php echo $r->iva; ?>">
              <input type="hidden" name="products_idproducts" value="<?php echo $r->products_idproducts; ?>">
              <input type="hidden" name="SESSIONCAJA" value="<?php echo $_SESSION['cash'] ?>">
              <input type="hidden" name="SESSION" value="<?php 
                if(isset($_SESSION['adminUserNew'])){
                  echo $_SESSION['adminUserNew'];
                }else{
                  echo $_SESSION['administrador'];
                }
               ?>">




                
              <td>
   
              
              <input min="1" name="cantidadP" id="cantidadP" style="width: 60px;" class="form-control" type="number" value="1"></td>

              <td>
                <center><h3 class="mb-0"><?php echo $r->quantityProduct; ?></h3 ></center>
              </td>
              <td>
                
              <input type="hidden" name='precioCompra' value="<?php echo $r->precio; ?>">


              <input type="hidden" name="precioVenta" value="<?php echo $r->price_buy; ?>">
              <center><h4 class="mb-0"><?php echo number_format($r->price_buy); ?></h4 ></center>

                

                  
              </div>
              <center>







              </td>
              <td>
                <center><h3 class="mb-0"><?php echo $r->iva; ?>%  </h3 ></center>
              </td>
              <input type="hidden" name="lote" value="">
              <input type="hidden" name="vencimiento" value="">
              <td>
                <button class="btn waves-effect waves-light btn-rounded btn-outline-success">AGREGAR</button>
                <a href="productos/detalles?id=<?php echo $r->products_idproducts ?>&configurar" target="_blank" class="btn waves-effect waves-light btn-rounded btn-outline-warning">EDITAR</a>
            </td>
          </tr>
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