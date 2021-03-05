<?php 
include '../../../../../../config.php';

$producto=$_POST["producto"];

print "<script>window.location='". URL ."cajas?caja=compras&producto=$producto';</script>";

 ?>
