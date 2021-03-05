  <?php
  include "facturacion/php/conection.php";

  ?>


  <?php
 
    if ($_GET['caja'] == 'ventas') {
      include 'lista/completa.php';
    } else{
      include 'lista/completaCompras.php';

    }
 ?>
