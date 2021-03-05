<?php

$server = "localhost";
$user = "root";
$password = "";//poner tu propia contraseña, si tienes una.
$bd = "irocket";
$dato1=$_GET['mes'];
$dato2=$_GET['año'];


	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	

$query = "SELECT * FROM bills 
INNER JOIN billdetails
ON bills.idbills=billdetails.bills_idbills
INNER JOIN userdetails
ON bills.users_idusers=userdetails.users_idusers
WHERE 
bills.typeBill=4 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$dato1' AND YEAR(bills.dateRegister)='$dato2' AND billdetails.typeBillDetail!=2 OR
bills.typeBill=4 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$dato1' AND YEAR(bills.dateRegister)='$dato2' AND billdetails.typeBillDetail!=2 OR
bills.typeBill=6 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$dato1' AND YEAR(bills.dateRegister)='$dato2' AND billdetails.typeBillDetail!=2 OR
bills.typeBill=6 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$dato1' AND YEAR(bills.dateRegister)='$dato2' AND billdetails.typeBillDetail!=2";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

