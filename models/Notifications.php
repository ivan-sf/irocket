<?php namespace models;

/**
* 
*/
class Notifications
{
	private $usuario;
	private $pass;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
	
	public function array()
	{
		$sql = "SELECT * FROM notifications ORDER BY idnotifications desc LIMIT 5";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function array2()
	{
		$sql = "SELECT * FROM notifications ORDER BY idnotifications desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
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
