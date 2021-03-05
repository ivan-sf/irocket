<?php namespace models;

/**
* 
*/
class Database
{
	private $name;
	private $code;
	private $clave;
	private $description;
	private $deposit;
	private $usuario;
	private $pass;
	private $caja;

	function __construct(){
		$this->con = new ConexionSDB;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}
	
	public function view()
	{
		#0
		$sql = "CREATE SCHEMA IF NOT EXISTS `iRocket` DEFAULT CHARACTER SET utf8";
		$query = $this->con->consulta($sql);

		#company
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`company` (
				  `idcompany` INT NOT NULL AUTO_INCREMENT,
				  `nameCompany` VARCHAR(45) NOT NULL,
				  `propietario` VARCHAR(45) NOT NULL,
				  `regimen` VARCHAR(45) NOT NULL,
				  PRIMARY KEY (`idcompany`))
				ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);


		#2users
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`users` (
			  `idusers` INT NOT NULL AUTO_INCREMENT,
			  `company_idcompany` INT NOT NULL,
			  `userName` VARCHAR(45) NULL,
			  `password` VARCHAR(300) NULL,
			  `stateBD` INT(1) NULL,
			  `numSes` VARCHAR(45) NULL,
			  `ultimaActividad` VARCHAR(45) NULL,
			  PRIMARY KEY (`idusers`),
			  INDEX `fk_users_company1_idx` (`company_idcompany` ASC),
			  CONSTRAINT `fk_users_company1`
			    FOREIGN KEY (`company_idcompany`)
			    REFERENCES `iRocket`.`company` (`idcompany`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		
		#3deposits
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`depositAccount` (
			`iddepositAccounts` INT NOT NULL AUTO_INCREMENT,
			`company_idcompany` INT NOT NULL,
			`users_idusers` INT NOT NULL,
			`codeAccount` VARCHAR(45) NULL,
			`stateBD` VARCHAR(45) NULL,
			PRIMARY KEY (`iddepositAccounts`),
			INDEX `fk_depositAccounts_company_idx` (`company_idcompany` ASC),
			INDEX `fk_depositAccounts_users1_idx` (`users_idusers` ASC),
			CONSTRAINT `fk_depositAccounts_company`
			  FOREIGN KEY (`company_idcompany`)
			  REFERENCES `iRocket`.`company` (`idcompany`)
			  ON DELETE NO ACTION
			  ON UPDATE NO ACTION,
			CONSTRAINT `fk_depositAccounts_users1`
			  FOREIGN KEY (`users_idusers`)
			  REFERENCES `iRocket`.`users` (`idusers`)
			  ON DELETE NO ACTION
			  ON UPDATE NO ACTION)
		  ENGINE = InnoDB;";
  $query = $this->con->consulta($sql);

  

  #4companyd
  $sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`companyDetails` (
	  `idcompanyDetails` INT NOT NULL AUTO_INCREMENT,
	  `company_idcompany` INT NOT NULL,
	  `nitCompany` VARCHAR(45) NULL,
	  `directionCompany` VARCHAR(80) NULL,
	  `cityCompany` VARCHAR(45) NULL,
	  `phoneCompany` BIGINT NULL,
	  `emailCompany` VARCHAR(100) NULL,
	  `logoCompany` LONGBLOB NULL,
	  `rutaLogoCompany` LONGTEXT NULL,
	  `data_register` DATE NULL,
	  `data_update` DATE NULL,
	  `userUpdate` VARCHAR(500) NULL,
	  `resolucion` VARCHAR(500) NULL,
	  `prefijoInicial` VARCHAR(500) NULL,
	  `prefijoFinal` VARCHAR(500) NULL,
	  `prefijoActual` VARCHAR(500) NULL,
	  `pieFactura` VARCHAR(500) NULL,
	  PRIMARY KEY (`idcompanyDetails`),
	  INDEX `fk_companyDetails_company1_idx` (`company_idcompany` ASC),
	  CONSTRAINT `fk_companyDetails_company1`
		FOREIGN KEY (`company_idcompany`)
		REFERENCES `iRocket`.`company` (`idcompany`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION)
	ENGINE = InnoDB;";
	$query = $this->con->consulta($sql);
		#5userd
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`userDetails` (
			`iduserDetails` INT NOT NULL AUTO_INCREMENT,
			`users_idusers` INT NOT NULL,
			`nameUser` VARCHAR(80) NULL,
			`lastnameUser` VARCHAR(60) NULL,
			`documentUser` BIGINT NULL,
			`genere` VARCHAR(45) NULL,
			`salaryBase` VARCHAR(45) NULL,
			`age` VARCHAR(45) NULL,
			`data_register` DATE NULL,
			`date_pay` VARCHAR(45) NULL,
			`salary` VARCHAR(45) NULL,
			`data_update` DATE NULL,
			`range` VARCHAR(45) NULL,
			`jobTitle` VARCHAR(45) NULL,
			`foto` BLOB NULL,
			`company` VARCHAR(100) NULL,
			`phone` BIGINT NULL,
			`email` VARCHAR(100) NULL,
			`ruta` LONGTEXT NULL,
			`userUpdate` VARCHAR(500) NULL,
			`description` LONGTEXT NULL,
			`rut` VARCHAR(100) NULL,
			`secondNameUser` VARCHAR(100) NULL,
			`personaJuridica` VARCHAR(100) NULL,
			PRIMARY KEY (`iduserDetails`),
			INDEX `fk_userDetails_users1_idx` (`users_idusers` ASC),
			CONSTRAINT `fk_userDetails_users1`
			  FOREIGN KEY (`users_idusers`)
			  REFERENCES `iRocket`.`users` (`idusers`)
			  ON DELETE NO ACTION
			  ON UPDATE NO ACTION)
		  ENGINE = InnoDB";
  $query = $this->con->consulta($sql);

		
		
		#6cash
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`cash` (
			  `idcash` INT NOT NULL AUTO_INCREMENT,
			  `depositAccount_iddepositAccounts` INT NOT NULL,
			  `users_idusers` INT NOT NULL,
			  `passCash` VARCHAR(100) NULL,
			  `codeCash` VARCHAR(45) NULL,
			  PRIMARY KEY (`idcash`),
			  INDEX `fk_cash_depositAccount1_idx` (`depositAccount_iddepositAccounts` ASC),
			  INDEX `fk_cash_users1_idx` (`users_idusers` ASC),
			  CONSTRAINT `fk_cash_depositAccount1`
			    FOREIGN KEY (`depositAccount_iddepositAccounts`)
			    REFERENCES `iRocket`.`depositAccount` (`iddepositAccounts`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_cash_users1`
			    FOREIGN KEY (`users_idusers`)
			    REFERENCES `iRocket`.`users` (`idusers`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		#7bills
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`bills` (
			  `idbills` INT NOT NULL AUTO_INCREMENT,
			  `users_idusers` INT NULL,
			  `cash_idcash` INT NULL,
			  `cliente` VARCHAR(150) NULL,
			  `typeBill` INT NULL,
			  `numeroFactura` INT NULL,
			  `dateRegister` DATE NULL,
			  `dateUpdate` DATE NULL,
			  `total` INT NULL,
			  `impuesto` VARCHAR(45) NULL,
			  `pago` VARCHAR(455) NULL,
			  `saldo` VARCHAR(455) NULL,
			  `stateBill` INT NULL,
			  `idCliente` VARCHAR(455) NULL,
			  `userName` VARCHAR(455) NULL,
			  PRIMARY KEY (`idbills`),
			  INDEX `fk_bills_users1_idx` (`users_idusers` ASC),
			  INDEX `fk_bills_cash1_idx` (`cash_idcash` ASC),
			  CONSTRAINT `fk_bills_users1`
			    FOREIGN KEY (`users_idusers`)
			    REFERENCES `iRocket`.`users` (`idusers`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_bills_cash1`
			    FOREIGN KEY (`cash_idcash`)
			    REFERENCES `iRocket`.`cash` (`idcash`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB";
		$query = $this->con->consulta($sql);

		#8inventory
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`inventory` (
			`idinventory` INT NOT NULL AUTO_INCREMENT,
			`company_idcompany` INT NULL,
			`codeInventory` VARCHAR(45) NULL,
			`stateBD` INT(1) NULL,
			PRIMARY KEY (`idinventory`),
			INDEX `fk_stock_company1_idx` (`company_idcompany` ASC),
			CONSTRAINT `fk_stock_company1`
			  FOREIGN KEY (`company_idcompany`)
			  REFERENCES `iRocket`.`company` (`idcompany`)
			  ON DELETE NO ACTION
			  ON UPDATE NO ACTION)
		  ENGINE = InnoDB;";
	  $query = $this->con->consulta($sql);

	  #Movimiento de productos
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`movimientoProductos` (
			`idmovimientoProductos` INT NOT NULL AUTO_INCREMENT,
			`idProduct` VARCHAR(45) NULL,
			`codeProduct` VARCHAR(45) NULL,
			`nameProduct` VARCHAR(45) NULL,
			`typeMovement` VARCHAR(45) NULL,
			`cantidad` VARCHAR(45) NULL,
			`stateBD` INT(1) NULL,
			PRIMARY KEY (`idmovimientoProductos`),
			  ON DELETE NO ACTION
			  ON UPDATE NO ACTION)
		  ENGINE = InnoDB;";
	  $query = $this->con->consulta($sql);

		#9products
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`products` (
			  `idproducts` INT NOT NULL AUTO_INCREMENT,
			  `inventory_idinventory` INT NULL,
			  `codeProduct` LONGTEXT NULL,
			  `codeProduct_promotion` LONGTEXT NULL,
			  `codeProduct_promotion2` LONGTEXT NULL,
			  `codeProduct_4` LONGTEXT NULL,
			  `codeProduct_5` LONGTEXT NULL,
			  `codeProduct_6` LONGTEXT NULL,
			  `codeProduct_7` LONGTEXT NULL,
			  `codeProduct_8` LONGTEXT NULL,
			  `codeProduct_9` LONGTEXT NULL,
			  `codeProduct_10` LONGTEXT NULL,
			  `precio` VARCHAR(45) NULL,
			  `precio_promotion` VARCHAR(45) NULL,
			  `precio_promotion2` VARCHAR(45) NULL,
			  `precio3` VARCHAR(45) NULL,
			  `precio4` VARCHAR(45) NULL,
			  `precio5` VARCHAR(45) NULL,
			  `precio6` VARCHAR(45) NULL,
			  `precio7` VARCHAR(45) NULL,
			  `precio8` VARCHAR(45) NULL,
			  `precio9` VARCHAR(45) NULL,
			  `price_buy_prom` VARCHAR(45) NULL,
			  `price_buy` VARCHAR(45) NULL,
			  `quantityProduct` BIGINT NULL,
			  `stateBD` VARCHAR(45) NULL,
			  `descripcion` VARCHAR(45) NULL,
			  PRIMARY KEY (`idproducts`),
			  INDEX `fk_products_inventory1_idx` (`inventory_idinventory` ASC),
			  CONSTRAINT `fk_products_inventory1`
			    FOREIGN KEY (`inventory_idinventory`)
			    REFERENCES `iRocket`.`inventory` (`idinventory`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		#10billd
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`billDetails` (
				  `idbillDetails` INT NOT NULL AUTO_INCREMENT,
				  `bills_idbills` INT NULL,
				  `products_idproducts` INT NULL,
				  `codigo` VARCHAR(150) NULL,
				  `nombre` VARCHAR(150) NULL,
				  `precioUnidad` BIGINT NULL,
				  `cantidad` BIGINT NULL,
				  `precioTotal` BIGINT NULL,
				  `impuesto` BIGINT NULL,
				  `dateRegister` DATE NULL,
				  `dateUpdate` DATE NULL,
				  `stateBillDetail` INT NULL,
				  PRIMARY KEY (`idbillDetails`),
				  INDEX `fk_billDetails_bills1_idx` (`bills_idbills` ASC),
				  INDEX `fk_billDetails_products1_idx` (`products_idproducts` ASC),
				  CONSTRAINT `fk_billDetails_bills1`
				    FOREIGN KEY (`bills_idbills`)
				    REFERENCES `iRocket`.`bills` (`idbills`)
				    ON DELETE NO ACTION
				    ON UPDATE NO ACTION,
				  CONSTRAINT `fk_billDetails_products1`
				    FOREIGN KEY (`products_idproducts`)
				    REFERENCES `iRocket`.`products` (`idproducts`)
				    ON DELETE NO ACTION
				    ON UPDATE NO ACTION)
				ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		#11prodd
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`productDetails` (
				`idproductDetails` INT NOT NULL AUTO_INCREMENT,
				`products_idproducts` INT NOT NULL,
				#product
				`nameProduct` VARCHAR(45) NULL,
				`iva` LONGTEXT NULL,
				`min_limit_items` VARCHAR(45) NULL,
				`date_register` VARCHAR(45) NULL,
				`dateVenc` VARCHAR(45) NULL,
				`date_update` VARCHAR(45) NULL,
				`ruta` LONGTEXT NULL,
				`totalBuy` INT NULL,
				`totalSales` INT NULL,
				`totalItem` INT NULL,
				`stateNotProd` INT NULL,
				`ubicacionBodega` VARCHAR(500) NULL,
				`ubicacionAlmacen` VARCHAR(500) NULL,
				`ubicacion2` VARCHAR(500) NULL,
				`ubicacion3` VARCHAR(500) NULL,
				`ubicacion4` VARCHAR(500) NULL,
				`ubicacion5` VARCHAR(500) NULL,
				`providerID` VARCHAR(500) NULL,
				`providerID2` VARCHAR(500) NULL,
				`providerID3` VARCHAR(500) NULL,
				`providerID4` VARCHAR(500) NULL,
				`providerID5` VARCHAR(500) NULL,
				`unidadesCaja` VARCHAR(500) NULL,
				`presentacionFarmaceutica` VARCHAR(500) NULL,
				`consentracion` VARCHAR(500) NULL,
				`laboratorio` VARCHAR(500) NULL,
				`lote` VARCHAR(500) NULL,
				`lote2` VARCHAR(500) NULL,
				`lote3` VARCHAR(500) NULL,
				`lote4` VARCHAR(500) NULL,
				`lote5` VARCHAR(500) NULL,
				`lote6` VARCHAR(500) NULL,
				`lote7` VARCHAR(500) NULL,
				`lote8` VARCHAR(500) NULL,
				`lote9` VARCHAR(500) NULL,
				`lote10` VARCHAR(500) NULL,
				`registroSanitario` VARCHAR(500) NULL,
				`fechaVencimiento` VARCHAR(500) NULL,
				`fechaVencimiento2` VARCHAR(500) NULL,
				`fechaVencimiento3` VARCHAR(500) NULL,
				`fechaVencimiento4` VARCHAR(500) NULL,
				`fechaVencimiento5` VARCHAR(500) NULL,
				`fechaVencimiento6` VARCHAR(500) NULL,
				`fechaVencimiento7` VARCHAR(500) NULL,
				`fechaVencimiento8` VARCHAR(500) NULL,
				`fechaVencimiento9` VARCHAR(500) NULL,
				`fechaVencimiento10` VARCHAR(500) NULL,
				`datoExtra8` VARCHAR(500) NULL,
				`datoExtra9` VARCHAR(500) NULL,
				`datoExtra10` VARCHAR(500) NULL,
				PRIMARY KEY (`idproductDetails`),
				INDEX `fk_productDetails_products1_idx` (`products_idproducts` ASC),
				CONSTRAINT `fk_productDetails_products1`
				FOREIGN KEY (`products_idproducts`)
				REFERENCES `iRocket`.`products` (`idproducts`)
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
				ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);
/*
		#11prodd
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`productDefect` (
				`idproductDefect` INT NOT NULL AUTO_INCREMENT,
				`products_idproducts` INT NOT NULL,
				`code` VARCHAR(45) NULL,
				`precio_defect` VARCHAR(45) NULL,
				`cantidadDef` VARCHAR(45) NULL,
				`stateNot` VARCHAR(45) NULL,
				PRIMARY KEY (`idproductDefect`),
				INDEX `fk_productDefect_products1_idx` (`products_idproducts` ASC),
				CONSTRAINT `fk_productDefect_products1`
				FOREIGN KEY (`products_idproducts`)
				REFERENCES `iRocket`.`products` (`idproducts`)
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
				ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		#11prodd	
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`depositReports` (
			  `iddepositReports` INT NOT NULL AUTO_INCREMENT,
			  `fecha` VARCHAR(45) NULL,
			  `tipo` VARCHAR(45) NULL,
			  `total` VARCHAR(45) NULL,
			  `empleado` VARCHAR(45) NULL,
			  `users_idusers` INT NULL,
			  PRIMARY KEY (`iddepositReports`),
			  INDEX `fk_depositReports_users1_idx` (`users_idusers` ASC),
			  CONSTRAINT `fk_depositReports_users1`
			    FOREIGN KEY (`users_idusers`)
			    REFERENCES `iRocket`.`users` (`idusers`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB";
		$query = $this->con->consulta($sql);
 */

		#12cashd
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`cashDetails` (
			  `idcashDetails` INT NOT NULL AUTO_INCREMENT,
			  `cash_idcash` INT NOT NULL,
			  `totalBillSale` VARCHAR(45) NULL,
			  `totalBillBuy` VARCHAR(45) NULL,
			  `totalItemsSale` VARCHAR(45) NULL,
			  `totalItemsBuy` VARCHAR(45) NULL,
			  `totalInput` VARCHAR(45) NULL,
			  `totalOutput` VARCHAR(45) NULL,
			  `nameCash` VARCHAR(80) NULL,
			  `descriptionCash` LONGTEXT NULL,
			  PRIMARY KEY (`idcashDetails`),
			  INDEX `fk_cashDetails_cash1_idx` (`cash_idcash` ASC),
			  CONSTRAINT `fk_cashDetails_cash1`
			    FOREIGN KEY (`cash_idcash`)
			    REFERENCES `iRocket`.`cash` (`idcash`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		#13depositd
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`depositAccountDetails` (
				  `iddepositAccountDetails` INT NOT NULL AUTO_INCREMENT,
				  `depositAccount_iddepositAccounts` INT NOT NULL,
				  `numberAccount` VARCHAR(45) NULL,
				  `currentAssets` BIGINT NULL,
				  `bank` VARCHAR(100) NULL,
				  `date_register` VARCHAR(45) NULL,
				  `date_update` VARCHAR(45) NULL,
				  `user_update` VARCHAR(45) NULL,
				  `total_sales` BIGINT NULL,
				  `total_buy` BIGINT NULL,
				  `description` LONGTEXT NULL,
				  PRIMARY KEY (`iddepositAccountDetails`),
				  INDEX `fk_depositAccountDetails_depositAccount1_idx` (`depositAccount_iddepositAccounts` ASC),
				  CONSTRAINT `fk_depositAccountDetails_depositAccount1`
				    FOREIGN KEY (`depositAccount_iddepositAccounts`)
				    REFERENCES `iRocket`.`depositAccount` (`iddepositAccounts`)
				    ON DELETE NO ACTION
				    ON UPDATE NO ACTION)
				ENGINE = InnoDB";
		$query = $this->con->consulta($sql);

		#14inventorid
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`inventoryDetails` (
				  `idinventoryDetails` INT NOT NULL AUTO_INCREMENT,
				  `inventory_idinventory` INT NOT NULL,
				  `nameInventory` VARCHAR(80) NULL,
				  `date_register` VARCHAR(45) NULL,
				  `date_update` VARCHAR(45) NULL,
				  `user_create` VARCHAR(45) NULL,
				  `user_update` VARCHAR(45) NULL,
				  `descriptionInventory` LONGTEXT NULL,
				  `codeStatus` VARCHAR(45) NULL,
				  `codeCurrent` VARCHAR(45) NULL,
				  PRIMARY KEY (`idinventoryDetails`),
				  INDEX `fk_inventoryDetails_inventory1_idx` (`inventory_idinventory` ASC),
				  CONSTRAINT `fk_inventoryDetails_inventory1`
				    FOREIGN KEY (`inventory_idinventory`)
				    REFERENCES `iRocket`.`inventory` (`idinventory`)
				    ON DELETE NO ACTION
				    ON UPDATE NO ACTION)
				ENGINE = InnoDB";
		$query = $this->con->consulta($sql);

		#15movement
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`movementDepositAccount` (
			  `idmovementDepositAccount` INT NOT NULL AUTO_INCREMENT,
			  `depositAccount_iddepositAccounts` INT NULL,
			  `bills_idbills` INT NULL,
			  `cash_idcash` INT NULL,
			  `users_idusers` INT NULL,
			  `typeMovement` INT NULL,
			  `totalMoney` VARCHAR(45) NULL,
			  `dataRegister` VARCHAR(45) NULL,
			  `dataUpdate` VARCHAR(45) NULL,
			  `userUpdate` VARCHAR(45) NULL,
			  `pago` VARCHAR(150) NULL,
			  `saldo` VARCHAR(450) NULL,
			  `change` VARCHAR(45) NULL,
			  `return` VARCHAR(45) NULL,
			  `typeDeposit` LONGTEXT NULL,
			  `fecha` VARCHAR(45) NULL,
			  `estado` VARCHAR(45) NULL,
			  PRIMARY KEY (`idmovementDepositAccount`),
			  INDEX `fk_movementDepositAccount_depositAccount1_idx` (`depositAccount_iddepositAccounts` ASC),
			  INDEX `fk_movementDepositAccount_bills1_idx` (`bills_idbills` ASC),
			  INDEX `fk_movementDepositAccount_cash1_idx` (`cash_idcash` ASC),
			  INDEX `fk_movementDepositAccount_users1_idx` (`users_idusers` ASC),
			  CONSTRAINT `fk_movementDepositAccount_depositAccount1`
			    FOREIGN KEY (`depositAccount_iddepositAccounts`)
			    REFERENCES `iRocket`.`depositAccount` (`iddepositAccounts`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_movementDepositAccount_bills1`
			    FOREIGN KEY (`bills_idbills`)
			    REFERENCES `iRocket`.`bills` (`idbills`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_movementDepositAccount_cash1`
			    FOREIGN KEY (`cash_idcash`)
			    REFERENCES `iRocket`.`cash` (`idcash`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_movementDepositAccount_users1`
			    FOREIGN KEY (`users_idusers`)
			    REFERENCES `iRocket`.`users` (`idusers`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB";
		$query = $this->con->consulta($sql);

		#16notificaciones
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`notifications` (
			  `idnotifications` INT NOT NULL AUTO_INCREMENT,
			  `users_idusers` INT NULL,
			  `products_idproducts` INT NULL,
			  `inventory_idinventory` INT NULL,
			  `typeNotification` INT NULL,
			  `message` LONGTEXT NULL,
			  `date_register` LONGTEXT NULL,
			  `movementDepositAccount_idmovementDepositAccount` INT NULL,
			  `company_idcompany` INT NULL,
			  `cash_idcash` INT NULL,
			  `depositAccount_iddepositAccounts` INT NULL,
			  PRIMARY KEY (`idnotifications`),
			  INDEX `fk_notifications_users1_idx` (`users_idusers` ASC),
			  INDEX `fk_notifications_products1_idx` (`products_idproducts` ASC),
			  INDEX `fk_notifications_inventory1_idx` (`inventory_idinventory` ASC),
			  INDEX `fk_notifications_movementDepositAccount1_idx` (`movementDepositAccount_idmovementDepositAccount` ASC),
			  INDEX `fk_notifications_company1_idx` (`company_idcompany` ASC),
			  INDEX `fk_notifications_cash1_idx` (`cash_idcash` ASC),
			  INDEX `fk_notifications_depositAccount1_idx` (`depositAccount_iddepositAccounts` ASC),
			  CONSTRAINT `fk_notifications_users1`
			    FOREIGN KEY (`users_idusers`)
			    REFERENCES `iRocket`.`users` (`idusers`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_notifications_products1`
			    FOREIGN KEY (`products_idproducts`)
			    REFERENCES `iRocket`.`products` (`idproducts`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_notifications_inventory1`
			    FOREIGN KEY (`inventory_idinventory`)
			    REFERENCES `iRocket`.`inventory` (`idinventory`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_notifications_movementDepositAccount1`
			    FOREIGN KEY (`movementDepositAccount_idmovementDepositAccount`)
			    REFERENCES `iRocket`.`movementDepositAccount` (`idmovementDepositAccount`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_notifications_company1`
			    FOREIGN KEY (`company_idcompany`)
			    REFERENCES `iRocket`.`company` (`idcompany`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_notifications_cash1`
			    FOREIGN KEY (`cash_idcash`)
			    REFERENCES `iRocket`.`cash` (`idcash`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION,
			  CONSTRAINT `fk_notifications_depositAccount1`
			    FOREIGN KEY (`depositAccount_iddepositAccounts`)
			    REFERENCES `iRocket`.`depositAccount` (`iddepositAccounts`)
			    ON DELETE NO ACTION
			    ON UPDATE NO ACTION)
			ENGINE = InnoDB";
		$query = $this->con->consulta($sql);

		#17billreports
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`billReports` (
				`idbillReports` INT NOT NULL AUTO_INCREMENT,
				`bills_idbills` INT NOT NULL,
				`total` VARCHAR(45) NULL,
				`pago` VARCHAR(45) NULL,
				`saldo` VARCHAR(45) NULL,
				`cliente` VARCHAR(45) NULL,
				`empleado` VARCHAR(45) NULL,
				`caja` VARCHAR(45) NULL,
				`fecha` VARCHAR(45) NULL,
				`estado` VARCHAR(45) NULL,
				`typeBill` VARCHAR(45) NULL,
				`bill` VARCHAR(45) NULL,
				PRIMARY KEY (`idbillReports`),
				INDEX `fk_billReports_bills1_idx` (`bills_idbills` ASC),
				CONSTRAINT `fk_billReports_bills1`
				FOREIGN KEY (`bills_idbills`)
				REFERENCES `iRocket`.`bills` (`idbills`)
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
				ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

		if ($query) {
			header("location:" . URL);
		}else{
			echo "2";
		}
	}

}
