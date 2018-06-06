<?php
/*
* Eliminar un producto del carrito
*/

include '../../../../../../config.php';

session_start();
if(!empty($_SESSION["cart"])){
	$cart  = $_SESSION["cart"];
	if(count($cart)==1){ unset($_SESSION["cart"]); }
	else{
		$newcart = array();
		foreach($cart as $c){
			if($c["product_id"]!=$_GET["id"]){
				$newcart[] = $c;
			}
		}
		$_SESSION["cart"] = $newcart;
	}
}

if (isset($_GET['caja'])) {
	if ($_GET['caja'] == 'ventas') {
		print "<script>window.location='". URL ."cajas?caja=ventas';</script>";
	}elseif ($_GET['caja'] == 'compras') {
		print "<script>window.location='". URL ."cajas?caja=compras';</script>";
	}elseif ($_GET['caja'] == 'cambios') {
		print "<script>window.location='". URL ."cajas?caja=cambios';</script>";
	}elseif ($_GET['caja'] == 'devoluciones') {
		print "<script>window.location='". URL ."cajas?caja=devoluciones';</script>";
	}else{
		print "<script>window.location='". URL ."cajas?caja=ventas';</script>";
	}
}
?>

