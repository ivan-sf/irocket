<?php namespace models\ajax;

$server = "localhost";
$user = "root";
$password = "";//poner tu propia contraseña, si tienes una.
$bd = "irocket";

	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	

$codigo=$_POST['codigo'];
$query = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE stateBD=1 AND codeProduct_promotion='$codigo'";
$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);  

while ($data = mysqli_fetch_assoc($result)) {
	$arreglo["data"][]= $data;
}
echo json_encode($arreglo);

