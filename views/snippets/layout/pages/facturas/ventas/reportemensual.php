<?php 
include '../../../../../../config.php';
$fecha = $_GET['fecha'];
$fechaA = $_GET['fechaA'];
header("location:" .URL."facturas?reportes=ventas&tipo=mensual&fecha=".$fecha."&fechaY=".$fechaA);
 ?>