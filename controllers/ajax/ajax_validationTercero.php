<?php namespace models\ajax;
include 'conexion.php';

$name = $_POST['idUser'];
$tipoPersona = $_POST['tipoPersona'];
$idUser = $_POST['idUser'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$razonSocial = $_POST['razonSocial'];
$nombreComercial = $_POST['nombreComercial'];
$tipodocumento = $_POST['tipodocumento'];
$documento = $_POST['documento'];
$digVer = $_POST['digVer'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pais = $_POST['pais'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$direccion = $_POST['direccion'];

$query = "SELECT * FROM userdetails WHERE documentUser=$documento";
$result = mysqli_query($conexion, $query);
if($result){
	$row = mysqli_num_rows($result);
}else{
	$row=0;
}



if(isset($_POST['tipoCliente'])){
	$tipoCliente = $_POST['tipoCliente'];
}else{
	$tipoCliente = 0;
}

if(isset($_POST['tipoProveedor'])){
	$tipoProveedor = $_POST['tipoProveedor'];
}else{
	$tipoProveedor= 0;
}

if(isset($_POST['tipoEmpleado'])){
	$tipoEmpleado = $_POST['tipoEmpleado'];
}else{
	$tipoEmpleado= 0;
}

if(isset($_POST['tipoOtro'])){
	$tipoOtro = $_POST['tipoOtro'];
}else{
	$tipoOtro= 0;
}
if($row>=1){
	echo "El documento ya esta registrado.";
}
else if($tipoCliente==0 AND $tipoEmpleado==0 AND $tipoOtro==0 AND $tipoProveedor==0){
	echo "Seleccione al menos un tipo de usuario.";
}
else if($tipoPersona==2 AND $razonSocial == '' AND $nombreComercial==''){
	echo 'Ingrese el nombre de la razon social y el nombre comercial.';
}
else if ($tipoPersona==1 AND $nombres == '' OR $apellidos == '' OR $documento == '' OR $digVer == '') {
	echo "Los campos con * son obligatorios.";
}else{
	echo "2";
}
