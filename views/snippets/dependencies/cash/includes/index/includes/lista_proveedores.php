<?php
  $modelInventory = new models\Products();
  $arrayProducts = $modelInventory->array();
  include "facturacion/php/conection.php";
  $products = $con->query("SELECT * FROM products 
    INNER JOIN productdetails 
    ON products.idproducts=productdetails.products_idproducts
    INNER JOIN inventory
    ON products.inventory_idinventory=inventory.idinventory
    INNER JOIN inventorydetails
    ON products.inventory_idinventory=inventorydetails.inventory_idinventory WHERE products.stateBD = 1
    ORDER BY products.idproducts desc");
  ?>


  <?php
  if (isset($_GET['caja'])) {
    if ($_GET['caja'] == 'compras') {
      include 'lista/proveedores.php';
    } 
  } else {
  } ?>


  <script>
    var statSend = false;

    function checkSubmit() {
      if (!statSend) {
        statSend = false;
        return false;
      } else {
        alert("El formulario ya se esta enviando...");
        return false;
      }
    }
  </script>