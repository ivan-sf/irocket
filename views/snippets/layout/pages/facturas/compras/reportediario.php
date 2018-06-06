<?php 
include '../../../../../../config.php';
$fecha = $_GET['fecha'];
header("location:" .URL."facturas?reportes=ventas&tipo=diario&fecha=".$fecha);
 ?>