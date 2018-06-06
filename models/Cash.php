<?php namespace models;

/**
* 
*/
class Cash
{
	private $name;
	private $code;
	private $clave;
	private $description;
	private $deposit;
	private $usuario;
	private $pass;
	private $caja;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
	
	public function view()
	{
		
	}

	public function login()
	{

		$name = $this->usuario;
		$pass = $this->pass;
		$caja = $this->caja;

		
			$sql = "SELECT * FROM users INNER JOIN userdetails ON idusers=users_idusers WHERE userName='$name' OR documentUser='$name'";
			$query = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($query);
			$array = mysqli_fetch_array($query);
			if ($row >= 1) {
				$permitsBD = $array['range'];
				$userName = $array['userName'];
				$numSesBD = $array['numSes'];
				$passwordBD = $array['password'];
				$idusers = $array['idusers'];
				
				$passwordMD5 = base64_encode($pass);

				if ($permitsBD == 9 OR $permitsBD == 1) {
					if ($passwordBD == $pass OR $passwordBD == $passwordMD5) {
						if ($permitsBD == 9) {
							session_start();
							$_SESSION['administrador'] = $array['idusers'];
							$_SESSION['cash'] = $caja;
						}elseif ($permitsBD == 1){
							session_start();
							$_SESSION['adminUserNew'] = $array['idusers'];
							$_SESSION['cash'] = $caja;
						}
					}else{
   						header("location:" . URL . "login/caja?error=datos");
					}
				}else{
   					header("location:" . URL . "login/caja?error=permisos");
				}
			}else{
 				header("location:" . URL . "login/caja?error=usuario");
			}
	}

	public function create()
	{
		$connect = $this->con->connect();
		$name = $this->name;
		$code = $this->code;
		$clave = $this->clave;
		$description = $this->description;
		$deposit = $this->deposit;
		

		$count = count($name);

		for ($i=0; $i < $count; $i++) { 
			

			$deposit = $deposit;
			$name1 = strtolower(mysqli_real_escape_string($connect,$name[$i]));
			$code1 = strtolower(mysqli_real_escape_string($connect,$code[$i]));
			$clave1 = md5(strtolower(mysqli_real_escape_string($connect,$clave[$i])));
			$description1 = strtolower(mysqli_real_escape_string($connect,$description[$i]));
			
		
			$sql = "SELECT * FROM depositaccountdetails WHERE numberAccount='$deposit'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idAD = $array['depositAccount_iddepositAccounts'];
			if ($query) {
				if ($query) {
					$sql = "INSERT INTO `cash` (`users_idusers`, `depositAccount_iddepositAccounts`, `codeCash`, `passCash`) VALUES ('1', '1', '$code1', '$clave1')";
					$query = $this->con->consulta($sql);
					if ($query) {
						$sql = "SELECT * FROM cash ORDER BY idcash desc";
						$query = $this->con->returnConsulta($sql);
						$array = mysqli_fetch_array($query);
						$idcash = $array['idcash'];
						if ($query) {
							$sql = "INSERT INTO `cashdetails` (`cash_idcash`, `totalBillBuy`, `totalBillSale`, `totalInput`, `totalOutput`, `totalItemsBuy`, `totalItemsSale`, `nameCash`, `descriptionCash`) VALUES ('$idcash', '0', '0', '0', '0', '0', '0', '$name1', '$description1')";
							$query = $this->con->consulta($sql);
							if ($query) {
								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Felicitaciones ! has ingresado una nueva caja registradora, desde aqui podras realizar compra y venta de productos.";
								$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `cash_idcash`) VALUES ('', '10', '$mensaje', '$datetimeNot', '$idcash')";
								$query = $this->con->consulta($sql);
							}else{
								echo "Err5";
							}
						}else{
							echo "Err4";
						}
					}else{
						echo "Err3";
					}
				}else{
					echo "Err2";
				}
			}else{
				echo "Err1";
			}
		}	
	}

	public function delete()
	{

	}

	public function update()
	{
	
	}

	public function list()
	{
		$sql = "SELECT * FROM irocket.cash";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function array()
	{
		$sql = "SELECT * FROM cash INNER JOIN cashdetails ON idcash=cash_idcash";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

}
