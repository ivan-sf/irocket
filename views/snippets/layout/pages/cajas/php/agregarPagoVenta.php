<?php
include '../../../../../../config.php';
session_start();
$idUser=$_POST['usuario'];
$pagoCompra=$_POST['pagoCompra'];
if($pagoCompra==''){
    $pagoCompra=0;
}

$sql = $con->query("SELECT * FROM bills WHERE users_idusers=$idUser AND typeBill=1 AND stateBill=2");
$array = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);
$total=$array['total'];
$idbill=$array['idbills'];
$saldo=$pagoCompra-$total;
$sql = $con->query("UPDATE `bills` SET `pago` = '$pagoCompra', `saldo` = '$saldo' WHERE `bills`.`idbills` = $idbill;");
print "<script>window.location='". URL . "cajas?caja=ventas';</script>";

