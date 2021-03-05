<?php 
include '../../../../../../config.php';
$fecha = $_GET['fecha'];
$fechaA = $_GET['fechaA'];
header("location:" .URL."facturas?reportes=ventas&tipo=contable&fecha=".$fecha."&fechaY=".$fechaA);
 ?>