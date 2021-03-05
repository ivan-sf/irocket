<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
$host = 'localhost';
$basededatos = 'irocket';
$usuario = 'root';
$contraseña = '';

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
    LIMIT 0";

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
        products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'
        LIMIT 20";
  } elseif ($contadorPala == 2) {
    $query = "SELECT * FROM products 
        INNER JOIN productdetails 
        ON products.idproducts=productdetails.products_idproducts
        WHERE 
        products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[0]%'AND
        products.stateBD = 1 AND productdetails.nameProduct LIKE '%$palabras[1]%'
        LIMIT 20";
  } elseif ($contadorPala == 3) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$palabras[0]%'OR 
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
  LIMIT 20";
  } elseif ($contadorPala > 10) {
    $query = "SELECT * FROM products 
  INNER JOIN productdetails 
  ON products.idproducts=productdetails.products_idproducts
  WHERE 
  products.stateBD = 1 AND products.codeProduct LIKE '%$q%'OR 
  products.stateBD = 1 AND productdetails.nameProduct LIKE '%$q%'
  LIMIT 20";
  }
}




$buscarProductos = $conexion->query($query);

if ($buscarProductos->num_rows > 0) {

  while ($r = $buscarProductos->fetch_object()) :

  $tabla 
?>


<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin:0.5em">
  <div class="white-box">
    <div class="el-card-item">
      <div  class="el-overlay-1">
        <img height="150px" src="<?php echo URL . $r->ruta; ?>">
        <div class="el-overlay">
          <ul class="el-info">

            <li>
              <a class="btn default btn-outline" href="javascript:void(0);">

                <form class="form-inline" onsubmit="return checkSubmit();" method="post" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocart2.php">

                  <div class="form-group">

                    <input type="hidden" name="product_id" class="product_id" value="<?php echo $r->idproducts; ?>">
                    <input type="hidden" name="codeProduct_promotion" value="<?php echo $r->codeProduct_promotion; ?>">
                    <input type="hidden" name="caja" id="caja" value="<?php echo "ventas"; ?>">
                    <input type="hidden" name="codeProduct" id="codeProduct<?php echo $r->idproducts; ?>" value="<?php echo $r->codeProduct; ?>">
                    <input type="hidden" name="precio" value="<?php echo $r->precio; ?>">
                    <input type="hidden" name="precio2" value="<?php echo $r->price_buy; ?>">
                    <input type="hidden" name="precio_promotion" value="<?php echo $r->precio_promotion; ?>">
                    <input type="hidden" name="nameProduct" value="<?php echo $r->nameProduct; ?>">
                    <input type="number" name="q" value="1" style="width:60px" min="1" class="form-control" placeholder="Cantidad">
                  </div>
                  <button type="submit" class="btn btn-primary" style="width:60px;">
                    <center><span style="font-size:7pt;">Agregar</span></center>
                  </button>
                </form>

              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="el-card-content">
        <?php
        if ($r->precio_promotion == $r->precio) { ?>
          <span class="pro-price bg-"><b><?php echo number_format($r->precio); ?></b></span><br>
          <span class="pro-price bg-"><b><?php //echo number_format($r->precio_promotion); 
                                          ?></b></span>
          <span class="pro-price bg-"><b><?php //echo number_format($r->precio_promotion2); 
                                          ?></b></span>



          <?php if ($r->totalItemsInventory > 0) : ?>
            <span class="pro-price bg-success"><small><b><?php echo number_format($r->totalItemsInventory); ?></b></small></span>
          <?php endif ?>

          <?php if ($r->totalItemsInventory <= 0) : ?>
            <span class="pro-price bg-danger"><small><b><?php echo number_format($r->totalItemsInventory); ?></b></small></span>
          <?php endif ?>


        <?php } elseif ($r->precio_promotion != $r->precio) { ?>


          <span class="pro-price bg-"><b><?php echo number_format($r->precio); ?></b></span><br>



          <?php if ($r->totalItemsInventory > 0) : ?>
            <span class="pro-price bg-success"><small><b><?php echo number_format($r->totalItemsInventory); ?></b></small></span>
          <?php endif ?>

          <?php if ($r->totalItemsInventory <= 0) : ?>
            <span class="pro-price bg-danger"><small><b><?php echo number_format($r->totalItemsInventory); ?></b></small></span>
          <?php endif ?>

        <?php } ?>
        <h3 class="box-title m-b-0">

          <?php $texto = $r->nameProduct;
          $codeProduct = $r->codeProduct;
          $descriptionProduct = $r->descriptionProduct;
          $presentationFarm = $r->presentationFarm;
          $dosis = $r->dosis;

          $codeProductP = $r->codeProduct_promotion; ?>

          <small><b><?php echo $texto;   ?></b></small>
          <?php //echo substr($texto,0,15); 
          ?><br><br>
          <?php if ($presentationFarm != '') { ?>
            <small>Presentacion</small> <br>
            <small><b><?php echo $presentationFarm;   ?></b></small> <br>
          <?php } ?>

          <?php if ($dosis != '') { ?>
            <small>Dosis</small> <br>
            <small><b><?php echo $dosis;   ?></b></small> <br>
          <?php } ?>

          <?php if ($descriptionProduct != '') { ?>
            <small>Descripcion</small> <br>
            <small><b><?php echo $descriptionProduct;   ?></b></small> <br>
          <?php } ?>



          <?php

          if ($r->precio_promotion == $r->precio) {
            //echo "<b>Cod:</b> ".$codeProduct . "<br>"; 
          } elseif ($r->precio_promotion != $r->precio) {
            //echo "<b>Cod:</b> ".$codeProduct . "<br>"; 
          }
          ?>


        </h3>
        <br>
      </div>
    </div>
  </div>
</div>

<?php endwhile;
} else {
  $tabla = "";
}


echo $tabla;
?>

<script>
  $('.agregarBusq').click(function() {
    alert($('#codeProduct').val())
  });
</script>