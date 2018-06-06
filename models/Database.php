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
				  `age` VARCHAR(45) NULL,
				  `data_register` DATE NULL,
				  `date_pay` DATE NULL,
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
			  `fecha` VARCHAR(100) NULL,
			  `fechaUpdate` VARCHAR(100) NULL,
			  `codeBar` VARCHAR(12) NULL,
			  `typeBill` INT NULL,
			  `dateRegister` DATE NULL,
			  `dateUpdate` DATE NULL,
			  `pos` INT NULL,
			  `impuesto` VARCHAR(45) NULL,
			  `pago` VARCHAR(455) NULL,
			  `stateBill` INT NULL,
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

		#9products
		$sql = "CREATE TABLE IF NOT EXISTS `iRocket`.`products` (
			  `idproducts` INT NOT NULL AUTO_INCREMENT,
			  `inventory_idinventory` INT NULL,
			  `codeProduct` LONGTEXT NULL,
			  `codeProduct_promotion` LONGTEXT NULL,
			  `precio` VARCHAR(45) NULL,
			  `precio_promotion` VARCHAR(45) NULL,
			  `quantityProduct` BIGINT NULL,
			  `stateBD` VARCHAR(45) NULL,
			  `price_buy_prom` VARCHAR(45) NULL,
			  `price_buy` VARCHAR(45) NULL,
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
				  `nombre` VARCHAR(150) NULL,
				  `precio_compra` BIGINT NULL,
				  `precio_c-u` BIGINT NULL,
				  `precio_c-u_prom` BIGINT NULL,
				  `cantidad` BIGINT NULL,
				  `precio_total` BIGINT NULL,
				  `documentoCliente` VARCHAR(150) NULL,
				  `dateRegister` DATE NULL,
				  `dateUpdate` DATE NULL,
				  `ganancia_c-u` VARCHAR(45) NULL,
				  `stateBillDetail` INT NULL,
				  `code` VARCHAR(45) NULL,
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
				`nameProduct` VARCHAR(45) NULL,
				`descriptionProduct` LONGTEXT NULL,
				`min_limit_items` VARCHAR(45) NULL,
				`date_register` VARCHAR(45) NULL,
				`date_update` VARCHAR(45) NULL,
				`ruta` LONGTEXT NULL,
				`totalItemsInventory` INT NULL,
				`totalBuy` INT NULL,
				`totalSales` INT NULL,
				`totalBuy_prom` INT NULL,
				`totalSales_prom` INT NULL,
				`totalItem` INT NULL,
				PRIMARY KEY (`idproductDetails`),
				INDEX `fk_productDetails_products1_idx` (`products_idproducts` ASC),
				CONSTRAINT `fk_productDetails_products1`
				FOREIGN KEY (`products_idproducts`)
				REFERENCES `iRocket`.`products` (`idproducts`)
				ON DELETE NO ACTION
				ON UPDATE NO ACTION)
				ENGINE = InnoDB;";
		$query = $this->con->consulta($sql);

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
				  `totalProducts` VARCHAR(45) NULL,
				  `totalItems` VARCHAR(45) NULL,
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
