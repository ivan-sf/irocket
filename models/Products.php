<?php namespace models;

/**
* 
*/
class Products
{
	private $nameInventory;
	private $code;
	private $price;
	private $codeProm;
	private $priceProm;
	private $name;
	private $limit;
	private $description;
	private $photoUserNameTemp;
	private $photoUserName;
	private $photoUserSize;
	private $photoUserType;
	private $idproduct;
	private $pricePromProductSale;
	private $priceProductSale;
	private $priceBuy;
	private $priceBuyProm;
	private $typeInventory;


	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
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
		}else{
			echo "asd";
		}
	}

	public function create()
	{
		$connect = $this->con->connect();
		$nameInventory = $this->nameInventory;
		$code = $this->code;
		$price = $this->price;
		$codeProm = $this->codeProm;
		$priceProm = $this->priceProm;
		$name = $this->name;
		$limit = $this->limit;
		$description = $this->description;
		$photoNameTemp = $this->photoUserNameTemp;
		$photoName = $this->photoUserName;
		$photoSize = $this->photoUserSize;
		$photoType = $this->photoUserType;
		$pricePromProductSale = $this->pricePromProductSale;
		$priceProductSale = $this->priceProductSale;
		$typeInventory = $this->typeInventory;
		
		$count = count($name);

		for ($i=0; $i < $count; $i++) { 
			$sql = "SELECT * FROM products WHERE codeProduct='$code[$i]' OR codeProduct_promotion='$codeProm[$i]' OR codeProduct_promotion='$code[$i]' OR codeProduct='$codeProm[$i]'";
			$query = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($query);
			if ($query) {
				if ($row >= 1) {
					header("location:" . URL . "productos/crear?error=existe");
					////HEADER A EL VIEW DE EL CODIGO INGRESADO YA EXISTE.
				}else{
					//;
					$dateTime = date("Y-m-d");
					$dataS = date("s") + rand(0,9);
					$code1 = strtolower(mysqli_real_escape_string($connect,$code[$i]));
					$code2 = "P" . $dataS . "-" . strtoupper($code1);;
					$price1 = mysqli_real_escape_string($connect,$price[$i]);
					$codeProm1 = strtolower(mysqli_real_escape_string($connect,$code[$i]."-p"));
					$codeProm2 = "PROM" . $dataS . "-" . strtoupper($codeProm1);;
					$priceProm1 = mysqli_real_escape_string($connect,$priceProm[$i]);
					$name1 = strtolower(mysqli_real_escape_string($connect,$name[$i]));
					$limit1 = mysqli_real_escape_string($connect,$limit[$i]);
					$pricePromProductSale1 = mysqli_real_escape_string($connect,$pricePromProductSale[$i]);
					$priceProductSale1 = mysqli_real_escape_string($connect,$priceProductSale[$i]);
					if ($priceProductSale1 == '') {
							$priceProductSale1 = 0;
						}
					if ($priceProm1 == '') {
							$priceProm1 = $price1;
						}
					$description1 = $description[$i];
					
					if ($code1 == $codeProm1) {
						header("location:" . URL . "productos/crear?error=code");
					}else{

					$sql = "SELECT * FROM inventorydetails WHERE nameInventory='$nameInventory'";
					$query = $this->con->returnConsulta($sql);
					$array = mysqli_fetch_array($query);
					$idinventory = mysqli_real_escape_string($connect,$array['inventory_idinventory']);
					$sql = "INSERT INTO `products` (`inventory_idinventory`, `codeProduct`, `codeProduct_promotion`, `precio`, `precio_promotion`, `quantityProduct`, `stateBD`, `price_buy_prom`, `price_buy`) VALUES ('$idinventory', '$code1', '$codeProm1', '$price1', '$priceProm1', '0', '1', '$priceProductSale1', '$priceProductSale1')";
					$query = $this->con->consulta($sql);
					if ($query) {
						////Acabo de guardar la imagen en el equipo ahora debo ingresar los detalles de usuario y la imagen blob
						//$photoInsert = addslashes(file_get_contents($this->photoNameTemp));
						//echo $photoUserType1;


						$ruta = 'views/assets/images/products/' . date('h-m.s') . $photoName[$i];
						$dir_subida = 'views/assets/images/products/' . date('h-m.s');
						$fichero_subido = $dir_subida . basename($photoName[$i]);
						if (move_uploaded_file($photoNameTemp[$i], $fichero_subido)) {
							$sql = "SELECT * FROM products ORDER BY idproducts desc";
							$query = $this->con->returnConsulta($sql);
							$array = mysqli_fetch_array($query);
							$idproduct = $array['idproducts'];
							if ($query) {
								$dateTime = date("Y-m-d");
								$sql = "INSERT INTO `productdetails` (`products_idproducts`, `nameProduct`, `descriptionProduct`, `min_limit_items`, `date_register`, `ruta`, `totalItemsInventory`, `totalBuy`, `totalSales`, `totalBuy_prom`, `totalSales_prom`, `totalItem`) VALUES ('$idproduct', '$name1', '$description1', '$limit1', '$dateTime', '$ruta', '0', '0', '0', '0', '0', '0')";
								$query = $this->con->consulta($sql);
								if ($query) {
									//header("location:" . URL . "productos/crear?success");

									$iduser = 1;
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! Se ha creado un nuevo producto puedes ver el resultado en el catalogo.";
									$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '4', '$mensaje', '$datetimeNot')";
									$query = $this->con->Consulta($sql);
									if ($query) {
										header("location:" . URL . "productos/crear?success");
									}else{
										echo "Error en la notificacion";
									}
									//echo "Si";
								}else{
									echo "No";
								}
							}
						}else{
							$ruta = 'views/assets/images/products/default.png';
							$sql = "SELECT * FROM products ORDER BY idproducts desc";
							$query = $this->con->returnConsulta($sql);
							$array = mysqli_fetch_array($query);
							$idproduct = $array['idproducts'];
							if ($query) {
								$dateTime = date("Y-m-d");
								$sql = "INSERT INTO `productdetails` (`products_idproducts`, `nameProduct`, `descriptionProduct`, `min_limit_items`, `date_register`, `ruta`, `totalItemsInventory`, `totalBuy`, `totalSales`, `totalBuy_prom`, `totalSales_prom`, `totalItem`) VALUES ('$idproduct', '$name1', '$description1', '$limit1', '$dateTime', '$ruta', '0', '0', '0', '0', '0', '0')";
								$query = $this->con->consulta($sql);
								if ($query) {
									//header("location:" . URL . "productos/crear?success");

									$iduser = 1;
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! Se ha creado un nuevo producto puedes ver el resultado en la lista.";
									$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '4', '$mensaje', '$datetimeNot')";
									$query = $this->con->Consulta($sql);
									if ($query) {
										if ($typeInventory == 2) {
											header("location:" . URL . "productos/crear?success&inventario=".$nameInventory);
										}elseif ($typeInventory == 1) {
											header("location:" . URL . "productos/crear?success&inventario=".$nameInventory);
										}
									}else{
										echo "Error en la notificacion";
									}
									//echo "Si";
								}else{
									echo "No";
								}
							}
						}

						
					}else{
						echo $idinventory;
						echo "Ha fallado el primer registro en la base de datos";
					}
				}
					}
			}else{
				echo "No codigo existe";
			}
		}
		$sql = "SELECT * FROM userdetails WHERE userdetails.range = 9";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);

	}

	public function array()
	{
		$sql = "SELECT * FROM products 
		INNER JOIN productdetails 
		ON products.idproducts=productdetails.products_idproducts
		INNER JOIN inventory
		ON products.inventory_idinventory=inventory.idinventory
		INNER JOIN inventorydetails
		ON products.inventory_idinventory=inventorydetails.inventory_idinventory WHERE products.stateBD = 1
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
		$nameInventory = strtolower(mysqli_real_escape_string($connect, $this->nameInventory));
		$name = strtolower(mysqli_real_escape_string($connect, $this->name));
		$code = strtolower(mysqli_real_escape_string($connect, $this->code));
		$codeProm = strtolower(mysqli_real_escape_string($connect, $this->codeProm));
		$price = mysqli_real_escape_string($connect, $this->price);
		$priceBuy = mysqli_real_escape_string($connect, $this->priceBuy);
		$priceSaleProm = mysqli_real_escape_string($connect, $this->priceSaleProm);
		$priceBuyProm = mysqli_real_escape_string($connect, $this->priceBuyProm);
		$limit = mysqli_real_escape_string($connect, $this->limit);
		$descripcionInventario = $this->description;
		$idproduct = mysqli_real_escape_string($connect, $this->idproduct);
		$photoUserNameTemp = $this->photoUserNameTemp;
		$photoUserName = $this->photoUserName;
		$photoUserSize = $this->photoUserSize;
		$photoUserType = $this->photoUserType;
		$dateTime = date("Y-m-d");
		if ($photoUserSize == 0) {
			echo $photoUserSize;
			$sql = "SELECT * FROM inventorydetails WHERE nameInventory='$nameInventory'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idinventory = mysqli_real_escape_string($connect,$array['inventory_idinventory']);

			$sql = "UPDATE `products` SET `inventory_idinventory`='$idinventory',`codeProduct`='$code', `codeProduct_promotion`='$codeProm', `precio`='$price', `precio_promotion`='$priceSaleProm', `price_buy_prom`='$priceBuy', `price_buy`='$priceBuy' WHERE `idproducts`='$idproduct'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `productdetails` SET `nameProduct`='$name', `descriptionProduct`='$descripcionInventario', `min_limit_items`='$limit', `date_update`='$dateTime' WHERE `idproductDetails`='$idproduct'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$iduser = 1;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado un producto puedes ver el resultado en la lista.";
					$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '5', '$mensaje', '$datetimeNot')";
					$query = $this->con->Consulta($sql);
					if ($query) {
					header("location:" . URL . "productos?success_update");
					}else{
						echo "Error en la notificacion";
					}
				}else{
					echo "string";
				}
			}else{
				echo "string";
			}
		}else{
			$ruta = 'views/assets/images/products/' . date('h-m.s') . $photoUserName;
			$dir_subida = 'views/assets/images/products/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($photoUserName);
			if (move_uploaded_file($photoUserNameTemp, $fichero_subido)){
				$sql = "SELECT * FROM inventorydetails WHERE nameInventory='$nameInventory'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idinventory = mysqli_real_escape_string($connect,$array['inventory_idinventory']);

			$sql = "UPDATE `products` SET `inventory_idinventory`='$idinventory',`codeProduct`='$code', `codeProduct_promotion`='$codeProm', `precio`='$price', `precio_promotion`='$priceSaleProm', `price_buy_prom`='$priceBuy', `price_buy`='$priceBuy' WHERE `idproducts`='$idproduct'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `productdetails` SET `nameProduct`='$name', `ruta`='$ruta', `descriptionProduct`='$descripcionInventario', `min_limit_items`='$limit', `date_update`='$dateTime' WHERE `idproductDetails`='$idproduct'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$iduser = 1;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado un producto puedes ver el resultado en la lista.";
					$sql = "INSERT INTO `notifications` (`users_idusers`, `products_idproducts`, `typeNotification`, `message`, `date_register`) VALUES ('$iduser', '$idproduct', '5', '$mensaje', '$datetimeNot')";
					$query = $this->con->Consulta($sql);
					if ($query) {
					header("location:" . URL . "productos?success_update");
					}else{
						echo "Error en la notificacion";
					}
				}else{
					echo "string";
				}
			}else{
				echo "string";
			}
			}else{
				echo "string";
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
			}else{
				echo "Error en la notificacion";
			}
		}else{
			echo "string";
		}
	}
}
