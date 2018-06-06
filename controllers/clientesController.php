<?php namespace controllers;

/**
* 
*/
use models\Clients as client;
use models\Conexion as conexion;

class clientesController
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
			$this->client = new client();//echo "Hi";
			$this->client->set("idcompany", $_POST['idcompany']);
			$this->client->set("idUser", $_POST['idUser']);
			$this->client->set("nameUser", $_POST['nameUser']);
			$this->client->set("lastnameUser", $_POST['lastnameUser']);
			$this->client->set("documentUser", $_POST['documentUser']);
			$this->client->set("companyUser", $_POST['companyUser']);
			$this->client->set("age", $_POST['age']);
			$this->client->set("phone", $_POST['phone']);
			$this->client->set("email", $_POST['email']);
			$this->client->set("description", $_POST['description']);
			$this->client->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->client->set("photo_name", $_FILES['photo']['name']);
			$this->client->set("photo_size", $_FILES['photo']['size']);
			$this->client->set("photo_type", $_FILES['photo']['type']);
			$this->client->create();
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
			$this->client = new client();//echo "Hi";
			$this->client->set("idUser", $_POST['idUser']);
			$this->client->set("nameUser", $_POST['nameUser']);
			$this->client->set("idcompany", $_POST['nameCompany']);
			$this->client->set("username", $_POST['userName']);
			$this->client->set("pass", $_POST['pass']);
			$this->client->set("lastnameUser", $_POST['lastname']);
			$this->client->set("documentUser", $_POST['document']);
			$this->client->set("companyUser", $_POST['companyUser']);
			$this->client->set("age", $_POST['age']);
			$this->client->set("phone", $_POST['phone']);
			$this->client->set("email", $_POST['email']);
			$this->client->set("description", $_POST['description']);
			$this->client->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->client->set("photo_name", $_FILES['photo']['name']);
			$this->client->set("photo_size", $_FILES['photo']['size']);
			$this->client->set("photo_type", $_FILES['photo']['type']);
			$this->client->update();
		}elseif(isset($_POST['idDelete'])){
			$this->conexion = new Conexion();
			$this->client = new client();//echo "Hi";
			$this->client->set("idUser", $_POST['idDelete']);
			$this->client->delete();
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