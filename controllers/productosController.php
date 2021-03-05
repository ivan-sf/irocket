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
			
			
			///BODEGA
			$this->products->set("nameInventory", $_POST['idInventary']);
			$this->products->set("nameInventory2", $_GET['inventario']);
			///UNIDADES - PRESENTACION - CONCENTRACION
			$this->products->set("unidadesCaja", $_POST['unidadesCaja']);
			$this->products->set("presentacionFarmaceutica", $_POST['presentacionFarmaceutica']);
			$this->products->set("consentracion", $_POST['consentracion']);
			$this->products->set("laboratorio", $_POST['laboratorio']);
			$this->products->set("lote", $_POST['lote']);
			$this->products->set("registroSanitario", $_POST['registroSanitario']);
			$this->products->set("fechaVencimiento", $_POST['fechaVencimiento']);
			

	
			///NOMBRE
			$this->products->set("inventarioGet", $_GET['inventarioGet']);
			$this->products->set("nameProduct", $_POST['nameProduct']);
			///PRECIO COMPRA
			$this->products->set("priceBuy", $_POST['priceBuy']);
			$this->products->set("priceBuy", $_POST['priceBuy']);
			///IVA
			$this->products->set("ivaProduct", $_POST['ivaProduct']);
			///UBICACION ALMACEN
			$this->products->set("ubicacionAlmacen", $_POST['ubicacionAlmacen']);
			///UBICACION BODEGA
			$this->products->set("ubicacionBodega", $_POST['ubicacionBodega']);
			///CODIGOS
			$this->products->set("code", $_POST['codeProduct_1']);
			$this->products->set("code2", $_POST['codeProduct_2']);
			$this->products->set("code3", $_POST['codeProduct_3']);
			$this->products->set("code4", $_POST['codeProduct_4']);
			$this->products->set("code5", $_POST['codeProduct_5']);
			$this->products->set("code6", $_POST['codeProduct_6']);
			$this->products->set("code7", $_POST['codeProduct_7']);
			$this->products->set("code8", $_POST['codeProduct_8']);
			$this->products->set("code9", $_POST['codeProduct_9']);
			$this->products->set("code10", $_POST['codeProduct_10']);
			///PRECIO
			$this->products->set("price", $_POST['priceProduct_1']);
			$this->products->set("price2", $_POST['priceProduct_2']);
			$this->products->set("price3", $_POST['priceProduct_3']);
			$this->products->set("price4", $_POST['priceProduct_4']);
			$this->products->set("price5", $_POST['priceProduct_5']);
			$this->products->set("price6", $_POST['priceProduct_6']);
			$this->products->set("price7", $_POST['priceProduct_7']);
			$this->products->set("price8", $_POST['priceProduct_8']);
			$this->products->set("price9", $_POST['priceProduct_9']);
			$this->products->set("price10", $_POST['priceProduct_10']);
			///FOTOS
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
		if (isset($_POST['idProducto'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("idInventory", $_POST['idInventory']);
			$this->products->set("nameInventory", $_POST['idInventory']);
			$this->products->set("inventario", $_POST['inventario']);
			$this->products->set("nameProduct", $_POST['nameProduct']);
			$this->products->set("codeProduct", $_POST['codeProduct']);
			$this->products->set("unidadesCaja", $_POST['unidadesCaja']);
			$this->products->set("presentacionFarmaceutica", $_POST['presentacionFarmaceutica']);
			$this->products->set("consentracion", $_POST['consentracion']);
			$this->products->set("laboratorio", $_POST['laboratorio']);
			$this->products->set("registroSanitario", $_POST['registroSanitario']);
			$this->products->set("priceBuy", $_POST['priceBuy']);
			
			if(isset( $_POST['precioVenta'])){
			$this->products->set("precio", $_POST['precioVenta']);
			}
			if(isset( $_POST['lote'])){
			$this->products->set("lote", $_POST['lote']);
			$this->products->set("loteID", $_POST['loteID']);
			}
			if(isset( $_POST['vencimiento'])){
			$this->products->set("vencimiento", $_POST['vencimiento']);
			$this->products->set("vencimientoID", $_POST['vencimientoID']);
			}
			$this->products->set("price_buy", $_POST['price_buy']);
			$this->products->set("iva", $_POST['iva']);
			$this->products->set("datoExtra1", $_POST['datoExtra1']);
			$this->products->set("idProducto", $_POST['idProducto']);
			$this->products->set("precioID", $_POST['precioID']);
			$this->products->set("cod", $_POST['cod']);
			$this->products->set("cantidadProductos", $_POST['cantidadProductos']);
			$this->products->set("photoUserNameTemp", $_FILES['photoProduct']['tmp_name']);
			$this->products->set("photoUserName", $_FILES['photoProduct']['name']);
			$this->products->set("photoUserSize", $_FILES['photoProduct']['size']);
			$this->products->set("photoUserType", $_FILES['photoProduct']['type']);
			$this->products->set("eliminarProducto", $_POST['eliminarProducto']);
			
			$this->products->update();
		}elseif (isset($_POST['idDelete'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("idproduct", $_POST['idDelete']);
			$this->products->delete();
			
		}elseif (isset($_POST['idDes'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("idproduct", $_POST['idDes']);
			$this->products->desactivate();
			
		}elseif (isset($_POST['idAct'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("idproduct", $_POST['idAct']);
			$this->products->activate();
			
		}elseif (isset($_POST['idDef'])) {
			$this->conexion = new Conexion();
			$this->products = new Products();
			$this->products->set("idproduct", $_POST['idProdDef']);
			$this->products->set("priceDef", $_POST['precioDefect']);
			$this->products->set("quantityDef", $_POST['CantidadDefect']);
			$this->products->defect();
			
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