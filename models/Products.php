<?php

namespace models;

/**
 * 
 */
class Products
{
	private $nameInventory;
	private $nameInventory2;
	private $code;
	private $code2;
	private $code3;
	private $code4;
	private $code5;
	private $code6;
	private $code7;
	private $code8;
	private $code9;
	private $code10;
	private $price;
	private $price2;
	private $price3;
	private $price4;
	private $price5;
	private $price6;
	private $price7;
	private $price8;
	private $price9;
	private $price10;
	private $codeProm;
	private $name;
	private $limit;
	private $description;
	private $photoUserNameTemp;
	private $photoUserName;
	private $photoUserSize;
	private $photoUserType;
	private $idproduct;
	private $priceDef;
	private $quantityDef;
	private $pricePromProductSale;
	private $priceProductSale;
	private $priceBuy;
	private $priceBuyProm;
	private $typeInventory;
	private $nameProduct;
	private $priceProductB;
	private $ivaProduct;
	private $ubicacionAlmacen;
	private $ubicacionBodega;
	
	private $codeProduct;
	private $codeProduct_promotion;
	private $codeProduct_promotion2;
	private $codeProduct_4;
	private $codeProduct_5;
	private $codeProduct_6;
	private $codeProduct_7;
	private $codeProduct_8;
	
	private $codeProduct_9;
	private $codeProduct_10;
	private $precio;
	private $precio_promotion;
	private $precio_promotion2;
	private $precio3;
	private $precio4;
	private $precio5;
	private $precio6;
	private $precio7;
	private $precio8;
	private $precio9;
	private $price_buy;
	private $iva;
	private $datoExtra1;

	private $idProducto;
	private $cod;
	private $cantidadProductos;
	private $precioID;
	private $lote;
	private $loteID;
	private $vencimiento;
	private $vencimientoID;

	private $unidadesCaja;
	private $presentacionFarmaceutica;
	private $consentracion;
	private $laboratorio;
	private $registroSanitario;


	



	function __construct()
	{
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro)
	{
		$this->$atributo = $parametro;
	}

	public function get($atributo)
	{
		return $this - $atributo;
	}

	public function view()
	{
		$iduser = $this->idproduct;
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		INNER JOIN inventory
		ON products.inventory_idinventory=inventory.idinventory
		INNER JOIN inventorydetails
		ON products.inventory_idinventory=inventorydetails.inventory_idinventory
		WHERE idproducts='$iduser'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		} else {
			echo "asd";
		}
	}


	public function viewInv()
	{
		$inventarioGet = $this->inventarioGet;
		$sql = "SELECT * FROM `inventorydetails` WHERE nameInventory='$inventarioGet'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		} else {
			echo "asd";
		}
	}


	public function viewDet()
	{
		$idprod = $this->idproduct;
		$sql = "SELECT * FROM `bills` INNER JOIN `billdetails` ON bills.idbills=billdetails.bills_idbills WHERE   stateBillDetail=2 AND products_idproducts='$idprod'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		} else {
			echo "asd";
		}
	}

	public function viewDetV()
	{
		$idprod = $this->idproduct;
		$sql = "SELECT * FROM `bills` INNER JOIN `billdetails` ON bills.idbills=billdetails.bills_idbills WHERE products_idproducts='$idprod' AND stateBillDetail=1 AND typeBill=1";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		} else {
			echo "asd";
		}
	}

	public function viewDetC()
	{
		$idprod = $this->idproduct;
		$sql = "SELECT * FROM `bills` INNER JOIN `billdetails` ON bills.idbills=billdetails.bills_idbills WHERE products_idproducts='$idprod' AND stateBillDetail=1 AND typeBill=2";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		} else {
			echo "asd";
		}
	}
	
	public function rowCodes()
	{
		$idProducto = $this->idproduct;
		$sql = "SELECT * FROM products WHERE idproducts=$idProducto";
		$datos = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($datos);
		$row = mysqli_num_rows($datos);
		if($array['codeProduct_promotion']==''){
			return 2;
		}if($array['codeProduct_promotion2']==''){
			return 3;
		}if($array['codeProduct_4']==''){
			return 4;
		}if($array['codeProduct_5']==''){
			return 5;
		}if($array['codeProduct_6']==''){
			return 6;
		}if($array['codeProduct_7']==''){
			return 7;
		}if($array['codeProduct_8']==''){
			return 8;
		}if($array['codeProduct_9']==''){
			return 9;
		}if($array['codeProduct_10']==''){
			return 9;
		}else{
			return 10;
		}
	}

	public function rowPrices()
	{
		$idProducto = $this->idproduct;
		$sql = "SELECT * FROM products WHERE idproducts=$idProducto";
		$datos = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($datos);
		$row = mysqli_num_rows($datos);
		if($array['precio_promotion']==''){
			return 2;
		}if($array['precio_promotion2']==''){
			return 3;
		}if($array['precio3']==''){
			return 4;
		}if($array['precio4']==''){
			return 5;
		}if($array['precio5']==''){
			return 6;
		}if($array['precio6']==''){
			return 7;
		}if($array['precio7']==''){
			return 8;
		}if($array['precio8']==''){
			return 9;
		}if($array['precio9']==''){
			return 9;
		}else{
			return 10;
		}
	}


	public function rowLotes()
	{
		$idProducto = $this->idproduct;
		$sql = "SELECT * FROM productdetails WHERE products_idproducts=$idProducto";
		$datos = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($datos);
		$row = mysqli_num_rows($datos);
		if($array['lote']==''){
			return 1;
		}if($array['lote2']==''){
			return 2;
		}if($array['lote3']==''){
			return 3;
		}if($array['lote4']==''){
			return 4;
		}if($array['lote5']==''){
			return 5;
		}if($array['lote6']==''){
			return 6;
		}if($array['lote7']==''){
			return 7;
		}if($array['lote8']==''){
			return 8;
		}if($array['lote9']==''){
			return 9;
		}else{
			return 10;
		}
	}

	public function rowVencimiento()
	{
		$idProducto = $this->idproduct;
		$sql = "SELECT * FROM productdetails WHERE products_idproducts=$idProducto";
		$datos = $this->con->returnConsulta($sql);
		$array = mysqli_fetch_array($datos);
		$row = mysqli_num_rows($datos);
		if($array['fechaVencimiento']==''){
			return 1;
		}if($array['fechaVencimiento2']==''){
			return 2;
		}if($array['fechaVencimiento3']==''){
			return 3;
		}if($array['fechaVencimiento4']==''){
			return 4;
		}if($array['fechaVencimiento5']==''){
			return 5;
		}if($array['fechaVencimiento6']==''){
			return 6;
		}if($array['fechaVencimiento7']==''){
			return 7;
		}if($array['fechaVencimiento8']==''){
			return 8;
		}if($array['fechaVencimiento9']==''){
			return 9;
		}else{
			return 10;
		}
	}



	public function create()
	{
		$connect = $this->con->connect();
		$nameInventory = $this->nameInventory;
		$nameInventory2 = $this->nameInventory2;

		if (isset($nameInventory2)) {
			$nameProduct = $this->nameProduct;
			$priceProductB = $this->priceProductB;
			$ivaProduct = $this->ivaProduct;
			$ubicacionBodega = $this->ubicacionBodega;
			$ubicacionAlmacen = $this->ubicacionAlmacen;
			$code = $this->code;
			$code2 = $this->code2;
			$code3 = $this->code3;
			$code4 = $this->code4;
			$code5 = $this->code5;
			$code6 = $this->code6;
			$code7 = $this->code7;
			$code8 = $this->code8;
			$code9 = $this->code9;
			$code10 = $this->code10;
			$unidadesCaja = $this->unidadesCaja;
			$presentacionFarmaceutica = $this->presentacionFarmaceutica;
			$consentracion = $this->consentracion;
			$laboratorio = $this->laboratorio;
			$lote = $this->lote;
			$registroSanitario = $this->registroSanitario;
			$fechaVencimiento = $this->fechaVencimiento;
			

			
			
			
			
			
			$price = $this->price;
			$price2 = $this->price2;
			$price3 = $this->price3;
			$price4 = $this->price4;
			$price5 = $this->price5;
			$price6 = $this->price6;
			$price7 = $this->price7;
			$price8 = $this->price8;
			$price9 = $this->price9;
			$price10 = $this->price10;

			$priceBuy = $this->priceBuy;
			$priceBuyProm = $this->priceBuyProm;

			$photoUserNameTemp = $this->photoUserNameTemp;
			$photoUserName = $this->photoUserName;
			$photoSize = $this->photoUserSize;
			$photoType = $this->photoUserType;
			$pricePromProductSale = $this->pricePromProductSale;
			$priceProductSale = $this->priceProductSale;
			$typeInventory = $this->typeInventory;

			$sql = "SELECT * FROM inventorydetails WHERE nameInventory='$nameInventory'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idinventory = mysqli_real_escape_string($connect, $array['inventory_idinventory']);
			$codeCurrent = mysqli_real_escape_string($connect, $array['codeCurrent']);
			$codeFree = $codeCurrent + 1;
			$sql = "UPDATE `inventorydetails` SET `codeCurrent` = '$codeFree' WHERE `inventorydetails`.`inventory_idinventory` = $idinventory";
			$query = $this->con->consulta($sql);
			if ($query) {
				//PRODUCTOS

				$sql = "INSERT INTO `products` (`inventory_idinventory`, `codeProduct`, `codeProduct_promotion`, `codeProduct_promotion2`, `codeProduct_4`, `codeProduct_5`, `codeProduct_6`, `codeProduct_7`, `codeProduct_8`, `codeProduct_9`, `codeProduct_10`, `precio`, `precio_promotion`, `precio_promotion2`, `precio3`, `precio4`, `precio5`, `precio6`, `precio7`, `precio8`, `precio9`, `price_buy_prom`, `price_buy`, `quantityProduct`, `stateBD`, `descripcion`) VALUES ('$idinventory', '$code', '$code2', '$code3', '$code4', '$code5', '$code6', '$code7', '$code8', '$code9', '$code10', '$price', '$price2', '$price3', '$price4', '$price5', '$price6', '$price7', '$price8', '$price9', '$price10', '$priceBuy', '$priceBuy', '0', '1', NULL)";
				$query = $this->con->consulta($sql);
				//DETALLES DE PRODUCTOS
				
				$sql = "SELECT * FROM products ORDER BY idproducts desc";
				$query = $this->con->returnConsulta($sql);
				$array = mysqli_fetch_array($query);
				$idproduct = $array['idproducts'];
				if ($query) {
					$ruta = 'views/assets/images/products/' . date('h-m.s') . $photoUserName;
					$dir_subida = 'views/assets/images/products/' . date('h-m.s');
					$fichero_subido = $dir_subida . basename($photoUserName);
					if (move_uploaded_file($photoUserNameTemp, $fichero_subido)) {
						$ruta = 'views/assets/images/products/' . date('h-m.s') . $photoUserName;
					//	header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory)."&success");
					}else{
						$ruta = 'views/assets/images/products/default.png';
					//	header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory)."&1$photoSize&2$photoUserNameTemp&3$photoUserNameTemp");
					}
					
					
					
					$dateTime = date("Y-m-d");
					$sql = "INSERT INTO `productdetails` (`products_idproducts`, `nameProduct`, `iva`, `min_limit_items`, `date_register`, `dateVenc`, `date_update`, `ruta`, `totalBuy`, `totalSales`, `totalItem`, `stateNotProd`, `ubicacionBodega`, `ubicacionAlmacen`, `unidadesCaja`, `presentacionFarmaceutica`, `consentracion`, `laboratorio`, `lote`, `registroSanitario`, `fechaVencimiento`) VALUES ('$idproduct', '$nameProduct', '$ivaProduct', '10', '$dateTime', '', '$dateTime', '$ruta', '0', '0', '0', '1', '$ubicacionAlmacen', '$ubicacionBodega', '$unidadesCaja', '$presentacionFarmaceutica', '$consentracion', '$laboratorio', '$lote', '$registroSanitario', '$fechaVencimiento')";
					$query = $this->con->consulta($sql);
					if($query){
						header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory)."&success");
					}else{
						header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory)."&1$photoSize&2$photoUserNameTemp&3$photoUserNameTemp");
					}

					
						
					

				} else {
					header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory) . "?" . $codeFree . $nameInventory);
				}
			} else {
				header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory) . "?" . $codeFree . $nameInventory);
			}
		} else {
			header("location:" . URL . "productos/crear?inventario=" . strtolower($nameInventory));
		}
	}


	public function array()
	{
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		INNER JOIN inventory
		ON products.inventory_idinventory=inventory.idinventory
		INNER JOIN inventorydetails
		ON products.inventory_idinventory=inventorydetails.inventory_idinventory
		ORDER BY products.idproducts desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayCrear()
	{
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts 
		WHERE products.inventory_idinventory=2
		ORDER BY products.idproducts desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayInventory($get)
	{
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		INNER JOIN inventory
		ON products.inventory_idinventory=inventory.idinventory
		INNER JOIN inventorydetails
		ON products.inventory_idinventory=inventorydetails.inventory_idinventory 
		WHERE products.stateBD = 1 AND products.inventory_idinventory = '$get'
		ORDER BY products.idproducts desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayInventory2($get)
	{
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		INNER JOIN inventory
		ON products.inventory_idinventory=inventory.idinventory
		INNER JOIN inventorydetails
		ON products.inventory_idinventory=inventorydetails.inventory_idinventory 
		WHERE products.stateBD = 1 AND products.inventory_idinventory = '$get'
		ORDER BY products.idproducts desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function list()
	{
		/**/
	}

	public function update()
	{
		$connect = $this->con->connect();
		$nameInventory = $this->nameInventory;
		$idInventory = $this->idInventory;
		$nameProduct = $this->nameProduct;
		$codeProduct = $this->codeProduct;
		$cod = $this->cod;
		$cantidadProductos = $this->cantidadProductos;
		$precio = $this->precio;
		$lote = $this->lote;
		$vencimiento = $this->vencimiento;
		$precioID = $this->precioID;
		$loteID = $this->loteID;
		$vencimientoID = $this->vencimientoID;
		$priceBuy = $this->priceBuy;
		$unidadesCaja = $this->unidadesCaja;
		$presentacionFarmaceutica = $this->presentacionFarmaceutica;
		$consentracion = $this->consentracion;
		$laboratorio = $this->laboratorio;
		$registroSanitario = $this->registroSanitario;
		
		$price_buy = $this->price_buy;
		$iva = $this->iva;
		$datoExtra1 = $this->datoExtra1;
		$idProducto = $this->idProducto;
		$inventario = $this->inventario;

		$photoUserNameTemp = $this->photoUserNameTemp;
		$photoName = $this->photoUserName;
		$photoUserSize = $this->photoUserSize;
		$photoUserType = $this->photoUserType;
		$dateTime = date("Y-m-d");
		$eliminarProducto = $this->eliminarProducto;
		if($eliminarProducto == "SI"){
			$sql = "UPDATE `products` SET `stateBD` = '0' WHERE `products`.`idproducts` = $idProducto";
			$query = $this->con->consulta($sql);
			header("location:" . URL . "productos?success_delete&$idProducto");
		}else{
			

		if($inventario==1){
			$sql = "SELECT * FROM `inventorydetails` WHERE nameInventory='$idInventory'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$inventarioID =$array['inventory_idinventory'];
		}else{
			$sql = "SELECT * FROM `inventorydetails` WHERE nameInventory='$idInventory'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$inventarioID =$array['inventory_idinventory'];
		}
		
		if(isset($nameInventory)){
			
			if($cod==1){
				$sql = "UPDATE `products` SET `codeProduct` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==2){
				$sql = "UPDATE `products` SET `codeProduct_promotion` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==3){
				$sql = "UPDATE `products` SET `codeProduct_promotion2` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==4){
				$sql = "UPDATE `products` SET `codeProduct_4` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==5){
				$sql = "UPDATE `products` SET `codeProduct_5` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==6){
				$sql = "UPDATE `products` SET `codeProduct_6` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==7){
				$sql = "UPDATE `products` SET `codeProduct_7` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==8){
				$sql = "UPDATE `products` SET `codeProduct_8` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==9){
				$sql = "UPDATE `products` SET `codeProduct_9` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}elseif($cod==10){
				$sql = "UPDATE `products` SET `codeProduct_10` = '$codeProduct' WHERE `products`.`idproducts` = $idProducto";
			}
			$query = $this->con->consulta($sql);
			
			if($precioID==1){
				$sql = "UPDATE `products` SET `precio` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==2){
				$sql = "UPDATE `products` SET `precio_promotion` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==3){
				$sql = "UPDATE `products` SET `precio_promotion2` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==4){
				$sql = "UPDATE `products` SET `precio3` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==5){
				$sql = "UPDATE `products` SET `precio4` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==6){
				$sql = "UPDATE `products` SET `precio5` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==7){
				$sql = "UPDATE `products` SET `precio6` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==8){
				$sql = "UPDATE `products` SET `precio7` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==9){
				$sql = "UPDATE `products` SET `precio8` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}elseif($precioID==10){
				$sql = "UPDATE `products` SET `precio9` = '$precio' WHERE `products`.`idproducts` = $idProducto";
			}

			if($loteID==1){
				$sql = "UPDATE `productdetails` SET `lote` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==2){
				$sql = "UPDATE `productdetails` SET `lote2` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==3){
				$sql = "UPDATE `productdetails` SET `lote3` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==4){
				$sql = "UPDATE `productdetails` SET `lote4` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==5){
				$sql = "UPDATE `productdetails` SET `lote5` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==6){
				$sql = "UPDATE `productdetails` SET `lote6` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==7){
				$sql = "UPDATE `productdetails` SET `lote7` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==8){
				$sql = "UPDATE `productdetails` SET `lote8` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==9){
				$sql = "UPDATE `productdetails` SET `lote9` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($loteID==10){
				$sql = "UPDATE `productdetails` SET `lote10` = '$lote' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}

			if($vencimientoID==1){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==2){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento2` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==3){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento3` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==4){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento4` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==5){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento5` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==6){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento6` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==7){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento7` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==8){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento8` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==9){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento9` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}elseif($vencimientoID==10){
				$sql = "UPDATE `productdetails` SET `fechaVencimiento10` = '$vencimiento' WHERE `productdetails`.`products_idproducts` = $idProducto";
			}


			$datetimeNot = 	date("Y-m-d G:i:s A");
			$dir_subida = 'views/assets/images/products/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($photoName);
			$query = $this->con->consulta($sql);
			

			$sql = "UPDATE `products` SET `price_buy` = '$priceBuy', `price_buy_prom` = '$priceBuy', `inventory_idinventory` = '$inventarioID', `quantityProduct` = '$cantidadProductos' WHERE `products`.`idproducts` = $idProducto;";
			$query = $this->con->consulta($sql);

			if (move_uploaded_file($photoUserNameTemp, $fichero_subido)) {
				$ruta = 'views/assets/images/products/' . date('h-m.s').$photoName;
				$sql = "UPDATE `productdetails` SET `nameProduct` = '$nameProduct', `iva` = '$iva', `min_limit_items` = '10', `date_register` = '$datetimeNot', `dateVenc` = '', `date_update` = '$datetimeNot', `totalItem` = '$cantidadProductos', `ruta` = '$ruta',  `stateNotProd` = '1', `unidadesCaja` = '$unidadesCaja', `presentacionFarmaceutica` = '$presentacionFarmaceutica', `consentracion` = '$consentracion', `laboratorio` = '$laboratorio', `registroSanitario` = '$registroSanitario' WHERE `productdetails`.`idproductDetails` = $idProducto;";
				$query = $this->con->consulta($sql);
				if($query){
					header("location:" . URL . "productos?succe66ss");
					
				}else{
					header("location:" . URL . "productos?success");
				}
			}else{
				$sql = "UPDATE `productdetails` SET `nameProduct` = '$nameProduct', `iva` = '$iva', `min_limit_items` = '10', `date_register` = '$datetimeNot', `dateVenc` = '', `date_update` = '$datetimeNot', `totalItem` = '$cantidadProductos',  `stateNotProd` = '1', `unidadesCaja` = '$unidadesCaja', `presentacionFarmaceutica` = '$presentacionFarmaceutica', `consentracion` = '$consentracion', `laboratorio` = '$laboratorio', `registroSanitario` = '$registroSanitario' WHERE `productdetails`.`idproductDetails` = $idProducto;";
				$query = $this->con->consulta($sql);
				
				if($query){
					header("location:" . URL . "productos/detalles?id=$idProducto&configurar&");
					
				}else{
					header("location:" . URL . "productos?success");
				}
			}
		}
		}
	}



	
	public function delete()
	{
		$connect = $this->con->connect();
		$idproduct = mysqli_real_escape_string($connect, $this->idproduct);
		$sql = "UPDATE `products` SET `stateBD`='0' WHERE `idproducts`='$idproduct'";
		$query = $this->con->consulta($sql);
		if ($query) {
			$iduser = 1;
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha eliminado un producto ya no tendras acceso a el.";
			$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '6', '$mensaje', '$datetimeNot')";
			$query = $this->con->Consulta($sql);
			if ($query) {
				header("location:" . URL . "productos?success_delete");
			} else {
				echo "Error en la notificacion";
			}
		} else {
			echo "string";
		}
	}


	public function desactivate()
	{
		$connect = $this->con->connect();
		$idproduct = mysqli_real_escape_string($connect, $this->idproduct);
		$sql = "UPDATE `products` SET `stateBD`='2' WHERE `idproducts`='$idproduct'";
		$query = $this->con->consulta($sql);
		if ($query) {
			$iduser = 1;
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha desactivado un producto ya no tendras acceso a el.";
			$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '97', '$mensaje', '$datetimeNot')";
			$query = $this->con->Consulta($sql);
			if ($query) {
				header("location:" . URL . "productos?success_delete");
			} else {
				echo "Error en la notificacion";
			}
		} else {
			echo "string";
		}
	}

	public function activate()
	{
		$connect = $this->con->connect();
		$idproduct = mysqli_real_escape_string($connect, $this->idproduct);
		$sql = "UPDATE `products` SET `stateBD`='1' WHERE `idproducts`='$idproduct'";
		$query = $this->con->consulta($sql);
		if ($query) {
			$iduser = 1;
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha activado un producto ya podras tener acceso a el.";
			$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '98', '$mensaje', '$datetimeNot')";
			$query = $this->con->Consulta($sql);
			if ($query) {
				header("location:" . URL . "productos?success_delete");
			} else {
				echo "Error en la notificacion";
			}
		} else {
			echo "string";
		}
	}

	public function defect()
	{
		$connect = $this->con->connect();
		$idproduct = mysqli_real_escape_string($connect, $this->idproduct);
		$priceDef = $this->priceDef;
		$quantityDef = $this->quantityDef;



		$sql = "UPDATE `productdefect` SET `precio_defect` = '$priceDef', `cantidadDef` = '$quantityDef', `stateNot` = 0 WHERE `productdefect`.`idproductDefect` = $idproduct";
		$query = $this->con->consulta($sql);
	}

	public function viewDef()
	{
		$iduser = $this->idproduct;
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		INNER JOIN productdefect 
		ON products.idproducts=productdefect.products_idproducts
		INNER JOIN inventory
		ON products.inventory_idinventory=inventory.idinventory
		INNER JOIN inventorydetails
		ON products.inventory_idinventory=inventorydetails.inventory_idinventory
		WHERE idproducts='$iduser'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		} else {
			echo "asd";
		}
	}
}
