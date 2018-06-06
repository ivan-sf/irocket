<?php
/*
* Agrega el producto a la variable de sesion de productos.
*/
include '../../../../../../config.php';
session_start();
if(!empty($_POST)){
	if(isset($_POST["product_id"]) && isset($_POST["q"] )){
		// si es el primer producto simplemente lo agregamos
		if(empty($_SESSION["cart"])){
			$_SESSION["cart"]=array( array("product_id"=>$_POST["product_id"],"q"=> $_POST["q"],"nombreProducto"=> $_POST["nameProduct"],"pu"=> $_POST["precio"],"pc"=> $_POST["precio2"],"codeProduct"=> $_POST["codeProduct"],"codeProduct_promotion"=> $_POST["codeProduct_promotion"],"pp"=> $_POST["precio_promotion"]));
			
		if (isset($_POST["codeClient"])) {
			$_SESSION["client"]=$_POST["codeClient"];
		}else{
			$_SESSION["client"]="";
		}
			
		}else{
			// apartie del segundo producto:
			$cart = $_SESSION["cart"];
			$repeated = false;
			// recorremos el carrito en busqueda de producto repetido
			foreach ($cart as $c) {
				// si el producto esta repetido rompemos el ciclo
				if($c["product_id"]==$_POST["product_id"]){
					$repeated=true;
					break;
				}
			}
			// si el producto es repetido no hacemos nada, simplemente redirigimos
			if($repeated){
				array_push($cart, array("product_id"=>$_POST["product_id"],"q"=> $_POST["q"],"nombreProducto"=> $_POST["nameProduct"],"pu"=> $_POST["precio"],"pc"=> $_POST["precio2"],"codeProduct"=> $_POST["codeProduct"],"codeProduct_promotion"=> $_POST["codeProduct_promotion"],"pp"=> $_POST["precio_promotion"]));
				$_SESSION["cart"] = $cart;
				if ($_SESSION["client"]=="") {
					if (isset($_POST["codeClient"])) {
						$_SESSION["client"]=$_POST["codeClient"];
					}else{
						$_SESSION["client"]="";
					}
				}else{
					
				}
				
			}else{
				// si el producto no esta repetido entonces lo agregamos a la variable cart y despues asignamos la variable cart a la variable de sesion
				array_push($cart, array("product_id"=>$_POST["product_id"],"q"=> $_POST["q"],"nombreProducto"=> $_POST["nameProduct"],"pu"=> $_POST["precio"],"pc"=> $_POST["precio2"],"codeProduct"=> $_POST["codeProduct"],"codeProduct_promotion"=> $_POST["codeProduct_promotion"],"pp"=> $_POST["precio_promotion"]));
				$_SESSION["cart"] = $cart;
				if ($_SESSION["client"]=="") {
					if (isset($_POST["codeClient"])) {
						$_SESSION["client"]=$_POST["codeClient"];
					}else{
						$_SESSION["client"]="";
					}
				}else{
					
				}
			}
		}
			if ($_POST['caja'] == 'ventas') {
				print "<script>window.location='". URL ."cajas?caja=ventas';</script>";
			}elseif ($_POST['caja'] == 'compras') {
				print "<script>window.location='". URL ."cajas?caja=compras';</script>";
			}elseif ($_POST['caja'] == 'cambios') {
				print "<script>window.location='". URL ."cajas?caja=cambios';</script>";
			}elseif ($_POST['caja'] == 'devoluciones') {
				print "<script>window.location='". URL ."cajas?caja=devoluciones';</script>";
			}else{
				print "<script>window.location='". URL ."cajas?caja=compras';</script>";
			}
	}
}

?>

