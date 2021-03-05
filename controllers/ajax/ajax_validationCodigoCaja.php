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

	//echo "2"; //SI
    echo "1"; //NO
