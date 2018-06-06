<?php namespace models\ajax;


$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$caja = $_POST['caja'];

if ($usuario == '') {
	echo "Por favor ingresar un usuario";
}elseif($pass == ''){
	echo "Por favor ingresar la clave";
}elseif($caja == ''){
	echo "Por favor ingresar una caja";
}else{
	echo "Hi";
}