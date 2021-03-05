<?php

date_default_timezone_set('America/Bogota');

session_start();
if (isset($_SESSION['adminUserNew'])) {
	$user = $_SESSION['adminUserNew'];
}elseif (isset($_SESSION['UserNew'])) {
	$user = $_SESSION['UserNew'];
}
if (isset($_SESSION['cash'])) {
	$caja = $_SESSION['cash'];
	$sql = $con->query("SELECT * FROM cashdetails WHERE nameCash='$caja'");
	$array = mysqli_fetch_array($sql);
	$cash = $array['cash_idcash'];
}

$sql = $con->query("SELECT * FROM billdetails WHERE nameCash='$caja'");


print "<script>window.location='".  URL ."cajas?caja=ventas&proceso=exitoso$user$cash';</script>";

