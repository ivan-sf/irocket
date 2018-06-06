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

		#1users
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



class BillReports
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


	public function AllBillsDayActive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=6  AND dataRegister='$today' OR typeMovement=7 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function AllBillsDayPassive()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=8  AND dataRegister='$today' OR typeMovement=9 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function AllBillsDay()
	{
		$today = date("Y-m-d");
		$sql = "SELECT * FROM movementdepositaccount WHERE typeMovement=8  AND dataRegister='$today' OR typeMovement=9 AND dataRegister='$today' OR typeMovement=6  AND dataRegister='$today' OR typeMovement=7 AND dataRegister='$today'";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	



	public function view()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE idbills='$idbill' AND  stateBill=2
		OR idbills='$idbill' AND   stateBill=1
		OR idbills='$idbill' AND   stateBill=3";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetails()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE bills_idbills='$idbill' AND  stateBillDetail=1
		";
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
<?php namespace models;

/**
* 
*/
class Bills
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
	
	public function array()
	{
		$sql = "SELECT * FROM bills WHERE stateBill=1 OR stateBill=2 OR stateBill=3 ORDER BY idbills desc LIMIT 5";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function array2()
	{
		$sql = "SELECT * FROM bills WHERE stateBill=1 OR stateBill=2 OR stateBill=3 ORDER BY idbills desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayBusqueda($id)
	{
		$sql = "SELECT * FROM bills WHERE stateBill=1 AND idbills LIKE $id OR stateBill=2 AND idbills LIKE $id OR stateBill=3 AND idbills LIKE $id ORDER BY idbills desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arrayBuy()
	{
		$sql = "SELECT * FROM bills WHERE typeBill=2 AND stateBill=1 OR typeBill=2 AND stateBill=2 OR typeBill=2 AND stateBill=3 ORDER BY idbills desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function arraySale()
	{
		$sql = "SELECT * FROM bills WHERE typeBill=1 AND stateBill=1 OR typeBill=1 AND stateBill=2 OR typeBill=1 AND stateBill=3 ORDER BY idbills desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function auth()
	{
		
	}
	public function view()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM bills 
		INNER JOIN billdetails 
		ON bills.idbills=billdetails.bills_idbills
		WHERE idbills='$idbill' AND  stateBill=2
		OR idbills='$idbill' AND   stateBill=1
		OR idbills='$idbill' AND   stateBill=3";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetails()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE bills_idbills='$idbill' AND  stateBillDetail=1
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function viewDetails2()
	{
		$idbill = $this->idbill;
		$sql = "SELECT * FROM  billdetails 
		WHERE idbillDetails='$idbill' AND  stateBillDetail=1
		";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function changeBill()
	{
		/*
		movementsaccounts
		depositdetails
		*/
		
		$cNewProd = $this->cNewProd;
		$estado = $this->estado;
		$qNewProd = $this->qNewProd;
		$idBillD = $this->idBillD;
		$idBill = $this->idBill;
		$idUser = $this->idUser;
		$tipo = $this->tipo;
		$typeBill = $this->typeBill;

		//DATOS VIEJO PRODUCTO BILLS
		$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
		$queryVP = $this->con->returnConsulta($sqlVP);
		$dataAVP = mysqli_fetch_array($queryVP);
		$idprodV = $dataAVP['products_idproducts'];
		$precioTotalVP = $dataAVP['precio_total'];
		$precioTotalViejoProducto = $precioTotalVP;
		$cantidadVP = $dataAVP['cantidad'];
		$precioTVP = $precioTotalVP/$cantidadVP;
		//DATOS VIEJO PRODUCTO PRODUCTS
		$sqlVPP = "SELECT * FROM products INNER JOIN productdetails
		ON  idproducts=products_idproducts
		WHERE idproducts='$idprodV'";
		$queryVPP = $this->con->returnConsulta($sqlVPP);
		$dataAVPP = mysqli_fetch_array($queryVPP);
		$precioTotalVPP = $dataAVPP['precio'];
		$precioTotalVPPP = $dataAVPP['precio_promotion'];
		$quantityProductVPP = $dataAVPP['quantityProduct'];
		$totalItemsInventoryVPP = $dataAVPP['totalItemsInventory'];
		$totalSalesVPP = $dataAVPP['totalSales'];
		$totalBuyVPP = $dataAVPP['totalBuy'];
		$totalItemVPP = $dataAVPP['totalItem'];
		$row = mysqli_num_rows($queryVPP);
		//DATOS NUEVO PRODUCTO
		$sqlNPP = "SELECT * FROM products INNER JOIN productdetails
		ON  idproducts=products_idproducts
		WHERE codeProduct='$cNewProd'";
		$queryNPP = $this->con->returnConsulta($sqlNPP);
		$dataNPP = mysqli_fetch_array($queryNPP);
		$quantityProductNPP = $dataNPP['quantityProduct'];
		
		$idNPP = $dataNPP['idproducts'];
		$totalItemsInventoryNPP = $dataNPP['totalItemsInventory'];
		$totalSalesNPP = $dataNPP['totalSales'];
		$totalBuyNPP = $dataNPP['totalBuy'];
		$totalItemNPP = $dataNPP['totalItem'];
		$precioNPP = $dataNPP['precio'];
		$precioNPPP = $dataNPP['price_buy'];
		$precioTotalNuevoProducto = $precioNPP*$qNewProd;
		$precioTotalNuevoProductoProm = $precioNPPP*$qNewProd;
		//DATOS CODIGO DE INGRESO
		$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct_promotion='$cNewProd'";
		$query2 = $this->con->returnConsulta($sql2);
		$row2=mysqli_num_rows($query2);

		if ($estado != 1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=saldo");
		}else{
			
		if ($precioTotalNuevoProducto < $precioTotalVP) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=precio");
		}else{
			if ($idprodV==$idNPP) {
				header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=codigo");
			}else{
				if ($precioTVP == $precioTotalVPP AND $row2!=1 AND $typeBill == 1) {
			//SABER SI ES DE VENTA O DE COMPRA
					if ($typeBill == 1) {
				//VENTA
				//PRIMERO VIEJO PRODUCTO:
				//SUMAR AL INVENTARIO Y RESTAR VENTA
						$newquantityProductVPP = $quantityProductVPP+$cantidadVP;
						$newtotalItemsInventoryVPP = $totalItemsInventoryVPP+$cantidadVP;
						$newtotalSalesVPP = $totalSalesVPP-$cantidadVP;
						$newtotalItemVPP = $totalItemVPP+$cantidadVP;
						$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductVPP' WHERE `idproducts`='$idprodV'";
						$queryVPP = $this->con->consulta($sql);
						if ($queryVPP) {
							$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryVPP', `totalSales`='$newtotalSalesVPP', `totalItem`='$newtotalItemVPP' WHERE `idproductDetails`='$idprodV'";
							$queryVPP = $this->con->consulta($sql);
						}
				//SEGUNDO NUEVO PRODUCTO
				//RESTAR AL INVENTARIO Y SUMAR VENTA
						$newquantityProductNPP = $quantityProductNPP-$qNewProd;
						$newtotalItemsInventoryNPP = $totalItemsInventoryNPP-$qNewProd;
						$newtotalSalesNPP = $totalSalesNPP+$qNewProd;
						$newtotalItemNPP = $totalItemNPP-$qNewProd;
						$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductNPP' WHERE `idproducts`='$idNPP'";
						$queryVPP = $this->con->consulta($sql);
						if ($queryVPP) {
							$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryNPP', `totalSales`='$newtotalSalesNPP', `totalItem`='$newtotalItemNPP' WHERE `idproductDetails`='$idNPP'";
							$queryVPP = $this->con->consulta($sql);
						}
						//MOVIMIENTOS















						$dateTime = date("Y-m-d");

		$sql1 = "SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
		$query1 = $this->con->returnConsulta($sql1);
		$data1= mysqli_fetch_array($query1);
		$change=$data1['change'];
		$return=$data1['return'];
		if ($change == 1 && $return == 1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=completa");
		}else{
			$sql1 = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query1 = $this->con->returnConsulta($sql1);
			$data1= mysqli_fetch_array($query1);
			$precio1=$data1['precio_c-u'];

			$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
			$query2 = $this->con->returnConsulta($sql2);
			$data2= mysqli_fetch_array($query2);
			$precio2=$data2['precio'];

			
				//DATOS VIEJO BILL DETAIL
				
				if ($estado == 1) {
					if ($cNewProd != '' && $qNewProd >= 1) {
						$sqlNP = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd'";
						$queryNP = $this->con->returnConsulta($sqlNP);
						$dataRNP = mysqli_num_rows($queryNP);
						if ($dataRNP >= 1) {

							if ($estado == 1) {
								$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
								$query = $this->con->consulta($sql);

								$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$query = $this->con->returnConsulta($sql);
								$dataA= mysqli_fetch_array($query);
								$id=$dataA['idbillDetails'];
								$totalProd=$dataA['precio_total'];

								$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
								$query2 = $this->con->returnConsulta($sql2);
								$dataA2= mysqli_fetch_array($query2);
								$dataR2= mysqli_num_rows($query2);
								$total=$dataA2['total'];
								$saldo=$dataA2['saldo'];
								$totalNew=$total-$totalProd;
								$totalNewPlus=$total+$totalProd;
								$saldoNew=$saldo-$totalProd;
								if ($saldoNew <= 0) {
									$saldoNew = 0;
									if ($typeBill == 1) {
										$est = 6;
									}else{
										$est = 8;
									}
								}else{
									if ($typeBill == 1) {
										$est = 7;
									}else{
										$est = 9;
									}
								}

								$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
								$query = $this->con->consulta($sql);

								$query = $this->con->consulta($sql);

								if ($query) {
									$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pcVP = $dataAVP['precio_compra'];
									$pvVP = $dataAVP['precio_c-u'];
									$pvPVP = $dataAVP['precio_c-u_prom'];
									$ptVP = $dataAVP['precio_total'];


									$dataANP = mysqli_fetch_array($queryNP);
									$idNP = $dataANP['idproducts'];
									$nameNP = $dataANP['nameProduct'];
									$codeNP = $dataANP['codeProduct'];
									$pcNP = $dataANP['price_buy'];
									$pvNP = $dataANP['precio'];
									$pvPNP = $dataANP['precio_promotion'];
									$codePromNP = $dataANP['codeProduct_promotion'];
									if ($codeNP == $cNewProd) {
										$precioNP = $dataANP['precio'];
									}else{
										$precioNP = $dataANP['precio_promotion'];
									}
									$precioTNP = $precioNP * $qNewProd;
									$gananciaNP = $precioNP - $pcNP;
									$sqlBD = "INSERT INTO `billdetails` (`bills_idbills`, `products_idproducts`, `nombre`, `precio_compra`, `precio_c-u`, `precio_c-u_prom`, `cantidad`, `precio_total`, `dateRegister`, `ganancia_c-u`, `stateBillDetail`) VALUES ('$idBill', '$idNP', '$nameNP', '$pcNP', '$pvNP', '$pvPNP', '$qNewProd', '$precioTNP', '$dateTime', '$gananciaNP', '1')";
									$queryBD = $this->con->consulta($sqlBD);

									$sqlVP = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$total = $dataAVP['total'];
									$pago = $dataAVP['pago'];
									$totalNew = $total+$precioTNP;
									$totalNewPlus=$total+$totalProd;

									if ($totalNew>$pago) {
										$saldoNew = $totalNew-$pago;
									}

									$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
									$query = $this->con->consulta($sql);

									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pago = $dataAVP['pago'];
									$saldo = $dataAVP['saldo'];
									$total = $totalNew;

									if ($typeBill == 1) {
										if ($saldoNew == 0) {
											$est = 6;
										}else{
											$est = 7;
										}
									}else{
										if ($saldoNew == 0) {
											$est = 8;
										}else{
											$est = 9;
										}
									}
									if ($totalNew > $totalNewPlus) {

									}else{
										$sql = "SELECT * FROM depositaccountdetails";
										$query = $this->con->returnConsulta($sql);
										$dataA= mysqli_fetch_array($query);
										$current=$dataA['currentAssets'];
										if ($typeBill == 1) {
											$totalDeposit = $current-$saldoNew;
										}else{
											$totalDeposit = $current+$saldoNew;
										}

										$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
										$query = $this->con->consulta($sql);

										$saldoNew = $saldoNew + $totalProd;
										
									}


									$query = $this->con->consulta($sql);

								}

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];
								$pagoPV=$dataPV['pago'];
								$saldoPV=$dataPV['saldo'];
								//Necesito restarle el valor del producto actual 
								$sqlPB="SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$queryPB=$this->con->returnConsulta($sqlPB);
								$dataPB=mysqli_fetch_array($queryPB);
								$pagoTotalProductoPB=$dataPB['precio_total'];

								$totalRM=$totalMoneyPV-$pagoTotalProductoPB;

								$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalRM' WHERE `bills_idbills`='$idBill'";
								$queryRM=$this->con->consulta($sqlRM);

								//Sumar nueva cantidad
								$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
								$query2 = $this->con->returnConsulta($sql2);
								$data2= mysqli_fetch_array($query2);
								$precio2=$data2['precio'];
								$precioTNP=$precio2*$qNewProd;

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];

								$totalSM=$totalMoneyPV+$precioTNP;
								if ($totalSM>$pagoPV) {
									$est=7;
									$saldo=$totalSM-$pagoPV;
									$totalSM = $totalSM-$saldo;
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `saldo`='$saldo' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);

								}else{
									$est=6;	
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);

								}
								




								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio");


							}else{
								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
							}
						}else{
							header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=no_encontrado");
						}			
					}else{
						header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=sin_producto");
					}
				}else{
					header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
				}
			}




						













					}
				}elseif ($row2!=1 AND $typeBill == 2) {
					if ($precioTotalNuevoProductoProm < $precioTotalVP) {
						header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=precio");
					}else{



















						//VENTA

				//PRIMERO VIEJO PRODUCTO:
				//SUMAR AL INVENTARIO Y RESTAR VENTA
					$newquantityProductVPP = $quantityProductVPP-$cantidadVP;
					$newtotalItemsInventoryVPP = $totalItemsInventoryVPP-$cantidadVP;
					$newtotalSalesVPP = $totalBuyVPP-$cantidadVP;
					$newtotalItemVPP = $totalItemVPP-$cantidadVP;
					$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductVPP' WHERE `idproducts`='$idprodV'";
					$queryVPP = $this->con->consulta($sql);
					if ($queryVPP) {
						$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryVPP', `totalBuy`='$newtotalSalesVPP', `totalItem`='$newtotalItemVPP' WHERE `idproductDetails`='$idprodV'";
						$queryVPP = $this->con->consulta($sql);
					}
				//SEGUNDO NUEVO PRODUCTO
				//RESTAR AL INVENTARIO Y SUMAR VENTA
					$newquantityProductNPP = $quantityProductNPP+$qNewProd;
					$newtotalItemsInventoryNPP = $totalItemsInventoryNPP+$qNewProd;
					$newtotalSalesNPP = $totalBuyNPP+$qNewProd;
					$newtotalItemNPP = $totalItemNPP+$qNewProd;
					$sql = "UPDATE `irocket`.`products` SET `quantityProduct`='$newquantityProductNPP' WHERE `idproducts`='$idNPP'";
					$queryVPP = $this->con->consulta($sql);
					if ($queryVPP) {
						$sql = "UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$newtotalItemsInventoryNPP', `totalBuy`='$newtotalSalesNPP', `totalItem`='$newtotalItemNPP' WHERE `idproductDetails`='$idNPP'";
						$queryVPP = $this->con->consulta($sql);
					}

















						$dateTime = date("Y-m-d");

		$sql1 = "SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
		$query1 = $this->con->returnConsulta($sql1);
		$data1= mysqli_fetch_array($query1);
		$change=$data1['change'];
		$return=$data1['return'];
		if ($change == 1 && $return == 1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=completa");
		}else{
			$sql1 = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query1 = $this->con->returnConsulta($sql1);
			$data1= mysqli_fetch_array($query1);
			$precio1=$data1['precio_c-u'];

			$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
			$query2 = $this->con->returnConsulta($sql2);
			$data2= mysqli_fetch_array($query2);
			$precio2=$data2['precio'];

			
				//DATOS VIEJO BILL DETAIL
				
				if ($estado == 1) {
					if ($cNewProd != '' && $qNewProd >= 1) {
						$sqlNP = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd'";
						$queryNP = $this->con->returnConsulta($sqlNP);
						$dataRNP = mysqli_num_rows($queryNP);
						if ($dataRNP >= 1) {

							if ($estado == 1) {
								$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
								$query = $this->con->consulta($sql);

								$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$query = $this->con->returnConsulta($sql);
								$dataA= mysqli_fetch_array($query);
								$id=$dataA['idbillDetails'];
								$totalProd=$dataA['precio_total'];

								$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
								$query2 = $this->con->returnConsulta($sql2);
								$dataA2= mysqli_fetch_array($query2);
								$dataR2= mysqli_num_rows($query2);
								$total=$dataA2['total'];
								$saldo=$dataA2['saldo'];
								$totalNew=$total-$totalProd;
								$totalNewPlus=$total+$totalProd;
								$saldoNew=$saldo-$totalProd;
								if ($saldoNew <= 0) {
									$saldoNew = 0;
									if ($typeBill == 1) {
										$est = 6;
									}else{
										$est = 8;
									}
								}else{
									if ($typeBill == 1) {
										$est = 7;
									}else{
										$est = 9;
									}
								}

								$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
								$query = $this->con->consulta($sql);

								$query = $this->con->consulta($sql);

								if ($query) {
									$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pcVP = $dataAVP['precio_compra'];
									$pvVP = $dataAVP['precio_c-u'];
									$pvPVP = $dataAVP['precio_c-u_prom'];
									$ptVP = $dataAVP['precio_total'];


									$dataANP = mysqli_fetch_array($queryNP);
									$idNP = $dataANP['idproducts'];
									$nameNP = $dataANP['nameProduct'];
									$codeNP = $dataANP['codeProduct'];
									$pcNP = $dataANP['price_buy'];
									$pvNP = $dataANP['precio'];
									$pvPNP = $dataANP['precio_promotion'];
									$codePromNP = $dataANP['codeProduct_promotion'];
									if ($codeNP == $cNewProd) {
										$precioNP = $dataANP['price_buy'];
									}else{
										$precioNP = $dataANP['precio_promotion'];
									}
									$precioTNP = $precioNP * $qNewProd;
									$gananciaNP = $precioNP - $pcNP;
									$sqlBD = "INSERT INTO `billdetails` (`bills_idbills`, `products_idproducts`, `nombre`, `precio_compra`, `precio_c-u`, `precio_c-u_prom`, `cantidad`, `precio_total`, `dateRegister`, `ganancia_c-u`, `stateBillDetail`) VALUES ('$idBill', '$idNP', '$nameNP', '$pcNP', '$pvNP', '$pvPNP', '$qNewProd', '$precioTNP', '$dateTime', '$gananciaNP', '1')";
									$queryBD = $this->con->consulta($sqlBD);

									$sqlVP = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$total = $dataAVP['total'];
									$pago = $dataAVP['pago'];
									$totalNew = $total+$precioTNP;
									$totalNewPlus=$total+$totalProd;

									if ($totalNew>$pago) {
										$saldoNew = $totalNew-$pago;
									}

									$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
									$query = $this->con->consulta($sql);

									$queryVP = $this->con->returnConsulta($sqlVP);
									$dataAVP = mysqli_fetch_array($queryVP);
									$pago = $dataAVP['pago'];
									$saldo = $dataAVP['saldo'];
									$total = $totalNew;

									if ($typeBill == 1) {
										if ($saldoNew == 0) {
											$est = 6;
										}else{
											$est = 7;
										}
									}else{
										if ($saldoNew == 0) {
											$est = 8;
										}else{
											$est = 9;
										}
									}
									if ($totalNew > $totalNewPlus) {

									}else{
										$sql = "SELECT * FROM depositaccountdetails";
										$query = $this->con->returnConsulta($sql);
										$dataA= mysqli_fetch_array($query);
										$current=$dataA['currentAssets'];
										if ($typeBill == 1) {
											$totalDeposit = $current-$saldoNew;
										}else{
											$totalDeposit = $current+$saldoNew;
										}

										$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
										$query = $this->con->consulta($sql);

										$saldoNew = $saldoNew + $totalProd;
										
									}


									$query = $this->con->consulta($sql);

								}

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];
								$pagoPV=$dataPV['pago'];
								$saldoPV=$dataPV['saldo'];
								//Necesito restarle el valor del producto actual 
								$sqlPB="SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
								$queryPB=$this->con->returnConsulta($sqlPB);
								$dataPB=mysqli_fetch_array($queryPB);
								$pagoTotalProductoPB=$dataPB['precio_total'];

								$totalRM=$totalMoneyPV-$pagoTotalProductoPB;

								$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalRM' WHERE `bills_idbills`='$idBill'";
								$queryRM=$this->con->consulta($sqlRM);

								//Sumar nueva cantidad
								$sql2 = "SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE codeProduct='$cNewProd' OR codeProduct_promotion='$cNewProd'";
								$query2 = $this->con->returnConsulta($sql2);
								$data2= mysqli_fetch_array($query2);
								$precio2=$data2['price_buy'];
								$precioTNP=$precio2*$qNewProd;

								$sqlPV="SELECT * FROM movementdepositaccount WHERE bills_idbills='$idBill'";
								$queryPV=$this->con->returnConsulta($sqlPV);
								$dataPV=mysqli_fetch_array($queryPV);
								$totalMoneyPV=$dataPV['totalMoney'];

								$totalSM=$totalMoneyPV+$precioTNP;
								if ($totalSM>$pagoPV) {
									$est=9;
									$saldo=$totalSM-$pagoPV;
									$totalSM=$totalSM-$saldo;
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `saldo`='$saldo' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
								}else{
									$esy=8;
									$sqlRM="UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalSM', `typeMovement`='$est' WHERE `bills_idbills`='$idBill'";
									$queryRM=$this->con->consulta($sqlRM);
								}
								





								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio");


							}else{
								header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
							}
						}else{
							header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=no_encontrado");
						}			
					}else{
						header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=sin_producto");
					}
				}else{
					header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=" . $idBillD . "&error=saldo");
				}
			}


























					}
				

						







				} else{
					header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&cambio=".$idBillD."&error=promocion");
				}

			}

		}
		}

	}

	public function returnBill()
	{
		$cNewProd = $this->cNewProd;
		$estado = $this->estado;
		$qNewProd = $this->qNewProd;
		$idBillD = $this->idBillD;
		$idBill = $this->idBill;
		$idUser = $this->idUser;
		$tipo = $this->tipo;
		$typeBill = $this->typeBill;



		//PRIMERO SI ES DE PROMOCION NO HACER LA DEVOLUCION

		$sqlVP = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
		$queryVP = $this->con->returnConsulta($sqlVP);
		$dataAVP = mysqli_fetch_array($queryVP);
		$idprodV = $dataAVP['products_idproducts'];
		$precioTotalVP = $dataAVP['precio_total'];
		$precioTotalViejoProducto = $precioTotalVP;
		$cantidadVP = $dataAVP['cantidad'];
		$precioTVP = $precioTotalVP/$cantidadVP;

		$sqlVPP = "SELECT * FROM products INNER JOIN productdetails
		ON  idproducts=products_idproducts
		WHERE idproducts='$idprodV'";
		$queryVPP = $this->con->returnConsulta($sqlVPP);
		$dataAVPP = mysqli_fetch_array($queryVPP);
		$precioTotalVPP = $dataAVPP['precio'];
		$precioTotalVPPP = $dataAVPP['precio_promotion'];
		$quantityProductVPP = $dataAVPP['quantityProduct'];
		$totalItemsInventoryVPP = $dataAVPP['totalItemsInventory'];
		$totalSalesVPP = $dataAVPP['totalSales'];
		$totalBuyVPP = $dataAVPP['totalBuy'];
		$totalItemVPP = $dataAVPP['totalItem'];
		$row = mysqli_num_rows($queryVPP);
if ($estado != 1) {
	header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion=".$idBillD."&error=saldo");
}else{
	if ($precioTVP==$precioTotalVPPP AND $typeBill==1) {
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion=".$idBillD."&error=promocion");
		}elseif ($typeBill==2) {








			//COMPRA LO TENGO ENTONCES SE DEBE RESTAR
			$quantityProductVPPN=$quantityProductVPP-$cantidadVP;
			$totalItemsInventoryVPPN=$totalItemsInventoryVPP-$cantidadVP;
			$totalSalesVPPN=$totalBuyVPP-$cantidadVP;
			$totalItemVPPN=$totalItemVPP-$cantidadVP;
			$sql="UPDATE `irocket`.`products` SET `quantityProduct`='$quantityProductVPPN' WHERE `idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			$sql="UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$totalItemsInventoryVPPN', `totalBuy`='$totalSalesVPPN', `totalItem`='$totalItemVPPN' WHERE `products_idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);


		
		$dateTime = date("Y-m-d");
		if ($estado == 1) {
			$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$id=$dataA['idbillDetails'];
			$totalProd=$dataA['precio_total'];

			$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
			$query2 = $this->con->returnConsulta($sql2);
			$dataA2= mysqli_fetch_array($query2);
			$dataR2= mysqli_num_rows($query2);
			$total=$dataA2['total'];
			$saldo=$dataA2['saldo'];
			$totalNew=$total-$totalProd;
			$saldoNew=$saldo-$totalProd;
			if ($saldoNew <= 0) {
				$saldoNew = 0;
				if ($typeBill == 1) {
					$est = 6;
				}else{
					$est = 8;
				}
			}else{
				if ($typeBill == 1) {
					$est = 7;
				}else{
					$est = 9;
				}
			}

			$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalNew', `dataUpdate`='1', `saldo`='$saldoNew', `return`='1' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM depositaccountdetails";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$current=$dataA['currentAssets'];
			if ($typeBill == 1) {
				$totalDeposit = $current-$totalProd;
			}else{
				$totalDeposit = $current+$totalProd;
			}

			$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);

			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion");
		}else{
			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion=" . $idBillD . "&error=saldo");
		}
	










			
		}elseif($precioTVP!=$precioTotalVPPP AND $typeBill==1){ 

		//SUMAR O RESTAR
		if ($typeBill==1) {
			//VENTA NO LO TENGO ENTONCES SE DEBE SUMAR
			$quantityProductVPPN=$quantityProductVPP+$cantidadVP;
			$totalItemsInventoryVPPN=$totalItemsInventoryVPP+$cantidadVP;
			$totalSalesVPPN=$totalSalesVPP-$cantidadVP;
			$totalItemVPPN=$totalItemVPP+$cantidadVP;
			$sql="UPDATE `irocket`.`products` SET `quantityProduct`='$quantityProductVPPN' WHERE `idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			$sql="UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$totalItemsInventoryVPPN', `totalSales`='$totalSalesVPPN', `totalItem`='$totalItemVPPN' WHERE `products_idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			


		}else{
			//COMPRA LO TENGO ENTONCES SE DEBE RESTAR
			$quantityProductVPPN=$quantityProductVPP-$cantidadVP;
			$totalItemsInventoryVPPN=$totalItemsInventoryVPP-$cantidadVP;
			$totalSalesVPPN=$totalBuyVPP-$cantidadVP;
			$totalItemVPPN=$totalItemVPP-$cantidadVP;
			$sql="UPDATE `irocket`.`products` SET `quantityProduct`='$quantityProductVPPN' WHERE `idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
			$sql="UPDATE `irocket`.`productdetails` SET `totalItemsInventory`='$totalItemsInventoryVPPN', `totalSales`='$totalSalesVPPN', `totalItem`='$totalItemVPPN' WHERE `products_idproducts`='$idprodV'";
			$queryVPP = $this->con->consulta($sql);
		}

		$dateTime = date("Y-m-d");
		if ($estado == 1) {
			$sql = "UPDATE `billdetails` SET `dateUpdate`='$dateTime', `stateBillDetail`='2' WHERE `idbillDetails`='$idBillD'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM billdetails WHERE idbillDetails='$idBillD'";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$id=$dataA['idbillDetails'];
			$totalProd=$dataA['precio_total'];

			$sql2 = "SELECT * FROM billreports WHERE bills_idbills='$idBill'";
			$query2 = $this->con->returnConsulta($sql2);
			$dataA2= mysqli_fetch_array($query2);
			$dataR2= mysqli_num_rows($query2);
			$total=$dataA2['total'];
			$saldo=$dataA2['saldo'];
			$totalNew=$total-$totalProd;
			$saldoNew=$saldo-$totalProd;
			if ($saldoNew <= 0) {
				$saldoNew = 0;
				if ($typeBill == 1) {
					$est = 6;
				}else{
					$est = 8;
				}
			}else{
				if ($typeBill == 1) {
					$est = 7;
				}else{
					$est = 9;
				}
			}

			$sql = "UPDATE `billreports` SET `total`='$totalNew', `saldo`='$saldoNew', `estado`='2' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "UPDATE `irocket`.`movementdepositaccount` SET `totalMoney`='$totalNew', `dataUpdate`='1', `saldo`='$saldoNew', `return`='1' WHERE `bills_idbills`='$idBill'";
			$query = $this->con->consulta($sql);

			$sql = "SELECT * FROM depositaccountdetails";
			$query = $this->con->returnConsulta($sql);
			$dataA= mysqli_fetch_array($query);
			$current=$dataA['currentAssets'];
			if ($typeBill == 1) {
				$totalDeposit = $current-$totalProd;
			}else{
				$totalDeposit = $current+$totalProd;
			}

			$sql = "UPDATE `irocket`.`depositaccountdetails` SET `currentAssets`='$totalDeposit' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);

			header("location:" . URL . "/facturas/detalles?id=" . $idBill . "&devolucion");
		}else{
			
		}
	}
}
		
	}



















	public function balanceBill()
	{
		$idBill = $this->idBill;
		$idUser = $this->idUser;
		$tipo = $this->tipo;
		$balance = $this->balance;

		$sql = "SELECT * FROM bills WHERE idbills='$idBill'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$pago = $dataA['pago'];
		$typeBill = $dataA['typeBill'];
		if ($typeBill==1) {
			$total = $pago+$tipo;
			$totalP = $pago+$balance;
			if ($totalP >= $total) {
				$state = 1;
				$type = 6;
				$totalP = $pago+$tipo;
			}else{
				$state = 2;
				$type = 7;
				$totalP = $pago+$balance;
			}
		}elseif ($typeBill==2) {
			$total = $pago+$tipo;
			$totalP = $pago+$balance;
			if ($totalP >= $total) {
				$state = 1;
				$type = 8;
				$totalP = $pago+$tipo;
			}else{
				$state = 2;
				$type = 9;
				$totalP = $pago+$balance;
			}
		}

		$sql = "UPDATE `bills` SET `pago`='$totalP', `stateBill`='$state' WHERE `idbills`='$idBill'";
		$query = $this->con->consulta($sql);

		$sql = "SELECT * FROM movementdepositaccount WHERE bills_idbills = '$idBill'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$saldo = $dataA['saldo'];
		$saldoNew=$saldo-$balance;

		$dateTime = date("Y-m-d");

		$sql = "UPDATE `movementdepositaccount` SET `totalMoney`='$totalP', `pago`='$totalP', `typeMovement`='$type', `saldo`='$saldoNew', `dataUpdate`='$dateTime' WHERE `bills_idbills`='$idBill'";
		$query = $this->con->consulta($sql);

		$sql = "SELECT * FROM billreports WHERE bills_idbills = '$idBill'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$saldo = $dataA['total'];
		$saldoo = $saldo-$totalP;

		$sql = "UPDATE `billreports` SET `pago`='$totalP', `saldo`='$saldoo' WHERE `bills_idbills`='$idBill'";
		$query = $this->con->consulta($sql);

		$sql = "SELECT * FROM depositaccountdetails WHERE iddepositAccountDetails = '1'";
		$query = $this->con->returnConsulta($sql);
		$dataA = mysqli_fetch_array($query);
		$currentAssets = $dataA['currentAssets'];
		$total = $totalP-$pago;

		if ($typeBill == 1) {
			$totalNew = $total+$currentAssets;
			$sql = "UPDATE `depositaccountdetails` SET `currentAssets`='$totalNew' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);
		}elseif ($typeBill == 2) {
			$totalNew = $currentAssets-$total;
			$sql = "UPDATE `depositaccountdetails` SET `currentAssets`='$totalNew' WHERE `iddepositAccountDetails`='1'";
			$query = $this->con->consulta($sql);
		}

		if ($query) {
			header("location:" . URL . "facturas/detalles?id=" . $idBill . "&detalles&success=deposito");
		}

	}

	public function deleteBill()
	{
		$idBill = $this->idBill;
		$idUser = 66666;
		$tipo = $this->tipo;
		header("location:" . URL . "/facturas/detalles?id=" . $idUser . "&detalles");
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


<?php namespace models;

/**
* 
*/
class Cash
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
		
	}

	public function login()
	{
		$name = $this->usuario;
		$pass = $this->pass;
		$caja = $this->caja;

		if ($name == "") {
			echo "Ingresa un usuario valido";
		}elseif ($pass == "") {
			echo "Ingresa una clave de usuario";
		}elseif ($caja == "") {
			echo "Ingresa una clave de usuario";
		}else{
			$sql = "SELECT * FROM users INNER JOIN userdetails ON idusers=users_idusers WHERE userName='$name' OR documentUser='$name'";
			$query = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($query);
			$array = mysqli_fetch_array($query);
			if ($row >= 1) {
				$permitsBD = $array['range'];
				$userName = $array['userName'];
				$numSesBD = $array['numSes'];
				$passwordBD = $array['password'];
				$idusers = $array['idusers'];
				
				$passwordMD5 = base64_encode($pass);
				if ($permitsBD == 9 OR $permitsBD == 1) {
					if ($passwordBD == $pass OR $passwordBD == $passwordMD5) {
						if ($permitsBD == 9) {
							session_destroy();
							session_start();
							$_SESSION['adminUserNew'] = $idusers;
							$_SESSION['administrador'] = $idusers;
							$_SESSION['cash'] = $caja;
						}elseif ($permitsBD == 1){
							session_destroy();
							session_start();
							$_SESSION['adminUserNew'] = $idusers;
							$_SESSION['cash'] = $caja;
						}
					}else{
   						header("location:" . URL . "login/caja?error=datos");
					}
				}else{
   					header("location:" . URL . "login/caja?error=permisos");
				}
			}else{
 				header("location:" . URL . "login/caja?error=usuario");
			}
		}
		
	}

	public function create()
	{
		$connect = $this->con->connect();
		$name = $this->name;
		$code = $this->code;
		$clave = $this->clave;
		$description = $this->description;
		$deposit = $this->deposit;
		

		$count = count($name);

		for ($i=0; $i < $count; $i++) { 
			

			$deposit = $deposit;
			$name1 = strtolower(mysqli_real_escape_string($connect,$name[$i]));
			$code1 = strtolower(mysqli_real_escape_string($connect,$code[$i]));
			$clave1 = md5(strtolower(mysqli_real_escape_string($connect,$clave[$i])));
			$description1 = strtolower(mysqli_real_escape_string($connect,$description[$i]));
			
		
			$sql = "SELECT * FROM depositaccountdetails WHERE numberAccount='$deposit'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idAD = $array['depositAccount_iddepositAccounts'];
			if ($query) {
				if ($query) {
					$sql = "INSERT INTO `cash` (`users_idusers`, `depositAccount_iddepositAccounts`, `codeCash`, `passCash`) VALUES ('1', '1', '$code1', '$clave1')";
					$query = $this->con->consulta($sql);
					if ($query) {
						$sql = "SELECT * FROM cash ORDER BY idcash desc";
						$query = $this->con->returnConsulta($sql);
						$array = mysqli_fetch_array($query);
						$idcash = $array['idcash'];
						if ($query) {
							$sql = "INSERT INTO `cashdetails` (`cash_idcash`, `totalBillBuy`, `totalBillSale`, `totalInput`, `totalOutput`, `totalItemsBuy`, `totalItemsSale`, `nameCash`, `descriptionCash`) VALUES ('$idcash', '0', '0', '0', '0', '0', '0', '$name1', '$description1')";
							$query = $this->con->consulta($sql);
							if ($query) {
								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Felicitaciones ! has ingresado una nueva caja registradora, desde aqui podras realizar compra y venta de productos.";
								$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `cash_idcash`) VALUES ('', '10', '$mensaje', '$datetimeNot', '$idcash')";
								$query = $this->con->consulta($sql);
							}else{
								echo "Err5";
							}
						}else{
							echo "Err4";
						}
					}else{
						echo "Err3";
					}
				}else{
					echo "Err2";
				}
			}else{
				echo "Err1";
			}
		}	
	}

	public function delete()
	{

	}

	public function update()
	{
	
	}

	public function list()
	{
		$sql = "SELECT * FROM irocket.cash";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function array()
	{
		$sql = "SELECT * FROM cash INNER JOIN cashdetails ON idcash=cash_idcash";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

}


<?php namespace models;

/**
* 
*/
class Cash
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
		
	}

	public function login()
	{
		$name = $this->usuario;
		$pass = $this->pass;
		$caja = $this->caja;

		if ($name == "") {
			echo "Ingresa un usuario valido";
		}elseif ($pass == "") {
			echo "Ingresa una clave de usuario";
		}elseif ($caja == "") {
			echo "Ingresa una clave de usuario";
		}else{
			$sql = "SELECT * FROM users INNER JOIN userdetails ON idusers=users_idusers WHERE userName='$name' OR documentUser='$name'";
			$query = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($query);
			$array = mysqli_fetch_array($query);
			if ($row >= 1) {
				$permitsBD = $array['range'];
				$userName = $array['userName'];
				$numSesBD = $array['numSes'];
				$passwordBD = $array['password'];
				$idusers = $array['idusers'];
				
				$passwordMD5 = base64_encode($pass);
				if ($permitsBD == 9 OR $permitsBD == 1) {
					if ($passwordBD == $pass OR $passwordBD == $passwordMD5) {
						if ($permitsBD == 9) {
							session_destroy();
							session_start();
							$_SESSION['adminUserNew'] = $idusers;
							$_SESSION['administrador'] = $idusers;
							$_SESSION['cash'] = $caja;
						}elseif ($permitsBD == 1){
							session_destroy();
							session_start();
							$_SESSION['adminUserNew'] = $idusers;
							$_SESSION['cash'] = $caja;
						}
					}else{
   						header("location:" . URL . "login/caja?error=datos");
					}
				}else{
   					header("location:" . URL . "login/caja?error=permisos");
				}
			}else{
 				header("location:" . URL . "login/caja?error=usuario");
			}
		}
		
	}

	public function create()
	{
		$connect = $this->con->connect();
		$name = $this->name;
		$code = $this->code;
		$clave = $this->clave;
		$description = $this->description;
		$deposit = $this->deposit;
		

		$count = count($name);

		for ($i=0; $i < $count; $i++) { 
			

			$deposit = $deposit;
			$name1 = strtolower(mysqli_real_escape_string($connect,$name[$i]));
			$code1 = strtolower(mysqli_real_escape_string($connect,$code[$i]));
			$clave1 = md5(strtolower(mysqli_real_escape_string($connect,$clave[$i])));
			$description1 = strtolower(mysqli_real_escape_string($connect,$description[$i]));
			
		
			$sql = "SELECT * FROM depositaccountdetails WHERE numberAccount='$deposit'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idAD = $array['depositAccount_iddepositAccounts'];
			if ($query) {
				if ($query) {
					$sql = "INSERT INTO `cash` (`users_idusers`, `depositAccount_iddepositAccounts`, `codeCash`, `passCash`) VALUES ('1', '1', '$code1', '$clave1')";
					$query = $this->con->consulta($sql);
					if ($query) {
						$sql = "SELECT * FROM cash ORDER BY idcash desc";
						$query = $this->con->returnConsulta($sql);
						$array = mysqli_fetch_array($query);
						$idcash = $array['idcash'];
						if ($query) {
							$sql = "INSERT INTO `cashdetails` (`cash_idcash`, `totalBillBuy`, `totalBillSale`, `totalInput`, `totalOutput`, `totalItemsBuy`, `totalItemsSale`, `nameCash`, `descriptionCash`) VALUES ('$idcash', '0', '0', '0', '0', '0', '0', '$name1', '$description1')";
							$query = $this->con->consulta($sql);
							if ($query) {
								$datetimeNot = 	date("Y-m-d G:i:s A");
								$mensaje = "Felicitaciones ! has ingresado una nueva caja registradora, desde aqui podras realizar compra y venta de productos.";
								$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `cash_idcash`) VALUES ('', '10', '$mensaje', '$datetimeNot', '$idcash')";
								$query = $this->con->consulta($sql);
							}else{
								echo "Err5";
							}
						}else{
							echo "Err4";
						}
					}else{
						echo "Err3";
					}
				}else{
					echo "Err2";
				}
			}else{
				echo "Err1";
			}
		}	
	}

	public function delete()
	{

	}

	public function update()
	{
	
	}

	public function list()
	{
		$sql = "SELECT * FROM irocket.cash";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function array()
	{
		$sql = "SELECT * FROM cash INNER JOIN cashdetails ON idcash=cash_idcash";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

}


<?php namespace models;

/**
* 
*/
class Clients
{
	private $idcompany;
	private $idUser;
	private $username;
	private $pass;
	private $nameUser;
	private $lastnameUser;
	private $documentUser;
	private $companyUser;
	private $age;
	private $phone;
	private $email;
	private $description;
	private $photo_tmp_name;
	private $photo_name;
	private $photo_size;
	private $photo_type;

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
		$sql = "SELECT * FROM users 
		INNER JOIN userdetails 
		ON users.idusers=userdetails.users_idusers
		WHERE idusers='$iduser'";
		$query = $this->con->returnConsulta($sql);
		if ($query) {
			return $query;
		}else{
			echo "asd";
		}
	}

	public function array()
	{
		$sql = "SELECT * FROM users 
		INNER JOIN userdetails 
		ON users.idusers=userdetails.users_idusers
		WHERE userdetails.range = 2
		AND users.stateBD = 1
		ORDER BY users.idusers desc";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function create()
	{
		$connect = $this->con->connect();
		$photo_size = $this->photo_size;
		$photo_tmp_name = $this->photo_tmp_name;
		$photo_name = $this->photo_name;
		$photo_type = $this->photo_type;
		$idcompany = $this->idcompany;
		$idUser = $this->idUser;
		$nameUser = $this->nameUser;
		$lastnameUser = $this->lastnameUser;
		$documentUser = $this->documentUser;
		$companyUser = $this->companyUser;
		$age = $this->age;
		$phone = $this->phone;
		$email = $this->email;
		$description = $this->description;

		$count = count($nameUser);

		for ($i=0; $i < $count; $i++) { 
			$idcompany = $idcompany;
			$idUser1 = strtolower(mysqli_real_escape_string($connect,$idUser[$i]));
			$nameUser1 = strtolower(mysqli_real_escape_string($connect,$nameUser[$i]));
			$lastnameUser1 = strtolower(mysqli_real_escape_string($connect,$lastnameUser[$i]));
			$documentUser1 = strtolower(mysqli_real_escape_string($connect,$documentUser[$i]));
			$companyUser1 = strtolower(mysqli_real_escape_string($connect,$companyUser[$i]));
			$age1 = strtolower(mysqli_real_escape_string($connect,$age[$i]));
			$phone1 = strtolower(mysqli_real_escape_string($connect,$phone[$i]));
			$email1 = strtolower(mysqli_real_escape_string($connect,$email[$i]));
			$description = strtolower(mysqli_real_escape_string($connect,$description[$i]));
		
			$sql = "SELECT * FROM company WHERE nameCompany='$idcompany'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idComp = $array['idcompany'];
			if ($query) {
				$sql = "INSERT INTO `users` (`company_idcompany`, `userName`, `password`, `stateBD`) VALUES ('$idComp', '$nameUser1', '$documentUser1', '1')";
				$query = $this->con->consulta($sql);
				if ($query) {
					$ruta = 'views/assets/images/users/' . date('h-m.s') . $photo_name[$i];
					$dir_subida = 'views/assets/images/users/' . date('h-m.s');
					$fichero_subido = $dir_subida . basename($photo_name[$i]);
					if (move_uploaded_file($photo_tmp_name[$i], $fichero_subido)) {
							$sql = "SELECT * FROM users ORDER BY idusers DESC";
							$query = $this->con->returnConsulta($sql);
							$array = mysqli_fetch_array($query);
							$idus = $array['idusers'];
						if ($query) {
							$dateTime = date("Y-m-d");
							$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `range`, `jobTitle`, `company`, `phone`, `email`, `ruta`, `description`) VALUES ('$idus', '$nameUser1', '$lastnameUser1', '$documentUser1', '', '$age1', '$dateTime', '2', 'cliente', '$companyUser1', '$phone1', '$email1', '$ruta', '$description')";
							$query = $this->con->consulta($sql);
								if ($query) {
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado el cliente " . $nameUser1 . " " . $lastnameUser1 . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '23', '$mensaje', '$datetimeNot', '$idus')";
									$query = $this->con->consulta($sql);
									if ($query) {
										header("location:" . URL . "clientes/crear?success");

									}else{
										echo "Error en la notificacion";
									}
								}else{
									echo "Error al ejecutar la segunda consulta";
								}
						}
					}else{
							$ruta = 'views/assets/images/users/default_client.png';
							$sql = "SELECT * FROM users ORDER BY idusers DESC";
							$query = $this->con->returnConsulta($sql);
							$array = mysqli_fetch_array($query);
							$idus = $array['idusers'];
						if ($query) {
							$dateTime = date("Y-m-d");
							$sql = "INSERT INTO `userdetails` (`users_idusers`, `nameUser`, `lastnameUser`, `documentUser`, `genere`, `age`, `data_register`, `range`, `jobTitle`, `company`, `phone`, `email`, `ruta`, `description`) VALUES ('$idus', '$nameUser1', '$lastnameUser1', '$documentUser1', '', '$age1', '$dateTime', '2', 'cliente', '$companyUser1', '$phone1', '$email1', '$ruta', '$description')";
							$query = $this->con->consulta($sql);
								if ($query) {
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado el cliente " . $nameUser1 . " " . $lastnameUser1 . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '23', '$mensaje', '$datetimeNot', '$idus')";
									$query = $this->con->consulta($sql);
									if ($query) {
										header("location:" . URL . "clientes/crear?success");
									}else{
										echo "Error en la notificacion";
									}
								}else{
									echo "Error al ejecutar la segunda consulta";
								}
						}
					}
				}
			}else{
				echo "Error al ejecutar la primera consulta";
			}
		}	
	}




	public function delete()
	{
		$connect = $this->con->connect();
		$idUser = strtolower(mysqli_real_escape_string($connect,$this->idUser));
		$sql = "UPDATE `users` SET `stateBD`='0' WHERE `idusers`='$idUser'";
		$query = $this->con->consulta($sql);
		if ($query) {
			$datetimeNot = 	date("Y-m-d G:i:s A");
			$mensaje = "Se ha eliminado un cliente ya no tendras acceso a el.";
			$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '21', '$mensaje', '$datetimeNot', '$idUser')";
			$query = $this->con->consulta($sql);
			if ($query) {
				header("location:" . URL . "clientes?success_delete");
			}else{
				echo "Error en la notificacion";
			}
		}else{
			echo "Error al eliminar el usuario de la base de datos";
		}

	}

	public function update()
	{
		$connect = $this->con->connect();
		$photo_size = $this->photo_size;
		$photo_tmp_name = $this->photo_tmp_name;
		$photo_name = $this->photo_name;
		$photo_type = $this->photo_type;
		$idcompany = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$idUser = strtolower(mysqli_real_escape_string($connect,$this->idUser));
		$username = strtolower(mysqli_real_escape_string($connect,$this->username));
		$pass = strtolower(mysqli_real_escape_string($connect,$this->pass));
		$nameUser = strtolower(mysqli_real_escape_string($connect,$this->nameUser));
		$lastnameUser = strtolower(mysqli_real_escape_string($connect,$this->lastnameUser));
		$documentUser = strtolower(mysqli_real_escape_string($connect,$this->documentUser));
		$companyUser = strtolower(mysqli_real_escape_string($connect,$this->companyUser));
		$age = strtolower(mysqli_real_escape_string($connect,$this->age));
		$phone = strtolower(mysqli_real_escape_string($connect,$this->phone));
		$email = strtolower(mysqli_real_escape_string($connect,$this->email));
		$description = strtolower(mysqli_real_escape_string($connect,$this->description));
		$dateTime = date("Y-m-d");
		if ($photo_size == 0) {
			$sql = "SELECT * FROM company WHERE nameCompany='$idcompany'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idcompany = $array['idcompany'];
			if ($query) {
				$sql = "UPDATE `users` SET `userName`='$username', `password`='$pass' WHERE `idusers`='$idUser'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$sql = "UPDATE `userdetails` SET `nameUser`='$nameUser', `lastnameUser`='$lastnameUser', `documentUser`='$documentUser', `age`='$age', `data_update`='$dateTime', `phone`='$phone', `email`='$email', `description`='$description', `company`='$companyUser' WHERE `iduserDetails`='$idUser'";
					$query = $this->con->consulta($sql);
					if ($query) {
						$datetimeNot = 	date("Y-m-d G:i:s A");
						$mensaje = "Se ha editado un cliente puedes ver el resultado en la lista.";
						$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '22', '$mensaje', '$datetimeNot', '$idUser')";
						$query = $this->con->consulta($sql);
						if ($query) {
							header("location:" . URL . "clientes?success_update");
						}else{
							echo "Error en la notificacion";
						}
					}else{
						echo "ERROR AL EJECUTAR LA SEGUNDA CONSULTA";
					}
				}else{
					echo "ERROR AL EJECUTAR LA PRIMER CONSULTA";
				}
			}else{
				echo "ERROR AL SELECCIONAR LA EMPRESA";
			}
		}else{
			$ruta = 'views/assets/images/users/' . date('h-m.s') . $photo_name;
			$dir_subida = 'views/assets/images/users/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($photo_name);
			if (move_uploaded_file($photo_tmp_name, $fichero_subido)) {
				$sql = "SELECT * FROM company WHERE nameCompany='$idcompany'";
			$query = $this->con->returnConsulta($sql);
			$array = mysqli_fetch_array($query);
			$idcompany = $array['idcompany'];
			if ($query) {
				$sql = "UPDATE `users` SET `userName`='$username', `password`='$pass' WHERE `idusers`='$idUser'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$sql = "UPDATE `userdetails` SET `nameUser`='$nameUser', `lastnameUser`='$lastnameUser', `documentUser`='$documentUser', `age`='$age', `data_update`='$dateTime', `phone`='$phone', `email`='$email', `description`='$description', `ruta`='$ruta', `company`='$companyUser' WHERE `iduserDetails`='$idUser'";
					$query = $this->con->consulta($sql);
					if ($query) {
						$datetimeNot = 	date("Y-m-d G:i:s A");
						$mensaje = "Se ha editado un producto puedes ver el resultado en la lista.";
						$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `users_idusers`) VALUES ('', '22', '$mensaje', '$datetimeNot', '$idUser')";
						$query = $this->con->consulta($sql);
						if ($query) {
							header("location:" . URL . "clientes?success_update");
						}else{
							echo "Error en la notificacion";
						}
					}else{
						echo "ERROR AL EJECUTAR LA SEGUNDA CONSULTA";
					}
				}else{
					echo "ERROR AL EJECUTAR LA PRIMER CONSULTA";
				}
			}else{
				echo "ERROR AL SELECCIONAR LA EMPRESA";
			}
			}else{
				echo "string";
			}
		}
	}

}


<?php namespace models;

/**
* 
*/
class Company
{

	private $idcompany;
	private $companyName;
	private $companyNit;
	private $companyDirection;
	private $companyCity;
	private $companyPhone;
	private $companyEmail;
	private $companyLogoNameTemp;
	private $companyLogoName;
	private $companyLogoSize;
	private $companyLogoType;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}

	public function array()
	{
		$sql = "SELECT * FROM company";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dataCompany()
	{
		$sql = "SELECT * FROM company INNER JOIN companydetails";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function view()
	{
		$connect = $this->con->connect();
		$idcompany = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$sql = "SELECT * FROM company INNER JOIN companydetails ON company.idcompany = companydetails.company_idcompany WHERE idcompany = '$idcompany'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}



	public function create()
	{
		$connect = $this->con->connect();
		$companyName = strtolower(mysqli_real_escape_string($connect,$this->companyName));
		$companyNit = strtolower(mysqli_real_escape_string($connect,$this->companyNit));
		$companyDirection = strtolower(mysqli_real_escape_string($connect,$this->companyDirection));
		$companyCity = strtolower(mysqli_real_escape_string($connect,$this->companyCity));
		$companyPhone = strtolower(mysqli_real_escape_string($connect,$this->companyPhone));
		$companyEmail = strtolower(mysqli_real_escape_string($connect,$this->companyEmail));
		$companyLogoNameTemp = strtolower(mysqli_real_escape_string($connect,$this->companyLogoNameTemp));
		$companyLogoName = strtolower(mysqli_real_escape_string($connect,$this->companyLogoName));
		$companyLogoSize = mysqli_real_escape_string($connect,$this->companyLogoSize);
		$companyLogoType = mysqli_real_escape_string($connect,$this->companyLogoType);
		$dateTime = date("Y-m-d");

		$sql = "SELECT * FROM userdetails WHERE userdetails.range = 9";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);
		
		

		if ($companyName != '') {
			$sql = "SELECT * FROM company";
			$datos = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($datos);
			if ($row == 0) {
				$i = 0;
				$datetime = date("Y-m-d");
				$sql = "INSERT INTO `inventory` (`codeInventory`, `stateBD`) VALUES ('007', '9')";
				$query = $this->con->Consulta($sql);
				$sql = "INSERT INTO `inventorydetails` (`inventory_idinventory`, `nameInventory`, `date_register`, `user_create`, `descriptionInventory`, `totalProducts`, `totalItems`) VALUES ('1', 'secretX', '$datetime', '1', 'x', '9', '')";
				$query = $this->con->Consulta($sql);
				while ($i < 9) {
					$i++;
					$sql = "INSERT INTO `products` (`codeProduct`, `codeProduct_promotion`, `precio`, `precio_promotion`, `quantityProduct`, `stateBD`, `price_buy_prom`, `price_buy`, `inventory_idinventory`) VALUES ('$i', '$i', '0', '0', '9999999999', '9', '0', '0', '1')";
					$query = $this->con->Consulta($sql);
					$sql = "INSERT INTO `productdetails` (`products_idproducts`, `nameProduct`, `min_limit_items`, `date_register`) VALUES ('$i', 'producto1', '1', '$datetime')";
					$query = $this->con->Consulta($sql);
				}

				$sql = "INSERT INTO `company` (`nameCompany`) VALUES ('$companyName')";
				$insert = $this->con->Consulta($sql);
				if ($insert == 1) {
					//echo $companyLogoNameTemp . "a <br>" ;
					//echo $companyLogoName . "<br>" ;
					//echo $companyLogoSize . "b <br>" ;
					//echo $companyLogoType . "c <br>" ;
					$sql = "SELECT * FROM company WHERE namecompany = '$companyName'";
					$datos = $this->con->returnConsulta($sql);
					$array = mysqli_fetch_array($datos);
					$idcompany = $array['idcompany'];

					if ($companyLogoSize == 0) {
						//echo $idcompany;
						//$ss = $array['namecompany'];
						$ruta = "views/assets/images/company/default.png";
						$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
						$datos2 = $this->con->consulta($sql2);
						if ($datos2 == 1) {
								
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);


						}else{
							echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
						}

					}else{
						$companyLogoInsert = addslashes(file_get_contents($this->companyLogoNameTemp));
						if ($companyLogoSize >= 2000000) {
							$dir_subida = 'views/assets/images/company/' . date('h-m.s');
							$ruta = 'views/assets/images/company/' . date('h-m.s') . $_FILES['companyLogo']['name'];
							$fichero_subido = $dir_subida . basename($_FILES['companyLogo']['name']);
							if (move_uploaded_file($_FILES['companyLogo']['tmp_name'], $fichero_subido)) {
							   	echo "El fichero es válido y se subió con éxito.\n";
								$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
								$datos2 = $this->con->consulta($sql2);
								if ($datos2 == 1) {
									
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);


								}else{
									echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
								}
							} else {
								echo "¡Posible ataque de subida de ficheros!\n";
							}
						}else{
							
							$dir_subida = 'views/assets/images/company/' . date('h-m.s');
							$ruta = 'views/assets/images/company/' . date('h-m.s') . $_FILES['companyLogo']['name'];
							$fichero_subido = $dir_subida . basename($_FILES['companyLogo']['name']);
							if (move_uploaded_file($_FILES['companyLogo']['tmp_name'], $fichero_subido)) {
								echo "El fichero es válido y se subió con éxito.\n";
								$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
								$datos2 = $this->con->consulta($sql2);
								if ($datos2 == 1) {
									
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);

								}else{
									echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
								}
							} else {
								echo "¡Posible ataque de subida de ficheros!\n";
							}
						}
					}
				}else{
					echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
				}
			}else{
				echo "Lo sentimos ya existe una empresa en nuestra base de Datos, si quieres ampliar tu plan <a href=''>Ponte en contacto</a> <a href='" . URL . "'>Inicia sesion</a>";
			}

		}else{
			echo "Nombre de empresa no ingresado";
		}
	}

	
	public function list()
	{
		$sql = "SELECT * FROM company";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function update()
	{
		$connect = $this->con->connect();
		$idUpdate = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$companyName = strtolower(mysqli_real_escape_string($connect,$this->companyName));
		$companyNit = strtolower(mysqli_real_escape_string($connect,$this->companyNit));
		$companyDirection = strtolower(mysqli_real_escape_string($connect,$this->companyDirection));
		$companyCity = strtolower(mysqli_real_escape_string($connect,$this->companyCity));
		$companyPhone = strtolower(mysqli_real_escape_string($connect,$this->companyPhone));
		$companyEmail = strtolower(mysqli_real_escape_string($connect,$this->companyEmail));
		$companyLogoNameTemp = $this->companyLogoNameTemp;
		$companyLogoName = $this->companyLogoName;
		$companyLogoSize = $this->companyLogoSize;
		$companyLogoType = $this->companyLogoType;
		$dateTime = date("Y-m-d");
		if ($companyLogoSize == 0) {
			$sql = "UPDATE `company` SET `nameCompany`='$companyName' WHERE `idcompany`='$idUpdate'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `companydetails` SET `nitCompany`='$companyNit', `directionCompany`='$companyDirection', `cityCompany`='$companyCity', `phoneCompany`='$companyPhone', `emailCompany`='$companyEmail', `data_update`='$dateTime' WHERE `idcompanyDetails`='$idUpdate'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$idUpdate = $this->idcompany;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado los datos empresariales con exito.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '16', '$mensaje', '$datetimeNot', '$idUpdate')";
					$query = $this->con->consulta($sql);
					header("location:" . URL . "empresa/detalles?id=" . $idUpdate . "&configurar&success_update");
				}else{
					echo "Error al ejecutar la segunda consulta";
				}
			}else{
				echo "Error al ejecutar la primer consulta";
			}
		}else{
			$ruta = 'views/assets/images/company/' . date('h-m.s') . $companyLogoName;
			$dir_subida = 'views/assets/images/company/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($companyLogoName);
			if (move_uploaded_file($companyLogoNameTemp, $fichero_subido)){
				$sql = "UPDATE `company` SET `nameCompany`='$companyName' WHERE `idcompany`='$idUpdate'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `companydetails` SET `nitCompany`='$companyNit',`rutaLogoCompany`='$ruta', `directionCompany`='$companyDirection', `cityCompany`='$companyCity', `phoneCompany`='$companyPhone', `emailCompany`='$companyEmail', `data_update`='$dateTime' WHERE `idcompanyDetails`='$idUpdate'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$idUpdate = $this->idcompany;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado los datos empresariales con exito.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '16', '$mensaje', '$datetimeNot', '$idUpdate')";
					$query = $this->con->consulta($sql);
					header("location:" . URL . "empresa/detalles?id=" . $idUpdate . "&configurar&success_update");
				}else{
					echo "Error al ejecutar la segunda consulta";
				}
			}else{
				echo "Error al ejecutar la primer consulta";
			}
			}else{
				echo $companyLogoName;
			}
		}
	}
	public function delete()
	{
		# code...
	}
}

<?php namespace models;

/**
* 
*/
class Company
{

	private $idcompany;
	private $companyName;
	private $companyNit;
	private $companyDirection;
	private $companyCity;
	private $companyPhone;
	private $companyEmail;
	private $companyLogoNameTemp;
	private $companyLogoName;
	private $companyLogoSize;
	private $companyLogoType;

	function __construct(){
		$this->con = new Conexion;
	}

	public function set($atributo, $parametro){
		$this->$atributo = $parametro;
	}

	public function get($atributo){
		return $this-$atributo;
	}

	public function array()
	{
		$sql = "SELECT * FROM company";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function dataCompany()
	{
		$sql = "SELECT * FROM company INNER JOIN companydetails";
		$datos = $this->con->returnConsulta($sql);
		return $datos;
	}

	public function view()
	{
		$connect = $this->con->connect();
		$idcompany = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$sql = "SELECT * FROM company INNER JOIN companydetails ON company.idcompany = companydetails.company_idcompany WHERE idcompany = '$idcompany'";
		$query = $this->con->returnConsulta($sql);
		return $query;
	}



	public function create()
	{
		$connect = $this->con->connect();
		$companyName = strtolower(mysqli_real_escape_string($connect,$this->companyName));
		$companyNit = strtolower(mysqli_real_escape_string($connect,$this->companyNit));
		$companyDirection = strtolower(mysqli_real_escape_string($connect,$this->companyDirection));
		$companyCity = strtolower(mysqli_real_escape_string($connect,$this->companyCity));
		$companyPhone = strtolower(mysqli_real_escape_string($connect,$this->companyPhone));
		$companyEmail = strtolower(mysqli_real_escape_string($connect,$this->companyEmail));
		$companyLogoNameTemp = strtolower(mysqli_real_escape_string($connect,$this->companyLogoNameTemp));
		$companyLogoName = strtolower(mysqli_real_escape_string($connect,$this->companyLogoName));
		$companyLogoSize = mysqli_real_escape_string($connect,$this->companyLogoSize);
		$companyLogoType = mysqli_real_escape_string($connect,$this->companyLogoType);
		$dateTime = date("Y-m-d");

		$sql = "SELECT * FROM userdetails WHERE userdetails.range = 9";
		$query = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($query);
		$array = mysqli_fetch_array($query);
		
		

		if ($companyName != '') {
			$sql = "SELECT * FROM company";
			$datos = $this->con->returnConsulta($sql);
			$row = mysqli_num_rows($datos);
			if ($row == 0) {
				$i = 0;
				$datetime = date("Y-m-d");
				$sql = "INSERT INTO `inventory` (`codeInventory`, `stateBD`) VALUES ('007', '9')";
				$query = $this->con->Consulta($sql);
				$sql = "INSERT INTO `inventorydetails` (`inventory_idinventory`, `nameInventory`, `date_register`, `user_create`, `descriptionInventory`, `totalProducts`, `totalItems`) VALUES ('1', 'secretX', '$datetime', '1', 'x', '9', '')";
				$query = $this->con->Consulta($sql);
				while ($i < 9) {
					$i++;
					$sql = "INSERT INTO `products` (`codeProduct`, `codeProduct_promotion`, `precio`, `precio_promotion`, `quantityProduct`, `stateBD`, `price_buy_prom`, `price_buy`, `inventory_idinventory`) VALUES ('$i', '$i', '0', '0', '9999999999', '9', '0', '0', '1')";
					$query = $this->con->Consulta($sql);
					$sql = "INSERT INTO `productdetails` (`products_idproducts`, `nameProduct`, `min_limit_items`, `date_register`) VALUES ('$i', 'producto1', '1', '$datetime')";
					$query = $this->con->Consulta($sql);
				}

				$sql = "INSERT INTO `company` (`nameCompany`) VALUES ('$companyName')";
				$insert = $this->con->Consulta($sql);
				if ($insert == 1) {
					//echo $companyLogoNameTemp . "a <br>" ;
					//echo $companyLogoName . "<br>" ;
					//echo $companyLogoSize . "b <br>" ;
					//echo $companyLogoType . "c <br>" ;
					$sql = "SELECT * FROM company WHERE namecompany = '$companyName'";
					$datos = $this->con->returnConsulta($sql);
					$array = mysqli_fetch_array($datos);
					$idcompany = $array['idcompany'];

					if ($companyLogoSize == 0) {
						//echo $idcompany;
						//$ss = $array['namecompany'];
						$ruta = "views/assets/images/company/default.png";
						$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
						$datos2 = $this->con->consulta($sql2);
						if ($datos2 == 1) {
								
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);


						}else{
							echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
						}

					}else{
						$companyLogoInsert = addslashes(file_get_contents($this->companyLogoNameTemp));
						if ($companyLogoSize >= 2000000) {
							$dir_subida = 'views/assets/images/company/' . date('h-m.s');
							$ruta = 'views/assets/images/company/' . date('h-m.s') . $_FILES['companyLogo']['name'];
							$fichero_subido = $dir_subida . basename($_FILES['companyLogo']['name']);
							if (move_uploaded_file($_FILES['companyLogo']['tmp_name'], $fichero_subido)) {
							   	echo "El fichero es válido y se subió con éxito.\n";
								$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
								$datos2 = $this->con->consulta($sql2);
								if ($datos2 == 1) {
									
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);


								}else{
									echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
								}
							} else {
								echo "¡Posible ataque de subida de ficheros!\n";
							}
						}else{
							
							$dir_subida = 'views/assets/images/company/' . date('h-m.s');
							$ruta = 'views/assets/images/company/' . date('h-m.s') . $_FILES['companyLogo']['name'];
							$fichero_subido = $dir_subida . basename($_FILES['companyLogo']['name']);
							if (move_uploaded_file($_FILES['companyLogo']['tmp_name'], $fichero_subido)) {
								echo "El fichero es válido y se subió con éxito.\n";
								$sql2 = "INSERT INTO `companydetails` (`company_idcompany`, `nitCompany`, `directionCompany`, `cityCompany`, `phoneCompany`, `emailCompany`, `rutaLogoCompany`, `data_register`) VALUES ('$idcompany', '$companyNit', '$companyDirection', '$companyCity', '$companyPhone', '$companyEmail', '$ruta', '$dateTime')";
								$datos2 = $this->con->consulta($sql2);
								if ($datos2 == 1) {
									
									$datetimeNot = 	date("Y-m-d G:i:s A");
									$mensaje = "Felicitaciones ! has registrado la empresa " . $companyName . " exitosamente.";
									$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '7', '$mensaje', '$datetimeNot', '$idcompany')";
									$query = $this->con->consulta($sql);

								}else{
									echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
								}
							} else {
								echo "¡Posible ataque de subida de ficheros!\n";
							}
						}
					}
				}else{
					echo "Lo sentimos, ah ocurrido un problema al insertar el nombre de tu empresa en la base de datos, por favor vuelva a intentar si el problema persiste por favor contacte con el Soporte tecnico.";
				}
			}else{
				echo "Lo sentimos ya existe una empresa en nuestra base de Datos, si quieres ampliar tu plan <a href=''>Ponte en contacto</a> <a href='" . URL . "'>Inicia sesion</a>";
			}

		}else{
			echo "Nombre de empresa no ingresado";
		}
	}

	
	public function list()
	{
		$sql = "SELECT * FROM company";
		$datos = $this->con->returnConsulta($sql);
		$row = mysqli_num_rows($datos);
		return $row;
	}

	public function update()
	{
		$connect = $this->con->connect();
		$idUpdate = strtolower(mysqli_real_escape_string($connect,$this->idcompany));
		$companyName = strtolower(mysqli_real_escape_string($connect,$this->companyName));
		$companyNit = strtolower(mysqli_real_escape_string($connect,$this->companyNit));
		$companyDirection = strtolower(mysqli_real_escape_string($connect,$this->companyDirection));
		$companyCity = strtolower(mysqli_real_escape_string($connect,$this->companyCity));
		$companyPhone = strtolower(mysqli_real_escape_string($connect,$this->companyPhone));
		$companyEmail = strtolower(mysqli_real_escape_string($connect,$this->companyEmail));
		$companyLogoNameTemp = $this->companyLogoNameTemp;
		$companyLogoName = $this->companyLogoName;
		$companyLogoSize = $this->companyLogoSize;
		$companyLogoType = $this->companyLogoType;
		$dateTime = date("Y-m-d");
		if ($companyLogoSize == 0) {
			$sql = "UPDATE `company` SET `nameCompany`='$companyName' WHERE `idcompany`='$idUpdate'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `companydetails` SET `nitCompany`='$companyNit', `directionCompany`='$companyDirection', `cityCompany`='$companyCity', `phoneCompany`='$companyPhone', `emailCompany`='$companyEmail', `data_update`='$dateTime' WHERE `idcompanyDetails`='$idUpdate'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$idUpdate = $this->idcompany;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado los datos empresariales con exito.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '16', '$mensaje', '$datetimeNot', '$idUpdate')";
					$query = $this->con->consulta($sql);
					header("location:" . URL . "empresa/detalles?id=" . $idUpdate . "&configurar&success_update");
				}else{
					echo "Error al ejecutar la segunda consulta";
				}
			}else{
				echo "Error al ejecutar la primer consulta";
			}
		}else{
			$ruta = 'views/assets/images/company/' . date('h-m.s') . $companyLogoName;
			$dir_subida = 'views/assets/images/company/' . date('h-m.s');
			$fichero_subido = $dir_subida . basename($companyLogoName);
			if (move_uploaded_file($companyLogoNameTemp, $fichero_subido)){
				$sql = "UPDATE `company` SET `nameCompany`='$companyName' WHERE `idcompany`='$idUpdate'";
			$query = $this->con->consulta($sql);
			if ($query) {
				$sql = "UPDATE `companydetails` SET `nitCompany`='$companyNit',`rutaLogoCompany`='$ruta', `directionCompany`='$companyDirection', `cityCompany`='$companyCity', `phoneCompany`='$companyPhone', `emailCompany`='$companyEmail', `data_update`='$dateTime' WHERE `idcompanyDetails`='$idUpdate'";
				$query = $this->con->consulta($sql);
				if ($query) {
					$idUpdate = $this->idcompany;
					$datetimeNot = 	date("Y-m-d G:i:s A");
					$mensaje = "Se ha editado los datos empresariales con exito.";
					$sql = "INSERT INTO `notifications` (`idnotifications`, `typeNotification`, `message`, `date_register`, `company_idcompany`) VALUES ('', '16', '$mensaje', '$datetimeNot', '$idUpdate')";
					$query = $this->con->consulta($sql);
					header("location:" . URL . "empresa/detalles?id=" . $idUpdate . "&configurar&success_update");
				}else{
					echo "Error al ejecutar la segunda consulta";
				}
			}else{
				echo "Error al ejecutar la primer consulta";
			}
			}else{
				echo $companyLogoName;
			}
		}
	}
	public function delete()
	{
		# code...
	}
}
