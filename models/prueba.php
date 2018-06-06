<?php namespace models;

/**
* 
*/
class Prueba
{
	private $id;
	private $nombre;

	public function hola($par1, $par2)
	{
		echo "Hola Modelo $par1 $par2";
	}

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}

	public function listar()
	{
		$sql = "SELECT * FROM irocket.company";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function view()
	{
		$sql = "SELECT * FROM irocket.company WHERE idcompany = '{$this->id}'";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_fetch_array($datos);
		return $row;
	}

}

