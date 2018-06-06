<?php namespace models\ajax;


$usuario = $_POST['usuario'];
$pass = $_POST['pass'];

if ($usuario == '') {
	echo "Por favor ingresar un usuario";
}elseif($pass == ''){
	echo "Por favor ingresar la clave";
}else{
	echo "Hi";
}