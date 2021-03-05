<?php

namespace models\ajax;


$server = "localhost";
$user = "root";
$password = ""; //poner tu propia contraseña, si tienes una.
$bd = "irocket";

$conexion = mysqli_connect($server, $user, $password, $bd);
if (!$conexion) {
	die('Error de Conexión: ' . mysqli_connect_errno());
}

$priceProduct = $_POST['priceProduct_1'];
$nameProduct = $_POST['nameProduct'];
$priceBuy = $_POST['priceBuy'];

if(isset($_POST['codeProduct_1'])){
	$code = $_POST['codeProduct_1'];
	
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code'
	";
}
if(isset($_POST['codeProduct_2'])){
	$code2 = $_POST['codeProduct_2'];

	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2'
	";
}
if(isset($_POST['codeProduct_3'])){
	$code3 = $_POST['codeProduct_3'];

	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3'
	";

}
if(isset($_POST['codeProduct_4'])){
	$code4 = $_POST['codeProduct_4'];

	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4'
	";
}
if(isset($_POST['codeProduct_5'])){
	$code5 = $_POST['codeProduct_5'];

	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4' OR
	codeProduct='$code5' OR codeProduct_promotion='$code5' OR codeProduct_promotion2='$code5' OR codeProduct_4='$code5' OR codeProduct_5='$code5' OR codeProduct_6='$code5' OR codeProduct_7='$code5' OR codeProduct_8='$code5' OR codeProduct_9='$code5' OR codeProduct_10='$code5'
	";
}
if(isset($_POST['codeProduct_6'])){
	$code6 = $_POST['codeProduct_6'];
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4' OR
	codeProduct='$code5' OR codeProduct_promotion='$code5' OR codeProduct_promotion2='$code5' OR codeProduct_4='$code5' OR codeProduct_5='$code5' OR codeProduct_6='$code5' OR codeProduct_7='$code5' OR codeProduct_8='$code5' OR codeProduct_9='$code5' OR codeProduct_10='$code5' Or
	codeProduct='$code6' OR codeProduct_promotion='$code6' OR codeProduct_promotion2='$code6' OR codeProduct_4='$code6' OR codeProduct_5='$code6' OR codeProduct_6='$code6' OR codeProduct_7='$code6' OR codeProduct_8='$code6' OR codeProduct_9='$code6' OR codeProduct_10='$code6'
	";
}
if(isset($_POST['codeProduct_7'])){
	$code7 = $_POST['codeProduct_7'];
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4' OR
	codeProduct='$code5' OR codeProduct_promotion='$code5' OR codeProduct_promotion2='$code5' OR codeProduct_4='$code5' OR codeProduct_5='$code5' OR codeProduct_6='$code5' OR codeProduct_7='$code5' OR codeProduct_8='$code5' OR codeProduct_9='$code5' OR codeProduct_10='$code5' Or
	codeProduct='$code6' OR codeProduct_promotion='$code6' OR codeProduct_promotion2='$code6' OR codeProduct_4='$code6' OR codeProduct_5='$code6' OR codeProduct_6='$code6' OR codeProduct_7='$code6' OR codeProduct_8='$code6' OR codeProduct_9='$code6' OR codeProduct_10='$code6' OR
	codeProduct='$code7' OR codeProduct_promotion='$code7' OR codeProduct_promotion2='$code7' OR codeProduct_4='$code7' OR codeProduct_5='$code7' OR codeProduct_6='$code7' OR codeProduct_7='$code7' OR codeProduct_8='$code7' OR codeProduct_9='$code7' OR codeProduct_10='$code7'
	";
}
if(isset($_POST['codeProduct_8'])){
	$code8 = $_POST['codeProduct_8'];
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4' OR
	codeProduct='$code5' OR codeProduct_promotion='$code5' OR codeProduct_promotion2='$code5' OR codeProduct_4='$code5' OR codeProduct_5='$code5' OR codeProduct_6='$code5' OR codeProduct_7='$code5' OR codeProduct_8='$code5' OR codeProduct_9='$code5' OR codeProduct_10='$code5' Or
	codeProduct='$code6' OR codeProduct_promotion='$code6' OR codeProduct_promotion2='$code6' OR codeProduct_4='$code6' OR codeProduct_5='$code6' OR codeProduct_6='$code6' OR codeProduct_7='$code6' OR codeProduct_8='$code6' OR codeProduct_9='$code6' OR codeProduct_10='$code6' OR
	codeProduct='$code7' OR codeProduct_promotion='$code7' OR codeProduct_promotion2='$code7' OR codeProduct_4='$code7' OR codeProduct_5='$code7' OR codeProduct_6='$code7' OR codeProduct_7='$code7' OR codeProduct_8='$code7' OR codeProduct_9='$code7' OR codeProduct_10='$code7' OR
	codeProduct='$code8' OR codeProduct_promotion='$code8' OR codeProduct_promotion2='$code8' OR codeProduct_4='$code8' OR codeProduct_5='$code8' OR codeProduct_6='$code8' OR codeProduct_7='$code8' OR codeProduct_8='$code8' OR codeProduct_9='$code8' OR codeProduct_10='$code8'
	";
}
if(isset($_POST['codeProduct_9'])){
	$code9 = $_POST['codeProduct_9'];
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4' OR
	codeProduct='$code5' OR codeProduct_promotion='$code5' OR codeProduct_promotion2='$code5' OR codeProduct_4='$code5' OR codeProduct_5='$code5' OR codeProduct_6='$code5' OR codeProduct_7='$code5' OR codeProduct_8='$code5' OR codeProduct_9='$code5' OR codeProduct_10='$code5' Or
	codeProduct='$code6' OR codeProduct_promotion='$code6' OR codeProduct_promotion2='$code6' OR codeProduct_4='$code6' OR codeProduct_5='$code6' OR codeProduct_6='$code6' OR codeProduct_7='$code6' OR codeProduct_8='$code6' OR codeProduct_9='$code6' OR codeProduct_10='$code6' OR
	codeProduct='$code7' OR codeProduct_promotion='$code7' OR codeProduct_promotion2='$code7' OR codeProduct_4='$code7' OR codeProduct_5='$code7' OR codeProduct_6='$code7' OR codeProduct_7='$code7' OR codeProduct_8='$code7' OR codeProduct_9='$code7' OR codeProduct_10='$code7' OR
	codeProduct='$code8' OR codeProduct_promotion='$code8' OR codeProduct_promotion2='$code8' OR codeProduct_4='$code8' OR codeProduct_5='$code8' OR codeProduct_6='$code8' OR codeProduct_7='$code8' OR codeProduct_8='$code8' OR codeProduct_9='$code8' OR codeProduct_10='$code8' OR
	codeProduct='$code9' OR codeProduct_promotion='$code9' OR codeProduct_promotion2='$code9' OR codeProduct_4='$code9' OR codeProduct_5='$code9' OR codeProduct_6='$code9' OR codeProduct_7='$code9' OR codeProduct_8='$code9' OR codeProduct_9='$code9' OR codeProduct_10='$code9'
	";
}
if(isset($_POST['codeProduct_10'])){
	$code10 = $_POST['codeProduct_10'];
	$query = "SELECT * FROM products WHERE 
	codeProduct='$code' OR codeProduct_promotion='$code' OR codeProduct_promotion2='$code' OR codeProduct_4='$code' OR codeProduct_5='$code' OR codeProduct_6='$code' OR codeProduct_7='$code' OR codeProduct_8='$code' OR codeProduct_9='$code' OR codeProduct_10='$code' OR
	codeProduct='$code2' OR codeProduct_promotion='$code2' OR codeProduct_promotion2='$code2' OR codeProduct_4='$code2' OR codeProduct_5='$code2' OR codeProduct_6='$code2' OR codeProduct_7='$code2' OR codeProduct_8='$code2' OR codeProduct_9='$code2' OR codeProduct_10='$code2' OR
	codeProduct='$code3' OR codeProduct_promotion='$code3' OR codeProduct_promotion2='$code3' OR codeProduct_4='$code3' OR codeProduct_5='$code3' OR codeProduct_6='$code3' OR codeProduct_7='$code3' OR codeProduct_8='$code3' OR codeProduct_9='$code3' OR codeProduct_10='$code3' OR
	codeProduct='$code4' OR codeProduct_promotion='$code4' OR codeProduct_promotion2='$code4' OR codeProduct_4='$code4' OR codeProduct_5='$code4' OR codeProduct_6='$code4' OR codeProduct_7='$code4' OR codeProduct_8='$code4' OR codeProduct_9='$code4' OR codeProduct_10='$code4' OR
	codeProduct='$code5' OR codeProduct_promotion='$code5' OR codeProduct_promotion2='$code5' OR codeProduct_4='$code5' OR codeProduct_5='$code5' OR codeProduct_6='$code5' OR codeProduct_7='$code5' OR codeProduct_8='$code5' OR codeProduct_9='$code5' OR codeProduct_10='$code5' Or
	codeProduct='$code6' OR codeProduct_promotion='$code6' OR codeProduct_promotion2='$code6' OR codeProduct_4='$code6' OR codeProduct_5='$code6' OR codeProduct_6='$code6' OR codeProduct_7='$code6' OR codeProduct_8='$code6' OR codeProduct_9='$code6' OR codeProduct_10='$code6' OR
	codeProduct='$code7' OR codeProduct_promotion='$code7' OR codeProduct_promotion2='$code7' OR codeProduct_4='$code7' OR codeProduct_5='$code7' OR codeProduct_6='$code7' OR codeProduct_7='$code7' OR codeProduct_8='$code7' OR codeProduct_9='$code7' OR codeProduct_10='$code7' OR
	codeProduct='$code8' OR codeProduct_promotion='$code8' OR codeProduct_promotion2='$code8' OR codeProduct_4='$code8' OR codeProduct_5='$code8' OR codeProduct_6='$code8' OR codeProduct_7='$code8' OR codeProduct_8='$code8' OR codeProduct_9='$code8' OR codeProduct_10='$code8' OR
	codeProduct='$code9' OR codeProduct_promotion='$code9' OR codeProduct_promotion2='$code9' OR codeProduct_4='$code9' OR codeProduct_5='$code9' OR codeProduct_6='$code9' OR codeProduct_7='$code9' OR codeProduct_8='$code9' OR codeProduct_9='$code9' OR codeProduct_10='$code9' OR
	codeProduct='$code10' OR codeProduct_promotion='$code10' OR codeProduct_promotion2='$code10' OR codeProduct_4='$code10' OR codeProduct_5='$code10' OR codeProduct_6='$code10' OR codeProduct_7='$code10' OR codeProduct_8='$code10' OR codeProduct_9='$code10' OR codeProduct_10='$code10'
	";
}


$result = mysqli_query($conexion, $query);
$row = mysqli_num_rows($result);
if ($row == 0) {
	if ($priceProduct == '' or $nameProduct == '' or $priceBuy == '') {
		echo "1"; //NO
	} else {
		echo "2"; //SI
	}
} else {
	echo "1"; //NO
}