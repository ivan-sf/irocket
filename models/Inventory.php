<?php namespace models;

class Inventory
{
	private $name;
	private $description;
	private $iduser;
	private $iddelete;
	private $idupdate;
	private $codeCurrent;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
	
	

	public function create()
	{
		$connect = $this->con->connect();
		$nameInventory = $this->name;
		$descriptionInventory = $this->description;
		$iduser = $this->iduser;
		$codeCurrent = $this->codeCurrent;
		$count = count($nameInventory);
		for ($i=0; $i < $count ; $i++) { 
			$inventoryName = strtolower(mysqli_real_escape_string($connect,$nameInventory[$i]));
			$inventoryDescription = strtolower(mysqli_real_escape_string($connect,$descriptionInventory[$i]));
			if ($inventoryName != '') {

				$sql = "SELECT * FROM inventory INNER JOIN inventorydetails ON inventory.idinventory=inventorydetails.inventory_idinventory WHERE inventory.stateBD = 1";
				$query = $this->con->returnConsulta($sql);
				$row = mysqli_num_rows($query);
				$array = mysqli_fetch_array($query);
				$nameInventory = $array['nameInventory'];

				if ($row <= 49 ) {
					$sql = "SELECT * FROM inventory INNER JOIN inventorydetails ON inventory.idinventory=inventorydetails.inventory_idinventory WHERE inventorydetails.nameInventory = '$inventoryName'";
					$query = $this->con->returnConsulta($sql);
					$row = mysqli_num_rows($query);
					if ($row >= 1) {
						header("location:" . URL . "inventarios/crear?error=1");
					}else{
						$sql = "SELECT * FROM users INNER JOIN company;";
						$query = $this->con->returnConsulta($sql);
						$row = mysqli_num_rows($query);
						$array = mysqli_fetch_array($query);
						$idcompany = $array['idcompany'];	
						$codeInventory = "ISL202020" . date('s') . rand(date('s'), 61);	
						if ($row >= 1) {

							$sql = "INSERT INTO `inventory` (`company_idcompany`, `codeInventory`, `stateBD`) VALUES ('$idcompany', '$codeInventory', '1')";
							$query = $this->con->Consulta($sql);
							if ($query) {
								$sql = "SELECT * FROM inventory order by idinventory desc";
								$query = $this->con->returnConsulta($sql);
								$row = mysqli_num_rows($query);
								$array = mysqli_fetch_array($query);
								$idinventory = $array['idinventory'];
								$dateTime = date("Y-m-d");

								$sql = "INSERT INTO `inventorydetails` (`inventory_idinventory`, `nameInventory`, `date_register`, `user_create`, `descriptionInventory`, `codeStatus`, `codeCurrent`) VALUES ('$idinventory', '$inventoryName', '$dateTime', '$iduser', '$inventoryDescription', '1', $codeCurrent)";
								$query = $this->con->consulta($sql);
								if ($query) {
									//echo "Si";
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! Se ha creado un nuevo inventario puedes ver el resultado en el catalogo.";
									$sql = "INSERT INTO `notifications` (`users_idusers`, `inventory_idinventory`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idinventory', '1', '$mensaje', '$datetimeNot')";
									$query = $this->con->Consulta($sql);
									if ($query) {
										header("location:" . URL . "inventarios/crear?success");	
									}else{
										header("location:" . URL . "inventarios/crear?success");	
										echo "Error en la notificacion";
									}
									
								}else{
									echo "No";
								}
							}else{
								echo "No se lograron ingresar los datos, vuelva a intentar. Contactar con el soporte si el problema persiste.";
							}
						}
					}
				}else{
					header("location:" . URL . "inventarios/crear?error=2");
				}
			}else{
				echo "sad";
			}
		}
		
	}
	public function array()
	{
		$sql = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE stateBD = 1";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
		
	}
	public function arrayCreate()
	{
		$sql = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE stateBD = 1";
		$datos = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($datos);
		return $array;
	}

	

	public function array1()
	{
		$sql = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE stateBD = 1";
		$datos = $this->con->consulta($sql);
		return $datos;
		
	}

	public function row()
	{
		$sql = "SELECT * FROM inventory";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function delete()
	{
		$connect = $this->con->connect();
		$iddelete = strtolower(mysqli_real_escape_string($connect,$this->iddelete));
		//echo $iddelete;
		$sql = "UPDATE `inventory` SET `stateBD`='0' WHERE `idinventory`='$iddelete';";
		$query = $this->con->consulta($sql);
		$iduser = $this->iduser;
		$idinventory = $iddelete;
		if ($query) {
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha eliminado un inventario puedes ver el resultado en la lista de inventarios.";
			$sql = "INSERT INTO `notifications` (`users_idusers`, `inventory_idinventory`, `typeNotification`, `message`, `date_register`) VALUES ('1', '$idinventory', '3', '$mensaje', '$datetimeNot')";
			$query = $this->con->Consulta($sql);
			if ($query) {
			header("location:" . URL . "inventarios?success_update");
			}else{
				echo "Error en la notificacion";
			}
		}else{
			echo "No";
		}
	}

	public function update()
	{	
		$connect = $this->con->connect();
		$idupdate = strtolower(mysqli_real_escape_string($connect,$this->idupdate));
		$name = strtolower(mysqli_real_escape_string($connect,$this->name));
		$description = strtolower(mysqli_real_escape_string($connect,$this->description));
		$dateTime = date("Y-m-d"); 
		$codeCurrent = $this->codeCurrent;
		$sql = "UPDATE `inventorydetails` SET `nameInventory`='$name',  `codeCurrent`='$codeCurrent', `date_update`='$dateTime', `descriptionInventory`='$description' WHERE `inventory_idinventory`='$idupdate';";
		$query = $this->con->consulta($sql);
		$iduser = $this->iduser;
		$idinventory = $idupdate;
		if ($query) {
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha editado un inventario puedes ver el resultado en la lista de inventarios.";
			$sql = "INSERT INTO `notifications` (`users_idusers`, `inventory_idinventory`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idinventory', '2', '$mensaje', '$datetimeNot')";
			$query = $this->con->Consulta($sql);
			if ($query) {
			header("location:" . URL . "inventarios?success_update");
			}else{
				echo "Error en la notificacion";
			}
		}else{
			echo "No";
		}
	}


	public function dataUser()
	{
		$iduser = $this->iduser;
		$description = $this->description;
		$iddelete = $this->iddelete;
		$sql = "SELECT * FROM inventory INNER JOIN inventorydetails ON idinventory=inventory_idinventory WHERE idinventory='$iduser'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}
}

