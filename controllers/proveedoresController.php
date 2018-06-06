<?php namespace controllers;

/**
* 
*/
use models\Providers as provider;
use models\Conexion as conexion;

class proveedoresController
{
	private $errors;

	public function __construct()
	{
		$this->errors = 'Isma';
	}

	public function crear()
	{
		if (isset($_POST['idcompany'])) {
			$this->conexion = new Conexion();
			$this->provider = new provider();//echo "Hi";
			$this->provider->set("idcompany", $_POST['idcompany']);
			$this->provider->set("idUser", $_POST['idUser']);
			$this->provider->set("nameUser", $_POST['nameUser']);
			$this->provider->set("lastnameUser", $_POST['lastnameUser']);
			$this->provider->set("documentUser", $_POST['documentUser']);
			$this->provider->set("companyUser", $_POST['companyUser']);
			$this->provider->set("age", $_POST['age']);
			$this->provider->set("phone", $_POST['phone']);
			$this->provider->set("email", $_POST['email']);
			$this->provider->set("description", $_POST['description']);
			$this->provider->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->provider->set("photo_name", $_FILES['photo']['name']);
			$this->provider->set("photo_size", $_FILES['photo']['size']);
			$this->provider->set("photo_type", $_FILES['photo']['type']);
			$this->provider->create();
		}else{
			//echo "string";
		}

	}

	public function index()
	{
	}

	public function detalles()
	{
		if (isset($_POST['idUser'])) {
			$this->conexion = new Conexion();
			$this->provider = new provider();//echo "Hi";
			$this->provider->set("idUser", $_POST['idUser']);
			$this->provider->set("nameUser", $_POST['nameUser']);
			$this->provider->set("idcompany", $_POST['nameCompany']);
			$this->provider->set("username", $_POST['userName']);
			$this->provider->set("pass", $_POST['pass']);
			$this->provider->set("lastnameUser", $_POST['lastname']);
			$this->provider->set("documentUser", $_POST['document']);
			$this->provider->set("companyUser", $_POST['companyUser']);
			$this->provider->set("age", $_POST['age']);
			$this->provider->set("phone", $_POST['phone']);
			$this->provider->set("email", $_POST['email']);
			$this->provider->set("description", $_POST['description']);
			$this->provider->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->provider->set("photo_name", $_FILES['photo']['name']);
			$this->provider->set("photo_size", $_FILES['photo']['size']);
			$this->provider->set("photo_type", $_FILES['photo']['type']);
			$this->provider->update();
		}elseif(isset($_POST['idDelete'])){
			$this->conexion = new Conexion();
			$this->provider = new provider();//echo "Hi";
			$this->provider->set("idUser", $_POST['idDelete']);
			$this->provider->delete();
		}	
	}

	public function tabla()
	{
	}

	public function delete()
	{
		
	}

	public function newProduct()
	{
	}

	public function success()
	{
		
	}

	public function limit()
	{
		
	}

}
$error = new errorsController();