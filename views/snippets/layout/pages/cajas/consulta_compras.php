<?php
/////// CONEXIÓN A LA BASE DE DATOS /////////
$host = 'localhost';
$basededatos = 'irocket';
$usuario = 'root';
$contraseña = '';

$conexion = new mysqli($host, $usuario,$contraseña, $basededatos);


//////////////// VALORES INICIALES ///////////////////////

$tabla="";
$query="SELECT * FROM irocket.products 
    INNER JOIN irocket.productdetails 
    ON products.idproducts=productdetails.products_idproducts
    INNER JOIN irocket.inventory
    ON products.inventory_idinventory=inventory.idinventory
    INNER JOIN irocket.inventorydetails
    ON products.inventory_idinventory=inventorydetails.inventory_idinventory
    WHERE products.stateBD = 1
    ORDER BY products.idproducts desc";

///////// LO QUE OCURRE AL TECLEAR SOBRE EL INPUT DE BUSQUEDA ////////////
if(isset($_POST['alumnos']))
{
  $q=$conexion->real_escape_string($_POST['alumnos']);
  $query="SELECT * FROM irocket.products 
        INNER JOIN irocket.productdetails 
        ON products.idproducts=productdetails.products_idproducts
        WHERE products.stateBD = 1 AND products.codeProduct LIKE '%$q%'
        OR products.stateBD = 1 AND products.codeProduct_promotion LIKE '%$q%'
        OR products.stateBD = 1 AND productdetails.nameProduct LIKE '%$q%'
        OR products.stateBD = 1 AND products.price_buy LIKE '%$q%'
        ";
}

$buscarAlumnos=$conexion->query($query);
if ($buscarAlumnos->num_rows > 0)
{

 while($r=$buscarAlumnos->fetch_object()):

  $tabla?> 

  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" style="margin:0.5em">
    <div class="white-box">
      <div class="el-card-item">
        <div style="height: 140px;" class="el-overlay-1">
          <img  height="150px" src="<?php echo URL . $r->ruta;?>">
          <div class="el-overlay">
            <ul class="el-info">
             
              <li>
                <a class="btn default btn-outline" href="javascript:void(0);">

                  <form class="form-inline" onsubmit="return checkSubmit();" method="post" action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocart.php">
                    
                    <div class="form-group">
                      
                      <input type="hidden" name="product_id" value="<?php echo $r->idproducts; ?>">
                      <input type="hidden" name="codeProduct_promotion" value="<?php echo $r->codeProduct_promotion; ?>">
                      <input type="hidden" name="caja" id="caja" value="<?php echo "compras"; ?>">
                      <input type="hidden" name="codeProduct" value="<?php echo $r->codeProduct; ?>">
                      <input type="hidden" name="precio" value="<?php echo $r->precio; ?>">
                      <input type="hidden" name="precio2" value="<?php echo $r->price_buy; ?>">
                      <input type="hidden" name="precio_promotion" value="<?php echo $r->precio_promotion; ?>">
                      <input type="hidden" name="nameProduct" value="<?php echo $r->nameProduct; ?>">
                      <input type="number" name="q" value="1" style="width:60px" min="1" class="form-control" placeholder="Cantidad">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:60px;" ><center><span style="font-size:7pt;">Agregar</span></center></button>
                  </form> 

                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="el-card-content">
          <?php 
          if ($r->precio_promotion == $r->precio) { ?>
          <span class="pro-price bg-success"><small><small><?php echo number_format($r->price_buy); ?></small></small></span><br>
          <?php }elseif ($r->precio_promotion != $r->precio) { ?>
          <span class="pro-price bg-success"><small><small><?php echo number_format($r->price_buy); ?></small></small></span><br>
          <?php } ?>
          <h3 class="box-title m-b-0"><small><?php $texto = $r->nameProduct;
          $codeProduct = $r->codeProduct;

          $codeProductP = $r->codeProduct_promotion;?>
          
          <b><?php //echo $texto;   ?></b>
          <?php echo substr($texto,0,15); ?><br>
          <?php
          
          if ($r->precio_promotion == $r->precio) {
            echo "<b>Cod:</b> ".$codeProduct . "<br>"; 
          }elseif ($r->precio_promotion != $r->precio) {
            echo "<b>Cod:</b> ".$codeProduct . "<br>"; 
          }  
          ?>
          
          
        </small></h3>
        <br>
      </div>
    </div>
  </div>
</div>
<?php endwhile;


} else
  {
    $tabla="No se encontraron coincidencias con sus criterios de búsqueda.";
  }


echo $tabla;
?>
