<?php namespace controllers;

/**
* 
*/
use models\Cash as employee;
use models\Conexion as conexion;

class cashController
{
	private $errors;

	public function __construct()
	{
		$this->errors = 'Isma';
	}

	public function create()
	{
		if (isset($_POST['idcompany'])) {
			$this->conexion = new Conexion();
			$this->employee = new employee();//echo "Hi";
			$this->employee->set("idcompany", $_POST['idcompany']);
			$this->employee->set("idUser", $_POST['idUser']);
			$this->employee->set("nameUser", $_POST['nameUser']);
			$this->employee->set("lastnameUser", $_POST['lastnameUser']);
			$this->employee->set("documentUser", $_POST['documentUser']);
			$this->employee->set("companyUser", $_POST['companyUser']);
			$this->employee->set("age", $_POST['age']);
			$this->employee->set("phone", $_POST['phone']);
			$this->employee->set("email", $_POST['email']);
			$this->employee->set("description", $_POST['description']);
			$this->employee->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->employee->set("photo_name", $_FILES['photo']['name']);
			$this->employee->set("photo_size", $_FILES['photo']['size']);
			$this->employee->set("photo_type", $_FILES['photo']['type']);
			$this->employee->create();
		}else{
			//echo "string";
		}

	}

	public function index()
	{
	}

	public function view()
	{
		if (isset($_POST['idUser'])) {
			$this->conexion = new Conexion();
			$this->employee = new employee();//echo "Hi";
			$this->employee->set("idUser", $_POST['idUser']);
			$this->employee->set("nameUser", $_POST['nameUser']);
			$this->employee->set("idcompany", $_POST['nameCompany']);
			$this->employee->set("username", $_POST['userName']);
			$this->employee->set("pass", $_POST['pass']);
			$this->employee->set("lastnameUser", $_POST['lastname']);
			$this->employee->set("documentUser", $_POST['document']);
			$this->employee->set("companyUser", $_POST['companyUser']);
			$this->employee->set("age", $_POST['age']);
			$this->employee->set("phone", $_POST['phone']);
			$this->employee->set("email", $_POST['email']);
			$this->employee->set("description", $_POST['description']);
			$this->employee->set("photo_tmp_name", $_FILES['photo']['tmp_name']);
			$this->employee->set("photo_name", $_FILES['photo']['name']);
			$this->employee->set("photo_size", $_FILES['photo']['size']);
			$this->employee->set("photo_type", $_FILES['photo']['type']);
			$this->employee->update();
		}elseif(isset($_POST['idDelete'])){
			$this->conexion = new Conexion();
			$this->employee = new employee();//echo "Hi";
			$this->employee->set("idUser", $_POST['idDelete']);
			$this->employee->delete();
		}	
	}

	public function table()
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