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

$idInventary = $_POST['idInventary'];
if(isset($idInventary)){
	echo "2"; //SI
}else{
	echo "1"; //NO
}


