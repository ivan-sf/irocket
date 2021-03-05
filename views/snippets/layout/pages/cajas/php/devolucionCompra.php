<?php 
include '../../../../../../config.php';
$id= $_GET['id'];
$idb= $_GET['idb'];
$sql= $con->query("SELECT * FROM billdetails WHERE idbillDetails=$id");
$array = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);
echo "hola mundo $array[6]";
$sql= $con->query("DELETE FROM `billdetails` WHERE `billdetails`.`idbillDetails` = $id;");


$idp=$array['products_idproducts'];
$cantFac=$array['cantidad'];
$precioTotal=$array['precioTotal'];
$sqlp= $con->query("SELECT * FROM products WHERE idproducts=$idp");
$arrayp = mysqli_fetch_array($sqlp);
$rowp = mysqli_num_rows($sqlp);
$cantAct=$arrayp['quantityProduct'];
$cantFin=$cantAct-$cantFac;


$sqlpp= $con->query("UPDATE `products` SET `quantityProduct` = '$cantFin' WHERE `products`.`idproducts` = $idp;");
$sqlpd= $con->query("UPDATE `productdetails` SET `totalItem` = '$cantFin' WHERE `productdetails`.`idproductDetails` = $idp;");

$sql= $con->query("SELECT * FROM bills WHERE idbills=$idb");
$array = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);
$total=$array['total'];
$totalFin=$total-$precioTotal;

$sqlpp= $con->query("UPDATE `bills` SET `total` = '$totalFin' WHERE `bills`.`idbills` = $idb;");



$type=1;
$datetimeNot = 	date("Y-m-d G:i:s A");
$dateTime = date("Y-m-d");
/*$query= $con->query("INSERT INTO `movementdepositaccount` (`depositAccount_iddepositAccounts`, `bills_idbills`, `cash_idcash`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`, `dataUpdate`, `userUpdate`, `pago`, `saldo`, `change`, `return`, `typeDeposit`, `fecha`, `estado`) VALUES ('1', '$idb', NULL, NULL, '2', '$precioTotal', '$dateTime', '$dateTime', NULL, NULL, NULL, NULL, NULL, 'devolucion', '$datetimeNot', NULL);");
*/
if($sqlpp){
    echo "si";
    print "<script>window.location='".  URL ."facturas/detalles&id=$idb&devolucion';</script>";
}else{
    echo "no";
}


/*
$fecha = $_GET['fecha'];
$array= $con->query("INSERT INTO `movementdepositaccount` (`depositAccount_iddepositAccounts`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`, `typeDeposit`, `fecha`) VALUES ('1', '$usuario', '$type', '$newfondos', '$dateTime', '$typeDeposit', '$datetimeNot')");
$data = mysqli_fetch_array($array);
*/