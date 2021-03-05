<?php
include '../../../../../../config.php';
session_start();
$idupdate =$_POST['idupdate'];
$idFactura =$_POST['idFactura'];
$precioUnidad =$_POST['precioUnidad'];
$cantidadP =$_POST['cantidadP'];
$precioTotal =$cantidadP*$precioUnidad;
$iva =$_POST['iva'];

$sql = $con->query("UPDATE `billdetails` SET `cantidad` = $cantidadP, `precioTotal` = $precioTotal, `impuesto` = $iva WHERE `billdetails`.`idbillDetails` = $idupdate;");

$sqlUpdate = $con->query("SELECT * FROM `billdetails` WHERE bills_idbills=$idFactura");
$rowUpdate = mysqli_num_rows($sqlUpdate);

$total = 0;
$totalImpuesto = 0;
while ($datos = mysqli_fetch_array($sqlUpdate)) {
    $total += $datos['precioTotal'];
    $totalImpuesto += $datos['impuesto']*$datos['cantidad'];
}

$sqlUpdate = $con->query("UPDATE `bills` SET `total` = '$total',`impuesto` = '$totalImpuesto',`pago` = '0',`saldo` = '0' WHERE `idbills` = $idFactura;");

if(isset($_POST['caja'])){
    print "<script>window.location='". URL . "cajas?caja=ventas';</script>";
}else{
    print "<script>window.location='". URL . "cajas?caja=compras';</script>";
}


?>