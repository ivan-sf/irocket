<?php namespace models;

/**
* 
*/
class UserReports
{
	private $usuario;
	private $idbill;
	private $pass;
	private $cNewProd;
	private $qNewProd;
	private $idBillD;
	private $idBill;
	private $idUser;
	private $tipo;
	private $balance;
	private $saldo;
	private $estado;
	private $typeBill;



	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}

	public function allUsersA()
	{
		$sql = "SELECT * FROM users 
				INNER JOIN userdetails 
				ON users.idusers = userdetails.iduserDetails 
				WHERE stateBD = '1'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}

	public function allUsersI()
	{
		$sql = "SELECT * FROM users 
				INNER JOIN userdetails 
				ON users.idusers = userdetails.iduserDetails 
				WHERE stateBD = '0'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}

	public function allUsersC()
	{
		$sql = "SELECT * FROM users 
				INNER JOIN userdetails 
				ON users.idusers = userdetails.iduserDetails 
				WHERE stateBD = '1' AND userdetails.range = 2";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}


	public function allUsersE()
	{
		$sql = "SELECT * FROM users 
				INNER JOIN userdetails 
				ON users.idusers = userdetails.iduserDetails 
				WHERE users.stateBD = '1' AND userdetails.range = 1";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}

	public function allUsersP()
	{
		$sql = "SELECT * FROM users 
				INNER JOIN userdetails 
				ON users.idusers = userdetails.iduserDetails 
				WHERE stateBD = '1' AND userdetails.range = 3";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}


}
