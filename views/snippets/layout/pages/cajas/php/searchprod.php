<?php 
include '../../../../../../config.php';

$producto=$_POST["producto"];

print "<script>window.location='". URL ."cajas?caja=ventas&producto=$producto';</script>";

 ?>
