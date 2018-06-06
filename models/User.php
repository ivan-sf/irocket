<?php namespace models;
/**
* 
*/
class User
{
	private $nameUser;
	private $lastnameUser;
	private $documentUser;
	private $phoneUser;
	private $emailUser;
	private $claveUser;
	private $genereUser;
	private $ageUser;
	private $photoUserNameTemp;
	private $photoUserName;
	private $photoUserSize;
	private $photoUserType;
	private $docuser;

	function __construct(){
		$this->con = new Conexion;
	}


	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}


	public function viewClient()
	{
		$connect = $this->con->connect();
		$docuser = strtolower(mysqli_real_escape_string($connect,$this->docuser));
		$sql = "SELECT * FROM users 
				INNER JOIN userdetails 
				ON users.idusers = userdetails.iduserDetails 
				WHERE idusers = '$docuser'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}

	public function get($atributo){
		return $this-$atributo;
	}


	public function list()
	{
		$sql = "SELECT * FROM users";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function inner()
	{
		if (isset($_SESSION['administrador'])) {
			$iduser = $_SESSION['administrador'];
		}elseif(isset($_SESSION['adminUserNew'])){
			$iduser = $_SESSION['adminUserNew'];
		}
		$sql = "SELECT * FROM users INNER JOIN userdetails ON idusers=users_idusers WHERE idusers='$iduser'";
		$datos = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($datos);
		return $array;
	}

	public function createAdmin()
	{
		$connect = $this->con->connect();
		$nameUser = strtolower(mysqli_real_escape_string($connect,$this->nameUser));
		$lastnameUser = strtolower(mysqli_real_escape_string($connect,$this->lastnameUser));
		$documentUser = strtolower(mysqli_real_escape_string($connect,$this->documentUser));
		$phoneUser = strtolower(mysqli_real_escape_string($connect,$this->phoneUser));
		$emailUser = strtolower(mysqli_real_escape_string($connect,$this->emailUser));
		$claveUser = mysqli_real_escape_string($connect,$this->claveUser);
		$genereUser = strtolower(mysqli_real_escape_string($connect,$this->genereUser));
		$ageUser = strtolower(mysqli_real_escape_string($connect,$this->ageUser));
		$photoUserNameTemp = strtolower(mysqli_real_escape_string($connect,$this->photoUserNameTemp));
		$photoUserName = strtolower(mysqli_real_escape_string($connect,$this->photoUserName));
		$photoUserSize = mysqli_real_escape_string($connect,$this->photoUserSize);
		$photoUserType = mysqli_real_escape_string($connect,$this->photoUserType);

		$sql = "SELECT * FROM userdetails WHERE userdetails.range = 9";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);
		if ($row == 0) {
		if ($nameUser != '') {
		$sql = "SELECT * FROM company";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);
		if ($row == 1) {
			$idcompany = $array['idcompany'];
			$strlen = strlen($nameUser) - 2;
			//echo $strlen - 2;
			//echo $strlen -3;
			$userNameStrlen = substr("$nameUser", 0, -$strlen);
			$userName = $userNameStrlen . $lastnameUser . date('s');
			$password = base64_encode($claveUser);
			$sql = "INSERT INTO `users` (`company_idcompany`, `userName`, `password`, `stateBD`, `numSes`) VALUES ('$idcompany', '$userName', '$password', '1', '1')";
			$insert = $this->con->consulta($sql);
			if ($insert) {
				$sql = "SELECT * FROM users WHERE userName = '$userName'";
				$query = $this->con->returnConsulta($sql);
				$array = mysqli_fetch_array($query);
				$row = mysqli_num_rows($query);
				if ($row >= 1) {
					$iduser = $array['idusers'];
					$dateTime = date("Y-m-d");
					if ($photoUserSize == 0) {
						$ruta = "views/assets/images/users/default.png";
						$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `data_update`, `range`, `jobTitle`, `phone`, `email`, `company`, `ruta`) VALUES ('$iduser', '$nameUser', '$lastnameUser', '$documentUser', '$genereUser', '$ageUser', '$dateTime', '', '9', 'administrador', '$phoneUser', '$emailUser', '1', '$ruta')";
						$insert = $this->con->consulta($sql);
						if ($insert) {

								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Felicitaciones ! has registrado como administrador a " . ucwords($nameUser) . " exitosamente.";
								$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '8', '$mensaje', '$datetimeNot', '$iduser')";
								$query = $this->con->consulta($sql);

						}else{
							echo "Lo sentimos ah ocurrido un error al ingresar los detalles de usuario en la base de datos por favor vuelva a intentar si el problema persiste por favor contacte con el soporte.";
						}
					}elseif ($photoUserSize >= 1) {
						$photoUserInsert = addslashes(file_get_contents($this->photoUserNameTemp));
						$ruta = 'views/assets/images/users/' . date('h-m.s') . $_FILES['photoUser']['name'];
						$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `data_update`, `range`, `jobTitle`, `phone`, `email`, `company`, `ruta`) VALUES ('$iduser', '$nameUser', '$lastnameUser', '$documentUser', '$genereUser', '$ageUser', '$dateTime', '', '9', 'administrador', '$phoneUser', '$emailUser', '1', '$ruta')";
						
						$insert = $this->con->consulta($sql);
						if ($insert) {
							$dir_subida = 'views/assets/images/users/' . date('h-m.s');
							$fichero_subido = $dir_subida . basename($_FILES['photoUser']['name']);
							if (move_uploaded_file($_FILES['photoUser']['tmp_name'], $fichero_subido)) {

								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Felicitaciones ! has registrado como administrador a " . ucwords($nameUser) . " exitosamente.";
								$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '8', '$mensaje', '$datetimeNot', '$iduser')";
								$query = $this->con->consulta($sql);

							}
						}else{
							echo "Lo sentimos ah ocurrido un error al ingresar los detalles de usuario en la base de datos por favor vuelva a intentar si el problema persiste por favor contacte con el soporte.";
						}
					}
					
				}
			}else{
				echo "Lo sentimos ah ocurrido un error al ingresar el formulario en la base de datos por favor vuelva a intentar si el problema persiste por favor contacte con el soporte.";
			}
		}elseif ($row == 0) {
			header("location:" . URL . "company/create/");
		}else{
			echo "Lo sentimos usted tiene mas empresas de las permitidas en su base de datos le recomendamos contactar con el soporte para arreglar el inconveniente.";
		}
	}else{
		echo "Lo sentimos, ah ocurrido un problema al insertar tu nombre en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
	}
		}else{
			echo "Ya existe un administrador";
			header("location:" . URL . "login?new_deposit");
		}

	
	}

}

