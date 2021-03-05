<?php namespace models;

/**
* 
*/
class Bills
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
	private $fecha;



	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}

	

	
	
	public function ingresosDiaPOS()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=1  AND billdetails.typeBillDetail=1 AND bills.dateRegister='$today' OR 
		bills.typeBill=1 AND  bills.stateBill=1 AND billdetails.typeBillDetail=3 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function editarFactura()
	{
		$idCliente = $this->idCliente;
		$cliente = $this->cliente;
		$documentUser = $this->documentUser;
		$idbill = $this->idbill;

		$sql="UPDATE `bills` SET `idCliente` = '$idCliente', `cliente` = '$cliente', `documentUser` = '$documentUser' WHERE `bills`.`idbills` = $idbill";
		$query = $this->con->returnConsulta($sql);

		header("location:" . URL . "facturas/detalles?id=" . "$idbill" . "&editar");
	}
	
	public function iva19($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=19 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1 OR 
		bills.typeBill=3 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=19 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function iva19Mes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;

		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 AND billdetails.ivaPorcentaje=19 OR
		bills.typeBill=1 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2  AND billdetails.ivaPorcentaje=19 OR
		bills.typeBill=3 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 AND billdetails.ivaPorcentaje=19 OR
		bills.typeBill=3 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2  AND billdetails.ivaPorcentaje=19";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	
	public function valorProductos($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;

		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=1 AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.ivaPorcentaje=19 AND billdetails.stateBillDetail=2 OR 
		bills.typeBill=3 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.ivaPorcentaje=19 AND billdetails.stateBillDetail=2
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	public function iva5($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=5 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1 OR 
		bills.typeBill=3 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=5 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1 
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function iva5Mes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 AND billdetails.ivaPorcentaje=5 OR
		bills.typeBill=1 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2  AND billdetails.ivaPorcentaje=5 OR
		bills.typeBill=3 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 AND billdetails.ivaPorcentaje=5 OR
		bills.typeBill=3 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2  AND billdetails.ivaPorcentaje=5";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


	public function iva19C($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=4 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=19 AND billdetails.stateBillDetail=2  AND billdetails.typeBillDetail=1 OR 
		bills.typeBill=6 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=19 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1 
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function iva19CMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=4 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 AND billdetails.ivaPorcentaje=19 OR
		bills.typeBill=4 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2  AND billdetails.ivaPorcentaje=19 OR
		bills.typeBill=6 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 AND billdetails.ivaPorcentaje=19 OR
		bills.typeBill=6 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2  AND billdetails.ivaPorcentaje=19"; 
		
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function iva5C($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=4 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=5 AND billdetails.stateBillDetail=2  AND billdetails.typeBillDetail=1 AND billdetails.typeBillDetail=1 AND billdetails.typeBillDetail=1 OR 
		bills.typeBill=6 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.ivaPorcentaje=5 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1 AND billdetails.typeBillDetail=1 AND billdetails.typeBillDetail=1 
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function iva5CMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=4 AND  bills.stateBill=1   AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.ivaPorcentaje=5 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1 OR 
		bills.typeBill=6 AND  bills.stateBill=1   AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.ivaPorcentaje=5 AND billdetails.stateBillDetail=2 AND billdetails.typeBillDetail=1
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaPosFD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=1 AND  bills.stateBill=3  AND bills.dateRegister='$day' AND billdetails.typeBillDetail!=2 OR
		bills.typeBill=1 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.typeBillDetail!=2";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaPosFDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE 
		bills.typeBill=1 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2 OR
		bills.typeBill=1 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail!=2";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaElecFD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=3 AND  bills.stateBill=3  AND bills.dateRegister='$day' OR
		bills.typeBill=3 AND  bills.stateBill=1  AND bills.dateRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaElecFDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=3 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' OR
		bills.typeBill=3 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaRemFD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=2 AND  bills.stateBill=3  AND bills.dateRegister='$day' OR
		bills.typeBill=2 AND  bills.stateBill=1  AND bills.dateRegister='$day' OR
		bills.typeBill=1 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.typeBillDetail=2 OR 
		bills.typeBill=1 AND  bills.stateBill=3  AND bills.dateRegister='$day' AND billdetails.typeBillDetail=2
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaRemFDMes($day,$dayY)
	{
		$this->$dayY = $dayY;
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=2 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' OR
		bills.typeBill=2 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' OR
		bills.typeBill=1 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail=2 OR 
		bills.typeBill=1 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail=2
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


	
	public function comprasDiaPosFD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=4 AND  bills.stateBill=3  AND bills.dateRegister='$day' AND billdetails.typeBillDetail=1 OR
		bills.typeBill=4 AND  bills.stateBill=1  AND bills.dateRegister='$day' AND billdetails.typeBillDetail=1";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaPosFDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=4 AND  bills.stateBill=3  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail=1 OR
		bills.typeBill=4 AND  bills.stateBill=1  AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' AND billdetails.typeBillDetail=1";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaElecFD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=6 AND  bills.stateBill=3  AND bills.dateRegister='$day' OR
		bills.typeBill=6 AND  bills.stateBill=1  AND bills.dateRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaElecFDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=6 AND  bills.stateBill=3 AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' OR
		bills.typeBill=6 AND  bills.stateBill=1   AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaRemFD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=5 AND  bills.stateBill=3  AND bills.dateRegister='$day' OR
		bills.typeBill=5 AND  bills.stateBill=1  AND bills.dateRegister='$day'
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaRemFDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=5 AND  bills.stateBill=3 AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY' OR
		bills.typeBill=5 AND  bills.stateBill=1 AND MONTH(bills.dateRegister)='$day' AND YEAR(bills.dateRegister)='$dayY'
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	/*public function ingresosDia($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=1 AND  bills.stateBill=1  AND bills.dateRegister='$day' OR
		bills.typeBill=2 AND  bills.stateBill=1  AND bills.dateRegister='$day' OR
		bills.typeBill=3 AND  bills.stateBill=1  AND bills.dateRegister='$day' OR
		bills.typeBill=1 AND  bills.stateBill=1  AND bills.dateRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}*/
	


	public function comprasDia($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=4 AND  bills.stateBill=1 AND bills.dateRegister='$day' OR
		bills.typeBill=5 AND  bills.stateBill=1 AND bills.dateRegister='$day' OR
		bills.typeBill=6 AND  bills.stateBill=1 AND bills.dateRegister='$day' ";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaPOS()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=4 AND  bills.stateBill=1 AND billdetails.typeBillDetail=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaRemisionPOS()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=1 AND  bills.stateBill=1 AND billdetails.typeBillDetail=2 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


	public function comprasDiaRemisionPOS()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE bills.typeBill=4 AND  bills.stateBill=1 AND billdetails.typeBillDetail=2 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function ingresosDiaRemision()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=2 AND  bills.stateBill=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaRemision()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=5 AND  bills.stateBill=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	

	public function ingresosDiaElectronica()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=3 AND  bills.stateBill=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function comprasDiaElectronica()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=6 AND  bills.stateBill=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function totalVentasDia()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=1 AND  bills.stateBill=1 AND bills.dateRegister='$today' or
		bills.typeBill=2 AND  bills.stateBill=1 AND bills.dateRegister='$today' or
		bills.typeBill=3 AND  bills.stateBill=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	
	public function totalComprasDia()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		WHERE bills.typeBill=4 AND  bills.stateBill=1 AND bills.dateRegister='$today' or
		bills.typeBill=5 AND  bills.stateBill=1 AND bills.dateRegister='$today' or
		bills.typeBill=6 AND  bills.stateBill=1 AND bills.dateRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	


	public function array()
	{
		$sql = "SELECT * FROM bills WHERE stateBill=1 OR stateBill=2 OR stateBill=3 ORDER BY idbills desc LIMIT 5";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function array2()
	{
		$sql = "SELECT * FROM bills WHERE dateRegister='2018-11-08' ORDER BY idbills desc ";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayBusqueda($id)
	{
		if (is_numeric($id)) {
			$sql = "SELECT * FROM bills WHERE stateBill=1 AND numeroFactura LIKE $id ORDER BY idbills desc";
			$datos = $this->con->returnConsulta($sql);
			return $datos;
		}else{
			$sql = "SELECT * FROM bills WHERE cliente LIKE '%$id%'";
			$datos = $this->con->returnConsulta($sql);
			return $datos;
		}
	}

	public function arrayBuyPos()
	{
		$sql = "SELECT * FROM bills WHERE 
		typeBill=4 AND stateBill=1 
		ORDER BY idbills desc LIMIT 20";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayBuyElec()
	{
		$sql = "SELECT * FROM bills WHERE 
		typeBill=6 AND stateBill=1 
		ORDER BY idbills desc LIMIT 20";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayBuyRem()
	{
		$sql = "SELECT * FROM bills WHERE 
		typeBill=5 AND stateBill=1 
		ORDER BY idbills desc LIMIT 20";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	
	public function arraySalePos()
	{
		$sql = "SELECT * FROM bills 
		WHERE typeBill=1 AND stateBill=1
		ORDER BY idbills desc LIMIT 20";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	public function arraySaleElec()
	{
		$sql = "SELECT * FROM bills 
		WHERE typeBill=3 AND stateBill=1
		ORDER BY idbills desc LIMIT 20";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	public function arraySaleRem()
	{
		$sql = "SELECT * FROM bills 
		WHERE typeBill=2 AND stateBill=1
		ORDER BY idbills desc LIMIT 20";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function auth()
	{
		
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
		WHERE 
		bills_idbills='$idbill' AND  stateBillDetail=2 ";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function arrayBillDetailDevolucion()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE 
		bills_idbills='$idbill' AND stateBillDetail=3";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}
	
	public function viewDetailsDayVV()
	{
		$idBillD = $this->idBillD;
		$sql = "SELECT * FROM  billdetails 
		WHERE bills_idbills='$idBillD' AND  stateBillDetail=2
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetailsDayV()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE bills_idbills='$idbill' AND  stateBillDetail=2
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetailsDayC()
	{
		$fecha = $this->fecha;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE billdetails.dateRegister='$fecha' AND  billdetails.stateBillDetail=1 AND bills.typeBill=2
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function arrayDet()
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
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE idbillDetails='$idbill' AND  stateBillDetail=1
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function changeBill()
	{
		/*
		movementsaccounts
		depositdetails
		*/
		
		$cNewProd = $this->cNewProd;
		$estado = $this->estado;
		$qNewProd = $this->qNewProd;
		$idBillD = $this->idBillD;
		$idBill = $this->idBill;
		$idUser = $this->idUser;
		$tipo = $this->tipo;
		$typeBill = $this->typeBill;

		//DATOS VIEJO PRODUCTO BILLS
		$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
		$queryVP = $this->con->returnConsulta($sqlVP);
		$dataAVP = mysqli_fetch_array($queryVP);
		$idprodV = $dataAVP['products_idproducts'];
		$precioTotalVP = $dataAVP['precio_total'];
		$precioTotalViejoProducto = $precioTotalVP;
		$cantidadVP = $dataAVP['cantidad'];
		$precioTVP = $precioTotalVP/$cantidadVP;
		//DATOS VIEJO PRODUCTO PRODUCTS
		$sqlVPP = "SELECT * FROM products INNER JOIN productdetails
		ON  idproducts=products_idproducts
		WHERE idproducts='$idprodV'";
		$queryVPP = $this->con->returnConsulta($sqlVPP);
		$dataAVPP = mysqli_fetch_array($queryVPP);
		$precioTotalVPP = $dataAVPP['precio'];
		$precioTotalVPPP = $dataAVPP['precio_promotion'];
		$quantityProductVPP = $dataAVPP['quantityProduct'];
		$totalItemsInventoryVPP = $dataAVPP['totalItemsInventory'];
		$totalSalesVPP = $dataAVPP['totalSales'];
		$totalBuyVPP = $dataAVPP['totalBuy'];
		$totalItemVPP = $dataAVPP['totalItem'];
		$row = mysqli_num_rows($queryVPP);
		//DATOS NUEVO PRODUCTO
		$sqlNPP = "SELECT * FROM products INNER JOIN productdetails
		ON  idproducts=products_idproducts
		WHERE codeProduct='$cNewProd'";
		$queryNPP = $this->con->returnConsulta($sqlNPP);
		$dataNPP = mysqli_fetch_array($queryNPP);
		$quantityProductNPP = $dataNPP['quantityProduct'];
		
		$idNPP = $dataNPP['idproducts'];
		$totalItemsInventoryNPP = $dataNPP['totalItemsInventory'];
		$totalSalesNPP = $dataNPP['totalSales'];
		$totalBuyNPP = $dataNPP['totalBuy'];
		$totalItemNPP = $dataNPP['totalItem'];
		$precioNPP = $dataNPP['precio'];
		$precioNPPP = $dataNPP['price_buy'];
		$precioTotalNuevoProducto = $precioNPP*$qNewProd;
		$precioTotalNuevoProductoProm = $precioNPPP*$qNewProd;
		//DATOS CODIGO DE INGRESO
		$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct_promotion='$cNewProd'";
		$query2 = $this->con->returnConsulta($sql2);
		$row2=mysqli_num_rows($query2);

		if ($estado != 1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=saldo");
		}else{
			
		if ($precioTotalNuevoProducto < $precioTotalVP) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=precio");
		}else{
			if ($idprodV==$idNPP) {
				header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=codigo");
			}else{
				if ($precioTVP == $precioTotalVPP AND $row2!=1 AND $typeBill == 1) {
			//SABER SI ES DE VENTA O DE COMPRA
					if ($typeBill == 1) {
				//VENTA
				//PRIMERO VIEJO PRODUCTO:
				//SUMAR AL INVENTARIO Y RESTAR VENTA
						$newquantityProductVPP = $quantityProductVPP+$cantidadVP;
						$newtotalItemsInventoryVPP = $totalItemsInventoryVPP+$cantidadVP;
						$newtotalSalesVPP = $totalSalesVPP-$cantidadVP;
						$newtotalItemVPP = $totalItemVPP+$cantidadVP;
						$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductVPP' WHERE `idproducts`='$idprodV'";
						$queryVPP = $this->con->consulta($sql);
						if ($queryVPP) {
							$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryVPP', `totalSales`='$newtotalSalesVPP', `totalItem`='$newtotalItemVPP' WHERE `idproductDetails`='$idprodV'";
							$queryVPP = $this->con->consulta($sql);
						}
				//SEGUNDO NUEVO PRODUCTO
				//RESTAR AL INVENTARIO Y SUMAR VENTA
						$newquantityProductNPP = $quantityProductNPP-$qNewProd;
						$newtotalItemsInventoryNPP = $totalItemsInventoryNPP-$qNewProd;
						$newtotalSalesNPP = $totalSalesNPP+$qNewProd;
						$newtotalItemNPP = $totalItemNPP-$qNewProd;
						$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductNPP' WHERE `idproducts`='$idNPP'";
						$queryVPP = $this->con->consulta($sql);
						if ($queryVPP) {
							$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryNPP', `totalSales`='$newtotalSalesNPP', `totalItem`='$newtotalItemNPP' WHERE `idproductDetails`='$idNPP'";
							$queryVPP = $this->con->consulta($sql);
						}
						//MOVIMIENTOS















						$dateTime = date("Y-m-d");

		$sql1 = "SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
		$query1 = $this->con->returnConsulta($sql1);
		$data1= mysqli_fetch_array($query1);
		$change=$data1['change'];
		$return=$data1['return'];
		if ($change == 1 && $return == 1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=completa");
		}else{
			$sql1 = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query1 = $this->con->returnConsulta($sql1);
			$data1= mysqli_fetch_array($query1);
			$precio1=$data1['precio_c-u'];

			$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
			$query2 = $this->con->returnConsulta($sql2);
			$data2= mysqli_fetch_array($query2);
			$precio2=$data2['precio'];

			
				//DATOS VIEJO BILL DETAIL
				
				if ($estado == 1) {
					if ($cNewProd != '' && $qNewProd >= 1) {
						$sqlNP = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd'";
						$queryNP = $this->con->returnConsulta($sqlNP);
						$dataRNP = mysqli_num_rows($queryNP);
						if ($dataRNP >= 1) {

							if ($estado == 1) {
								$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
								$query = $this->con->consulta($sql);

								$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$query = $this->con->returnConsulta($sql);
								$dataA= mysqli_fetch_array($query);
								$id=$dataA['idbillDetails'];
								$totalProd=$dataA['precio_total'];

								$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
								$query2 = $this->con->returnConsulta($sql2);
								$dataA2= mysqli_fetch_array($query2);
								$dataR2= mysqli_num_rows($query2);
								$total=$dataA2['total'];
								$saldo=$dataA2['saldo'];
								$totalNew=$total-$totalProd;
								$totalNewPlus=$total+$totalProd;
								$saldoNew=$saldo-$totalProd;
								if ($saldoNew <= 0) {
									$saldoNew = 0;
									if ($typeBill == 1) {
										$est = 6;
									}else{
										$est = 8;
									}
								}else{
									if ($typeBill == 1) {
										$est = 7;
									}else{
										$est = 9;
									}
								}

								$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
								$query = $this->con->consulta($sql);

								$query = $this->con->consulta($sql);

								if ($query) {
									$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pcVP = $dataAVP['precio_compra'];
									$pvVP = $dataAVP['precio_c-u'];
									$pvPVP = $dataAVP['precio_c-u_prom'];
									$ptVP = $dataAVP['precio_total'];


									$dataANP = mysqli_fetch_array($queryNP);
									$idNP = $dataANP['idproducts'];
									$nameNP = $dataANP['nameProduct'];
									$codeNP = $dataANP['codeProduct'];
									$pcNP = $dataANP['price_buy'];
									$pvNP = $dataANP['precio'];
									$pvPNP = $dataANP['precio_promotion'];
									$codePromNP = $dataANP['codeProduct_promotion'];
									if ($codeNP == $cNewProd) {
										$precioNP = $dataANP['precio'];
									}else{
										$precioNP = $dataANP['precio_promotion'];
									}
									$precioTNP = $precioNP * $qNewProd;
									$gananciaNP = $precioNP - $pcNP;
									$sqlBD = "INSERT INTO `billdetails` (`bills_idbills`, `products_idproducts`, `nombre`, `precio_compra`, `precio_c-u`, `precio_c-u_prom`, `cantidad`, `precio_total`, `dateRegister`, `ganancia_c-u`, `stateBillDetail`) VALUES ('$idBill', '$idNP', '$nameNP', '$pcNP', '$pvNP', '$pvPNP', '$qNewProd', '$precioTNP', '$dateTime', '$gananciaNP', '1')";
									$queryBD = $this->con->consulta($sqlBD);

									$sqlVP = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$total = $dataAVP['total'];
									$pago = $dataAVP['pago'];
									$totalNew = $total+$precioTNP;
									$totalNewPlus=$total+$totalProd;

									if ($totalNew>$pago) {
										$saldoNew = $totalNew-$pago;
									}

									$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
									$query = $this->con->consulta($sql);

									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pago = $dataAVP['pago'];
									$saldo = $dataAVP['saldo'];
									$total = $totalNew;

									if ($typeBill == 1) {
										if ($saldoNew == 0) {
											$est = 6;
										}else{
											$est = 7;
										}
									}else{
										if ($saldoNew == 0) {
											$est = 8;
										}else{
											$est = 9;
										}
									}
									if ($totalNew > $totalNewPlus) {

									}else{
										$sql = "SELECT * FROM depositaccountdetails";
										$query = $this->con->returnConsulta($sql);
										$dataA= mysqli_fetch_array($query);
										$current=$dataA['currentAssets'];
										if ($typeBill == 1) {
											$totalDeposit = $current-$saldoNew;
										}else{
											$totalDeposit = $current+$saldoNew;
										}

										$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
										$query = $this->con->consulta($sql);

										$saldoNew = $saldoNew + $totalProd;
										
									}


									$query = $this->con->consulta($sql);

								}

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];
								$pagoPV=$dataPV['pago'];
								$saldoPV=$dataPV['saldo'];
								//Necesito restarle el valor del producto actual 
								$sqlPB="SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$queryPB=$this->con->returnConsulta($sqlPB);
								$dataPB=mysqli_fetch_array($queryPB);
								$pagoTotalProductoPB=$dataPB['precio_total'];

								$totalRM=$totalMoneyPV-$pagoTotalProductoPB;

								$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalRM' WHERE `bills_idbills`='$idBill'";
								$queryRM=$this->con->consulta($sqlRM);

								//Sumar nueva cantidad
								$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
								$query2 = $this->con->returnConsulta($sql2);
								$data2= mysqli_fetch_array($query2);
								$precio2=$data2['precio'];
								$precioTNP=$precio2*$qNewProd;

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];

								$totalSM=$totalMoneyPV+$precioTNP;
								if ($totalSM>$pagoPV) {
									$est=7;
									$saldo=$totalSM-$pagoPV;
									$totalSM = $totalSM-$saldo;
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `saldo`='$saldo' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);

								}else{
									$est=6;	
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);

								}
								

								$iduser = 1;
								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Se ha realizado un cambio en una factura.";
								$sqlRM="INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '10', '95', '$mensaje', '$datetimeNot')";
								$queryRM=$this->con->consulta($sqlRM);




								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio");


							}else{
								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
							}
						}else{
							header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=no_encontrado");
						}			
					}else{
						header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=sin_producto");
					}
				}else{
					header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
				}
			}




						













					}
				}elseif ($row2!=1 AND $typeBill == 2) {
					if ($precioTotalNuevoProductoProm < $precioTotalVP) {
						header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=precio");
					}else{



















						//VENTA

				//PRIMERO VIEJO PRODUCTO:
				//SUMAR AL INVENTARIO Y RESTAR VENTA
					$newquantityProductVPP = $quantityProductVPP-$cantidadVP;
					$newtotalItemsInventoryVPP = $totalItemsInventoryVPP-$cantidadVP;
					$newtotalSalesVPP = $totalBuyVPP-$cantidadVP;
					$newtotalItemVPP = $totalItemVPP-$cantidadVP;
					$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductVPP' WHERE `idproducts`='$idprodV'";
					$queryVPP = $this->con->consulta($sql);
					if ($queryVPP) {
						$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryVPP', `totalBuy`='$newtotalSalesVPP', `totalItem`='$newtotalItemVPP' WHERE `idproductDetails`='$idprodV'";
						$queryVPP = $this->con->consulta($sql);
					}
				//SEGUNDO NUEVO PRODUCTO
				//RESTAR AL INVENTARIO Y SUMAR VENTA
					$newquantityProductNPP = $quantityProductNPP+$qNewProd;
					$newtotalItemsInventoryNPP = $totalItemsInventoryNPP+$qNewProd;
					$newtotalSalesNPP = $totalBuyNPP+$qNewProd;
					$newtotalItemNPP = $totalItemNPP+$qNewProd;
					$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductNPP' WHERE `idproducts`='$idNPP'";
					$queryVPP = $this->con->consulta($sql);
					if ($queryVPP) {
						$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryNPP', `totalBuy`='$newtotalSalesNPP', `totalItem`='$newtotalItemNPP' WHERE `idproductDetails`='$idNPP'";
						$queryVPP = $this->con->consulta($sql);
					}

















						$dateTime = date("Y-m-d");

		$sql1 = "SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
		$query1 = $this->con->returnConsulta($sql1);
		$data1= mysqli_fetch_array($query1);
		$change=$data1['change'];
		$return=$data1['return'];
		if ($change == 1 && $return == 1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=completa");
		}else{
			$sql1 = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query1 = $this->con->returnConsulta($sql1);
			$data1= mysqli_fetch_array($query1);
			$precio1=$data1['precio_c-u'];

			$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
			$query2 = $this->con->returnConsulta($sql2);
			$data2= mysqli_fetch_array($query2);
			$precio2=$data2['precio'];

			
				//DATOS VIEJO BILL DETAIL
				
				if ($estado == 1) {
					if ($cNewProd != '' && $qNewProd >= 1) {
						$sqlNP = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd'";
						$queryNP = $this->con->returnConsulta($sqlNP);
						$dataRNP = mysqli_num_rows($queryNP);
						if ($dataRNP >= 1) {

							if ($estado == 1) {
								$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
								$query = $this->con->consulta($sql);

								$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$query = $this->con->returnConsulta($sql);
								$dataA= mysqli_fetch_array($query);
								$id=$dataA['idbillDetails'];
								$totalProd=$dataA['precio_total'];

								$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
								$query2 = $this->con->returnConsulta($sql2);
								$dataA2= mysqli_fetch_array($query2);
								$dataR2= mysqli_num_rows($query2);
								$total=$dataA2['total'];
								$saldo=$dataA2['saldo'];
								$totalNew=$total-$totalProd;
								$totalNewPlus=$total+$totalProd;
								$saldoNew=$saldo-$totalProd;
								if ($saldoNew <= 0) {
									$saldoNew = 0;
									if ($typeBill == 1) {
										$est = 6;
									}else{
										$est = 8;
									}
								}else{
									if ($typeBill == 1) {
										$est = 7;
									}else{
										$est = 9;
									}
								}

								$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
								$query = $this->con->consulta($sql);

								$query = $this->con->consulta($sql);

								if ($query) {
									$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pcVP = $dataAVP['precio_compra'];
									$pvVP = $dataAVP['precio_c-u'];
									$pvPVP = $dataAVP['precio_c-u_prom'];
									$ptVP = $dataAVP['precio_total'];


									$dataANP = mysqli_fetch_array($queryNP);
									$idNP = $dataANP['idproducts'];
									$nameNP = $dataANP['nameProduct'];
									$codeNP = $dataANP['codeProduct'];
									$pcNP = $dataANP['price_buy'];
									$pvNP = $dataANP['precio'];
									$pvPNP = $dataANP['precio_promotion'];
									$codePromNP = $dataANP['codeProduct_promotion'];
									if ($codeNP == $cNewProd) {
										$precioNP = $dataANP['price_buy'];
									}else{
										$precioNP = $dataANP['precio_promotion'];
									}
									$precioTNP = $precioNP * $qNewProd;
									$gananciaNP = $precioNP - $pcNP;
									$sqlBD = "INSERT INTO `billdetails` (`bills_idbills`, `products_idproducts`, `nombre`, `precio_compra`, `precio_c-u`, `precio_c-u_prom`, `cantidad`, `precio_total`, `dateRegister`, `ganancia_c-u`, `stateBillDetail`) VALUES ('$idBill', '$idNP', '$nameNP', '$pcNP', '$pvNP', '$pvPNP', '$qNewProd', '$precioTNP', '$dateTime', '$gananciaNP', '1')";
									$queryBD = $this->con->consulta($sqlBD);

									$sqlVP = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$total = $dataAVP['total'];
									$pago = $dataAVP['pago'];
									$totalNew = $total+$precioTNP;
									$totalNewPlus=$total+$totalProd;

									if ($totalNew>$pago) {
										$saldoNew = $totalNew-$pago;
									}

									$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
									$query = $this->con->consulta($sql);

									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pago = $dataAVP['pago'];
									$saldo = $dataAVP['saldo'];
									$total = $totalNew;

									if ($typeBill == 1) {
										if ($saldoNew == 0) {
											$est = 6;
										}else{
											$est = 7;
										}
									}else{
										if ($saldoNew == 0) {
											$est = 8;
										}else{
											$est = 9;
										}
									}
									if ($totalNew > $totalNewPlus) {

									}else{
										$sql = "SELECT * FROM depositaccountdetails";
										$query = $this->con->returnConsulta($sql);
										$dataA= mysqli_fetch_array($query);
										$current=$dataA['currentAssets'];
										if ($typeBill == 1) {
											$totalDeposit = $current-$saldoNew;
										}else{
											$totalDeposit = $current+$saldoNew;
										}

										$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
										$query = $this->con->consulta($sql);

										$saldoNew = $saldoNew + $totalProd;
										
									}


									$query = $this->con->consulta($sql);

								}

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];
								$pagoPV=$dataPV['pago'];
								$saldoPV=$dataPV['saldo'];
								//Necesito restarle el valor del producto actual 
								$sqlPB="SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$queryPB=$this->con->returnConsulta($sqlPB);
								$dataPB=mysqli_fetch_array($queryPB);
								$pagoTotalProductoPB=$dataPB['precio_total'];

								$totalRM=$totalMoneyPV-$pagoTotalProductoPB;

								$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalRM' WHERE `bills_idbills`='$idBill'";
								$queryRM=$this->con->consulta($sqlRM);

								//Sumar nueva cantidad
								$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
								$query2 = $this->con->returnConsulta($sql2);
								$data2= mysqli_fetch_array($query2);
								$precio2=$data2['price_buy'];
								$precioTNP=$precio2*$qNewProd;

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];

								$totalSM=$totalMoneyPV+$precioTNP;
								if ($totalSM>$pagoPV) {
									$est=9;
									$saldo=$totalSM-$pagoPV;
									$totalSM=$totalSM-$saldo;
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `saldo`='$saldo' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
								}else{
									$esy=8;
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
								}

								$iduser = 1;
								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Se ha realizado un cambio en una factura.";
								$sqlRM="INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '10', '95', '$mensaje', '$datetimeNot')";
								$queryRM=$this->con->consulta($sqlRM);




								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio");


							}else{
								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
							}
						}else{
							header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=no_encontrado");
						}			
					}else{
						header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=sin_producto");
					}
				}else{
					header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
				}
			}


























					}
				

						







				} else{
					header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=promocion");
				}

			}

		}
		}

	}

	public function returnBill()
	{
		$cNewProd = $this->cNewProd;
		$estado = $this->estado;
		$qNewProd = $this->qNewProd;
		$idBillD = $this->idBillD;
		$idBill = $this->idBill;
		$idUser = $this->idUser;
		$tipo = $this->tipo;
		$typeBill = $this->typeBill;



		//PRIMERO SI ES DE PROMOCION NO HACER LA DEVOLUCION

		$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
		$queryVP = $this->con->returnConsulta($sqlVP);
		$dataAVP = mysqli_fetch_array($queryVP);
		$idprodV = $dataAVP['products_idproducts'];
		$precioTotalVP = $dataAVP['precio_total'];
		$precioTotalViejoProducto = $precioTotalVP;
		$cantidadVP = $dataAVP['cantidad'];
		$precioTVP = $precioTotalVP/$cantidadVP;

		$sqlVPP = "SELECT * FROM products INNER JOIN productdetails
		ON  idproducts=products_idproducts
		WHERE idproducts='$idprodV'";
		$queryVPP = $this->con->returnConsulta($sqlVPP);
		$dataAVPP = mysqli_fetch_array($queryVPP);
		$precioTotalVPP = $dataAVPP['precio'];
		$precioTotalVPPP = $dataAVPP['precio_promotion'];
		$quantityProductVPP = $dataAVPP['quantityProduct'];
		$totalItemsInventoryVPP = $dataAVPP['totalItemsInventory'];
		$totalSalesVPP = $dataAVPP['totalSales'];
		$totalBuyVPP = $dataAVPP['totalBuy'];
		$totalItemVPP = $dataAVPP['totalItem'];
		$row = mysqli_num_rows($queryVPP);
if ($estado != 1) {
	header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion=".$idBillD."&error=saldo");
}else{
	if ($typeBill==2) {








			//COMPRA LO TENGO ENTONCES SE DEBE RESTAR
			$quantityProductVPPN=$quantityProductVPP-$cantidadVP;
			$totalItemsInventoryVPPN=$totalItemsInventoryVPP-$cantidadVP;
			$totalSalesVPPN=$totalBuyVPP-$cantidadVP;
			$totalItemVPPN=$totalItemVPP-$cantidadVP;
			$sql="UPDATE `irocket`.`products` SET `quantityProduct`='$quantityProductVPPN' WHERE `idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			$sql="UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$totalItemsInventoryVPPN', `totalBuy`='$totalSalesVPPN', `totalItem`='$totalItemVPPN' WHERE `products_idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);


		
		$dateTime = date("Y-m-d");
		if ($estado == 1) {
			$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$dataR= mysqli_num_rows($query);
			$id=$dataA['idbillDetails'];
			$totalProd=$dataA['precio_total'];

			$sql2 = "SELECT * FROM billdetails WHERE bills_idbills='$idBill' AND stateBillDetail=1";
			$query2 = $this->con->returnConsulta($sql2);
			while ($dataA2= mysqli_fetch_array($query2)) {
				$total+=$dataA['precio_total'];
			}
			$dataR2= mysqli_num_rows($query2);


			$totalNew=$total;
			$saldoNew=$saldo-$totalProd;
			if ($saldoNew <= 0) {
				$saldoNew = 0;
				if ($typeBill == 1) {
					$est = 6;
				}else{
					$est = 8;
				}
			}else{
				if ($typeBill == 1) {
					$est = 7;
				}else{
					$est = 9;
				}
			}

			$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalNew', `dataUpdate`='1', `saldo`='$saldoNew', `return`='1' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM `movementdepositaccount` WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);
			$dataA= mysqli_fetch_array($query);
			$total=$dataA['totalMoney'];

			if ($total=='') {
				$sql = "UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`=0 WHERE `bills_idbills`='$idBill'";
				$query = $this->con->consulta($sql);
			}



			$sql = "SELECT * FROM depositaccountdetails";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$current=$dataA['currentAssets'];
			if ($typeBill == 1) {
				$totalDeposit = $current-$totalProd;
			}else{
				$totalDeposit = $current+$totalProd;
			}

			$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);

			$iduser = 1;
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha realizado una devolucion en una factura.";
			$sqlRM="INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '10', '94', '$mensaje', '$datetimeNot')";
			$queryRM=$this->con->consulta($sqlRM);

			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion");
		}else{
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion=" . $idBillD . "&error=saldo");
		}
	










			
		}elseif($typeBill==1){ 

		//SUMAR O RESTAR
		if ($typeBill==1) {
			//VENTA NO LO TENGO ENTONCES SE DEBE SUMAR
			$quantityProductVPPN=$quantityProductVPP+$cantidadVP;
			$totalItemsInventoryVPPN=$totalItemsInventoryVPP+$cantidadVP;
			$totalSalesVPPN=$totalSalesVPP-$cantidadVP;
			$totalItemVPPN=$totalItemVPP+$cantidadVP;
			$sql="UPDATE `irocket`.`products` SET `quantityProduct`='$quantityProductVPPN' WHERE `idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			$sql="UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$totalItemsInventoryVPPN', `totalSales`='$totalSalesVPPN', `totalItem`='$totalItemVPPN' WHERE `products_idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			


		}else{
			//COMPRA LO TENGO ENTONCES SE DEBE RESTAR
			$quantityProductVPPN=$quantityProductVPP-$cantidadVP;
			$totalItemsInventoryVPPN=$totalItemsInventoryVPP-$cantidadVP;
			$totalSalesVPPN=$totalBuyVPP-$cantidadVP;
			$totalItemVPPN=$totalItemVPP-$cantidadVP;
			$sql="UPDATE `irocket`.`products` SET `quantityProduct`='$quantityProductVPPN' WHERE `idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			$sql="UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$totalItemsInventoryVPPN', `totalSales`='$totalSalesVPPN', `totalItem`='$totalItemVPPN' WHERE `products_idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
		}

		$dateTime = date("Y-m-d");
		if ($estado == 1) {
			$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$id=$dataA['idbillDetails'];
			$totalProd=$dataA['precio_total'];

			$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
			$query2 = $this->con->returnConsulta($sql2);
			$dataA2= mysqli_fetch_array($query2);
			$dataR2= mysqli_num_rows($query2);
			$total=$dataA2['total'];
			$saldo=$dataA2['saldo'];
			$totalNew=$total-$totalProd;
			$saldoNew=$saldo-$totalProd;
			if ($saldoNew <= 0) {
				$saldoNew = 0;
				if ($typeBill == 1) {
					$est = 6;
				}else{
					$est = 8;
				}
			}else{
				if ($typeBill == 1) {
					$est = 7;
				}else{
					$est = 9;
				}
			}

			$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalNew', `dataUpdate`='1', `saldo`='$saldoNew', `return`='1' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM depositaccountdetails";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$current=$dataA['currentAssets'];
			if ($typeBill == 1) {
				$totalDeposit = $current-$totalProd;
			}else{
				$totalDeposit = $current+$totalProd;
			}

			$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);

			$iduser = 1;
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha realizado una devolucion en una factura.";
			$sqlRM="INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '10', '94', '$mensaje', '$datetimeNot')";
			$queryRM=$this->con->consulta($sqlRM);

			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion");
		}else{
			
		}
	}
}
		
	}



















	public function balanceBill()
	{
		$idBill = $this->idBill;
		$idUser = $this->idUser;
		$tipo = $this->tipo;
		$balance = $this->balance;

		$sql = "SELECT * FROM bills WHERE idbills='$idBill'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$pago = $dataA['pago'];
		$typeBill = $dataA['typeBill'];
		if ($typeBill==1) {
			$total = $pago+$tipo;
			$totalP = $pago+$balance;
			if ($totalP >= $total) {
				$state = 1;
				$type = 6;
				$totalP = $pago+$tipo;
			}else{
				$state = 2;
				$type = 7;
				$totalP = $pago+$balance;
			}
		}elseif ($typeBill==2) {
			$total = $pago+$tipo;
			$totalP = $pago+$balance;
			if ($totalP >= $total) {
				$state = 1;
				$type = 8;
				$totalP = $pago+$tipo;
			}else{
				$state = 2;
				$type = 9;
				$totalP = $pago+$balance;
			}
		}

		$sql = "UPDATE `bills` SET `pago`='$totalP', `stateBill`='$state' WHERE `idbills`='$idBill'";
		$query = $this->con->consulta($sql);

		$sql = "SELECT * FROM movementdepositaccount WHERE bills_idbills = '$idBill'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$saldo = $dataA['saldo'];
		$saldoNew=$saldo-$balance;

		$dateTime = date("Y-m-d");

		$sql = "UPDATE `movementdepositaccount` SET `totalMoney`='$totalP', `pago`='$totalP', `typeMovement`='$type', `saldo`='$saldoNew', `dataUpdate`='$dateTime' WHERE `bills_idbills`='$idBill'";
		$query = $this->con->consulta($sql);

		$sql = "SELECT * FROM billreports WHERE bills_idbills = '$idBill'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$saldo = $dataA['total'];
		$saldoo = $saldo-$totalP;

		$sql666 = "SELECT * FROM bills WHERE idbills = '$idBill'";
		$query666 = $this->con->returnConsulta($sql666);
		$dataA666 = mysqli_fetch_array($query666);
		$estado666 = $dataA666['stateBill'];

		if ($estado666==2) {
			$sql = "UPDATE `billreports` SET `pago`='$totalP', `saldo`='$saldoo' WHERE `bills_idbills`='$idBill'";
		}else{
			$sql = "UPDATE `billreports` SET `pago`='$totalP', `saldo`='$saldoo', `estado`='CANCELADA' WHERE `bills_idbills`='$idBill'";
		}

		$query = $this->con->consulta($sql);

		$sql = "SELECT * FROM depositaccountdetails WHERE iddepositAccountDetails = '1'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$currentAssets = $dataA['currentAssets'];
		$total = $totalP-$pago;

		if ($typeBill == 1) {
			$totalNew = $total+$currentAssets;
			$sql = "UPDATE `depositaccountdetails` SET `currentAssets`='$totalNew' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);
		}elseif ($typeBill == 2) {
			$totalNew = $currentAssets-$total;
			$sql = "UPDATE `depositaccountdetails` SET `currentAssets`='$totalNew' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);
		}

		$iduser = 1;
		$datetimeNot = 	date("Y-m-d G:i:s A");
		$mensaje = "Se ha cancelado un saldo pendiente en una factura.";
		$sqlRM="INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '10', '93', '$mensaje', '$datetimeNot')";
		$queryRM=$this->con->consulta($sqlRM);

		if ($query) {
			header("location:" . URL . "facturas/detalles?id=" . $idBill . "&detalles&success=deposito");
		}

	}

	public function deleteBill()
	{
		$idBill = $this->idBill;
		$idUser = 66666;
		$tipo = $this->tipo;
		header("location:" . URL . "/facturas/detalles?id=" . $idUser . "&detalles");
	}

















	public function printDayV()
	{
		header("location:" . URL . "cajas/imprimir");
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
