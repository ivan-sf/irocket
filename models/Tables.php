<?php namespace models;

/**
* 
*/
class Login
{
	private $usuario;
	private $pass;

	function __construct(){
		$this->con = new Conexion;
	}

	public function arrayTable()
	{
		

	}

	public function get($atributo){
		return $this-$atributo;
	}
	
	public function view()
	{
		# code...
	}

	public function auth()
	{
		
	}
	public function list()
	{
		# code...
	}

	public function update()
	{
		# code...
	}
	public function delete()
	{
		# code...
	}
}
