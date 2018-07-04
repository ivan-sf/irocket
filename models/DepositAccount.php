<?php namespace models;
/**
* 
*/
class DepositAccount
{

	private $nameInput;
	private $numberInput;
	private $currentInput;
	private $newcurrentInput;
	private $bankInput;
	private $iduser;
	private $idupdate;
	private $typeDeposit;

	function __construct(){
		$this->con = new Conexion;
	}

	public function dataCompany()
	{
		$sql = "SELECT * FROM depositaccount INNER JOIN depositaccountdetails";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}


	public function get($atributo){
		return $this-$atributo;
	}


	public function list()
	{
		$sql = "SELECT * FROM depositaccount";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function deleteDeposit()
	{
		$connect = $this->con->connect();
		$idupdate = mysqli_real_escape_string($connect,$this->idupdate);
		$sql = "UPDATE `movementdepositaccount` SET `totalMoney`='0' WHERE `idmovementDepositAccount`='$idupdate'";
		$query = $this->con->consulta($sql);

		$datetimeNot = 	date("Y-m-d G:i:s A");
		$mensaje = "Has eliminado un deposito.";
		$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `movementDepositAccount_idmovementDepositAccount`) VALUES ('', '27', '$mensaje', '$datetimeNot', '$idupdate')";
		$query = $this->con->consulta($sql);


		if ($query) {
			header("location:" . URL . "depositos/detalles?id=" . $idupdate . "&detalles&success&tipo=activo");
			
		}
	}

	public function array()
	{
		$sql = "SELECT * FROM depositaccount
		INNER JOIN depositaccountdetails
		ON depositaccount.iddepositAccounts=depositaccountdetails.depositAccount_iddepositAccounts";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function newMoney()
	{
		$datos = $this->array();
		$data = mysqli_fetch_array($datos);
		$fondos = $data['currentAssets'];
		$newfondos = $this->newcurrentInput;
		$idupdate = $this->idupdate;
		$typeDeposit = $this->typeDeposit;
		$tipoDeposito = $this->tipoDeposito;
		$datetimeNot = 	date("Y-m-d G:i:s A");
		if ($newfondos >= 1) {
			if ($tipoDeposito == 'activo') {
				$fondosTotales = $fondos + $newfondos;
			}else{
				$fondosTotales = $newfondos + $fondos;
			}
			//echo $fondosTotales;
			$sql = "UPDATE `depositaccountdetails` SET `currentAssets`='$fondosTotales' WHERE `iddepositAccountDetails`='$idupdate'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$dateTime = date("Y-m-d");
				$dateTime = date("Y-m-d");
				session_start();
				if (isset($_SESSION['adminUserNew'])) {
					$usuario = $_SESSION['adminUserNew'];
				}else{
					$usuario = $_SESSION['administrador'];
				}
				if ($tipoDeposito == 'activo') {
					$type=1;
					$sql = "INSERT INTO `movementdepositaccount` (`depositAccount_iddepositAccounts`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`, `typeDeposit`, `fecha`) VALUES ('1', '$usuario', '$type', '$newfondos', '$dateTime', '$typeDeposit', '$datetimeNot')";
				}else{
					$fondosTotales = $newfondos;
					$type=2;
					$sql = "INSERT INTO `movementdepositaccount` (`depositAccount_iddepositAccounts`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`, `typeDeposit`, `fecha`) VALUES ('1', '$usuario', '$type', '$fondosTotales', '$dateTime', '$typeDeposit', '$datetimeNot')";
				}
				
				$query = $this->con->consulta($sql);
				if ($query) {
					$sql = "SELECT * FROM `movementdepositaccount` ORDER BY idmovementDepositAccount DESC";
					$query = $this->con->returnConsulta($sql);
					$data = mysqli_fetch_array($query);
					$idMove = $data['idmovementDepositAccount'];
					$totalMoney = $data['totalMoney'];

					if ($totalMoney > 0) {
						if ($tipoDeposito == 'activo') {
						$mensaje = "Felicitaciones ! has ingresado la suma de <b>$" . number_format($newfondos) . "</b> a tu cuenta de depositos.";
						$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `movementDepositAccount_idmovementDepositAccount`) VALUES ('', '11', '$mensaje', '$datetimeNot', '$idMove')";
					}else{
						$mensaje = "Felicitaciones ! has hecho un retiro por <b>$" . number_format($newfondos) . "</b> de tu cuenta de depositos.";
						$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `movementDepositAccount_idmovementDepositAccount`) VALUES ('', '12', '$mensaje', '$datetimeNot', '$idMove')";
					}
						
					$query = $this->con->consulta($sql);
					if ($query) {
						if ($tipoDeposito == 'activo') {
							header("location:" . URL . "depositos/detalles?id=" . 1 . "&fondos&success_update&tipo=activo");
						}else{
							header("location:" . URL . "depositos/detalles?id=" . 1 . "&fondos&success_update&tipo=pasivo");							
						}
					}else{
						echo "Error";
					}
					}

					
				}
			}else{
				header("location:" . URL . "login?new_cash");
			}

		}else{
			if ($tipoDeposito == 'activo') {
				header("location:" . URL . "depositos/detalles?id=" . 1 . "&fondos&error=minimo&tipo=activo");
			}else{
				header("location:" . URL . "depositos/detalles?id=" . 1 . "&fondos&error=minimo&tipo=pasivo");			
			}
		}
		
	}

	public function update()
	{
		$connect = $this->con->connect();
		$dataNumber = strtolower(mysqli_real_escape_string($connect,$this->numberInput));
		$currentInput = strtolower(mysqli_real_escape_string($connect,$this->currentInput));
		$bankInput = strtolower(mysqli_real_escape_string($connect,$this->bankInput));
		$idupdate = strtolower(mysqli_real_escape_string($connect,$this->idupdate));
		$dateTime = date("Y-m-d");
		$sql = "UPDATE `irocket`.`depositaccountdetails` SET `numberAccount`='$dataNumber', `bank`='$bankInput', `date_update`='$dateTime' WHERE `iddepositAccountDetails`='$idupdate'";
		$query = $this->con->consulta($sql);
		if ($query) {
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha editado la cuenta de depositos con exito.";
			$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `depositAccount_iddepositAccounts`) VALUES ('', '17', '$mensaje', '$datetimeNot', '$idupdate')";
			$query = $this->con->consulta($sql);
			if ($query) {
				header("location:" . URL . "depositos/detalles?id=" . $idupdate . "&configurar&success_update&tipo=activo");
			}
		}else{
			header("location:" . URL . "login?new_cash");
		}
	}

	public function createAccount()
	{
		$connect = $this->con->connect();
		$nameAccount = $this->nameInput;
		$numberAccount = $this->numberInput;
		$currentAccount = $this->currentInput;
		$bankAccount = $this->bankInput;
		$count = count($nameAccount);
		for ($i=0; $i < $count; $i++) { 
			$data = strtolower(mysqli_real_escape_string($connect,$nameAccount[$i]));
			$dataNumber = strtolower(mysqli_real_escape_string($connect,$numberAccount[$i]));
			$dataCurrent = mysqli_real_escape_string($connect,$currentAccount[$i]);
			$dataBank = strtolower(mysqli_real_escape_string($connect,$bankAccount[$i]));
			$dateTime = date("Y-m-d");
			if ($data != '') {
				$sql = "SELECT * FROM users INNER JOIN company;";
				$query = $this->con->returnConsulta($sql);
				$row = mysqli_num_rows($query);
				$array = mysqli_fetch_array($query);
				$iduser = $array['idusers'];
				$idcompany = $array['company_idcompany'];
				$sql = "INSERT INTO `depositaccount` (`company_idcompany`, `users_idusers`, `codeAccount`, `stateBD`) VALUES ('$idcompany', '$iduser', '$data', '1')";
				$query = $this->con->consulta($sql);
				if ($query) {
					$sql = "SELECT * FROM depositaccount ORDER BY iddepositAccounts desc";
					$query = $this->con->returnConsulta($sql);
					$row = mysqli_num_rows($query);
					$array = mysqli_fetch_array($query);
					$idAccount = $array['iddepositAccounts'];
					$sql = "INSERT INTO `depositaccountdetails` (`depositAccount_iddepositAccounts`, `numberAccount`, `currentAssets`, `bank`, `date_register`, `total_sales`, `total_buy`) VALUES ('$idAccount', '$dataNumber', '$dataCurrent', '$dataBank', '$dateTime', '0', '0')";
					$query = $this->con->consulta($sql);
					if ($query) {
						$sql = "INSERT INTO `movementdepositaccount` (`depositAccount_iddepositAccounts`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`) VALUES ('1', '1', '1', '$dataCurrent', '$dateTime')";
						$query = $this->con->consulta($sql);
						if ($query) {

							$datetimeNot = 	date("Y-m-d G:i:s A");
							$mensaje = "Felicitaciones ! has registrado una cuenta de depositos a tu empresa exitosamente.";
							$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `depositAccount_iddepositAccounts`) VALUES ('', '9', '$mensaje', '$datetimeNot', '$idAccount')";
							$query = $this->con->consulta($sql);

							$sql = "SELECT * FROM movementdepositaccount ORDER BY idmovementDepositAccount DESC";
							$query = $this->con->returnConsulta($sql);
							$data = mysqli_fetch_array($query);
							$idMove = $data['idmovementDepositAccount'];
							$totalMoney = $data['totalMoney'];
							if ($totalMoney > 0) {
								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Felicitaciones ! has ingresado la suma de <b>$" . number_format($dataCurrent) . "</b> a tu cuenta de depositos.";
								$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `movementDepositAccount_idmovementDepositAccount`) VALUES ('', '11', '$mensaje', '$datetimeNot', '$idMove')";
								$query = $this->con->consulta($sql);

								if ($query) {
									header("location:" . URL . "login?new_cash");
								}else{
									header("location:" . URL . "login?new_cash=error_notification");
								}
							}else{
								header("location:" . URL . "login?new_cash");
							}

							
						}else{
							header("location:" . URL . "login?new_cash=error_movement_account");
						}
					}else{
						echo "Ah ocurrido un error al ingresar los detalles de la cuenta de deposito";
					}
				}else{
					echo "Ah ocurrido un error al ingresar los datos principales de la cuenta de deposito";
				}
			}else{
				echo "Campo vacio";
			}
			if ($query) {
				//echo "Si";
			}else{
				echo "No insert";
			}
			//echo $sql . "<br>";
		}
	}


	
}