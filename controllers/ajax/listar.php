<?php

$server = "localhost";
$user = "root";
$password = "";//poner tu propia contraseña, si tienes una.
$bd = "irocket";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	

$query = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE stateBD=1";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

