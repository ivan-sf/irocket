<?php namespace controllers;
$metodo = $request->getMetodo();
/**
* 
*/
use models\prueba as prueba;

class pruebasController
{

	public $prueba;
	public function index()
	{
		# code...
	}
	public function login()
	{
		if (isset($_POST['usuario'])) {
			if ($_POST['usuario'] == '') {
				return "Por favor ingresar un usuario";
			}else if ($_POST['pass'] == '') {
				return "Por favor ingresar una clave";
			}elseif ($_POST['usuario'] != '' && $_POST['pass'] != '') {
				$user = 'isma';
				$pass = '123';
				if ($_POST['usuario'] == $user) {
					$this->prueba = new Prueba();
					$this->prueba->hola($_POST['usuario'],$_POST['pass']);
				}else{
					return "Usuario incorrecto";
				}
			}
		}else{
			return "Bienvenido por favor ingrese sus datos !";
		}
	}


}