<?php

namespace models\ajax;


$server = "localhost";
$user = "root";
$password = ""; //poner tu propia contraseña, si tienes una.
$bd = "irocket";

$conexion = mysqli_connect($server, $user, $password, $bd);
if (!$conexion) {
	die('Error de Conexión: ' . mysqli_connect_errno());
}



if(isset($_POST['codeProduct'])){
	$code10 = $_POST['codeProduct'];
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code10' OR codeProduct_promotion='$code10' OR codeProduct_promotion2='$code10' OR codeProduct_4='$code10' OR codeProduct_5='$code10' OR codeProduct_6='$code10' OR codeProduct_7='$code10' OR codeProduct_8='$code10' OR codeProduct_9='$code10' OR codeProduct_10='$code10'";
}


$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);
if ($row == 0) {
	echo "2"; //SI
} else {
	echo "1"; //NO
}