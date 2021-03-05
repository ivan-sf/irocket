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
        products.stateBD = 1 AND products.codeProduct LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_promotion LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_promotion2 LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_4 LIKE '$palabras[0]'OR 
        products.stateBD = 1 AND products.codeProduct_5 LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_6 LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_7 LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_8 LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_9 LIKE '$palabras[0]'OR
        products.stateBD = 1 AND products.codeProduct_10 LIKE '$palabras[0]'
        LIMIT 20";
  } 
}




$buscarProductos = $conexion->query($query);

if ($buscarProductos->num_rows > 0) {

?>
<form action="<?php echo URL; ?>views/snippets/layout/pages/cajas/php/addtocartVenta.php" method="POST">
  <table class="table stylish-table">
      <thead>
          <tr>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Venta</th>
              <th>Codigo</th>
              <th>Opcion</th>
          </tr>
      </thead>
      <tbody>
        
<?php
  while ($r = $buscarProductos->fetch_object()) :
?>
     

      <tbody>
          <tr>
          <td><span class="round"><img src="<?php echo URL . $r->ruta; ?>" alt="user" width="50"></span></td>
              <td><?php echo $r->nameProduct; ?></td>

               
              <input type="hidden" name="nameProduct" value="<?php echo $r->nameProduct; ?>">
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




              <td><input min="1" name="cantidadP" id="cantidadP" style="width: 60px;" class="form-control" type="number" value="1"></td>
              <td>
                



              <div class="form-group m-form__group">
    
              <select id="optionvalue" name="precioVenta" id="precioVenta" class="form-control m-input m-input--air m-input--pill"">


              <?php if($r->precio!=''){  ?>
              <option value="<?php echo $r->precio ?>">
              <?php echo number_format($r->precio) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio_promotion!=''){  ?>
              <option value="<?php echo $r->precio_promotion ?>">
              <?php echo number_format($r->precio_promotion) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio_promotion_2!=''){  ?>
              <option value="<?php echo $r->precio_promotion_2 ?>">
              <?php echo number_format($r->precio_promotion_2) ?>
              </option>
              <?php }  ?>
              
              <?php if($r->precio3!=''){  ?>
              <option value="<?php echo $r->precio3 ?>">
              <?php echo number_format($r->precio3) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio4!=''){  ?>
              <option value="<?php echo $r->precio4 ?>">
              <?php echo number_format($r->precio4) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio5!=''){  ?>
              <option value="<?php echo $r->precio5 ?>">
              <?php echo number_format($r->precio5) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio6!=''){  ?>
              <option value="<?php echo $r->precio6 ?>">
              <?php echo number_format($r->precio6) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio7!=''){  ?>
              <option value="<?php echo $r->precio7 ?>">
              <?php echo number_format($r->precio7) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio8!=''){  ?>
              <option value="<?php echo $r->precio8 ?>">
              <?php echo number_format($r->precio8) ?>
              </option>
              <?php }  ?>

              <?php if($r->precio9!=''){  ?>
              <option value="<?php echo $r->precio9 ?>">
              <?php echo number_format($r->precio9) ?>
              </option>
              <?php }  ?>
              
              </select>

                  
              </div>
              <center>







              </td>
              <td>
              <select id="optionvalue" name="codeProduct" id="codeProduct" class="form-control m-input m-input--air m-input--pill"">
              <?php if($r->codeProduct!=''){  ?>
                <option value="<?php echo $r->codeProduct ?>">
                <?php echo $r->codeProduct ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_promotion!=''){  ?>
                <option value="<?php echo $r->codeProduct_promotion ?>">
                <?php echo $r->codeProduct_promotion ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_promotion2!=''){  ?>
                <option value="<?php echo $r->codeProduct_promotion2 ?>">
                <?php echo $r->codeProduct_promotion2 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_4!=''){  ?>
                <option value="<?php echo $r->codeProduct_4 ?>">
                <?php echo $r->codeProduct_4 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_5!=''){  ?>
                <option value="<?php echo $r->codeProduct_5 ?>">
                <?php echo $r->codeProduct_5 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_6!=''){  ?>
                <option value="<?php echo $r->codeProduct_6 ?>">
                <?php echo $r->codeProduct_6 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_7!=''){  ?>
                <option value="<?php echo $r->codeProduct_7 ?>">
                <?php echo $r->codeProduct_7 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_8!=''){  ?>
                <option value="<?php echo $r->codeProduct_8 ?>">
                <?php echo $r->codeProduct_8 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_9!=''){  ?>
                <option value="<?php echo $r->codeProduct_9 ?>">
                <?php echo $r->codeProduct_9 ?>
                </option>
                <?php }  ?>

                <?php if($r->codeProduct_10!=''){  ?>
                <option value="<?php echo $r->codeProduct_10 ?>">
                <?php echo $r->codeProduct_10 ?>
                </option>
                <?php }  ?>
              </select>
              </td>

              <td>
                <button class="btn waves-effect waves-light btn-rounded btn-outline-success">
                  AGREGAR
                <?php echo $r->products_idproducts ?>

                </button>
            </td>
          </tr>
         
      </tbody>
      <?php endwhile;
      } ?>
  </table>
</form>

    


      </tbody>
  </table>
</form>

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