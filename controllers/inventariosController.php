<?php namespace controllers;

/**
* 
*/
use models\Inventory as inventory;
use models\Conexion as conexion;

class inventariosController
{
	private $errors;

	public function __construct()
	{
		$this->errors = 'Hi world desde error controller';
	}

	public function crear()
	{
		if (isset($_POST['nameInventary']) && isset($_POST['descriptionInventary'])) {
			$this->Conexion = new Conexion();
			$this->inventory = new Inventory();
			$this->inventory->set("name",$_POST['nameInventary']);
			$this->inventory->set("description",$_POST['descriptionInventary']);
			$this->inventory->set("iduser",$_POST['iduser']);
			$this->inventory->set("codeCurrent",$_POST['codeCurrent']);
			
			$this->inventory->create();
			
		}else{
			echo "";
		}
	}

	public function index()
	{

	}

	public function tabla()
	{

	}

	public function detalles()
	{
		if (isset($_POST['idUpdate'])) {
			$this->Conexion = new Conexion();
			$this->inventory = new Inventory();
			$this->inventory->set("idupdate",$_POST['idUpdate']);
			$this->inventory->set("name",$_POST['nombreInventario']);
			$this->inventory->set("description",$_POST['descripcionInventario']);
			$this->inventory->set("iduser",$_POST['iduser']);
			$this->inventory->set("codeCurrent",$_POST['codeCurrent']);
			$this->inventory->update();
		}elseif (isset($_POST['idDelete'])) {
			$this->Conexion = new Conexion();
			$this->inventory = new Inventory();
			$this->inventory->set("iddelete",$_POST['idDelete']);
			$this->inventory->delete();
		}
	}

	public function table()
	{

	}

}
$error = new errorsController();