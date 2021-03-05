<?php namespace models;

/**
* 
*/
class Tercero
{

    
	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
    
    public function arrayPaises()
	{
		$sql = "SELECT * FROM paises";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayDepartamentos()
	{
		$sql = "SELECT * FROM departamentos";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayMunicipios()
	{
		$sql = "SELECT * FROM municipios";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function crearTercero()
	{
		$tipoPersona = $this->tipoPersona;
		$tipoCliente = $this->tipoCliente;
		$tipoProveedor = $this->tipoProveedor;
		$tipoEmpleado = $this->tipoEmpleado;
		$tipoOtro = $this->tipoOtro;
		$idUser = $this->idUser;
		$nombres = $this->nombres;
		$apellidos = $this->apellidos;
		$razonSocial = $this->razonSocial;
		$nombreComercial = $this->nombreComercial;
		$tipodocumento = $this->tipodocumento;
		$documento = $this->documento;
		$digVer = $this->digVer;
		$phone = $this->phone;
		$email = $this->email;
		$pais = $this->pais;
		$departamento = $this->departamento;
		$municipio = $this->municipio;
		$direccion = $this->direccion;
		$description = $this->description;
		$photo_tmp_name = $this->photo_tmp_name;
		$photo_name = $this->photo_name;
		$photo_size = $this->photo_size;
		$photo_type = $this->photo_type;

		$nombreExplode = explode (" ", $nombres);
		$nombre1=$nombreExplode[0];
		$nombren2=$nombreExplode[1];
		$nombren3=$nombreExplode[2];
		$nombren4=$nombreExplode[3];
		$nombre2=$nombren2." ".$nombren3." ".$nombren4;

		$apellidoExplode = explode (" ", $apellidos);
		$apellido1=$apellidoExplode[0];
		$apellidon2=$apellidoExplode[1];
		$apellidon3=$apellidoExplode[2];
		$apellidon4=$apellidoExplode[3];
		$apellido2=$apellidon2." ".$apellidon3." ".$apellidon4;


		$subtrNombre = substr("$nombre1", -1, 3);
		$userName=$nombre1.$subtrNombre;
		$strlen = strlen($nombre1) - 2;
		$userNameStrlen = substr("$nombre1", 0, -$strlen);
		$userName = $userNameStrlen . $apellido1 . date('s');

		$sql = "SELECT * FROM municipios WHERE codigo=$municipio AND departamento=$departamento";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$municipioNombre = $array['nombre'];

		$sql = "SELECT * FROM departamentos WHERE codigo=$departamento";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$departamentoNombre = $array['nombre'];

		$sql = "SELECT * FROM paises WHERE codigo=$pais";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$paisNombre = $array['nombre'];

		
		$sql = "INSERT INTO `users` (`company_idcompany`, `userName`, `password`, `stateBD`) VALUES ('1', '$userName', '$documento', '1')";
		$query = $this->con->consulta($sql);
		
		if($query){
			if($tipoEmpleado==1){
				$rango=1;
			}else{
				$rango=0;
			}
			$sql = "SELECT * FROM users ORDER BY idusers DESC";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idusers = $array['idusers'];
			$dateTime = 	date("Y-m-d G:i:s A");
			$dir_subida = 'views/assets/images/users/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($photo_name);
			if (move_uploaded_file($photo_tmp_name, $fichero_subido)) {
				$ruta = 'views/assets/images/users/' . date('h-m.s') . $photo_name;
			}else{
				$ruta = 'views/assets/images/users/default_client.png';
			}
			$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `range`, `jobTitle`, `company`, `phone`, `email`, `ruta`, `description`, `documento`, `dv`, `codmunicipio`, `codigodepartamento`, `codigopais`, `direccion`, `municipio`, `departamento`, `pais`, `primerNombre`, `otrosNombres`, `primerApellido`, `segundoApellido`, `tipoCliente`, `tipoEmpleado`, `tipoProveedor`, `tipoOtro`, `tipoAdmin`, `tipoContador`, `tipoCajero`, `razonSocial`, `nombreComercial`) VALUES ('$idusers', '$nombres', '$apellidos', '$documento', '', '', '$dateTime', '$rango', '', '$razonSocial', '$phone', '$email', '$ruta', '$description', '$documento', '$digVer', '$municipio', '$departamento', '$pais', '$direccion', '$municipioNombre', '$departamentoNombre', '$paisNombre', '$nombre1', '$nombre2', '$apellido1', '$apellido2', '$tipoCliente', '$tipoEmpleado', '$tipoProveedor', '$tipoOtro',0,0,0, '$razonSocial', '$nombreComercial')";
			$query = $this->con->returnConsulta($sql);
			if($query){
				header("location:" . URL . "tercero/crear?success");
			}else{
				header("location:" . URL . "tercero/crear?error");
			}
		}else{
			header("location:" . URL . "tercero/crear?error");
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
			$mensaje = "Se ha eliminado un cliente ya no tendras acceso a el.";
			$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '21', '$mensaje', '$datetimeNot', '$idUser')";
			$query = $this->con->consulta($sql);
			if ($query) {
				header("location:" . URL . "clientes?success_delete");
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
		$idcompany = strtolower($this->idcompany);
		$idUser = strtolower($this->idUser);
		$username = strtolower($this->username);
		$pass = base64_encode($this->pass);
		$nameUser = strtolower($this->nameUser);
		$nombres = strtolower($this->nameUser);
		$lastnameUser = strtolower($this->lastnameUser);
		$apellidos = strtolower($this->lastnameUser);
		$documentUser = strtolower($this->documentUser);
		$companyUser = strtolower($this->companyUser);
		$dv = strtolower($this->dv);
		$age = strtolower($this->age);
		$phone = strtolower($this->phone);
		$email = strtolower($this->email);
		$description = strtolower($this->description);
		$pais = strtolower($this->pais);
		$departamento = strtolower($this->departamento);
		$municipio = strtolower($this->municipio);
		$direccion = strtolower($this->direccion);
		$tipoCliente = strtolower($this->tipoCliente);
		$tipoProveedor = strtolower($this->tipoProveedor);
		$tipoEmpleado = strtolower($this->tipoEmpleado);
		$tipoOtro = strtolower($this->tipoOtro);

		$sql = "SELECT * FROM municipios WHERE codigo=$municipio AND departamento=$departamento";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$municipioNombre = $array['nombre'];

		$sql = "SELECT * FROM departamentos WHERE codigo=$departamento";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$departamentoNombre = $array['nombre'];

		$sql = "SELECT * FROM paises WHERE codigo=$pais";
		$query = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($query);
		$paisNombre = $array['nombre'];
		
		$dateTime = date("Y-m-d");
			$dir_subida = 'views/assets/images/users/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($photo_name);
			if (move_uploaded_file($photo_tmp_name, $fichero_subido)) {
				$ruta = 'views/assets/images/users/' . date('h-m.s') . $photo_name;
			}else{
				$ruta = 'views/assets/images/users/default_client.png';
			}	
			$sql = "UPDATE `users` SET `userName`='$username', `password`='$pass' WHERE `idusers`='$idUser'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$nombreExplode = explode (" ", $nombres);
				$nombre1=$nombreExplode[0];
				$nombren2=$nombreExplode[1];
				$nombren3=$nombreExplode[2];
				$nombren4=$nombreExplode[3];
				$nombre2=$nombren2." ".$nombren3." ".$nombren4;

				$apellidoExplode = explode (" ", $apellidos);
				$apellido1=$apellidoExplode[0];
				$apellidon2=$apellidoExplode[1];
				$apellidon3=$apellidoExplode[2];
				$apellidon4=$apellidoExplode[3];
				$apellido2=$apellidon2." ".$apellidon3." ".$apellidon4;

				$sql = "UPDATE `userdetails` SET `nameUser`='$nameUser', `lastnameUser`='$lastnameUser', `documentUser`='$documentUser', `age`='$age', `data_update`='$dateTime', `phone`='$phone', `email`='$email', `description`='$description', `ruta`='$ruta', `company`='$companyUser', `primerNombre`='$nombre1', `otrosNombres`='$nombre2', `primerApellido`='$apellido1', `segundoApellido`='$apellido2', `documento`='$documentUser', `dv`='$dv', `municipio`='$municipioNombre', `codmunicipio`='$municipio', `departamento`='$departamentoNombre', `codigodepartamento`='$departamento', `pais`='$paisNombre', `codigopais`='$pais', `direccion`='$direccion', `tipoCliente`='$tipoCliente', `tipoProveedor`='$tipoProveedor', `tipoEmpleado`='$tipoEmpleado', `tipoOtro`='$tipoOtro' WHERE `iduserDetails`='$idUser'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado un producto puedes ver el resultado en la lista.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '19', '$mensaje', '$datetimeNot', '$idUser')";
					$query = $this->con->consulta($sql);
					if ($query) {
						header("location:" . URL . "tercero/editar?id=$idUser&configurar&success_update");
					}else{
						echo "Error en la notificacion";
					}
				}else{
					echo "ERROR AL EJECUTAR LA SEGUNDA CONSULTA";
				}
			}else{
				echo "ERROR AL EJECUTAR LA PRIMER CONSULTA";
			}
			
	}


	

}