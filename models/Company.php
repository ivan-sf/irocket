<?php namespace models;

/**
* 
*/
class Company
{

	private $idcompany;
	private $companyName;
	private $companyNit;
	private $companyDirection;
	private $companyCity;
	private $companyPhone;
	private $companyEmail;
	private $companyLogoNameTemp;
	private $companyLogoName;
	private $companyLogoSize;
	private $companyLogoType;
	private $regimen;
	private $lastnameUser;
	private $nameUser;

	private $resolucion;
	private $prefijoInicial;
	private $prefijoFinal;
	private $pieFactura;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}

	public function array()
	{
		$sql = "SELECT * FROM company";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dataCompany()
	{
		$sql = "SELECT * FROM company INNER JOIN companydetails";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function view()
	{
		$connect = $this->con->connect();
		$idcompany = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$sql = "SELECT * FROM company INNER JOIN companydetails ON company.idcompany = companydetails.company_idcompany WHERE idcompany = '$idcompany'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}



	public function create()
	{
		$connect = $this->con->connect();
		$companyName = strtolower(mysqli_real_escape_string($connect,$this->companyName));
		$companyNit = strtolower(mysqli_real_escape_string($connect,$this->companyNit));
		$companyDirection = strtolower(mysqli_real_escape_string($connect,$this->companyDirection));
		$companyCity = strtolower(mysqli_real_escape_string($connect,$this->companyCity));
		$regimen = strtolower(mysqli_real_escape_string($connect,$this->regimen));
		$lastnameUser = strtolower(mysqli_real_escape_string($connect,$this->lastnameUser));
		$nameUser = strtolower(mysqli_real_escape_string($connect,$this->nameUser));
		$companyPhone = strtolower(mysqli_real_escape_string($connect,$this->companyPhone));
		$companyEmail = strtolower(mysqli_real_escape_string($connect,$this->companyEmail));
		$companyLogoNameTemp = strtolower(mysqli_real_escape_string($connect,$this->companyLogoNameTemp));
		$companyLogoName = strtolower(mysqli_real_escape_string($connect,$this->companyLogoName));
		$companyLogoSize = mysqli_real_escape_string($connect,$this->companyLogoSize);
		$companyLogoType = mysqli_real_escape_string($connect,$this->companyLogoType);
		$dateTime = date("Y-m-d");

		$sql = "SELECT * FROM userdetails WHERE userdetails.range = 9";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);
		
		$propietario = $nameUser . " " . $lastnameUser; 

		if ($companyName != '') {
			$sql = "SELECT * FROM company";
			$datos = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($datos);
			if ($row == 0) {		
				$sql = "INSERT INTO `company` (`nameCompany`,`regimen`,`propietario`) VALUES ('$companyName','$regimen','$propietario')";
				$insert = $this->con->Consulta($sql);
				if ($insert == 1) {
					
					$sql = "SELECT * FROM company WHERE namecompany = '$companyName'";
					$datos = $this->con->returnConsulta($sql);
					$array = mysqli_fetch_array($datos);
					$idcompany = $array['idcompany'];

					if ($companyLogoSize == 0) {
						
						$ruta = "views/assets/images/company/default.png";
						$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
						$datos2 = $this->con->consulta($sql2);
						if ($datos2 == 1) {
								
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);
						}else{
							echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
						}

					}
				}else{
					echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
				}
			}else{
				echo "Lo sentimos ya existe una empresa en nuestra base de Datos, si quieres ampliar tu plan <a href=''>Ponte en contacto</a> <a href='" . URL . "'>Inicia sesion</a>";
			}

		}else{
			echo "Nombre de empresa no ingresado";
		}
	}

	
	public function list()
	{
		$sql = "SELECT * FROM company";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function update()
	{
		$connect = $this->con->connect();
		$idUpdate = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$companyName = strtolower(mysqli_real_escape_string($connect,$this->companyName));
		$companyNit = strtolower(mysqli_real_escape_string($connect,$this->companyNit));
		$companyDirection = strtolower(mysqli_real_escape_string($connect,$this->companyDirection));
		$companyCity = strtolower(mysqli_real_escape_string($connect,$this->companyCity));
		$companyPhone = strtolower(mysqli_real_escape_string($connect,$this->companyPhone));
		$companyEmail = strtolower(mysqli_real_escape_string($connect,$this->companyEmail));

		$resolucion = strtolower(mysqli_real_escape_string($connect,$this->resolucion));
		$prefijoInicial = strtolower(mysqli_real_escape_string($connect,$this->prefijoInicial));
		$prefijoFinal = strtolower(mysqli_real_escape_string($connect,$this->prefijoFinal));
		$pieFactura = strtolower(mysqli_real_escape_string($connect,$this->pieFactura));
		

		$companyLogoNameTemp = $this->companyLogoNameTemp;
		$companyLogoName = $this->companyLogoName;
		$companyLogoSize = $this->companyLogoSize;
		$companyLogoType = $this->companyLogoType;
		$dateTime = date("Y-m-d");
		if ($companyLogoSize == 0) {
			$sql = "UPDATE `company` SET `nameCompany`='$companyName' WHERE `idcompany`='$idUpdate'";
			$query = $this->con->consulta($sql);
			
			if ($query) {
				$sql = "UPDATE `companydetails` SET 
				`nitCompany`='$companyNit', 
				`directionCompany`='$companyDirection', 
				`cityCompany`='$companyCity', 
				`phoneCompany`='$companyPhone', 
				`emailCompany`='$companyEmail', 
				`data_update`='$dateTime', 
				`resolucion`='$resolucion',  
				`prefijoInicial`='$prefijoInicial',  
				`prefijoFinal`='$prefijoFinal',  
				`pieFactura`='$pieFactura' 
				WHERE `idcompanyDetails`='$idUpdate'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$idUpdate = $this->idcompany;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado los datos empresariales con exito.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '16', '$mensaje', '$datetimeNot', '$idUpdate')";
					$query = $this->con->consulta($sql);
					header("location:" . URL . "empresa/detalles?id=" . $idUpdate . "&configurar&success_update");
				}else{
					echo "Error al ejecutar la segunda consulta";
				}
			}else{
				echo "Error al ejecutar la primer consulta";
			}
		}else{
			$ruta = 'views/assets/images/company/' . date('h-m.s') . $companyLogoName;
			$dir_subida = 'views/assets/images/company/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($companyLogoName);
			if (move_uploaded_file($companyLogoNameTemp, $fichero_subido)){
				$sql = "UPDATE `company` SET `nameCompany`='$companyName' WHERE `idcompany`='$idUpdate'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `companydetails` SET 
				`nitCompany`='$companyNit', 
				`directionCompany`='$companyDirection', 
				`cityCompany`='$companyCity', 
				`phoneCompany`='$companyPhone', 
				`emailCompany`='$companyEmail', 
				`data_update`='$dateTime', 
				`resolucion`='$resolucion',  
				`prefijoInicial`='$prefijoInicial',  
				`prefijoFinal`='$prefijoFinal',  
				`pieFactura`='$pieFactura' 
				WHERE `idcompanyDetails`='$idUpdate'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$idUpdate = $this->idcompany;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado los datos empresariales con exito.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '16', '$mensaje', '$datetimeNot', '$idUpdate')";
					$query = $this->con->consulta($sql);
					header("location:" . URL . "empresa/detalles?id=" . $idUpdate . "&configurar&success_update");
				}else{
					echo "Error al ejecutar la segunda consulta";
				}
			}else{
				echo "Error al ejecutar la primer consulta";
			}
			}else{
				echo $companyLogoName;
			}
		}
	}
	public function delete()
	{
		# code...
	}
}
