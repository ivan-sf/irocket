<?php namespace models;

/**
* 
*/
class ProductsReports
{
	private $usuario;
	private $idbill;
	private $pass;
	private $cNewProd;
	private $qNewProd;
	private $idBillD;
	private $idBill;
	private $idUser;
	private $tipo;
	private $balance;
	private $saldo;
	private $estado;
	private $typeBill;



	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}


	public function AllProductsActive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE stateBD='1'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function AllProductsInactive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE stateBD='0'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function ProductsTopSale()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE stateBD='1'
		ORDER BY totalSales DESC
		LIMIT 20";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function Productsexce()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE quantityProduct<0
		ORDER BY totalSales DESC";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}


	public function Productsago()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE quantityProduct=0
		ORDER BY totalSales DESC";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}




public function ProductsTopVenP()
	{
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE stateBD='1'
		ORDER BY dateVenc ASC
		LIMIT 50";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	

	public function ProductsLimit()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		WHERE stateBD='1' AND quantityProduct <= 0
		ORDER BY totalItemsInventory DESC
		LIMIT 500";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetails2()
	{
	
	}

	public function changeBill()
	{

	}

	public function returnBill()
	{
		
	}

	public function balanceBill()
	{
		

	}

	public function deleteBill()
	{

	}


	public function update()
	{
		# code...
	}
	public function delete()
	{
		# code...
	}
}
