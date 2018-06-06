  <?php 
  $modelInventory = new models\Products();
  $arrayProducts = $modelInventory->array();
  include "facturacion/php/conection.php";
  $products = $con->query("SELECT * FROM irocket.products 
    INNER JOIN irocket.productdetails 
    ON products.idproducts=productdetails.products_idproducts
    INNER JOIN irocket.inventory
    ON products.inventory_idinventory=inventory.idinventory
    INNER JOIN irocket.inventorydetails
    ON products.inventory_idinventory=inventorydetails.inventory_idinventory WHERE products.stateBD = 1
    ORDER BY products.idproducts desc");
  ?>

  <div class="row el-element-overlay m-b-40">
    <div class="col-md-12">
      <div class="col-lg-12">
      <div class="col-lg-12">
        <?php 
        if (isset($_GET['caja'])) {
          if ($_GET['caja']=='ventas') {
           include 'lista/completa.php';
          }else{
            include 'lista/compras.php';
          }
         }else{
          include 'lista/buscar.php';
         } ?>

      </div>
  </div>
    </div>
    <!-- /.usercard -->
  

    <!-- /.usercard-->

    <!-- /.usercard-->
</div>


<script>
    var statSend = false;
function checkSubmit() {
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert("El formulario ya se esta enviando...");
        return false;
    }
}
</script>