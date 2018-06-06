<?php 
date_default_timezone_set('America/Bogota');

session_start();
if (isset($_SESSION['adminUserNew'])) {
	$user = $_SESSION['adminUserNew'];
}elseif (isset($_SESSION['UserNew'])) {
	$user = $_SESSION['UserNew'];
}
if (isset($_SESSION['cash'])) {
	$caja = $_SESSION['cash'];
	$sql = $con->query("SELECT * FROM cashdetails WHERE nameCash='$caja'");
	$array = mysqli_fetch_array($sql);
	$cash = $array['cash_idcash'];
}
if(!empty($_POST)){
	if (isset($_POST['codigocliente'])) {
		$clienteDocumento = $_POST['codigocliente'];
		$sql = $con->query("SELECT * FROM userdetails WHERE documentUser='$clienteDocumento'");
		$array = mysqli_fetch_array($sql);
		if ($array['range'] == 2) {
			$cliente = $array['users_idusers'];
		}else{
			$cliente = $_POST['codigocliente'];
		}
	}

$codeBar = date('s') . rand(0,1000) . date('d');
$sql = $con->query("SELECT * FROM bills WHERE codeBar='$codeBar'");
$array = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);
$typeBill = $_POST['typeBill'];
$pago = $_POST['pagoForm'];
$total = 0;
foreach($_SESSION["cart"] as $b){
	$total += $b['q'] * $b['pu']; 	 	
}
$total;
if ($total<=$pago) {
	$stateBill = 1;
}else{
	$stateBill = 2;
}
$dateTime = date("Y-m-d");

if ($row == 0) {

	$q1 = $con->query("insert into bills(users_idusers,cash_idcash,cliente,fecha,codeBar,typeBill,dateRegister,pago,stateBill) value($user,$cash,'$cliente',NOW(),'$codeBar',$typeBill,NOW(),$pago,$stateBill)");
	

	
}else{
	$q1 = $con->query("insert into bills(users_idusers,cash_idcash,cliente,fecha,codeBar,dateRegister,pago,stateBill) value($user,$cash,'$cliente',NOW(),'',$typeBill,NOW(),$pago,$stateBill)");

	
}


if($q1){
$cart_id = $con->insert_id;
$total = 0;
$ganancia = 0;


foreach($_SESSION["cart"] as $c){
	$total = $c['q'] * $c['pu'];
	$ganancia = $c['pu'] - $c['pc'];

	$q1 = $con->query("INSERT INTO `billdetails` (`idbillDetails`, `nombre`, `precio_c-u`, `precio_total`, `cantidad`, `bills_idbills`, `products_idproducts`, `precio_compra`, `precio_c-u_prom`, `dateRegister`, `ganancia_c-u`, stateBillDetail) VALUES ('','$c[nombreProducto]','$c[pu]','$total','$c[q]','$cart_id','$c[product_id]','$c[pc]', '$c[pp]',NOW(),'$ganancia', 1)");

	$sql = $con->query("SELECT * FROM `products` INNER JOIN productdetails ON idproducts=products_idproducts WHERE `idproducts`='$c[product_id]'");
	$array = mysqli_fetch_array($sql);
	$quantity = $array['quantityProduct'];
	$totalInventory = $array['totalItemsInventory'];
	$sale = $array['totalSales'];
	$saleProm = $array['totalSales_prom'];
	$item = $array['totalItem'];
	$precioBD = $array['precio'];
	$precioPromBD = $array['precio_promotion'];

	$quantityProduct = $quantity - $c['q'];
	$totalItemsInventory = $totalInventory - $c['q'];
	$totalSales = $sale + $c['q'];
	$totalSalesProm = $saleProm + $c['q'];
	$totalItem = $item - $c['q'];
	if ($c['pu'] == $precioBD) {
		$sql = $con->query("UPDATE `products` SET `quantityProduct`='$quantityProduct' WHERE `idproducts`='$c[product_id]'");
		$sql = $con->query("UPDATE `productdetails` SET `totalItemsInventory`='$totalItemsInventory', `totalSales`='$totalSales', `totalItem`='$totalItem' WHERE `idproductDetails`='$c[product_id]'");
	}else{
		$sql = $con->query("UPDATE `products` SET `quantityProduct`='$quantityProduct' WHERE `idproducts`='$c[product_id]'");
		$sql = $con->query("UPDATE `productdetails` SET `totalItemsInventory`='$totalItemsInventory', `totalSales_prom`='$totalSalesProm', `totalItem`='$totalItem' WHERE `idproductDetails`='$c[product_id]'");
	}

	

	$sql = $con->query("SELECT * FROM depositaccount INNER JOIN depositaccountdetails ON iddepositAccounts=depositAccount_iddepositAccounts");
	$array = mysqli_fetch_array($sql);
	$assets = $array['currentAssets'];
	$buy = $array['total_sales'];

	$total_buy = $buy + $c['q'];
}


$sql = $con->query("SELECT * FROM bills INNER JOIN billdetails ON idbills=bills_idbills WHERE idbills='$cart_id'");
$sql = $con->query("SELECT * FROM products INNER JOIN productdetails ON idproducts=products_idproducts WHERE idproducts='$cart_id'");
$total = 0;
foreach($_SESSION["cart"] as $c){
	$total += $c['q'] * $c['pu'];
}

if ($pago>=$total) {
	$currentAssets = $assets + $total;
	$sql = $con->query("UPDATE `depositaccountdetails` SET `currentAssets`='$currentAssets', `total_buy`='$total_buy' WHERE `iddepositAccountDetails`='1'");
}else{
	$currentAssets = $assets + $pago;
	$sql = $con->query("UPDATE `depositaccountdetails` SET `currentAssets`='$currentAssets', `total_buy`='$total_buy' WHERE `iddepositAccountDetails`='1'");
}

$sql = $con->query("UPDATE `bills` SET `precio_total`='$total', `precio_compras`='1', `impuesto`='1', `total_cancelado`='1', `saldo`='1', `cambio`='1' WHERE `idbills`='$cart_id'");


if ($pago>=$total) {
	$cambio = $pago - $total;
	$q2 = $con->query("INSERT INTO `movementdepositaccount` (`bills_idbills`, `cash_idcash`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`, `pago`, `saldo`) VALUES ('$cart_id', '$cash', '1', '6', '$total', '$dateTime', '$pago', '$cambio')");
}else{
	$saldo = $total - $pago;
	$q2 = $con->query("INSERT INTO `movementdepositaccount` (`bills_idbills`, `cash_idcash`, `users_idusers`, `typeMovement`, `totalMoney`, `dataRegister`, `pago`, `saldo`) VALUES ('$cart_id', '$cash', '1', '7', '$pago', '$dateTime', '$pago', '$saldo')");
}


$saldo = $total - $pago;
if ($pago>=$total) {
	$saldo = 0;
}
if (isset($_POST['codigocliente'])) {
	$clienteDocumento = $_POST['codigocliente'];
	$sql = $con->query("SELECT * FROM userdetails WHERE documentUser='$clienteDocumento'");
	$array = mysqli_fetch_array($sql);
	if ($array['range'] == 2) {
		$cliente = ucwords($array['nameUser'] . " " . $array['lastnameUser']);
	}else{
		if ($_POST['codigocliente'] != '') {
			$cliente = $_POST['codigocliente'];
		}else{
			$cliente = 'N/A';
		}
	}
}

if (isset($_SESSION['cash'])) {
	$caja = $_SESSION['cash'];
	$sql = $con->query("SELECT * FROM cashdetails WHERE nameCash='$caja'");
	$array = mysqli_fetch_array($sql);
	$cash = ucfirst($array['nameCash']);
}

$q2 = $con->query("INSERT INTO `billreports` (`bills_idbills`, `total`, `pago`, `saldo`, `cliente`, `empleado`, `caja`, `fecha`, `estado`, `typeBill`) VALUES ('$cart_id', '$total', '$pago', '$saldo', '$cliente', '1', '$cash', '$dateTime', '1', 'Venta')");



unset($_SESSION["cart"]);
unset($_SESSION["client"]);
}
}







if (isset($_POST['typeBill'])) {
	if ($_POST['typeBill'] == '1') {
		print "<script>window.location='".  URL ."cajas?caja=ventas&proceso=exitoso';</script>";
	}elseif ($_POST['typeBill'] == '2') {
		print "<script>window.location='".  URL ."cajas?caja=compras&proceso=exitoso';</script>";
	}elseif ($_POST['typeBill'] == '3') {
		print "<script>window.location='".  URL ."cajas?caja=cambios&proceso=exitoso';</script>";
	}elseif ($_POST['typeBill'] == '4') {
		print "<script>window.location='".  URL ."cajas?caja=devoluciones&proceso=exitoso';</script>";
	}else{
		print "<script>window.location='".  URL ."cajas?proceso=exitoso';</script>";
	}
}


?>