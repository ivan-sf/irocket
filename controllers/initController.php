<?php namespace controllers;
$metodo = $request->getMetodo();
/**
* 
*/
class initController
{
	public function index()
	{
		//echo "MANTENER FUNCION SIEMPRE VACIA PARA EVITAR ERRORES";
	}
	public function create($cod)
	{
		echo "Hola Isma desde create controller $cod";
		
	}
}