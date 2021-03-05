<?php namespace models;

class Movements
{
	private $name;
	private $description;
	private $iduser;
	private $iddelete;
	private $idupdate;
	private $day;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
	
	public function index()
	{
		
	}

	public function toPay()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=7  AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function toPayAll()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=7";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function toChargeAll()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=9";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayActive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1  AND dataRegister='$today' OR typeMovement=6  AND dataRegister='$today' OR typeMovement=7 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dayActive($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1  AND dataRegister='$day' OR typeMovement=6  AND dataRegister='$day' OR typeMovement=7 AND dataRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dayActiveV($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=6  AND dataRegister='$day' OR typeMovement=7 AND dataRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dayPassiveV($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=8  AND dataRegister='$day' OR typeMovement=9 AND dataRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dayPassive($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2  AND dataRegister='$day' OR typeMovement=8  AND dataRegister='$day' OR typeMovement=9 AND dataRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function semActive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 week' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function semActiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 week' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function semActiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 week' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function semPassiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 week' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function semPassiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 week' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function semPassive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 week' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function mesActive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function mesPassive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function mesActiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function mesPassiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function mesActiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function mesPassiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-1 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function sixActive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function sixPassive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function sixActiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day'
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function sixPassiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function sixActiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE
		typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day'
		";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function sixPassiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE
		typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


	public function yearActive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function yearPassive($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function yearActiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=6 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=7 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function yearPassiveV($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=8 AND dataRegister BETWEEN '$day2' AND '$day' OR
		typeMovement=9 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}
	public function yearActiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=1 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function yearPassiveD($day)
	{
		$this->$day = $day;
		date_default_timezone_set('America/Bogota');
		$datetime = $day;
		$nuevafecha = strtotime ( '-6 month' , strtotime ( $datetime ) ) ;
		$day2 = date ( 'Y-m-j' , $nuevafecha );
		$sql = "SELECT * FROM movementdepositaccount 
		WHERE 
		typeMovement=2 AND dataRegister BETWEEN '$day2' AND '$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


	public function todayPassive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2  AND dataRegister='$today' OR typeMovement=8  AND dataRegister='$today' OR typeMovement=9 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function alltimeActive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1 OR typeMovement=6 OR typeMovement=7";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function alltimeActiveV()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=6 OR typeMovement=7";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function alltimeActiveD()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function daytimeActiveD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1  AND dataRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function daytimeActiveDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1  AND MONTH(dataRegister)='$day' AND YEAR(dataRegister)='$dayY'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


	public function alltimePassive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2 OR typeMovement=8 OR typeMovement=9";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function alltimePassiveV()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=8 OR typeMovement=9";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function alltimePassiveD()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function daytimePassiveD($day)
	{
		$this->$day = $day;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2  AND dataRegister='$day'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function daytimePassiveDMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2  AND MONTH(dataRegister)='$day' AND YEAR(dataRegister)='$dayY'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayToCharge()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=7 ORDER BY idmovementDepositAccount DESC";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayToPay()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM bills 
		INNER JOIN billreports 
		ON idbills=bills_idbills 
		WHERE billreports.estado='PENDIENTE'
		AND billreports.typeBill='Compra'
		ORDER BY dateUpdate ASC";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayListDeposit()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1 AND totalMoney>0 ORDER BY idmovementDepositAccount DESC LIMIT 5";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function listaDevoluciones()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM `movementdepositaccount` WHERE dataRegister='$today' AND typeDeposit='devolucion'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function listaDevolucionesMes($day,$dayY)
	{
		$this->$day = $day;
		$this->$dayY = $dayY;
		$sql = "SELECT * FROM `movementdepositaccount` WHERE MONTH(dataRegister)='$day' AND YEAR(dataRegister)='$dayY' AND typeDeposit='devolucion'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayListRetreats()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2 AND totalMoney>0 ORDER BY idmovementDepositAccount DESC LIMIT 5";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayListDepositAll()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=1 AND totalMoney>0 ORDER BY idmovementDepositAccount DESC LIMIT 100";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function todayListRetreatsAll()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=2 AND totalMoney>0 ORDER BY idmovementDepositAccount DESC LIMIT 100";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}


}

