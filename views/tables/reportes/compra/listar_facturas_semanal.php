<?php
date_default_timezone_set('America/Bogota');

	$datetime = $_GET['fecha'];//
	$nuevafecha = strtotime ( '-7 day' , strtotime ( $datetime ) ) ;
	$datetime2 = date ( 'Y-m-j' , $nuevafecha );
	
$server = "localhost";
$user = "root";
$password = "";//poner tu propia contraseña, si tienes una.
$bd = "irocket";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	

$query = "SELECT * FROM billreports WHERE typeBill='Compra' AND fecha BETWEEN '$datetime2' AND '$datetime' ORDER BY idbillReports DESC";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);

    

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

?>