<?php 
include '../../../../../../config.php';

session_start();
if (isset($_SESSION['adminUserNew'])) {
	$user = $_SESSION['adminUserNew'];
}elseif (isset($_SESSION['UserNew'])) {
	$user = $_SESSION['UserNew'];
}
if(!empty($_POST)){
$q1 = $con->query("insert into bills(users_idusers,cash_idcash,cliente,fecha,codeBar,typeBill) value($user,1,'',NOW(),'',1)");

if($q1){
$cart_id = $con->insert_id;
$total = 0;
foreach($_SESSION["cart"] as $c){
	$total += $c['q'] * $c['pu'];
	$q1 = $con->query("INSERT INTO `irocket`.`billdetails` (`idbillDetails`, `nombre`, `precio_c-u`, `precio_total`, `cantidad`, `bills_idbills`, `products_idproducts`) VALUES ('','$c[nombreProducto]','$c[pu]','$total','$c[q]','$cart_id','$c[product_id]')");
}

unset($_SESSION["cart"]);
}
}





print "<script>window.location='".  URL ."cajas';</script>";
?>