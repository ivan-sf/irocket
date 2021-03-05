<?php
include '../../../../../../config.php';
session_start();

$SESSION =$_POST['SESSION'];
$nameUser =$_POST['nameUser'];
$lastnameUser =$_POST['lastnameUser'];
$documentUser =$_POST['documentUser'];
$idusers =$_POST['idusers'];
$nameClient = $nameUser . " " . $lastnameUser;

$sql = $con->query("SELECT * FROM `bills` WHERE stateBill=2 AND users_idusers=$SESSION AND typeBill=1");
$array = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);
$idFactura = $array['idbills'];


$sql = $con->query("UPDATE `bills` SET `idCliente` = '$idusers', `cliente` = '$nameClient', `documentUser` = '$documentUser' WHERE `bills`.`idbills` = $idFactura;");
if($sql){
    print "<script>window.location='". URL . "cajas?caja=ventas';</script>";
}else{
    echo "$nameClient";
    echo "$documentUser";
    echo "$idFactura";
    echo "$idusers";
}



/*
include '../../../../../../config.php';
session_start();
$busquedaCliente =$_POST['busquedaCliente'];

$sql = $con->query("SELECT * FROM users 
INNER JOIN userdetails 
ON users.idusers=userdetails.users_idusers
WHERE users.stateBD = 1 AND userdetails.range=2
AND users.userName LIKE  '%$busquedaCliente%'
ORDER BY users.idusers desc");

$array = mysqli_fetch_array($sql);
$row1 = mysqli_num_rows($sql);

print "<script>window.location='". URL . "cajas?caja=ventas&$row1';</script>";
*/