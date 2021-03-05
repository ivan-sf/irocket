<?php namespace models;

/**
* 
*/
class Providers
{
	private $idcompany;
	private $idUser;
	private $username;
	private $pass;
	private $nameUser;
	private $lastnameUser;
	private $documentUser;
	private $companyUser;
	private $age;
	private $phone;
	private $email;
	private $description;
	private $photo_tmp_name;
	private $photo_name;
	private $photo_size;
	private $photo_type;

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
		$iduser = $this->idproduct;
		$sql = "SELECT * FROM users 
		INNER JOIN userdetails 
		ON users.idusers=userdetails.users_idusers
		WHERE idusers='$iduser'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function array()
	{
		$sql = "SELECT * FROM users 
		INNER JOIN userdetails 
		ON users.idusers=userdetails.users_idusers
		WHERE userdetails.range = 3
		AND users.stateBD = 1
		ORDER BY users.idusers desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function array2()
	{
		$sql = "SELECT * FROM users 
		INNER JOIN userdetails 
		ON users.idusers=userdetails.users_idusers
		WHERE userdetails.range = 3
		AND users.stateBD = 1
		ORDER BY `users`.`userName` ASC";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function create()
	{
		$connect = $this->con->connect();
		$photo_size = $this->photo_size;
		$photo_tmp_name = $this->photo_tmp_name;
		$photo_name = $this->photo_name;
		$photo_type = $this->photo_type;
		$idcompany = $this->idcompany;
		$idUser = $this->idUser;
		$nameUser = $this->nameUser;
		$lastnameUser = $this->lastnameUser;
		$documentUser = $this->documentUser;
		$companyUser = $this->companyUser;
		$age = $this->age;
		$phone = $this->phone;
		$email = $this->email;
		$description = $this->description;

		$count = count($nameUser);

		for ($i=0; $i < $count; $i++) { 
			$idcompany = $idcompany;
			$idUser1 = strtolower(mysqli_real_escape_string($connect,$idUser[$i]));
			$nameUser1 = strtolower(mysqli_real_escape_string($connect,$nameUser[$i]));
			$lastnameUser1 = strtolower(mysqli_real_escape_string($connect,$lastnameUser[$i]));
			$documentUser1 = strtolower(mysqli_real_escape_string($connect,$documentUser[$i]));
			$companyUser1 = strtolower(mysqli_real_escape_string($connect,$companyUser[$i]));
			$age1 = strtolower(mysqli_real_escape_string($connect,$age[$i]));
			$phone1 = strtolower(mysqli_real_escape_string($connect,$phone[$i]));
			$email1 = strtolower(mysqli_real_escape_string($connect,$email[$i]));
			$description = strtolower(mysqli_real_escape_string($connect,$description[$i]));
		
			$sql = "SELECT * FROM company WHERE nameCompany='$idcompany'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idComp = $array['idcompany'];
			$nameUser11 = $nameUser1 . " " . $lastnameUser1;

			$sql = "SELECT * FROM users 
			INNER JOIN userdetails 
			ON users.idusers=userdetails.users_idusers
			WHERE userdetails.range = 3
			AND users.userName = '$nameUser11'
			OR userdetails.range = 3
			AND userdetails.documentUser = '$documentUser1'";
			$datos = $this->con->returnConsulta($sql);
			$rowdata = mysqli_num_rows($datos);

			if ($rowdata >= 1) {
				header("location:" . URL . "proveedores/crear?error");
			}else{
				if ($query) {
				$sql = "INSERT INTO `users` (`company_idcompany`, `userName`, `password`, `stateBD`) VALUES ('$idComp', '$nameUser11', '$documentUser1', '1')";
				$query = $this->con->consulta($sql);
				if ($query) {
					$ruta = 'views/assets/images/users/' . date('h-m.s') . $photo_name[$i];
					$dir_subida = 'views/assets/images/users/' . date('h-m.s');
					$fichero_subido = $dir_subida . basename($photo_name[$i]);
					if (move_uploaded_file($photo_tmp_name[$i], $fichero_subido)) {
							$sql = "SELECT * FROM users ORDER BY idusers DESC";
							$query = $this->con->returnConsulta($sql);
							$array = mysqli_fetch_array($query);
							$idus = $array['idusers'];
						if ($query) {
							$dateTime = date("Y-m-d");
							$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `range`, `jobTitle`, `company`, `phone`, `email`, `ruta`, `description`) VALUES ('$idus', '$nameUser1', '$lastnameUser1', '$documentUser1', '', '$age1', '$dateTime', '3', 'proveedor', '$companyUser1', '$phone1', '$email1', '$ruta', '$description')";
							$query = $this->con->consulta($sql);
								if ($query) {
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado el proveedor " . $nameUser1 . " " . $lastnameUser1 . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '24', '$mensaje', '$datetimeNot', '$idus')";
									$query = $this->con->consulta($sql);
									if ($query) {
										header("location:" . URL . "proveedores/crear?success");
									}else{
										echo "Error en la notificacion";
									}
								}else{
									echo "Error al ejecutar la segunda consulta";
								}
						}
					}else{
							$ruta = 'views/assets/images/users/default_provider.png';
							$sql = "SELECT * FROM users ORDER BY idusers DESC";
							$query = $this->con->returnConsulta($sql);
							$array = mysqli_fetch_array($query);
							$idus = $array['idusers'];
						if ($query) {
							$dateTime = date("Y-m-d");
							$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `range`, `jobTitle`, `company`, `phone`, `email`, `ruta`, `description`) VALUES ('$idus', '$nameUser1', '$lastnameUser1', '$documentUser1', '', '$age1', '$dateTime', '3', 'proveedor', '$companyUser1', '$phone1', '$email1', '$ruta', '$description')";
							$query = $this->con->consulta($sql);
								if ($query) {
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado el proveedor " . $nameUser1 . " " . $lastnameUser1 . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '24', '$mensaje', '$datetimeNot', '$idus')";
									$query = $this->con->consulta($sql);
									if ($query) {
										header("location:" . URL . "proveedores/crear?success");
									}else{
										echo "Error en la notificacion";
									}
								}else{
									echo "Error al ejecutar la segunda consulta";
								}
						}
					}
				}
			}
			else{
				echo "Error al ejecutar la primera consulta";
			}
			}

		}	
	}




	public function delete()
	{
		$connect = $this->con->connect();
		$idUser = strtolower(mysqli_real_escape_string($connect,$this->idUser));
		$sql = "UPDATE `users` SET `stateBD`='0' WHERE `idusers`='$idUser'";
		$query = $this->con->consulta($sql);
		if ($query) {
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha eliminado un proveedor ya no tendras acceso a el.";
			$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '26', '$mensaje', '$datetimeNot', '$idUser')";
			$query = $this->con->consulta($sql);
			if ($query) {
				header("location:" . URL . "proveedores?success_delete");
			}else{
				echo "Error en la notificacion";
			}
		}else{
			echo "Error al eliminar el usuario de la base de datos";
		}

	}

	public function update()
	{
		$connect = $this->con->connect();
		$photo_size = $this->photo_size;
		$photo_tmp_name = $this->photo_tmp_name;
		$photo_name = $this->photo_name;
		$photo_type = $this->photo_type;
		$idcompany = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$idUser = strtolower(mysqli_real_escape_string($connect,$this->idUser));
		$username = strtolower(mysqli_real_escape_string($connect,$this->username));
		$pass = strtolower(mysqli_real_escape_string($connect,$this->pass));
		$nameUser = strtolower(mysqli_real_escape_string($connect,$this->nameUser));
		$lastnameUser = strtolower(mysqli_real_escape_string($connect,$this->lastnameUser));
		$documentUser = strtolower(mysqli_real_escape_string($connect,$this->documentUser));
		$companyUser = strtolower(mysqli_real_escape_string($connect,$this->companyUser));
		$age = strtolower(mysqli_real_escape_string($connect,$this->age));
		$phone = strtolower(mysqli_real_escape_string($connect,$this->phone));
		$email = strtolower(mysqli_real_escape_string($connect,$this->email));
		$description = strtolower(mysqli_real_escape_string($connect,$this->description));
		$dateTime = date("Y-m-d");
		$newUserName = $nameUser . " " . $lastnameUser;

		$sqlProv = "SELECT * FROM users 
		INNER JOIN userdetails
		ON idusers=users_idusers
		WHERE idusers='$idUser'";
		$queryProv = $this->con->returnConsulta($sqlProv);
		$rowProv = mysqli_num_rows($queryProv);
		$arrayProv = mysqli_fetch_array($queryProv);
		$nameUserOld = $arrayProv['userName'];
		$docUserOld = $arrayProv['documentUser'];
		
		if ($nameUserOld==$newUserName OR $docUserOld==$documentUser) {
			




		if ($photo_size == 0) {
			$sql = "SELECT * FROM company WHERE nameCompany='$idcompany'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);



			$idcompany = $array['idcompany'];
			if ($query) {
				$sql = "UPDATE `users` SET `userName`='$newUserName', `password`='$pass' WHERE `idusers`='$idUser'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$sql = "UPDATE `userdetails` SET `nameUser`='$nameUser', `lastnameUser`='$lastnameUser', `documentUser`='$documentUser', `age`='$age', `data_update`='$dateTime', `phone`='$phone', `email`='$email', `description`='$description', `company`='$companyUser' WHERE `iduserDetails`='$idUser'";
					$query = $this->con->consulta($sql);
					if ($query) {
						$datetimeNot = 	date("Y-m-d G:i:s A");
						$mensaje = "Se ha editado un proveedor puedes ver el resultado en la lista.";
						$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '25', '$mensaje', '$datetimeNot', '$idUser')";
						$query = $this->con->consulta($sql);
						if ($query) {
							header("location:" . URL . "proveedores?success_update");
						}else{
							echo "Error en la notificacion";
						}
					}else{
						echo "ERROR AL EJECUTAR LA SEGUNDA CONSULTA";
					}
				}else{
					echo "ERROR AL EJECUTAR LA PRIMER CONSULTA";
				}
			}else{
				echo "ERROR AL SELECCIONAR LA EMPRESA";
			}
		}else{
			$ruta = 'views/assets/images/users/' . date('h-m.s') . $photo_name;
			$dir_subida = 'views/assets/images/users/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($photo_name);
			if (move_uploaded_file($photo_tmp_name, $fichero_subido)) {
				$sql = "SELECT * FROM company WHERE nameCompany='$idcompany'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idcompany = $array['idcompany'];
			if ($query) {
				$sql = "UPDATE `users` SET `userName`='$username', `password`='$pass' WHERE `idusers`='$idUser'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$sql = "UPDATE `userdetails` SET `nameUser`='$nameUser', `lastnameUser`='$lastnameUser', `documentUser`='$documentUser', `age`='$age', `data_update`='$dateTime', `phone`='$phone', `email`='$email', `description`='$description', `ruta`='$ruta', `company`='$companyUser' WHERE `iduserDetails`='$idUser'";
					$query = $this->con->consulta($sql);
					if ($query) {
						$datetimeNot = 	date("Y-m-d G:i:s A");
						$mensaje = "Se ha editado un proveedor puedes ver el resultado en la lista.";
						$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '25', '$mensaje', '$datetimeNot', '$idUser')";
						$query = $this->con->consulta($sql);
						if ($query) {
							header("location:" . URL . "proveedores?success_update");
						}else{
							echo "Error en la notificacion";
						}
					}else{
						echo "ERROR AL EJECUTAR LA SEGUNDA CONSULTA";
					}
				}else{
					echo "ERROR AL EJECUTAR LA PRIMER CONSULTA";
				}
			}else{
				echo "ERROR AL SELECCIONAR LA EMPRESA";
			}
			}else{
				echo "string";
			}
		}















		}else{
			





			///VERIFICAR SI LOS NUEVOS DATOS SON IGUALES A ALGUNOS QUE EXISTAN EN EL SISTEMA







		}

		
	}

}
