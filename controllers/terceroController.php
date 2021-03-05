<?php namespace controllers;
$metodo = $request->getMetodo();
/**
* 
*/
use models\Tercero as tercero;

class terceroController
{

	public function index()
	{
		# code...
	}

	public function editar()
	{
		if (isset($_POST['idUser'])) {
			$this->tercero = new tercero();//echo "Hi";
			$this->tercero->set("idUser", $_POST['idUser']);
			$this->tercero->set("nameUser", $_POST['nameUser']);
			$this->tercero->set("idcompany", $_POST['nameCompany']);
			$this->tercero->set("username", $_POST['userName']);
			$this->tercero->set("pass", $_POST['pass']);
			$this->tercero->set("lastnameUser", $_POST['lastname']);
			$this->tercero->set("documentUser", $_POST['document']);
			$this->tercero->set("companyUser", $_POST['companyUser']);
			$this->tercero->set("age", $_POST['age']);
			$this->tercero->set("phone", $_POST['phone']);
			$this->tercero->set("email", $_POST['email']);
			$this->tercero->set("dv", $_POST['dv']);
			$this->tercero->set("pais", $_POST['pais']);
			$this->tercero->set("departamento", $_POST['departamento']);
			$this->tercero->set("municipio", $_POST['municipio']);
			$this->tercero->set("direccion", $_POST['direccion']);
			$this->tercero->set("description", $_POST['description']);
			$this->tercero->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->tercero->set("photo_name", $_FILES['photo']['name']);
			$this->tercero->set("photo_size", $_FILES['photo']['size']);
			$this->tercero->set("photo_type", $_FILES['photo']['type']);
			if(isset($_POST['tipoCliente'])){
				$this->tercero->set("tipoCliente", $_POST['tipoCliente']);
			}else{
				$this->tercero->set("tipoCliente", 0);
			}if(isset($_POST['tipoProveedor'])){
				$this->tercero->set("tipoProveedor", $_POST['tipoProveedor']);
			}else{
				$this->tercero->set("tipoProveedor", 0);
			}if(isset($_POST['tipoEmpleado'])){
				$this->tercero->set("tipoEmpleado", $_POST['tipoEmpleado']);
			}else{
				$this->tercero->set("tipoEmpleado", 0);
			}if(isset($_POST['tipoOtro'])){
				$this->tercero->set("tipoOtro", $_POST['tipoOtro']);
			}else{
				$this->tercero->set("tipoOtro", 0);
			} 
			$this->tercero->update();
		}elseif(isset($_POST['idDelete'])){
			$this->tercero = new tercero();//echo "Hi";
			$this->tercero->set("idUser", $_POST['idDelete']);
			$this->tercero->delete();
		}
	}

    public function crear()
	{
		if (isset($_POST['tipoPersona'])) {
 			$this->tercero = new tercero();//echo "Hi";
			
			 if(isset($_POST['tipoCliente'])){
				$this->tercero->set("tipoCliente", $_POST['tipoCliente']);
			}else{
				$this->tercero->set("tipoCliente", 0);
			}if(isset($_POST['tipoProveedor'])){
				$this->tercero->set("tipoProveedor", $_POST['tipoProveedor']);
			}else{
				$this->tercero->set("tipoProveedor", 0);
			}if(isset($_POST['tipoEmpleado'])){
				$this->tercero->set("tipoEmpleado", $_POST['tipoEmpleado']);
			}else{
				$this->tercero->set("tipoEmpleado", 0);
			}if(isset($_POST['tipoOtro'])){
				$this->tercero->set("tipoOtro", $_POST['tipoOtro']);
			}else{
				$this->tercero->set("tipoOtro", 0);
			} 
			$this->tercero->set("tipoPersona", $_POST['tipoPersona']);
			$this->tercero->set("idUser", $_POST['idUser']);
			$this->tercero->set("nombres", $_POST['nombres']);
			$this->tercero->set("apellidos", $_POST['apellidos']);
			$this->tercero->set("razonSocial", $_POST['razonSocial']);
			$this->tercero->set("nombreComercial", $_POST['nombreComercial']);
			$this->tercero->set("tipodocumento", $_POST['tipodocumento']);
			$this->tercero->set("documento", $_POST['documento']);
			$this->tercero->set("digVer", $_POST['digVer']);
			$this->tercero->set("phone", $_POST['phone']);
			$this->tercero->set("email", $_POST['email']);
			$this->tercero->set("pais", $_POST['pais']);
			$this->tercero->set("departamento", $_POST['departamento']);
			$this->tercero->set("municipio", $_POST['municipio']);
			$this->tercero->set("direccion", $_POST['direccion']);
			$this->tercero->set("description", $_POST['description']);
			$this->tercero->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->tercero->set("photo_name", $_FILES['photo']['name']);
			$this->tercero->set("photo_size", $_FILES['photo']['size']);
			$this->tercero->set("photo_type", $_FILES['photo']['type']);
			
			$this->tercero->crearTercero();
		}
	}

}