<?php namespace models;

/**
* 
*/
class BillReports
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


	public function AllBillsDayActive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=6  AND dataRegister='$today' OR typeMovement=7 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function AllBillsDayPassive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=8  AND dataRegister='$today' OR typeMovement=9 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function AllBillsDay()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=8  AND dataRegister='$today' OR typeMovement=9 AND dataRegister='$today' OR typeMovement=6  AND dataRegister='$today' OR typeMovement=7 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	



	public function view()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE idbills='$idbill' AND  stateBill=2
		OR idbills='$idbill' AND   stateBill=1
		OR idbills='$idbill' AND   stateBill=3";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetails()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE bills_idbills='$idbill' AND  stateBillDetail=1
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetails2()
	{
	
	}

	public function changeBill()
	{

	}

	public function returnBill()
	{
		
	}

	public function balanceBill()
	{
		

	}

	public function deleteBill()
	{

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
