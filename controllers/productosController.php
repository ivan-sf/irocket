<?php namespace controllers;

/**
* 
*/
use models\Products as products;
use models\Conexion as conexion;

class productosController
{
	private $errors;

	public function __construct()
	{
		$this->errors = 'Errorrr';
	}

	public function crear()
	{
		//echo "Hi";
		if (isset($_POST['idInventary'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("nameInventory", $_POST['idInventary']);
			$this->products->set("code", $_POST['codeProduct']);
			$this->products->set("price", $_POST['priceProduct']);
			$this->products->set("codeProm", $_POST['codePromProduct']);
			$this->products->set("priceProm", $_POST['pricePromProduct']);
			$this->products->set("name", $_POST['nameProduct']);
			$this->products->set("limit", $_POST['limitProduct']);
			$this->products->set("pricePromProductSale", $_POST['pricePromProductSale']);
			if ($_POST['priceProductSale'] == '') {
				$this->products->set("priceProductSale", 0);
			}else{
				$this->products->set("priceProductSale", $_POST['priceProductSale']);
			}
			$this->products->set("description", $_POST['descriptionProduct']);
			$this->products->set("typeInventory", $_POST['typeInventory']);
			$this->products->set("photoUserNameTemp", $_FILES['photoProduct']['tmp_name']);
			$this->products->set("photoUserName", $_FILES['photoProduct']['name']);
			$this->products->set("photoUserSize", $_FILES['photoProduct']['size']);
			$this->products->set("photoUserType", $_FILES['photoProduct']['type']);
			$this->products->set("photoUserType", $_FILES['photoProduct']['type']);
			$this->products->create();
		}

	}

	public function detalles()
	{
		if (isset($_POST['idUpdate'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("nameInventory", $_POST['idInventory']);
			$this->products->set("name", $_POST['nombreProducto']);
			$this->products->set("code", $_POST['codeProduct']);
			$this->products->set("codeProm", $_POST['codeProductProm']);
			$this->products->set("price", $_POST['priceSale']);
			$this->products->set("priceBuy", $_POST['priceBuy']);
			$this->products->set("priceSaleProm", $_POST['priceSaleProm']);
			$this->products->set("priceBuyProm", $_POST['priceBuyProm']);
			$this->products->set("limit", $_POST['limit']);
			$this->products->set("description", $_POST['descripcionInventario']);
			$this->products->set("idproduct", $_POST['idUpdate']);
			$this->products->set("photoUserNameTemp", $_FILES['photoProduct']['tmp_name']);
			$this->products->set("photoUserName", $_FILES['photoProduct']['name']);
			$this->products->set("photoUserSize", $_FILES['photoProduct']['size']);
			$this->products->set("photoUserType", $_FILES['photoProduct']['type']);
			$this->products->update();

		}elseif (isset($_POST['idDelete'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("idproduct", $_POST['idDelete']);
			$this->products->delete();
			
		}
	}

	public function tabla()
	{
		

	}

	public function index()
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